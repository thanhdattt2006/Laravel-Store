@extends('layout.admin')

@section('content')
<form action="{{url(('admin/saveProducts'))}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Product</div>
        </div>
        <div class="card-body">
            <div  class="description" >
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
                            name="name"
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
                                name="price"
                            />
                            </div>
                        </div>
                    </div>
                    <!-- Stock -->
                    <!-- <div class="form-group">
                        <div class="input-group mb-3">
                            <div><label
                            for="inlineinput"
                            class="col-md-3 col-form-label"
                            >Stock</label>
                            <input
                                type="number"
                                class="form-control"
                                aria-label="Amount (to the nearest dollar)" placeholder="Price product"
                                name="stock"
                            />
                            </div>
                        </div>
                    </div> -->
                    <!-- Category -->
                     <div class="form-group">
                          <label class="form-label">Category</label>
                          <div class="selectgroup selectgroup-pills">
                            @foreach($cates as $cate)
                            <label class="selectgroup-item">
                              <input
                                type="radio"
                                name="cate_id"
                                value="{{$cate->id}}"
                                class="selectgroup-input"
                              />
                              <span class="selectgroup-button">{{$cate->name}}</span>
                            </label>
                            @endforeach
                          </div>
                        </div>
                    <!-- Color -->
                    <div class="form-group">
                        <label class="form-label">Color</label>
                        <div class="row gutters-xs">
                          @foreach($colors as $color)
                            <div class="col-auto">
                                <label class="colorinput">
                                <input
                                    name="color_id[]"
                                    type="checkbox"
                                    value="{{$color->id}}"
                                    class="colorinput-input"
                                />
                                <span class="colorinput-color" style="background-color: {{$color->name}};"></span>
                                </label>
                            </div>
                          @endforeach
                        </div>
                    </div>
                    @for ($i = 0; $i < 2; $i++)
                    <!-- Stock -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div><label
                            for="inlineinput"
                            class="col-md-3 col-form-label"
                            >Stock</label>
                            <input
                                type="number"
                                class="form-control"
                                aria-label="Amount (to the nearest dollar)" placeholder="Price product"
                                name="stock{{$i}}"
                            />
                            </div>
                        </div>
                    </div>
                    <!-- Color -->
                    <!-- <div class="form-group">
                        <label class="form-label">Color</label>
                        <div class="row gutters-xs">
                          @foreach($colors as $color)
                            <div class="col-auto">
                                <label class="colorinput">
                                <input
                                    name="color_id[]"
                                    type="radio"
                                    value="{{$color->id}}"
                                    class="colorinput-input"
                                />
                                <span class="colorinput-color" style="background-color: {{$color->name}};"></span>
                                </label>
                            </div>
                          @endforeach
                        </div>
                    </div> -->
                    <!-- Product-img -->
                    <div class="form-group conTainer">
                        <input type="file" name="photo_name{{$i}}[]" class="input" onchange="preview('{{$i}}')" id="file-input{{$i}}" accept="image/png, image/jpeg, image.jpg," multiple maxlength="8">
                        <label class="label" for="file-input{{$i}}" >
                            <i class="fa-solid fa-cloud-arrow-up" style="color: #1a2035;"></i> &nbsp;
                            choose A Photo
                        </label>
                        <p class="num-of-files" id="num-of-files{{$i}}">No Photo chosen</p>
                        <div class="images" id="images{{$i}}"></div>
                    </div>
                    @endfor
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

                <!-- Description -->
                <div>
                    <div class="input-group">
                        <span class="input-group-text">Description</span>
                        <textarea
                        class="form-control"
                        aria-label="With textarea"
                        name="description"
                        ></textarea>
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