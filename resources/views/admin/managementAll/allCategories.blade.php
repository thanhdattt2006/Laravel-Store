@extends('layout.admin')
@section('content')
   <div class="container">
          <div class="page-inner">
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center top">
                      <h4 class="card-title">Categories List</h4>
                      <a href="{{url('admin/addCategories')}}">
                        <button class="btn btn-primary btn-round ms-auto">
                          <i class="fa fa-plus"></i>
                          Add Categories
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
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($cates as $cate)
                          <tr>
                            <td>{{$cate->id}}</td>
                            <td>{{$cate->name}}</td>
                            <td>Active</td>
                            <td>
                              <div class="form-button-action">
                               <a href="{{url('admin/editCategory/' . $cate->id)}}">
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
                               <a href="{{url('admin/deleteCategory/' . $cate->id)}}" onclick="return confirm('Bạn có chắc muốn xoá?')">
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