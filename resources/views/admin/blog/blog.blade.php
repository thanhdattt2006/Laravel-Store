@extends('layout.admin')
@section('content')
<div class="container">
          <div class="page-inner">
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center top">
                      <h4 class="card-title">Blog List</h4>
                      <a href="{{url('admin/addBlog')}}">
                        <button class="btn btn-primary btn-round ms-auto">
                          <i class="fa fa-plus"></i>
                          Add Blog
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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>description</th>
                            <th>Created_at</th>
                            <th>Update_at</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Iamge</th>
                            <th>Content</th>
                            <th>description</th>
                            <th>Created_at</th>
                            <th>Update_at</th>
                            <th>Status</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($blogs as $blog)
                          <tr>
                            <td>{{$blog->id}}</td>
                            <td class="overflow-short">{{$blog->title}}</td>
                            <td class="tbody-td"><img src="{{asset('user')}}/blog/{{ $blog->photo}}" alt="{{ $blog->photo}}"></td>
                            <td class="overflow">{{ $blog->content}}</td>
                            <td class="overflow-short">{{ $blog->description}}</td>
                            <td class="format-date">{{ $blog->created_at}}</td>
                            <td class="format-date">{{ $blog->updated_at}}</td>
                            <!-- <td>Active</td> -->
                            <td>
                              <div class="form-button-action">
                               <a href="{{url('admin/editBlog/' . $blog->id)}}">
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
                               <a href="{{url('admin/deleteBlog/' . $blog->id)}}" onclick="return confirm('Bạn có chắc muốn xoá?')">
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