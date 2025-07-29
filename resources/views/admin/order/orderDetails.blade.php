@extends('layout.admin')
@section('content')
<link rel="stylesheet" href="{{asset('admin')}}/assets/css/elementCss/orderDetails.css">
<div class="container">
    <div class="page-inner">
        <form action="{{url(('admin/editOrderDetails'))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="order_id" value="{{$orderDetails->id}}" />
            <input type="hidden" name="voucher_id" value="{{isset($orderDetails->voucher->discount_value) ?  $orderDetails->voucher->discount_value : 0}}" />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center top">
                                <h4 class="card-title">Orders Details</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table
                                    id="add-row"
                                    class="display table table-striped table-hover">
                                    @if (session('success'))
                                    <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 alert alert-success">
                                        <span class="block sm:inline">{{ session('success') }}</span>
                                    </div>
                                    @elseif (session('error'))
                                    <div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 alert alert-danger">
                                        <span class="block sm:inline">{{ session('error') }}</span>
                                    </div>
                                    @endif
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Product's name</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Product's name</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($orderDetails->orderDetails as $orderDetail)
                                        <tr data-price="{{$orderDetail->price}}">
                                            <input type="hidden" name="id[]" value="{{$orderDetail->id}}">
                                            @foreach ($orderDetail->product->variant as $photo)
                                            @if ($photo->photos->isNotEmpty())
                                            <td class="tbody-td"><img src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" alt=""></td>
                                            @break;
                                            @endif
                                            @endforeach
                                            <td>{{$orderDetail->product->name}}</td>
                                            <td>
                                                <select name="color_id[]">
                                                    @foreach ($orderDetail->product->variant as $color)
                                                    <option value="{{$color->colors->id}}" {{$color->colors->id == $orderDetail->color_id ? 'selected' : ''}}>{{$color->colors->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="size[]">
                                                    @php $i = 36 @endphp
                                                    @for($i; $i <= 46; $i++)
                                                        <option value="{{$i}}" {{$orderDetail->size == $i? 'selected' : ''}}>{{$i}}</option>
                                                        @endfor
                                                </select>
                                            </td>
                                            <td class="currency-format price">{{$orderDetail->price}}</td>
                                            <td>
                                                <input type="number" name="quantity[]" class="qty-input" value="{{$orderDetail->quantity}}" min="1" max="20" />
                                            </td>
                                            <td>
                                                <select name="total_price[]" style="pointer-events: none;">
                                                    <option class="total-price currency-format-not-currency">{{$orderDetail->total_price}}</option>
                                                </select> VND
                                            </td>
                                            <!-- <td>Active</td> -->
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{url('admin/deleteOrderDetail/' . $orderDetail->id)}}" onclick="return confirm('Are you sure to delete?')">
                                                        <button
                                                            type="button"
                                                            data-bs-toggle="tooltip"
                                                            title=""
                                                            class="btn btn-link btn-danger"
                                                            data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Edit</button>
                            <a href="{{url('admin/order')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
<script src="{{asset('admin/assets/js/elementJs/orderDetails.js')}}"></script>
<script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection