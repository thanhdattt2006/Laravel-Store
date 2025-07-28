@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Confirmation</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="confirmation">Confirmation</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Order Details Area =================-->
<section class="order_details section_gap">
    <div class="container">
        <h3 class="title_confirmation">Thank you for choosing our shop</h3>

        @foreach($orders as $order)
        <div class="row justify-content-center order_d_inner mb-5 text-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="details_item">
                    <h4>Order Info</h4>
                    <ul class="list">
                        <li><span>Order number:</span> {{ $order->id }}</li>
                        <li><span>Date:</span> {{ \Carbon\Carbon::parse($order->created_day)->format('d/m/Y') }}</li>
                        <li><span>Payment method:</span> {{ $order->payment->name ?? 'N/A' }}</li>
                        <li><span>Voucher:</span> {{ $order->voucher->code_name ?? 'Dont use' }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="details_item">
                    <h4>Shipping Address</h4>
                    <ul class="list">
                        <li><span>Fullname:</span> {{ $order->fullname }}</li>
                        <li><span>Phone:</span> {{ $order->phone }}</li>
                        <li><span>Address:</span> {{ $order->address }}</li>
                        <li><span>Note:</span> {{ $order->note ?? 'Không' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="order_details_table mb-5">
            <h2>Order Details</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                            <td>{{$detail->size}}</td>
                            <td>{{$detail->color->name}}</td>
                            <td>x {{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->total_price) }}₫</td>
                        </tr>
                        @endforeach


                        <tr>
                            <td><strong>Discount</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>{{ $order->voucher ? $order->voucher->discount_value . '%' : 'No Voucher' }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>{{ number_format($order->grand_price) }}₫</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>{{ $order->status ? 'Paid' : 'Unpaid' }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <div style="margin: 125px 0px;"></div>
        @endforeach
    </div>
</section>
<!--================End Order Details Area =================-->

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