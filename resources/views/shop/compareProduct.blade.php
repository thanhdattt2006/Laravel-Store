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
    <table class="compare-table" border="1">
        <tr>
            <th></th>
            @forelse($products as $index => $product)
            <th>
                Product {{ $index + 1 }}
                <form action="{{ route('compare.remove') }}" method="POST" class="delete-form" style="display:inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"
                        style="color:red; background:none; border:none; padding:0; margin: 0px; font-size: 20px; font-weight:bold; cursor:pointer;">
                        &times;
                    </button>
                </form>
            </th>
            @empty
            <th colspan="1" class="py-4 px-4 text-center">Your compare list is empty.</th>
            @endforelse
        </tr>
        <tr>
            <td><strong>Photo</strong></td>
            @forelse($products as $product)
            <td>
                @php
                $found = false;
                @endphp
                @foreach($product->variant as $variant)
                @if($variant->photos->first())
                <img src="{{ asset('user/nike-img/' . $variant->photos->first()->name) }}" width="250px" height="300px">
                @php $found = true; @endphp
                @break
                @endif
                @endforeach
                @if(!$found)
                <span>No photo</span>
                @endif
            </td>
            @empty
            <td>-</td>
            @endforelse
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            @forelse($products as $product)
            <td>{{ $product->name }}</td>
            @empty
            <td>-</td>
            @endforelse
        </tr>
        <tr>
            <td><strong>Price</strong></td>
            @forelse($products as $product)
            <td>{{ number_format($product->price, 0, ',', '.') }}VND</td>
            @empty
            <td>-</td>
            @endforelse
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            @forelse($products as $product)
            <td>{{ $product->description }}</td>
            @empty
            <td>-</td>
            @endforelse
        </tr>
        <tr>
            <td><strong>Action</strong></td>
            @forelse($products as $product)
            <td>
                <div class="compare-card">
                    <div class="single-product">
                        <div class="product-details">
                            <div class="prd-bottom">
                                <a href="" class="social-info">
                                    <span data-id="{{$product->id}}" class="ti-bag"></span>
                                </a>
                                <a href="#" class="social-info add-to-wishlist" data-id="{{ $product->id }}">
                                    <span class="lnr lnr-heart"></span>
                                </a>
                                <a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            @empty
            <td>-</td>
            @endforelse
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- alert them san pham wishlist -->
<script>
    $(document).ready(function() {
        $('.add-to-wishlist').click(function(e) {
            e.preventDefault();
            if (!checkLoginAndAlert()) return;

            var productId = $(this).data('id');
            $.ajax({
                url: "{{ route('wishlist.ajaxAdd') }}",
                type: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Notification!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    showError('Error!', 'Cannot add the product to the wishlist.');
                }
            });
        });
    });
</script>
<!-- alert remove compare list -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure you want to delete this product?',
                    text: 'The product will be removed from compare list!',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
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
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Product added',
        text: @json(session('success')),
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Notification!',
        text: @json(session('error')),
        confirmButtonText: 'OK'
    });
</script>
@endif