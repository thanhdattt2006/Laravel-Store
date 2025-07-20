<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

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

    $productId = $request->input('product_id');
    $product = Product::find($productId);
    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Invalid product.'], 422);
    }

    $cart = Cart::firstOrCreate(['account_id' => $user->id]);

    $item = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $productId)
        ->first();

    if ($item) {
        $item->quantity += 1;
    } else {
        $item = new CartItem([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => 1,
            'total' => $product->price, // quantity = 1
            'size' => 36 // Mặc định size
        ]);
    }

    $item->total = $item->quantity * $product->price;

    // Bắt lỗi khi không lưu được
    if (!$item->save()) {
        return response()->json([
            'success' => false,
            'message' => 'Cannot save cart item.'
        ], 500);
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
                'message' => 'You need to log in to view your cart.'
            ], 401);
        }

        return redirect()->route('account.login')->with('error', 'Please log in first.');
    }

    $user = auth()->user();
    $cart = Cart::where('account_id', $user->id)->first();

    $cartItems = $cart
        ? $cart->cartItems()->with(['product', 'product.variant.colors'])->orderByDesc('id')->get()
        : collect(); // Giỏ trống vẫn trả về collection

    return view('shop.shoppingCart', compact('cartItems'));
}

    public function destroy($id)
    {
        $cartItem = CartItem::find($id);

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('shop.shoppingCart')->with('delete', 'Product removed from cart successfully.');
        }

        return redirect()->route('shop.shoppingCart')->with('errordelete', 'Product not found in cart.');
    }

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

        // Tính tổng toàn bộ giỏ hàng của user hiện tại
        $totalCart = CartItem::whereHas('cart', function ($query) {
            $query->where('account_id', Auth::id());
        })->sum('total');

        return response()->json([
            'success' => true,
            'total' => $cartItem->total,
            'totalCart' => $totalCart
        ]);
    }
    public function updateSize(Request $request)
{
    $request->validate([
        'cart_item_id' => 'required|exists:cart_items,id',
        'size' => 'required|integer|min:36|max:46'
    ]);

    $user = auth()->user();
    if (!$user) return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);

    $cartItem = CartItem::find($request->cart_item_id);

    if ($cartItem->cart->account_id !== $user->id) {
        return response()->json(['success' => false, 'message' => 'Permission denied'], 403);
    }

    $cartItem->size = $request->size;
    $cartItem->save();

    return response()->json(['success' => true, 'message' => 'Size updated']);
}

    // public function show(){
    //     $data =[
    //         'products' => Product::get()
    //     ];
    //     return view('shop/shoppingCart')->with($data);
    // }

}
