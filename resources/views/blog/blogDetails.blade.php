@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Blog Details</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ url('/') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{ url('blog/index') }}">Blog<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Chi tiết</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<div class="container py-5">
    @if ($blog)
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="mb-3 font-weight-bold">{{ $blog->title }}</h2>
            <p class="text-muted mb-4">{{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</p>
            <img src="{{ asset('user/blog/' . $blog->photo) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">

            <div class="blog-content mb-5">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <!-- FORM GỬI BÌNH LUẬN -->
            <div class="mt-5">
                <h4 class="mb-3">Comment</h4>

                @if (Auth::check())
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('blog.comment', $blog->id) }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" rows="3" class="form-control" placeholder="Nhập bình luận..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark mt-2">Gửi bình luận</button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Vui lòng <a href="{{ route('account.login') }}">đăng nhập</a> để bình luận.
                    </div>
                @endif
            </div>

            <!-- DANH SÁCH Bình Luận -->
            <div class="mt-4">
                @if (isset($comments) && $comments->count())
                    @foreach ($comments as $cmt)
                        <div class="border-bottom py-2">
                            <strong>{{ $cmt->account->fullname }}</strong>
                            <span class="text-muted"> - {{ $cmt->created_at->format('d/m/Y H:i') }}</span>
                            <p class="mb-0">{{ $cmt->comment }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Chưa có bình luận nào.</p>
                @endif
            </div>

        </div>
    </div>
    @else
    <div class="text-center">
        <h4 class="text-danger">Bài viết không tồn tại.</h4>
        <a href="{{ url('blog/index') }}" class="btn btn-outline-secondary mt-3">Quay lại Blog</a>
    </div>
    @endif
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