@extends('layout.admin')
@section('content')
<link rel="stylesheet" href="{{asset('admin')}}/assets/css/elementCss/orderDetails.css">
 <div class="container">
          <div class="page-inner">
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center top">
                      <h4 class="card-title">Orders List</h4>
                      <a href="#">
                        <button class="btn btn-primary btn-round ms-auto">
                          <i class="fa fa-plus"></i>
                          Add Order
                        </button>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
  
                    <div class="table-responsive">
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
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
                          <tr data-price="2591199">
                            @foreach ($orderDetail->product->variant as $photo)
                                @if ($photo->photos->isNotEmpty()) 
                            <td class="tbody-td"><img src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" alt=""></td>
                                    @break;
                                @endif
                            @endforeach
                            <td>{{$orderDetail->product->name}}</td>
                            <td>
                                <select>
                                    <option value="yellow" selected>Yellow</option>
                                    <option value="black">Black</option>
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option value="36" selected>36</option>
                                    <option value="37">37</option>
                                </select>
                            </td>
                            <td class="currency-format price" class="currency-format">{{$orderDetail->price}}</td>
                            <td>
                                <input type="number" class="qty-input" value="{{$orderDetail->quantity}}" min="1" max="20"/>
                            </td>
                            <td class="total-price currency-format">{{$orderDetail->total_price}}</td>
                            <!-- <td>Active</td> -->
                            <td>
                              <div class="form-button-action">
                                <button
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-danger"
                                  data-original-title="Remove"
                                >
                                  <i class="fa fa-times"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('scripts')
  <script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
  <script src="{{asset('admin/assets/js/elementJs/orderDetails.js')}}"></script>
  <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection