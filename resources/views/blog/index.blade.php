@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Blog Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ url('/') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{ url('blog/index') }}">Blog</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!-- BANNER FEATURED STORY -->
<section class="featured-banner mt-5 mb-5">
    <div class="container">
        <div class="position-relative">
            <img src="{{ asset('user/blog/banner.png') }}" class="img-fluid w-100 rounded" alt="Featured Story Banner">
        </div>
    </div>
</section>

<!-- TIÊU ĐỀ DANH MỤC -->
<section class="text-center mb-5">
    <h2 class="font-weight-bold">Never Done Challenging Convention</h2>
</section>

<!-- THÔNG BÁO -->
<div class="container">
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
</div>

<!-- NÚT THÊM BÀI VIẾT -->
<div class="container pb-3">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('blog/create') }}" class="btn btn-outline-dark">+ Thêm bài viết</a>
    </div>
</div>

<!-- DANH SÁCH BLOG -->
<div class="container pb-5">
    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm d-flex flex-column">
                    <img src="{{ asset('user/blog/' . $blog->photo) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->description, 100) }}</p>
                        </div>
                        <div class="text-center mt-auto">
                            <a href="{{ url('blog/blogDetails/' . $blog->id) }}" class="btn btn-outline-dark">Đọc thêm</a>
                        </div>
                    </div>

                    <div class="card-footer text-muted text-center">
                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- PHÂN TRANG -->
    <div class="d-flex justify-content-center mt-4">
        {{ $blogs->links() }}
    </div>
</div>

	@endsection