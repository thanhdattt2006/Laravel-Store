@extends('layout.user')
@section ('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Login/Register</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">Login/Register</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->


<!-- Register Area -->
<div class="navbar-links">
		<i class="fa fa-close close"></i>
		<section class="login_box_area section_gap">		
				<div class="container containerOfRegister set_containerOfRegister">
                    <div class="login_form_inner login_form_fix form_background">
                        <h3>Registeration</h3>
                        
                        <form class="row login_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                            <!-- Username -->
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Name'">
                            </div>
                            <!-- Email -->
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email'">
                            </div>
                            <!-- password -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="name" name="name" placeholder="your Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'your Password'">
                            </div>
                            <!-- Confirm-password -->
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="name" name="name" placeholder="Comfirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Comfirm Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">I accept terms & conditions</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Register Now</button>
                            </div>
                        </form>
                    </div>
				</div>
			</section>
	</div>

<!--================Login Box Area =================-->

<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="{{asset('user')}}/img/login.jpg" alt="">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <button type="submit" class="primary-btn register_button sidebar">Create an Account</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" action="{{ url('/account/login') }}" method="POST" id="loginForm" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Username"
                                value="{{ old('username') }}"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Username'" required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Password'" required>
                        </div>

                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="remember">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>

                        @error('login')
                        <div class="col-md-12 form-group">
                            <p style="color: red;">{{ $message }}</p>
                        </div>
                        @enderror

                        <div class="col-md-12 form-group">
                            <button type="submit" class="primary-btn">Log In</button>
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->

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
<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
@endsection