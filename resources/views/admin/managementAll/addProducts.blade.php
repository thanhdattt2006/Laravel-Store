@extends('layout.admin')

@section('content')
<form action="" method="">
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">Add Product</div>
                      </div>
                      <div class="card-body">
                        <div class="">
                          <div class="col-md-6 col-lg-4">
                            <!-- Name-product -->
                                <div class="form-group form-inline" >
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
                                      placeholder="Name Product"
                                    />
                                  </div>
                                </div>
                            <!-- Price -->
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div><label
                                    for="inlineinput"
                                    class="col-md-3 col-form-label"
                                    >Price</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        aria-label="Amount (to the nearest dollar)" placeholder="Price product"
                                    />
                                    </div>
                                </div>
                            </div>
                           <!-- Category -->
                             <div class="form-group">
                          <label for="smallSelect">Category</label>
                          <select
                            class="form-select form-control-sm"
                            id="smallSelect"
                          >
                            <option>Gym</option>
                            <option>sport</option>
                            <option>Football</option>
                            <option>Pick-ca-ball</option>
                            <option>swimming-shoes</option>
                          </select>
                            </div>
                           <!-- Color -->
                           <div class="form-group">
                          <label class="form-label">Color Input</label>
                          <div class="row gutters-xs">
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="dark"
                                  class="colorinput-input"
                                />
                                <span class="colorinput-color bg-black"></span>
                              </label>
                            </div>
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="primary"
                                  class="colorinput-input"
                                />
                                <span
                                  class="colorinput-color bg-primary"
                                ></span>
                              </label>
                            </div>
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="secondary"
                                  class="colorinput-input"
                                />
                                <span
                                  class="colorinput-color bg-secondary"
                                ></span>
                              </label>
                            </div>
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="info"
                                  class="colorinput-input"
                                />
                                <span class="colorinput-color bg-info"></span>
                              </label>
                            </div>
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="success"
                                  class="colorinput-input"
                                />
                                <span
                                  class="colorinput-color bg-success"
                                ></span>
                              </label>
                            </div>
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="danger"
                                  class="colorinput-input"
                                />
                                <span class="colorinput-color bg-danger"></span>
                              </label>
                            </div>
                            <div class="col-auto">
                              <label class="colorinput">
                                <input
                                  name="color"
                                  type="checkbox"
                                  value="warning"
                                  class="colorinput-input"
                                />
                                <span
                                  class="colorinput-color bg-warning"
                                ></span>
                              </label>
                            </div>
                          </div>
                            </div>
                            <!-- Product-img -->
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
                        <button type="submit" class="btn btn-success">Add</button>
                        <button class="btn btn-danger">Cancel</button>
                      </div>
                    </div>
                  </div>
               </form>
@endsection

@section('scripts')
    <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection