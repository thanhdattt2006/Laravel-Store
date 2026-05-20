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
    protected $productService;

    public function __construct(\App\Services\ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function shopCategory(Request $request)
    {
        $query = Product::with(['variant.photos', 'variant.colors']);

        // Nếu có keyword, áp dụng tìm kiếm
    if ($request->filled('keyword')) {
        $keyword = $request->input('keyword');
        $query->where('name', 'like', '%' . $keyword . '%');
    } else {
        // Filter by Color
        if ($request->filled('color_id')) {
            $filteredProductIds = Product_variant::whereIn('colors_id', (array) $request->color_id)
                ->pluck('product_id')->unique();

            if ($filteredProductIds->isNotEmpty()) {
                $query->whereIn('id', $filteredProductIds);
            } else {
                $query->whereRaw('0 = 1'); // Không có sản phẩm phù hợp
            }
        }

        // Filter by Category
        if ($request->filled('cate_id')) {
            $query->where('cate_id', $request->cate_id);
        }

        // Filter by Price
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) === 2) {
                $query->whereBetween('price', [$range[0], $range[1]]);
            }
        }
    }

    $productsfilter = $query->orderBy('id', 'desc')->paginate(6)->appends($request->all());

    return view('shop.shopCategory', [
        'productsfilter' => $productsfilter,
        'products' => $this->productService->getProductsWithVariants(6),
        'colors' => Colors::all(),
        'cates' => Cate::get(),
        'keyword' => $request->keyword
    ]);
}



    public function productDetails()
    {

        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('shop/productDetails')->with($data);
    }


    public function shoppingCart()
    {

        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('shop/shoppingCart')->with($data);
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
        $details = $this->productService->getProductDetails($id, request()->query('color_id'));
        
        $data = array_merge($details, [
            'names' => Cate::pluck('name'),
            'products' => $this->productService->getProductsWithVariants(9), // Only get what we need, with relations
            'review' => $details['reviews'] // Map to the view's expected variable name
        ]);

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
        $averageRating = Review::where('product_id', $request->product_id)->avg('rating');

        return response()->json([
            'message' => 'Bình luận đã được gửi thành công!',
            'review' => [
                'fullname' => $account->fullname,
                'created_at' => now()->format('d/m/Y H:i'),
                'comment' => $review->comment,
                'rating' => $review->rating,

            ],
            'average_rating' => number_format($averageRating, 1),
        ]);
    }
}
