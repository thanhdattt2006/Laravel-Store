<?php
namespace App\Http\Controllers;

use App\Models\Cate;

class BlogController extends Controller
{
    public function index()
    {
        
        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('blog/index')->with($data);
    }
     public function blogDetails()
    {
        
        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('blog/blogDetails')->with($data);
    }
}
?>