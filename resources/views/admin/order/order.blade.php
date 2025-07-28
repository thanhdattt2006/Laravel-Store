 @extends('layout.admin')
 @section('content')
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
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Created Day</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order detail</th>
                            <th>Bill</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Created Day</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order detail</th>
                            <th>Bill</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $order)
                          <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->account->fullname}}</td>
                            <td>{{$order->created_day}}</td>
                            <td>{{$order->payment->name}}</td>
                            <td>999000999</td>
                            <td>{{$order->status == 1 ? 'Paid' : 'Not yet Paid'}}</td>
                            <td>
                                <a href="#"><span class="badge badge-black">Detail</span></a>
                            </td>
                            <td><i class="icon-options-vertical"></i></td>
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