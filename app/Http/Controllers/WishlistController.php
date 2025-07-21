<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Hiển thị danh sách wishlist
    public function index()
    {
        $userId = Auth::id();

        // Lấy sản phẩm user đã thêm vào wishlist
        $wishlistItems = Wishlist::with('product')
            ->where('account_id', $userId)
            ->get();

        return view('shop/wishlistProduct', compact('wishlistItems'));
    }

    // Thêm sản phẩm vào wishlist
    public function add($productId)
    {
        $userId = Auth::id();

        // Kiểm tra đã có chưa để tránh thêm trùng
        $exists = Wishlist::where('account_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'account_id' => $userId,
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào wishlist!');
    }

    // Xóa sản phẩm khỏi wishlist
    public function remove($productId)
    {
        $userId = Auth::id();

        Wishlist::where('account_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Đã xóa khỏi wishlist!');
    }
}
