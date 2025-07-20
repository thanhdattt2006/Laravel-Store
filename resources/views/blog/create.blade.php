@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Thêm bài viết</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ url('/') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{ url('blog/index') }}">Blog<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Thêm</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<div class="container py-5">
    <h2 class="text-center font-weight-bold mb-4">Thêm bài viết mới</h2>

    {{-- Hiển thị thông báo --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tạo bài viết --}}
    <form action="{{ url('blog/save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="description">Mô tả ngắn:</label>
            <textarea name="description" id="description" rows="3" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="photo">Ảnh đại diện:</label>
            <input type="file" name="photo" id="photo" class="form-control-file">
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-dark px-5">Thêm bài viết</button>
            <a href="{{ url('blog/index') }}" class="btn btn-outline-secondary ml-2">Quay lại</a>
        </div>
    </form>
</div>

@endsection
