<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cate;
use App\Models\Review;
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

        if (!$blog) {
            return view('blog.blogDetails', [
                'names' => Cate::pluck('name'),
                'blog' => null
            ]);
        }

        $comments = Review::where('blog_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('blog.blogDetails', [
            'names' => Cate::pluck('name'),
            'blog' => $blog,
            'comments' => $comments
        ]);
    }

    public function postComment(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để bình luận.');
        }

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'account_id' => auth()->user()->id, 
            'blog_id' => $id,
            'comment' => $request->comment,
            'rating' => null,
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã bình luận!');
    }
}
