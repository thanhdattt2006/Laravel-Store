@extends('layout.admin')

@section('content')
    <div class="container">
          <div class="page-inner">
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center top">
                      <h4 class="card-title">Slider List</h4>
                      <a href="{{url('admin/addSlider')}}">
                        <button class="btn btn-primary btn-round ms-auto">
                          <i class="fa fa-plus"></i>
                          Add Slider
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($photos as $photo)
                          <tr>
                            <td>{{$photo->id}}</td>
                            <td class="tbody-td"><img src="{{asset('user')}}/banner/{{$photo->name}}" alt="{{$photo->name}}"></td>
                            <td>{{$photo->name}}</td>
                            <td>
                              <div class="form-button-action">
                                <a href="{{url('admin/deleteSlider/' . $photo->id)}}" onclick="return confirm('Are you sure to delete?')">
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
  <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection