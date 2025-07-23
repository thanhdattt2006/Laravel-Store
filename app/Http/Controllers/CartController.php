<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Voucher;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {
        return view('shop/shoppingCart');
    }

    public function add(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please log in.'], 401);
        }

        // ✅ Validate đầu vào
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'size' => 'nullable|integer|min:36|max:46',
            'color_id' => 'nullable|exists:colors,id'
        ]);

        $productId = $validated['product_id'];
        $size = $validated['size'] ?? 36;
        $colorId = $validated['color_id'] ?? null;

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Invalid product.'], 422);
        }

        // ✅ Tạo hoặc lấy cart của user
        $cart = Cart::firstOrCreate(['account_id' => $user->id]);
        $quantity = $request->input('quantity', 1);

        // ✅ Tìm xem item đã tồn tại trong cart chưa
        $item = CartItem::where([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'size' => $size,
            'color_id' => $colorId
        ])->first();

        if ($item) {
            $item->quantity += $quantity;
        } else {
            $item = new CartItem([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'size' => $size,
                'color_id' => $colorId
            ]);
        }

        // ✅ Tính total và lưu lại
        $item->total = $item->quantity * $product->price;

        if (!$item->save()) {
            return response()->json(['success' => false, 'message' => 'Cannot save cart item.'], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart_item_id' => $item->id
        ]);
    }


    public function showShoppingCart(Request $request)
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'loggedIn' => false,
                    'message' => 'Bạn cần đăng nhập để xem giỏ hàng.'
                ], 401);
            }

            return redirect()->route('account.login')->with('error', 'Vui lòng đăng nhập.');
        }

        $user = auth()->user();
        $cart = Cart::where('account_id', $user->id)->first();

        $cartItems = $cart
            ? $cart->cartItems()->with(['product', 'product.variant.colors'])->orderByDesc('id')->get()
            : collect();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        if ($request->expectsJson()) {
            return response()->json([
                'loggedIn' => true,
                'subtotal' => $subtotal,
                'cartItems' => $cartItems // Nếu cần render client-side
            ]);
        }

        return view('shop.shoppingCart', compact('cartItems', 'subtotal'));
    }



    public function destroy($id)
    {
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm.'], 404);
        }

        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Product removed from cart successfully.']);
    }



    // thay đổi số lượng
    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::with('product')->find($request->id);

        if (!$cartItem || !$cartItem->product) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'
            ], 404);
        }

        $quantity = max(1, (int)$request->quantity);
        $cartItem->quantity = $quantity;
        $cartItem->total = $quantity * $cartItem->product->price;
        $cartItem->save();

        // ✅ Lấy cart gốc và tính lại subtotal
        $cart = Cart::with('cartItems.product')->find($cartItem->cart_id);

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy giỏ hàng.'
            ]);
        }

        $subtotal = $cart->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return response()->json([
            'success' => true,
            'total' => $cartItem->total,
            'subtotal' => $subtotal
        ]);
    }


    //update size lên database

    public function updateSize(Request $request)
    {
        logger('== DEBUG UPDATE SIZE ==', $request->all());

        $validated = $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'size' => 'required|integer|min:36|max:46'
        ]);

        $user = auth()->user();
        if (!$user) {
            logger('❌ User not logged in');
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $cartItem = CartItem::with('cart')->find($validated['cart_item_id']);

        if (!$cartItem || !$cartItem->cart || $cartItem->cart->account_id !== $user->id) {
            logger('❌ Permission denied', ['user_id' => $user->id, 'cart_owner' => optional($cartItem->cart)->account_id]);
            return response()->json(['success' => false, 'message' => 'Permission denied'], 403);
        }

        logger('✅ Updating size', ['old' => $cartItem->size, 'new' => $validated['size']]);

        $cartItem->size = $validated['size'];
        $cartItem->save();

        return response()->json(['success' => true, 'message' => 'Size updated']);
    }

    // cập nhật màu lên database
    public function updateColor(Request $request)
    {
        try {
            $request->validate([
                'cart_item_id' => 'required|exists:cart_items,id',
                'color_id' => 'required|exists:colors,id',
            ]);

            $item = CartItem::find($request->cart_item_id);

            if (!$item) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy cart item.'], 404);
            }

            $item->color_id = $request->color_id;

            // Cập nhật lại tổng nếu cần (nếu giá thay đổi theo màu thì xử lý ở đây)
            $item->total = $item->quantity * $item->product->price;

            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật màu sản phẩm thành công.'
            ]);
        } catch (\Throwable $e) {
            \Log::error('Lỗi updateColor: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }



    public function payment()
    {
        $data = [
            'payments' => Payment::pluck('name')
        ];
        return view('shop/productCheckout')->with($data);
    }


    // mã giảm giá
    public function applyVoucher(Request $request)
    {
        $code = $request->input('keyword');
        $voucher = Voucher::where('code_name', $code)->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid voucher code.'
            ]);
        }

        // Check nếu voucher chỉ được dùng 1 lần (giả sử là global)
        $isUsed = Order::where('voucher_discount_id', $voucher->id)->exists();
        if ($isUsed) {
            return response()->json([
                'success' => false,
                'message' => 'This voucher has already been used.'
            ]);
        }

        // Giả sử bạn có $subtotal truyền vào (hoặc lấy lại từ session)
        $subtotal = session('subtotal') ?? 0; // <-- bạn gán subtotal vào session trước đó

        $discounted = $subtotal * (1 - $voucher->discount_percent / 100);

        return response()->json([
            'success' => true,
            'message' => 'Voucher applied successfully.',
            'subtotal' => number_format($discounted, 0, ',', '.') . ' đ',
            'voucher_id' => $voucher->id
        ]);
    }
}
