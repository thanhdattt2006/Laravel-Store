<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('shop/shoppingCart');
    }

    public function addToCart(Request $request)
    {
        // Validate dữ liệu từ client
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->quantity ?? 1;

        // Tìm cart theo account_id (nếu chưa có thì tạo mới)
        $cart = Cart::firstOrCreate(['account_id' => $request->account_id]);

        // Tìm sản phẩm trong cart_items
        $existingItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($existingItem) {
            // Nếu đã tồn tại, tăng số lượng
            $existingItem->quantity += $quantity;
            $existingItem->save();
        } else {
            // Nếu chưa có, tạo mới
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $quantity
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
    }
    public function showCart($accountId)
    {
        $cart = Cart::with(['items.product']) // eager load luôn sản phẩm
            ->where('account_id', $accountId)
            ->first();

        if (!$cart) {
            return response()->json(['success' => true, 'data' => [], 'message' => 'Cart is empty.']);
        }

        $cartItems = $cart->items->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'product_name' => $item->product->name ?? '(deleted)',
                'price' => $item->product->price ?? 0,
                'quantity' => $item->quantity,
                'subtotal' => ($item->product->price ?? 0) * $item->quantity
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $cartItems,
            'total' => $cartItems->sum('subtotal')
        ]);
    }
    public function showCartPage()
    {
        $accountId = Auth::user()->id; // đảm bảo đúng ID
        $cart = Cart::firstOrCreate(['account_id' => $accountId]);
        $cart->load(['items.product']);

        return view('shop.shoppingCart', compact('cart'));
    }
}
