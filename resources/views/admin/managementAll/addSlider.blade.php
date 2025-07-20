@extends('layout.admin')

@section('content')
<form action="" method="">
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
                                >Name</label
                              >
                              <div class="col-md-9 p-0">
                                <input
                                  type="text"
                                  class="form-control input-full"
                                  id="inlineinput"
                                  placeholder="Name Slide"
                                />
                              </div>
                            </div>
                            <!-- slide-img -->
                            <div class="form-group conTainer">
                                <input type="file" class="input" onchange="preview()" id="file-input" accept="image/png, image/jpeg" multiple>
                                <label class="label" for="file-input" >
                                    <i class="fa-solid fa-cloud-arrow-up" style="color: #1a2035;"></i> &nbsp;
                                    choose A Photo
                                </label>
                                <p  id="num-of-files">No Photo chosen</p>
                                <div id="images"></div>
                            </div>
                            <!-- Action  -->
                            <div class="form-group">
                              <label>Action</label><br />
                              <div class="d-flex">
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    name="flexRadioDefault"
                                    id="flexRadioDefault1"
                                    value="1"
                                    checked
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexRadioDefault1"
                                  >
                                    Active
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="radio"
                                    name="flexRadioDefault"
                                    id="flexRadioDefault2"
                                    value="0"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexRadioDefault2"
                                  >
                                    InActive
                                  </label>
                                </div>
                              </div>
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