<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Colors;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopCategory()
    {
        $data = [
            'cates' => Cate::get(),
            'names' => Cate::pluck('name'),
            'products' => Product::get(),
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
    // public function show($id)
    // {
    //     // Lấy sản phẩm kèm theo category
    //     $product = Product::with('cate')->findOrFail($id);
    //     // Lấy các variant
    //     $variants = $product->variant;
    //     // Lấy danh sách id các variant
    //     $variantIds = $product->variant()->pluck('id');


    //     // Lấy ảnh theo danh sách variant_id vừa tìm
    //     $photos = Photo::whereIn('product_variant_id', $variantIds)->pluck('name');
    //     // Tách chuỗi thành mảng ảnh
    //     //$photos = explode(',', $product->photo);
    //     $colorIds = $variants->pluck('colors_id')->unique();
    //     $colors = Colors::whereIn('id', $colorIds)->get();

    //     $data = [
    //         'product' => $product,
    //         'names' => Cate::pluck('name'),
    //         'photos' => $photos,
    //         'colors' => $colors
    //     ];

    //     return view('shop.productDetails')->with($data);
    // }
    public function show($id)
    {
        // Lấy sản phẩm kèm theo category
        $product = Product::with('cate')->findOrFail($id);

        // Lấy tất cả variant của sản phẩm
        $variants = $product->variant;

        // Lấy danh sách color_id duy nhất từ các variant
        $colorIds = $variants->pluck('colors_id')->unique();

        // Lấy danh sách màu từ bảng colors
        $colors = Colors::whereIn('id', $colorIds)->get();

        // Chọn màu mặc định là màu đầu tiên
        $defaultColorId = $variants->first()->colors_id ?? null;

        // Tìm variant tương ứng với màu mặc định
        $selectedVariant = $variants->where('colors_id', $defaultColorId)->first();

        // Lấy ảnh của variant tương ứng
        $photos = [];
        if ($selectedVariant) {
            $photos = Photo::where('product_variant_id', $selectedVariant->id)->pluck('name');
        }

        $data = [
            'product' => $product,
            'names' => Cate::pluck('name'),
            'photos' => $photos,
            'colors' => $colors,
            'defaultColorId' => $defaultColorId
        ];

        return view('shop.productDetails')->with($data);
    }
    // tim` kiem
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

}



