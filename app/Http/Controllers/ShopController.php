<?php

namespace App\Http\Controllers;

use App\Models\Cate;

class ShopController extends Controller
{
    public function shopCategory()
    {

        $data = [
            'cates' => Cate::get(),
            'names' => Cate::pluck('name'),
            'products' => Product::get(),
            'photo' => Product::pluck('name') ,
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
    public function show($id)
    {
        $product = Product::findOrFail($id);
        // Tách chuỗi thành mảng ảnh
        $photos = explode(',', $product->photo);

        $data = [
            'product' => $product,
            'names' => Cate::pluck('name'),
            'photos' => $photos
        ];

        return view('shop.productDetails')->with($data);
    }
}
