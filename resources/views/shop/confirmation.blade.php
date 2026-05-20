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
        @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '✅ Success',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '❌ Error',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif
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













@endsection