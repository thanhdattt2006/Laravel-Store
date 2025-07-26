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

    <div class="overflow-x-auto">
        <table border="1">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-center">Photo</th>
                    <th class="py-2 px-4 text-center">Name</th>
                    <th class="py-2 px-4 text-center">Price</th>
                    <th class="py-2 px-4 text-center">Stock status</th>
                    <th class="py-2 px-4 text-center">Added on</th>
                    <th class="py-2 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wishlistItems as $item)
                @php
                // Lấy biến thể đầu tiên của product
                $variant = $item->product->variant->first();
                @endphp
                <tr class="border-t border-gray-200">
                    <td class="py-2 px-4">
                        @if($variant && $variant->photos && $variant->photos->isNotEmpty())
                        <img src="{{ asset('user/nike-img/' . $variant->photos->first()->name) }}" height="150px" class="w-16 h-16 object-cover">
                        @else
                        <span>No photo</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $item->product->name }}</td>
                    <td class="py-2 px-4">{{ number_format($item->product->price, 0, ',', '.') }}VND</td>
                    <td class="py-2 px-4">
                        @if($variant)
                        @if ($variant->stock > 0)
                        <span class="text-green-600">In stock</span>
                        @else
                        <span class="text-red-600">Out of stock</span>
                        @endif
                        @else
                        <span>No variant</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $item->created_at->format('F d, Y') }}</td>
                    <td class="py-2 px-4">
                        <div class="compare-card">
                            <div class="single-product">
                                <div class="product-details">
                                    <div class="prd-bottom">
                                        <a href="" class="social-info">
                                            <span data-id="{{$item->id}}" class="ti-bag"></span>
                                        </a>
                                        <a href="#" class="social-info add-to-compare" data-id="{{ $item->id }}">
                                            <span class="lnr lnr-sync"></span>
                                        </a>
                                        <a href="{{ url('/shop/productDetails/' . $item->id) }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                        </a>
                                        <form action="{{ route('wishlist.remove', $item->product_id) }}" method="POST" class="delete-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="color:red; background:none; border:none; padding:0; margin:0; font-size: 20px; font-weight:bold; cursor:pointer;">
                                                &times;
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<!-- alert them san pham compare -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-compare').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.dataset.id;

                fetch('/shop/compare/' + productId)
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: data.success ? 'success' : 'info',
                            title: data.success ? 'Product added' : 'Notification!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Connection error!',
                            text: err.message,
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    });
</script>
<!-- alert remove wishlist -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure you want to delete this product?',
                    text: 'The product will be removed from wishlist!',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>

<!-- <a> va alert add to cart  -->
<script>
    // Kiểm tra đăng nhập
    function isLogined() {
        return @json(Auth::check());
    }

    function showError(title, message) {
        Swal.fire({
            icon: 'error',
            title,
            text: message
        });
    }


    function sendAddToCartRequest(productId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error("CSRF token not found.");
            showError('Error', 'Cannot find CSRF token. Please reload the page.');
            return;
        }
        Swal.fire({
            icon: 'info',
            title: 'Adding product...',
            text: 'Please wait...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        fetch('/shop/shoppingCart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: data.success ? 'success' : 'error',
                    title: data.success ? 'Product added' : 'Error',
                    text: data.message
                });
            })
            .catch(err => {
                console.error("Error sending request:", err);
                showError('System Error', 'Cannot add product. Please try again later.');
            });
    }

    function addToCart(productId) {
        if (!isLogined()) {
            Swal.fire({
                icon: 'warning',
                title: 'You need to log in',
                text: 'Please log in to add products to the cart.',
                showCancelButton: true,
                confirmButtonText: 'Log in now',
                cancelButtonText: 'Later'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/account";
                }
            });
            return;
        }

        sendAddToCartRequest(productId);
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log("Login status:", isLogined());

        document.querySelectorAll('.ti-bag, .add-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.classList.contains('skip-add-to-cart')) return;
                e.preventDefault();

                const productId = this.dataset.id || this.closest('[data-id]')?.dataset.id;
                if (productId) {
                    addToCart(productId);
                } else {
                    showError('Error', 'Cannot find product ID. Please try again.');
                }
            });
        });
    });
</script>
@endsection