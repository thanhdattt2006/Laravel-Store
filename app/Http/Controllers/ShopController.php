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
            'names' => Cate::pluck('name'),
            'products' => Product::paginate(6),
            'photo' => Product::pluck('name'),
            'colors' => Colors::pluck('name'),
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
            'colors' => Colors::pluck('name'),
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
                'message' => 'Sản phẩm không tồn tại'
            ]);
        }

        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('shoppingCart', []);

        // Nếu sản phẩm đã có, tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Nếu chưa có, thêm mới
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'photo' => $product->photo,
                'quantity' => 1
            ];
        }

        session()->put('shoppingCart', $cart); // lưu lại session

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng'
        ]);
    }


    // lấy dữ liệu in lên shoppingCart
    public function showCart()
    {
        $cart = session('shoppingCart', []);
        return view('shop/shoppingCart', compact('cart'));
    }
    public function show($id)
    {
        $product = Product::with('cate')->findOrFail($id);
        $variantIds = Product_variant::where('product_id', $id)->pluck('id');
        $photos = Photo::whereIn('product_variant_id', $variantIds)->get();
        $colorIds = Product_variant::where('product_id', $id)->pluck('colors_id')->unique();
        $colors = Colors::whereIn('id', $colorIds)->get();

        // $firstVariant = Product_variant::where('product_id', $id)->first();
        // $selectedColorId = $firstVariant?->colors_id ?? null;
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
                'selectedColorId' => $selectedColorId
            ];
        return view('shop/productDetails')->with($data);
    }
    // Function phân trang cho các Cates theo id
    public function showByCategory($id)
    {
        $data = [
            'cates' => Cate::get(),
            'names' => Cate::pluck('name'),
            'productByCate' => Product::where('cate_id', $id)->paginate(6),
            'products' => Product::paginate(6),
            'photo' => Product::pluck('name'),
            'colors' => Colors::pluck('name'),
        ];
        return view('shop/shopCategory')->with($data);
    }
}
