@extends('layout.admin')
@section('content')
<form action="{{url('admin/saveCategories')}}" method="post">
  @csrf
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">Form Elements</div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 col-lg-4">
                            <!-- Name-category -->
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
                                  name="name"
                                  id="inlineinput"
                                  placeholder="Name Category"
                                />
                              </div>
                            </div>
                            
                            <!-- Action  -->
                            <!-- <div class="form-group">
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
                            </div> -->
                        </div>
                      </div>
                      <div class="card-action">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="{{url('admin/allCategories')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                      </div>
                    </div>
                  </div>
               </form>
@endsection