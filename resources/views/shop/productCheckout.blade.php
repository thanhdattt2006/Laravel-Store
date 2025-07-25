@extends('layout.user')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Checkout</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">

        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Bill Details</h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your fullname">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Company name">
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number" placeholder="Phone number">

                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="compemailany" placeholder="Email address">

                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select">
                                <option value="vietnam">Vietnam</option>
                                <option value="india">India</option>
                                <option value="russia">Russia</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="add1">
                            <span class="placeholder" data-placeholder="Address line 01"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add2" name="add2">
                            <span class="placeholder" data-placeholder="Address line 02"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city">
                            <span class="placeholder" data-placeholder="Town/City"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select">
                                <option value="1">District</option>
                                <option value="2">District</option>
                                <option value="4">District</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Create an account?</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <h3>Shipping Details</h3>
                                <input type="checkbox" id="f-option3" name="selector">
                                <label for="f-option3">Ship to a different address?</label>
                            </div>
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box" style="width: 400px;">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a  style="cursor:pointer">Product <span>Total</span></a></li>
                            @foreach ($cartItems as $item)
                            <li><a>{{ Str::limit($item->product->name, 20) }}<span class="middle" style="gap: 5px;">x{{$item->quantity}}</span> <span class="last">{{ number_format($item->total, 0, ',', '.') }} VND</span></a></li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a  style="cursor:pointer">Subtotal <span>{{ number_format($subtotal, 0, ',', '.') }} VND</span></a></li>
                            <li><a  style="cursor:pointer">Shipping <span>Free ship</span></a></li>
                            <li><a  style="cursor:pointer">Total <span>{{ number_format($subtotal, 0, ',', '.') }} VND</span></a></li>
                        </ul>
                        @foreach ($payments as $payment)
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="payment{{$payment->id}}" name="payment_method" value="{{ $payment->name }}">
                                <label for="payment{{$payment->id}}">{{ $payment->name }}</label>
                                <div class="check"></div>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus consectetur quasi perspiciatis earum eum vitae molestiae hic neque, amet deleniti?</p>
                        </div>
                        @endforeach

                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a  style="cursor:pointer">terms & conditions*</a>
                        </div>
                        <a class="primary-btn"  style="cursor:pointer">Proceed to Paypal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

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