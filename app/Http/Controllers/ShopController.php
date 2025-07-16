<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Colors;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopCategory(Request $request)
    {
        // 1. Lọc ID sản phẩm theo màu nếu có
        $filteredProductIds = Product_variant::when($request->color_id, function ($query) use ($request) {
            $query->whereIn('colors_id', (array) $request->color_id);
        })->pluck('product_id')->unique();

        // 2. Lọc sản phẩm theo ID đã lọc ở bước 1 + cate_id nếu có
        $query = Product::query();

        if ($request->filled('color_id') && $filteredProductIds->isNotEmpty()) {
            $query->whereIn('id', $filteredProductIds);
        }

        if ($request->filled('cate_id')) {
            $query->where('cate_id', $request->cate_id);
        }

        //  Lọc theo khoảng giá từ select option
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) == 2) {
                $query->whereBetween('price', [$range[0], $range[1]]);
            }
        }

        // 3. Dữ liệu truyền ra view
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


    // Thêm vào giỏ hàng khó vcl đừng đụng !!! //
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product_variant = Product_variant::where('product_id', $id)->get();
        $colorIds = Product_variant::where('product_id', $id)->pluck('colors_id')->unique();
        $colors = Colors::whereIn('id', $colorIds)->get();

        $selectedColorId = request()->query('color_id');

        if (!$selectedColorId) {
            $firstVariant = Product_variant::where('product_id', $id)->first();
            $selectedColorId = $firstVariant?->colors_id ?? null;
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ]);
        }

        $cart = session()->get('shoppingCart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;

            // Đưa item lên đầu
            $item = $cart[$id];
            unset($cart[$id]);
            $cart = [$id => $item] + $cart;
        } else {
            $cart = [
                $id => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'photo' => $product->photo,
                    'size' => 36,
                    'quantity' => 1,
                    'colors' => $colors,
                    'selectedColorId' => $selectedColorId,
                    'product_variant' =>  $product_variant
                ]
            ] + $cart;
        }

        session()->put('shoppingCart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
        ]);
    }




    // lấy dữ liệu in lên shoppingCart
    public function showCart()
    {
        $cart = session('shoppingCart', []);
        return view('shop/shoppingCart', compact('cart'));
    }

    // xóa sản phẩm trong giỏ hàng
    public function removeFromCart($id)
    {
        $cart = session('shoppingCart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['shoppingCart' => $cart]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    // update giỏ hàng khi ấn tăng số lượng
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('shoppingCart', []);

        if (isset($cart[$id])) {
            $quantity = (int) $request->input('quantity');

            if ($quantity < 1) $quantity = 1;

            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['total'] = $cart[$id]['price'] * $quantity;

            session(['shoppingCart' => $cart]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
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
                'product_variant' =>  $product_variant

            ];
        return view('shop/productDetails')->with($data);
    }
}
