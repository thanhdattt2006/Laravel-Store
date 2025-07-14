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

        $data = [
            'cates' => Cate::get(),
            'products' => Product::paginate(6),
            'photo' => Product::pluck('name'),
            'colors' => Colors::all(),
        ];
        return view('shop/shopCategory')->with($data);
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
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'photo' => $product->photo,
                'quantity' => 1,
            ];

            // 👉 Đưa sản phẩm mới lên đầu
            $cart = array_reverse($cart, true);
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
    // Function phân trang cho các Cates theo id
    public function showByCategory($cate_id)
    {
        $data = [
            'cates' => Cate::get(),
            'productByCate' => Product::where('cate_id', $cate_id)->paginate(6),
            'products' => Product::paginate(6),
            'photo' => Product::pluck('name'),
            'colors' => Colors::all(),
        ];
        return view('shop.shopCategory')->with($data);
    }
}
