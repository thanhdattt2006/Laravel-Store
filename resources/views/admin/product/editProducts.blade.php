@extends('layout.admin')

@section('content')
<form action="{{url(('admin/upDateProducts'))}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$products->id}}"/>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Product</div>
        </div>
        <div class="card-body">
          @if (session('error'))
            <div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 alert alert-danger">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
          @endif
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
                            value="{{$products->name}}"
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
                                oninput="limitInput(this)"
                                value="{{$products->price}}"
                            />
                            </div>
                        </div>
                    </div>
                    <!-- Category -->
                     <div class="form-group">
                        <label class="form-label">Category</label>
                        <div class="selectgroup selectgroup-pills">
                        @foreach($cates as $cate)
                        @if($products->cate->id == $cate->id)
                            <label class="selectgroup-item">
                            <input
                            type="radio"
                            name="cate_id"
                            value="{{$products->cate->id}}"
                            class="selectgroup-input"
                            checked
                            />
                            <span class="selectgroup-button">{{$cate->name}}</span>
                        </label>
                        @else
                        <label class="selectgroup-item">
                            <input
                            type="radio"
                            name="cate_id"
                            value="{{$cate->id}}"
                            class="selectgroup-input"
                            />
                            <span class="selectgroup-button">{{$cate->name}}</span>
                        </label>
                        @endif
                        @endforeach
                        </div>
                    </div>
                        
                    @php $i = 0 @endphp
                    @foreach($products->variant as $variant) 
                        @for ($i; $i < 2; $i++)
                        <input type="hidden" name="variant_id{{$i}}" value="{{$variant->id}}" />
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
                                    oninput="limitInput2(this)"
                                    value="{{$variant->stock}}"
                                />
                                </div>
                            </div>
                        </div>
                        <!-- Color -->
                        <div class="form-group">
                            <label class="form-label">Color</label>
                            <div class="row gutters-xs">
                            @foreach($colors as $color)
                            @if($variant->colors_id == $color->id)
                                <div class="col-auto">
                                    <label class="colorinput">
                                    <input
                                        name="color_id[]"
                                        type="checkbox"
                                        value="{{$color->id}}"
                                        class="colorinput-input"
                                        checked
                                    />
                                    <span class="colorinput-color" style="background-color: {{$color->name}};"></span>
                                    </label>
                                </div>
                                @else
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
                                @endif
                            @endforeach
                            </div>
                        </div>
                            <!-- Product-img -->
                            <div class="form-group conTainer">
                                <input type="file" name="photo_name{{$i}}[]"  class="input" onchange="preview('{{$i}}')" id="file-input{{$i}}" accept="image/png, image/jpeg, image.jpg," multiple maxlength="8">
                                <label class="label" for="file-input{{$i}}" >
                                    <i class="fa-solid fa-cloud-arrow-up" style="color: #1a2035;"></i> &nbsp;
                                    choose A Photo
                                </label>
                                <p class="num-of-files" id="num-of-files{{$i}}">No Photo chosen</p>
                                <div class="images" id="images{{$i}}"></div>
                            </div>
                            @break
                            @endfor
                        @php $i++ @endphp
                        @endforeach
                        </div>

                <!-- Description -->
                <div>
                    <div class="input-group">
                        <span class="input-group-text">Description</span>
                        <textarea
                        class="form-control"
                        aria-label="With textarea"
                        name="description"
                        >{{$products->description}}</textarea>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-action">
            <button type="submit" class="btn btn-success">Add</button>
             <a href="{{url('admin/allProducts')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
    <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
    <script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection