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

@section('scripts')
<script>
    const ASSET_URL = "{{asset('user')}}"
</script>
<script src="{{asset('user/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
<script src="{{asset('user/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('user/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('user/js/jquery.sticky.js')}}"></script>
<script src="{{asset('user/js/nouislider.min.js')}}"></script>
<script src="{{asset('user/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
<!--gmaps Js-->
<script src="{{asset('user/js/gmaps.min.js')}}"></script>
<script src="{{asset('user/js/main.js')}}"></script>

@endsection