<?php
namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::get()  
        ];
        return view('product/index')->with($data);
    }
    
}
?>