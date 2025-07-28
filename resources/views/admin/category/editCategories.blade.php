@extends('layout.admin')
@section('content')
<form action="{{url('admin/updateCategory')}}" method="post">
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
                                  value="{{$cate->name}}"
                                />
                              </div>
                            </div>
                            
                            <input type="hidden" name="id" value="{{$cate->id}}"/>
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