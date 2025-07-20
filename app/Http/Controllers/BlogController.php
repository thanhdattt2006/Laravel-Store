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

    public function create()
    {
        if (!session()->has('account_id')) {
            return redirect()->back()->with('error', 'Bạn chưa đăng nhập');
        }

        $data = [
            'names' => Cate::pluck('name'),
        ];
        return view('blog.create')->with($data);
    }

    public function save(Request $request)
    {
        if (!session()->has('account_id')) {
            return redirect()->back()->with('error', 'Bạn chưa đăng nhập');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'content'     => 'required|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = new Blog();
        $blog->title       = $request->title;
        $blog->description = $request->description;
        $blog->content     = $request->content;
        $blog->account_id  = session('account_id'); // Gán account_id vào đây

        if ($request->hasFile('photo')) {
            $image     = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('user/blog'), $imageName);
            $blog->photo = $imageName;
        }

        $blog->save();

        return redirect()->back()->with('success', 'Thêm bài viết thành công!');
    }

    public function edit($id)
    {
        if (!session()->has('account_id')) {
            return redirect()->back()->with('error', 'Bạn chưa đăng nhập');
        }

        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Không tìm thấy bài viết');
        }

        $data = [
            'blog' => $blog,
            'names' => Cate::pluck('name')
        ];
        return view('blog.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('account_id')) {
            return redirect()->back()->with('error', 'Bạn chưa đăng nhập');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'content'     => 'required|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Không tìm thấy bài viết');
        }

        $blog->title       = $request->title;
        $blog->description = $request->description;
        $blog->content     = $request->content;

        if ($request->hasFile('photo')) {
            $image     = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('user/blog'), $imageName);
            $blog->photo = $imageName;
        }

        $blog->save();

        return redirect()->back()->with('success', 'Cập nhật bài viết thành công!');
    }

    public function delete($id)
    {
        if (!session()->has('account_id')) {
            return redirect()->back()->with('error', 'Bạn chưa đăng nhập');
        }

        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->back()->with('error', 'Không tìm thấy bài viết');
        }

        $blog->delete();
        return redirect()->back()->with('success', 'Xóa bài viết thành công!');
    }

}
