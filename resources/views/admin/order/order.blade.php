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
                            <th>Id</th>
                            <th>Name</th>
                            <th>Created Day</th>
                            <th>Payment</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Bill</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Created Day</th>
                            <th>Payment</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Bill</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $order)
                          <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->account->fullname}}</td>
                            <td class="format-date">{{$order->created_day}}</td>
                            <td>{{$order->payment->name}}</td>
                            @php $total = 0; @endphp
                            @foreach($order->orderDetails as $orderDetails)
                                @php
                                    $subtotal = $orderDetails->price * $orderDetails->quantity;
                                    $total += $subtotal;
                                @endphp
                            @endforeach
                            <td class="currency-format">{{($total)}}</td>
                            <td>{{$order->status == 1 ? 'Paid' : 'Not yet Paid'}}</td>
                            <td>
                                <select>
                                    <option value="1" {{$order->status == 1 ? 'selected' : ''}}>Paid</option>
                                    <option value="0" {{$order->status == 0 ? 'selected' : ''}}>Not yet Paid</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{url('admin/orderDetails/' . $order->id)}}"><span class="badge badge-black">Detail</span></a>
                            </td>
                            <td>
                                <a href="{{url('admin/bill/' . $order->id)}}"><i class="icon-options-vertical"></i></a>
                            </td>
                            <!-- <td>Active</td> -->
                            <td>
                              <div class="form-button-action">
                                <button
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-primary btn-lg"
                                  data-original-title="Edit Task"
                                >
                                  <i class="fa fa-edit"></i>
                                </button>
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
  <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection