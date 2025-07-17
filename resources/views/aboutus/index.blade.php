	@extends('layout.user')

	@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
	    <div class="container">
	        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
	            <div class="col-first">
	                <h1>About Us Page</h1>
	                <nav class="d-flex align-items-center">
	                    <a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
	                    <a href="#">About Us</a>
	                </nav>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- End Banner Area -->
	<section class="blog_categorie_area">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-4">
	                <div class="categories_post">
	                    <img src="{{asset('user')}}/banner/aboutus1.png" alt="post">
	                    <div class="categories_details">
	                        <div class="categories_text">
	                            <a href="#">
	                                <h5>ATHLETIC LIFE</h5>
	                            </a>
	                            <div class="border_line"></div>
	                            <p>Live strong. Train stronger.</p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-4">
	                <div class="categories_post">
	                    <img src="{{asset('user')}}/banner/aboutus2.png" alt="post">
	                    <div class="categories_details">
	                        <div class="categories_text">
	                            <a href="blog-details.html">
	                                <h5>INNOVATION</h5>
	                            </a>
	                            <div class="border_line"></div>
	                            <p>Designed for performance and style.</p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-4">
	                <div class="categories_post">
	                    <img src="{{asset('user')}}/banner/aboutus3.png" alt="post">
	                    <div class="categories_details">
	                        <div class="categories_text">
	                            <a href="blog-details.html">
	                                <h5>STYLE & CULTURE</h5>
	                            </a>
	                            <div class="border_line"></div>
	                            <p>Where fashion meets functionality.</p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="blog_area">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8">
	                <div class="blog_left_sidebar">
	                    <article class="row blog_item">
	                        <div class="col-md-3"></div>
	                        <div class="col-md-9">
	                            <div class="blog_post">
	                                <img src="{{asset('user')}}/banner/aboutus4.png" alt="">
	                                <div class="blog_details">
	                                    <a href="single-blog.html">
	                                        <h2>Who We Are:</h2>
	                                    </a>
	                                    <p>At Nike, we believe that everyone is an athlete. Our mission is to bring inspiration and innovation to every athlete in the world.</p>
	                                </div>
	                            </div>
	                        </div>
	                    </article>
	                    <article class="row blog_item">
	                        <div class="col-md-3"></div>
	                        <div class="col-md-9">
	                            <div class="blog_post">
	                                <img src="{{asset('user')}}/banner/aboutus5.png" alt="">
	                                <div class="blog_details">
	                                    <a href="single-blog.html">
	                                        <h2>Our Vision:</h2>
	                                    </a>
	                                    <p>To break barriers through sport and style. From elite athletes to everyday dreamers, Nike is here to support every journey.</p>
	                                </div>
	                            </div>
	                        </div>
	                    </article>
	                    <article class="row blog_item">
	                        <div class="col-md-3">
	                        </div>
	                        <div class="col-md-9">
	                            <div class="blog_post">
	                                <img src="{{asset('user')}}/banner/aboutus6.png" alt="">
	                                <div class="blog_details">
	                                    <a href="single-blog.html">
	                                        <h2>Our Impact:</h2>
	                                    </a>
	                                    <p>Through sustainable practices, inclusive innovation, and powerful storytelling, we empower communities globally.</p>
	                                </div>
	                            </div>
	                        </div>
	                    </article>
	                </div>
	            </div>
	            <div class="col-lg-4"></div>
	        </div>
	    </div>
	</section>

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