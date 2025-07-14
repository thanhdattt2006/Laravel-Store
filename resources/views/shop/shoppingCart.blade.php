@extends('layout.user')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shopping Cart</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">Cart</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $cart = session('shoppingCart');
                        @endphp
                        @foreach ($cart ?? [] as $id => $item)
                        <tr class="top" id="{{ $id }}">
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img height="150px" src="{{ asset('user')}}/nike-img/{{ $item['photo'] }}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $item['name'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="currency-format">{{$item['price'] }} </h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="text"
                                        name="qty"
                                        id="qty-{{ $id }}"
                                        min="1"
                                        value="{{ $item['quantity'] }}"
                                        class="input-text qty"
                                        data-id="{{ $id }}"
                                        data-price="{{ $item['price'] }}"
                                        oninput="handleQtyChange(this)">

                                    <button onclick="changeQty('{{ $id }}', 1)" class="increase items-count" type="button">
                                        <i class="lnr lnr-chevron-up"></i>
                                    </button>

                                    <button onclick="changeQty('{{ $id }}', -1)" class="reduced items-count" type="button">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </button>
                                </div>

                            </td>
                            <td>
                                <h5 id="total-{{ $id }}">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</h5>
                            </td>
                            <td>
                                <i class="fa fa-close hidden" onclick="removeItem('{{ $id }}')"></i>
                            </td>
                        </tr>
                        @endforeach
                        <!-- CSRF token -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn update-cart">Update Cart</a>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="cupon_text d-flex align-items-center">
                                    <input type="text" placeholder="Coupon Code">
                                    <a class="primary-btn" href="#">Apply</a>
                                    <a class="gray_btn" href="#">Close Coupon</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5 id="subtotal" class="currency-format">0</h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Shipping</h5>
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li><a href="#">Flat Rate: $5.00</a></li>
                                        <li><a href="#">Free Shipping</a></li>
                                        <li><a href="#">Flat Rate: $10.00</a></li>
                                        <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                    </ul>
                                    <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                    <select class="shipping_select">
                                        <option value="1">Bangladesh</option>
                                        <option value="2">India</option>
                                        <option value="4">Pakistan</option>
                                    </select>
                                    <select class="shipping_select">
                                        <option value="1">Select a State</option>
                                        <option value="2">Select a State</option>
                                        <option value="4">Select a State</option>
                                    </select>
                                    <input type="text" placeholder="Postcode/Zipcode">
                                    <a class="gray_btn" href="#">Update Details</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="{{url('home/index')}}">Continue Shopping</a>
                                    <a class="primary-btn" href="{{url('shop/productCheckout')}}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!--================End Cart Area =================-->
<script type="text/javascript">

</script>
@endsection

@section('scripts')
<script>
</script>
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
<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function updateTotal(id, price) {
        let qty = parseInt(document.getElementById('sst-' + id).value);
        if (!isNaN(qty)) {
            let total = qty * price;
            document.getElementById('total-' + id).innerText = total.toLocaleString('vi-VN');
        }
    }

    function updateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.qty').forEach(function(input) {
            const qty = parseInt(input.value) || 1;
            const price = parseFloat(input.dataset.price) || 0;
            subtotal += qty * price;
        });
        document.getElementById('subtotal').innerText = subtotal.toLocaleString('vi-VN');
    }

    // Gọi khi trang vừa load
    document.addEventListener('DOMContentLoaded', function() {
        updateSubtotal();
    });

    // Gọi sau mỗi lần thay đổi số lượng
    function changeQty(id, delta) {
        const input = document.getElementById('qty-' + id);
        let qty = parseInt(input.value) || 1;

        qty += delta;
        if (qty < 1) qty = 1;

        input.value = qty;
        updateTotalDisplay(id, qty);
        updateCartSession(id, qty);
        updateSubtotal(); // Thêm dòng này
    }

    function handleQtyChange(input) {
        let qty = parseInt(input.value) || 1;
        if (qty < 1) qty = 1;
        input.value = qty;

        const id = input.dataset.id;
        updateTotalDisplay(id, qty);
        updateCartSession(id, qty);
        updateSubtotal(); // Thêm dòng này
    }

    function updateTotalDisplay(id, qty) {
        const price = parseFloat(document.getElementById('qty-' + id).dataset.price);
        const total = qty * price;
        document.getElementById('total-' + id).innerText = total.toLocaleString('vi-VN');
    }

    function removeItem(id) {
        Swal.fire({
            title: 'Are you sure to delete this product?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/shop/shoppingCart/' + id, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(id).remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The product has been removed from the cart.',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Could not delete',
                                text: 'Unable to delete this product.',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Please try again later.',
                            confirmButtonText: 'OK'
                        });
                        console.error(error);
                    });
            }
        });
    }



    function updateCartSession(id, newQty) {
        console.log('🟡 Send updation: ', id, newQty);
        fetch('/shop/shoppingCart/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    quantity: newQty
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    console.log('🟢 Update session OK');
                } else {
                    alert('Update failed');
                }
            })
            .catch(err => {
                console.error('🔴 Error fetching:', err);
            });
    }

    function increaseQty(id, price) {
        let input = document.getElementById('sst-' + id);
        let qty = parseInt(input.value) || 1;
        qty++;
        input.value = qty;
        updateCartSession(id, qty);
    }

    function decreaseQty(id, price) {
        let input = document.getElementById('sst-' + id);
        let qty = parseInt(input.value) || 1;
        if (qty > 1) qty--;
        input.value = qty;
        updateCartSession(id, qty);
    }
</script>


@endsection