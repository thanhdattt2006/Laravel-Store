@extends('layout.admin')
@section('content')
<!-- <link rel="stylesheet" href="billStyle.css"> -->
<link rel="stylesheet" href="{{asset('admin')}}/assets/css/elementCss/billStyle.css">
<div class="container">
    <div class="page-inner">
        <div class="invoice-box">
    <h2><strong>PAYMENT INVOICE</strong></h2>

    <div class="info">
      <p><strong>Invoice ID: </strong> {{$bills->id}}</p>
      <p><strong>Customer: </strong> {{$bills->fullname}}</p>
      <p><strong>Phone: </strong> {{$bills->phone}}</p>
      <p><strong>Address: </strong> {{$bills->address}}</p>
      <p><strong>Order Date: </strong> {{$bills->created_day}}</p>
      <p><strong>Payment Method: </strong> {{$bills->payment->name}}</p>
      <p><strong>Status: </strong> {{$bills->status == 1 ? 'Paid' : 'Not yet Paid'}}</p>
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Product Name</th>
          <th>Color</th>
          <th>Size</th>
          <th>Qty</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @php $i = 1 @endphp
        @php $subTotal = 0 @endphp
        @foreach($bills->orderDetails as $billDetails)
            <tr>
            <td>{{$i}}</td>
            <td>{{$billDetails->product->name}}</td>
            <td>{{$billDetails->color->name}}</td>
            <td>{{$billDetails->size}}</td>
            <td>{{$billDetails->quantity}}</td>
            <td class="currency-format">{{$billDetails->price}}</td>
            <td class="currency-format">{{$billDetails->total_price}}</td>
            </tr>
            @php $i++ @endphp
            @php $subTotal += $billDetails->total_price @endphp
        @endforeach
      </tbody>
    </table>

    <div class="totals">
        <p>Subtotal:  <span class="currency-format">{{$subTotal}}</span></p>
        <p>voucher Discount:  <span>{{isset($bills->voucher->code_name) ? $bills->voucher->code_name : 0}} %</span></p>
        <p>VAT:  <span class="currency-format">0</span></p>
        <p>Shipping:  <span>Free Ship</span></p>
        @php
            $discount = $subTotal * (100 - (isset($bills->voucher_discount_id) ? $bills->voucher->discount_value : 0)) / 100;
        @endphp
        <p><strong>Grand Total: <span class="currency-format">{{$discount}}</span></strong></p>
    </div>

    <div class="note">
     Thank you for shopping with us!
    </div>
  </div>

    </div>
</div>
@endsection

@section('scripts')
  <script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
  <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection