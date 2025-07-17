<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('user')}}/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>
    <!--
		CSS
		============================================= -->
    <link rel="stylesheet" href="{{asset('user')}}/css/linearicons.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/nice-select.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/nouislider.min.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="{{asset('user')}}/css/ion.rangeSlider.skinFlat.css" />
    <link rel="stylesheet" href="{{asset('user')}}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('user')}}/css/main.css">

    <!-- Element-CSS -->
    <link rel="stylesheet" href="{{asset('user')}}/css/elementCss/carousel.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .toggle-btn {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        @if (Auth::check())
        Hi, {{ Auth::user()->fullname }} |
        @if (Auth::user()->role_id == 1)
        Admin
        @elseif (Auth::user()->role_id == 2)
        User
        @endif
        @endif

        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{url('home')}}"><img src="{{asset('user')}}/nike-img/logonike.png" alt=""style="height: 50px; width: auto;></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{url('home')}}">Home</a></li>
                            <li class="nav-item active">
                                <a href="{{url('shop/shopCategory')}}" class="nav-link">Shop</a>
                                <!-- <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{url('shop/shopCategory')}}">Shop Category</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="{{url('shop/productDetails')}}">Product Details</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="{{url('shop/productCheckout')}}">Product Checkout</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="{{url('shop/shoppingCart')}}">Shopping Cart</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="{{url('shop/confirmation')}}">Confirmation</a></li> -->
                                <!-- </ul> -->
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{url('blog/index')}}">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('blog/blogDetails')}}">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <!-- <li class="nav-item"><a class="nav-link" href="{{url('/login')}}">Login</a></li> -->
                                    <!-- <li class="nav-item"><a class="nav-link" href="{{url('tracking')}}">Tracking</a></li> -->
                                    <li class="nav-item"><a class="nav-link" href="{{url('/elements')}}">Elements</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{url('/contact')}}">Contact</a></li>



                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                            <li class="nav-item"><a href="{{url('shop/shoppingCart')}}" class="cart"><span class="ti-bag skip-add-to-cart"></span></a></li>
                        </ul>

                        <ul class="nav navbar-nav" style="margin-left: 22px;">
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" viewBox="0 0 24 24" style="fill: rgba(255, 186, 0, 1);">
                                        <path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('account.login') }}">Log-in</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('shop/confirmation')}}">Confirmation</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('/tracking')}}">Tracking</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('account/logout')}}">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 186, 0, 1);">
                                                    <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                                    <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path>
                                                </svg>
                                            </span> Log-out</a></li>
                                </ul>
                            </li>


                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between" method="get" action="{{ url('/shop/search-by-keyword') }}">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    @yield('content')
    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">

                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="form-inline">

                                <div class="d-flex flex-row">

                                    <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                        required="" type="email">


                                    <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="{{asset('user')}}/img/i1.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i2.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i3.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i4.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i5.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i6.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i7.jpg" alt=""></li>
                            <li><img src="{{asset('user')}}/img/i8.jpg" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->
    <!-- Optional JavaScript -->
     
    @yield('scripts')
</body>

</html>