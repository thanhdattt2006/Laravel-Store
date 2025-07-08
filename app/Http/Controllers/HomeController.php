<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {

        $data = [
            'names' => Cate::pluck('name'),
            'products' => Product::get(),
            'photo' => Product::pluck('name')
        ];
        return view('home/index')->with($data);
    }
}
