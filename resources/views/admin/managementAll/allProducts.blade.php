@extends('layout.admin')

@section('content')
 <div class="container">
          <div class="page-inner">
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center top">
                      <h4 class="card-title">Product List</h4>
                      <a href="{{url('admin/addProducts')}}">
                        <button class="btn btn-primary btn-round ms-auto">
                          <i class="fa fa-plus"></i>
                          Add Product
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
                            <th>Category</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Iamge</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($products as $product)
                          <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->cate->name}}</td>
                              @foreach ($product->variant as $photo)
                                @if ($photo->photos->isNotEmpty()) 
                                  <td class="tbody-td"><img src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" alt=""></td>
                                  @break;
                                @endif
                              @endforeach
                            <td class="currency-format">{{$product->price}}</td>
                            <td>
                              @foreach($product->variant as $product_variant)
                                  <span>{{ $product_variant->colors->name}}, </span>
                              @endforeach
                            <td>Active</td>
                            <td>
                              <div class="form-button-action">
                                <a href="{{url('admin/editProduct/' . $product->id)}}">
                                  <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    title=""
                                    class="btn btn-link btn-primary btn-lg"
                                    data-original-title="Edit Task"
                                  >
                                    <i class="fa fa-edit"></i>
                                  </button>
                                </a>
                               <a href="{{url('admin/deleteProduct/' . $product->id)}}" onclick="return confirm('Are you sure to delete?')">
                                  <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    title=""
                                    class="btn btn-link btn-danger"
                                    data-original-title="Remove"
                                  >
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