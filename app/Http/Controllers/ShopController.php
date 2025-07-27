<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cart;
use App\Models\Cate;
use App\Models\Colors;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Review;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function shopCategory(Request $request)
    {
        // Filter by Color
        $filteredProductIds = Product_variant::when($request->color_id, function ($query) use ($request) {
            $query->whereIn('colors_id', (array) $request->color_id);
        })->pluck('product_id')->unique();

        // Filter by Category
        $query = Product::query();

        if ($request->filled('color_id') && $filteredProductIds->isNotEmpty()) {
            $query->whereIn('id', $filteredProductIds);
        }

        if ($request->filled('cate_id')) {
            $query->where('cate_id', $request->cate_id);
        }

        //  Filter by Price range
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) == 2) {
                $query->whereBetween('price', [$range[0], $range[1]]);
            }
        }

        // Show
        $data = [
            'productsfilter' => $query->orderBy('id', 'desc')->paginate(6)->appends($request->all()),
            'products' => Product::orderBy('id', 'desc')->paginate(6),
            'colors' => Colors::all(),
            'cates' => Cate::get(),
        ];

        return view('shop.shopCategory')->with($data);
    }
    public function productDetails()
    {

        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('shop/productDetails')->with($data);
    }

    public function productCheckout()
    {

        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('shop/productCheckout')->with($data);
    }

    public function shoppingCart()
    {

        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('shop/shoppingCart')->with($data);
    }
    public function confirmation()
    {

        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('shop/confirmation')->with($data);
    }
    public function searchByKeyword(Request $request)
    {
        $keyword = $request->get('keyword');
        $data = [
            'cates' => Cate::get(),
            'names' => Cate::pluck('name'),
            'products' => Product::get(),
            'photo' => Product::pluck('name'),
            'colors' => Colors::all(),
            'products' => Product::where('name', 'like', '%' . $keyword . '%')->get(),
            'keyword' => $keyword
        ];
        return view('shop/shopCategory')->with($data);
    }

    public function show($id)
    {
        $product = Product::with('cate', 'variant')->findOrFail($id);
        $reviews = Review::where('product_id', $id)->get();

        $product_variant = Product_variant::where('product_id', $id)->get();
        $variantIds = Product_variant::where('product_id', $id)->pluck('id');
        $photos = Photo::whereIn('product_variant_id', $variantIds)->get();
        $colorIds = Product_variant::where('product_id', $id)->pluck('colors_id')->unique();
        $colors = Colors::whereIn('id', $colorIds)->get();

        $selectedColorId = request()->query('color_id');

        if (!$selectedColorId) {
            $firstVariant = Product_variant::where('product_id', $id)->first();
            $selectedColorId = $firstVariant?->colors_id ?? null;
        }
        $data =
            [
                'product' => $product,
                'names' => Cate::pluck('name'),
                'photos' => $photos,
                'colors' => $colors,
                'selectedColorId' => $selectedColorId,
                'product_variant' =>  $product_variant,
                'products' => Product::get(),
                'review' => $reviews
            ];
        return view('shop/productDetails')->with($data);
    }


   public function storeReview(Request $request)
{
    $accountId = session('account_id');
    if (!$accountId) {
        return response()->json(['message' => 'Bạn chưa đăng nhập.'], 401);
    }

    $account = Account::find($accountId);
    if (!$account) {
        return response()->json(['message' => 'Tài khoản không tồn tại.'], 404);
    }

    $review = new Review();
    $review->account_id = $accountId;
    $review->product_id = $request->input('product_id');
    $review->comment = $request->input('comment');
    $review->rating = $request->input('rating');

    $review->created_at = now();
    $review->updated_at = now();
    $review->save();

    return response()->json([
        'message' => 'Bình luận đã được gửi thành công!',
        'review' => [
            'fullname' => $account->fullname,
            'created_at' => now()->format('d/m/Y H:i'),
            'comment' => $review->comment,
            'rating' => $review->rating,

        ]
    ]);
}

}
