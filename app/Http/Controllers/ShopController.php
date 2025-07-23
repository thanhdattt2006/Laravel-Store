<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cate;
use App\Models\Colors;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Review;
use Illuminate\Http\Request;

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
            'productsfilter' => $query->paginate(6)->appends($request->all()),
            'products' => Product::paginate(6),
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
            ];
        return view('shop/productDetails')->with($data);
    }
    public function cmt()
    {
        
    }

}
