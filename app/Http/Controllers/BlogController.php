<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cate;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'names' => Cate::pluck('name'),
            'blogs' => Blog::orderBy('created_at', 'desc')->paginate(6)
        ];
        return view('blog.index')->with($data);
    }

    public function blogDetails($id)
    {
        $blog = Blog::find($id);
        $data = [
            'names' => Cate::pluck('name'),
            'blog' => $blog
        ];
        return view('blog.blogDetails')->with($data);
    }
}
