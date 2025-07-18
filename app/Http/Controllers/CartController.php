<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('shop/shoppingCart');
    }

    public function add(Request $request)
    {
        $accountId = Auth::id();
        $productId = $request->input('product_id');

        // Tìm hoặc tạo cart
        $cart = Cart::firstOrCreate(['account_id' => $accountId]);

        // Tìm item trong cart
        $item = CartItems::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            // Nếu có rồi thì tăng số lượng
            $item->quantity += 1;
            $item->save();
        } else {
            // Nếu chưa có thì tạo mới
            CartItems::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }
}
