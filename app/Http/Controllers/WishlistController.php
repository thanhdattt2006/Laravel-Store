<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Hiển thị danh sách wishlist
    public function index()
    {
        $userId = Auth::user()->id;

        // Lấy sản phẩm user đã thêm vào wishlist
        $wishlistItems = Wishlist::with('product.variant.photos')
            ->where('account_id', $userId)
            ->get();

        return view('shop/wishlistProduct', compact('wishlistItems'));
    }

    // Thêm sản phẩm vào wishlist
    public function add($productId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please log in to add products to wishlist.');
        }

        $userId = Auth::user()->id;

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
            return redirect()->back()->with('success', 'Product added to wishlist successfully!');
        } else {
            return redirect()->back()->with('info', 'The product is already in the wishlist.');
        }
    }

    public function ajaxAdd(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please log in to add products to wishlist.']);
        }

        $userId = Auth::user()->id;
        $productId = $request->product_id;

        $exists = Wishlist::where('account_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'The product is already in the wishlist.']);
        }

        Wishlist::create([
            'account_id' => $userId,
            'product_id' => $productId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Product added to wishlist successfully!']);
    }


    // Xóa sản phẩm khỏi wishlist
    public function remove($productId)
    {
        $userId = Auth::user()->id;

        Wishlist::where('account_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'The product has been removed from the wishlist.');
    }
}
