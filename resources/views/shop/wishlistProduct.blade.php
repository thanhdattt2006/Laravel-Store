@extends('layout.user')

@section('content')
<link rel="stylesheet" href="{{asset('user')}}/css/compare-wishlist.css">

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Wishlist Products Page</h1>
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
<div class="container my-5">
    <h2 class="text-2xl font-semibold mb-4">My Wishlist</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Image</th>
                    <th class="py-2 px-4 text-left">Product name</th>
                    <th class="py-2 px-4 text-left">Unit price</th>
                    <th class="py-2 px-4 text-left">Stock status</th>
                    <th class="py-2 px-4 text-left">Added on</th>
                    <th class="py-2 px-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wishlistItems as $item)
                <tr class="border-t border-gray-200">
                    <td class="py-2 px-4">
                        <img src="{{ asset('storage/products/' . $item->product->photo) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover">
                    </td>
                    <td class="py-2 px-4">{{ $item->product->name }}</td>
                    <td class="py-2 px-4">${{ number_format($item->product->price, 2) }}</td>
                    <td class="py-2 px-4">
                        @if ($item->product->stock > 0)
                        <span class="text-green-600">In stock</span>
                        @else
                        <span class="text-red-600">Out of stock</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $item->created_at->format('F d, Y') }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('cart.add', $item->product_id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white py-1 px-3 rounded">Add to cart</button>
                        </form>
                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="inline ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Remove</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 px-4 text-center">Your wishlist is empty.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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