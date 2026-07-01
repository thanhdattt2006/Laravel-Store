@extends('layout.user')
@section ('content')
<!-- Start Banner Area -->
<style>
    .register-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .register-box {
        background: #fff;
        border-radius: 16px;
        padding: 40px 30px;
        width: 100%;
        max-width: 650px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .register-box h3 {
        margin-bottom: 24px;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        color: #333;
    }

    .register-box input.form-control {
        height: 46px;
        border-radius: 10px;
        border: 1px solid #ccc;
        padding-left: 14px;
        margin-bottom: 16px;
        transition: border-color 0.3s;
    }

    .register-box input.form-control:focus {
        border-color: #7abaff;
        outline: none;
    }

    .creat_account label {
        margin-left: 8px;
        font-weight: 500;
    }

    .fa-close.close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 20px;
        color: #888;
        cursor: pointer;
    }

    .fa-close.close-btn:hover {
        color: #000;
    }

    #match_message {
        font-size: 14px;
        margin-top: -10px;
        display: block;
    }
</style>
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
<div class="register-overlay" id="registerOverlay" style="display: none;">
    <div class="register-box">
        <i class="fa fa-close close-btn" onclick="hideRegisterForm()"></i>
        <h3>Registeration</h3>

        <form class="row login_form" action="/account/register" method="post" id="contactForm">
            @csrf

            <!-- Username -->
            <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Name'" required>
                <input type="hidden" class="form-control" id="role_id" name="role_id" value="2" required>
            </div>

            <!-- Fullname -->
            <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Fullname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Fullname'" required>
            </div>

            <!-- Birthday -->
            <div class="col-md-6 form-group">
                <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Your Birthday" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Birthday'" required>
            </div>

            <!-- Phone -->
            <div class="col-md-6 form-group">
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Phone'" required>
            </div>

            <!-- Address -->
            <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="address" name="address" placeholder="Your Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Address'" required>
            </div>

            <!-- Password -->
            <div class="col-md-12 form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Password'" required>
            </div>

            <!-- Confirm Password -->
            <div class="col-md-12 form-group">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required>
                <span id="match_message" style="color: red; display: none;">Passwords do not match</span>
            </div>

            <!-- Terms and Conditions -->
            <div class="col-md-12 form-group">
                <div class="creat_account">
                    <input type="checkbox" id="f-option2" name="selector" required>
                    <label for="f-option2">I accept terms & conditions</label>
                </div>
            </div>

            <!-- Error Message -->
            <div>
                @if(session('fail'))
                <span style="color: red;">{{ session('fail') }}</span>
                @endif
            </div>

            <!-- Submit -->
            <div class="col-md-12 form-group">
                <button type="submit" value="submit" class="primary-btn">Register Now</button>
            </div>
        </form>
    </div>
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
                        <button type="submit" class="primary-btn register_button sidebar" onclick="showRegisterForm()">Create an Account</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" action="{{ url('/account/login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Username"
                                value="{{ old('username') }}"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Username'" required>
                        </div>

                        <div class="col-md-12 form-group password-wrapper">
                            <input type="password" class="form-control" id="passwordshow" name="password"
                                placeholder="Password"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Password'" required>
                            <span onclick="togglePassword()" style="position: absolute; top: 10px; right: 15px; cursor: pointer;">
                                <i id="eye-icon" class="fa fa-eye-slash"></i>
                            </span>
                        </div>


                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="remember">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>

                        @if(session('ok'))
                        <div class="col-md-12 form-group">
                            <span style="color: green;">{{session('ok')}}</span>
                        </div>
                        @endif

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('passwordshow');

        toggle.addEventListener('change', function() {
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>
<script>
    document.getElementById('contactForm', 'loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill out all required fields correctly.',
            });
        } else {
            this.submit();
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pass = document.getElementById('password');
        const confirm = document.getElementById('confirm_password');
        const message = document.getElementById('match_message');

        confirm.addEventListener('input', function() {
            if (pass.value !== confirm.value) {
                message.style.display = 'inline';
            } else {
                message.style.display = 'none';
            }
        });
    });
</script>
<!-- JS xử lý bật/tắt -->
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordshow');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
</script>
<script>
    function hideRegisterForm() {
        document.getElementById('registerOverlay').style.display = 'none';
    }

    function showRegisterForm() {
        document.getElementById('registerOverlay').style.display = 'flex';
    }
</script>
@endsection