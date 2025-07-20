@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{asset('user')}}/css/compare-wishlist.css">

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Compare Products Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">product-details</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<div class="container">
    <table border="1" style="color: orange;">
        <tr>
            <th></th>
            @foreach($products as $product)
            <th>
                Product {{ $product->id }}
                <form action="{{ route('compare.remove') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit">X</button>
                </form>
            </th>
            @endforeach
        </tr>
        <tr>
            <td><strong>Photo</strong></td>
            @foreach($products as $product)
            <td><img src="{{asset('user')}}/nike-img/{{$product->photo}}" width="250px" height="300px"></td>
            @endforeach
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            @foreach($products as $product)
            <td>{{ $product->name }}</td>
            @endforeach
        </tr>
        <tr>
            <td><strong>Price</strong></td>
            @foreach($products as $product)
            <td>{{ $product->price }}VND</td>
            @endforeach
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            @foreach($products as $product)
            <td>{{ $product->description }}</td>
            @endforeach
        </tr>
        <tr>
            <td><strong>Action</strong></td>
            @foreach($products as $product)
            <td>
    <div  class="compare-card"> 
        <div class="single-product">
            <div class="product-details">
                
                <div class="prd-bottom">
                    <a href="" class="social-info">
                        <span class="ti-bag"></span>
                        <p class="hover-text">add to bag</p>
                    </a>
                    <a href="" class="social-info">
                        <span class="lnr lnr-heart"></span>
                        <p class="hover-text">Wishlist</p>
                    </a>
                    <a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
                        <span class="lnr lnr-move"></span>
                        <p class="hover-text">view more</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</td>




            @endforeach
        </tr>
    </table>

</div>

@endsection
@section('scripts')
<script>
    const ASSET_URL = "{{asset('user')}}"
</script>
<script src="{{asset('user/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
<script src="{{asset('user/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('user/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('user/js/jquery.sticky.js')}}"></script>
<script src="{{asset('user/js/nouislider.min.js')}}"></script>
<script src="{{asset('user/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
<!--gmaps Js-->
<script src="{{asset('user/js/gmaps.min.js')}}"></script>
<script src="{{asset('user/js/main.js')}}"></script>

@endsection