@extends('layout.user')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Sửa bài viết</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ url('/') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{ url('blog/index') }}">Blog<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Sửa</a>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('blog/update/' . $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $blog->title) }}">
        </div>

        <div class="form-group">
            <label for="description">Mô tả ngắn:</label>
            <textarea name="description" id="description" rows="3" class="form-control" required>{{ old('description', $blog->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="photo">Ảnh đại diện mới (nếu muốn thay):</label>
            <input type="file" name="photo" id="photo" class="form-control-file">
            @if ($blog->photo)
                <p class="mt-2">Ảnh hiện tại:</p>
                <img src="{{ asset('user/blog/' . $blog->photo) }}" alt="Ảnh hiện tại" class="img-thumbnail" style="max-height: 200px;">
            @endif
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark">Cập nhật bài viết</button>
            <a href="{{ url('blog/index') }}" class="btn btn-outline-secondary">Quay lại</a>
        </div>
    </form>
</div>
@endsection
