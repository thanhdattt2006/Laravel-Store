<?php
namespace App\Http\Controllers;

use App\Models\Cate;

class HomeController extends Controller
{
    public function index()
    {
        
        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('home/index')->with($data);
    }
}
?>