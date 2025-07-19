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
	                    <div class="col-lg-3  col-md-3">
	                        <div class="blog_info text-right">
	                            <ul class="blog_meta list">
	                                <li><a href="#">Wuyx Tran<i class="lnr lnr-user"></i></a></li>
	                                <li><a href="#">{{$item -> created_at}}<i class="lnr lnr-calendar-full"></i></a></li>
	                                <li><a href="#">100 Like<i class="lnr lnr-heart"></i></a></li>
	                                <li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>
	                            </ul>
	                            <ul class="social-links">
	                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
	                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
	                                <li><a href="#"><i class="fa fa-github"></i></a></li>
	                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
	                            </ul>
	                        </div>
	                    </div>
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
	                <div class="navigation-area">
	                    <div class="row">
	                        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
	                            <div class="thumb">
	                                <a href="#"><img class="img-fluid" src="{{asset('user')}}/img/blog/prev.jpg" alt=""></a>
	                            </div>
	                            <div class="arrow">
	                                <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
	                            </div>
	                            <div class="detials">
	                                <p>Prev Post</p>
	                            </div>
	                        </div>
	                        <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
	                            <div class="detials">
	                                <p>Next Post</p>
	                            </div>
	                            <div class="arrow">
	                                <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
	                            </div>
	                            <div class="thumb">
	                                <a href="#"><img class="img-fluid" src="{{asset('user')}}/img/blog/next.jpg" alt=""></a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="comments-area">
	                    <h4>05 Comments</h4>
	                    <div class="comment-list">
	                        <div class="single-comment justify-content-between d-flex">
	                            <div class="user justify-content-between d-flex">
	                                <div class="thumb">
	                                    <img src="{{asset('user')}}/img/blog/c1.jpg" alt="">
	                                </div>
	                                <div class="desc">
	                                    <h5><a href="#">Emilly Blunt</a></h5>
	                                    <p class="date">December 4, 2018 at 3:12 pm </p>
	                                    <p class="comment">
	                                        Never say goodbye till the end comes!
	                                    </p>
	                                </div>
	                            </div>
	                            <div class="reply-btn">
	                                <a href="" class="btn-reply text-uppercase">reply</a>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="comment-list left-padding">
	                        <div class="single-comment justify-content-between d-flex">
	                            <div class="user justify-content-between d-flex">
	                                <div class="thumb">
	                                    <img src="{{asset('user')}}/img/blog/c2.jpg" alt="">
	                                </div>
	                                <div class="desc">
	                                    <h5><a href="#">Elsie Cunningham</a></h5>
	                                    <p class="date">December 4, 2018 at 3:12 pm </p>
	                                    <p class="comment">
	                                        Never say goodbye till the end comes!
	                                    </p>
	                                </div>
	                            </div>
	                            <div class="reply-btn">
	                                <a href="" class="btn-reply text-uppercase">reply</a>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="comment-list left-padding">
	                        <div class="single-comment justify-content-between d-flex">
	                            <div class="user justify-content-between d-flex">
	                                <div class="thumb">
	                                    <img src="{{asset('user')}}/img/blog/c3.jpg" alt="">
	                                </div>
	                                <div class="desc">
	                                    <h5><a href="#">Annie Stephens</a></h5>
	                                    <p class="date">December 4, 2018 at 3:12 pm </p>
	                                    <p class="comment">
	                                        Never say goodbye till the end comes!
	                                    </p>
	                                </div>
	                            </div>
	                            <div class="reply-btn">
	                                <a href="" class="btn-reply text-uppercase">reply</a>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="comment-list">
	                        <div class="single-comment justify-content-between d-flex">
	                            <div class="user justify-content-between d-flex">
	                                <div class="thumb">
	                                    <img src="{{asset('user')}}/img/blog/c4.jpg" alt="">
	                                </div>
	                                <div class="desc">
	                                    <h5><a href="#">Maria Luna</a></h5>
	                                    <p class="date">December 4, 2018 at 3:12 pm </p>
	                                    <p class="comment">
	                                        Never say goodbye till the end comes!
	                                    </p>
	                                </div>
	                            </div>
	                            <div class="reply-btn">
	                                <a href="" class="btn-reply text-uppercase">reply</a>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="comment-list">
	                        <div class="single-comment justify-content-between d-flex">
	                            <div class="user justify-content-between d-flex">
	                                <div class="thumb">
	                                    <img src="{{asset('user')}}/img/blog/c5.jpg" alt="">
	                                </div>
	                                <div class="desc">
	                                    <h5><a href="#">Ina Hayes</a></h5>
	                                    <p class="date">December 4, 2018 at 3:12 pm </p>
	                                    <p class="comment">
	                                        Never say goodbye till the end comes!
	                                    </p>
	                                </div>
	                            </div>
	                            <div class="reply-btn">
	                                <a href="" class="btn-reply text-uppercase">reply</a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="comment-form">
	                    <h4>Leave a Reply</h4>
	                    <form>
	                        <div class="form-group form-inline">
	                            <div class="form-group col-lg-6 col-md-6 name">
	                                <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''"
	                                    onblur="this.placeholder = 'Enter Name'">
	                            </div>
	                            <div class="form-group col-lg-6 col-md-6 email">
	                                <input type="email" class="form-control" id="email" placeholder="Enter email address"
	                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''"
	                                onblur="this.placeholder = 'Subject'">
	                        </div>
	                        <div class="form-group">
	                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege"
	                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
	                        </div>
	                        <a href="#" class="primary-btn submit_btn">Post Comment</a>
	                    </form>
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