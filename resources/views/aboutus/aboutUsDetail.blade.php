	@extends('layout.user')

	@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
	    <div class="container">
	        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
	            <div class="col-first">
	                <h1>About Us Page</h1>
	                <nav class="d-flex align-items-center">
	                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
	                    <a href="category.html">About Us</a>
	                </nav>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- End Banner Area -->

	<!--================About Us Area =================-->
	<section class="blog_area single-post-area section_gap">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8 posts-list">
	                <div class="single-post row">
	                    <div class="col-lg-12">
	                        <div class="feature-img">
	                            <img class="img-fluid" src="{{asset('user')}}/aboutus/{{$item ->photo}}" alt="">
	                        </div>
	                    </div>
	                    <div class="col-lg-3  col-md-3"></div>
	                    <div class="col-lg-9 col-md-9 blog_details">
	                        <h2>{{$item -> title}}</h2>
	                        <p class="excert">
	                            {{$item -> content}}
	                        </p>
	                    </div>
	                    <div class="col-lg-12">
	                        <div class="quotes">
	                            {{$item -> description}}
	                        </div>
	                        <div class="row">
	                            <div class="col-6">
	                                <img class="img-fluid" src="{{asset('user')}}/banner/aboutus1.png" alt="">
	                            </div>
	                            <div class="col-6">
	                                <img class="img-fluid" src="{{asset('user')}}/banner/aboutus2.png" alt="">
	                            </div>
	                            <div class="col-lg-12 mt-25">
	                                <p>
	                                    {{$item -> description}}
	                                </p>
	                                <p>
	                                    {{$item -> description}}
	                                </p>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!--================Blog Area =================-->

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