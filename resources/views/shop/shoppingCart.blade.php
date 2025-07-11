@extends('layout.user')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shopping Cart</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">Cart</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $cart = session('shoppingCart', []);
                    @endphp
                    @foreach ($cart as $id => $item)
                        <tr class="top">
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img height="150px"  src="{{asset('user')}}/nike-img/{{ $item['photo'] }}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $item['name'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>{{ $item['price'] }}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="text" name="qty" id="sst" maxlength="12" value="{{1}}" title="Quantity:"
                                        class="input-text qty">
                                    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                        class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;"
                                        class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                </div>
                            </td>
                            <td>
                                <h5>{{ $item['price'] }}</h5>
                            </td>
                            <td>
                                <i class="fa fa-close hidden"></i>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn update-cart">Update Cart</a>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="cupon_text d-flex align-items-center">
                                    <input type="text" placeholder="Coupon Code">
                                    <a class="primary-btn" href="#">Apply</a>
                                    <a class="gray_btn" href="#">Close Coupon</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>$2160.00</h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Shipping</h5>
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li><a href="#">Flat Rate: $5.00</a></li>
                                        <li><a href="#">Free Shipping</a></li>
                                        <li><a href="#">Flat Rate: $10.00</a></li>
                                        <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                    </ul>
                                    <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                    <select class="shipping_select">
                                        <option value="1">Bangladesh</option>
                                        <option value="2">India</option>
                                        <option value="4">Pakistan</option>
                                    </select>
                                    <select class="shipping_select">
                                        <option value="1">Select a State</option>
                                        <option value="2">Select a State</option>
                                        <option value="4">Select a State</option>
                                    </select>
                                    <input type="text" placeholder="Postcode/Zipcode">
                                    <a class="gray_btn" href="#">Update Details</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="{{url('home/index')}}">Continue Shopping</a>
                                    <a class="primary-btn" href="{{url('shop/productCheckout')}}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!--================End Cart Area =================-->
<script type="text/javascript">
       
    </script>
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