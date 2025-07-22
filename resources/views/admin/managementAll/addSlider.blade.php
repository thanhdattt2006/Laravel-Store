@extends('layout.admin')

@section('content')
<form action="{{url('admin/uploadImg')}}" method="post" enctype="multipart/form-data">
   @csrf
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">Form Elements</div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 col-lg-4">
                            <!-- Name-slide -->
                            <div class="form-group form-inline">
                              <label
                                for="inlineinput"
                                class="col-md-3 col-form-label"
                                >Name Slide Without Spaces</label
                              >
                              <div class="col-md-9 p-0">
                                <input
                                  type="text"
                                  class="form-control input-full"
                                  id="inlineinput"
                                  placeholder="Enter name without spaces"
                                  name="name"
                                  pattern="^\S*$"
                                  title="No spaces allowed"
                                  required
                                />
                              </div>
                            </div>
                            <!-- slide-img -->
                            <p style=" visibility: hidden;">{{$i = 0}}</p>
                            <label>Slide Photo</label>
                            <div class="form-group conTainer">
                                <input type="file" class="input" name="file" onchange="preview('{{$i}}')" id="file-input{{$i}}" accept="image/png, image/jpeg, image/jpg" required>
                                <label class="label" for="file-input{{$i}}" >
                                    <i class="fa-solid fa-cloud-arrow-up" style="color: #1a2035;"></i> &nbsp;
                                    choose A Photo
                                </label>
                                <p  id="num-of-files{{$i}}">No Photo chosen</p>
                                <div id="images{{$i}}"></div>
                            </div>
                        </div>
                      </div>
                      <div class="card-action">
                        <button class="btn btn-success">Add</button>
                        <button class="btn btn-danger">Cancel</button>
                      </div>
                    </div>
                  </div>
               </form>
@endsection

@section('scripts')
    <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection 
