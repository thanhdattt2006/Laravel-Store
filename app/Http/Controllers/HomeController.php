<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Colors;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $colors = Colors::get();

        $products = Product::orderBy('id', 'desc')->with('variant.colors')->get();

        $products->map(function ($product) {
            $firstVariant = $product->variant->first();
            $product->default_color_id = $firstVariant?->color_id ?? null;
            $product->default_color_name = $firstVariant?->colors?->name ?? 'Không rõ';
            $product->default_size = $firstVariant?->size ?? null;
            return $product;
        });

        $data = [
            'names' => Cate::pluck('name'),
            'products' => $products,
            'photo' => Product::pluck('name'),
            'colors' => $colors,
            'photos' => Photo::where('product_variant_id', null)->orderBy('id', 'desc')->take(5)->get()
        ];

        return view('home/index')->with($data);
    }
}
