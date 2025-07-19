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
                            <th scope="col">Color</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cartItems as $item)
                        <tr class="top" id="cart-item-{{ $item->id }}">
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img height="150px" src="{{ asset('user/nike-img/' . $item->product->photo  ) }}" alt="{{ $item->product->name }}">
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $item->product->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div>
                                    <select name="size" data-cart-item-id="{{ $item->id }}">
                                        @for ($i = 36; $i <= 46; $i++)
                                            <option value="{{ $i }}" {{ $item->size == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                            </option>
                                            @endfor
                                    </select>

                                </div>
                            </td>
                            <td>
                                <h5 class="currency-format">{{ $item->product->price }}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="text"
                                        name="qty"
                                        id="qty-{{ $item->id }}"
                                        min="1"
                                        value="{{ $item->quantity }}"
                                        class="input-text qty"
                                        data-id="{{ $item->id }}"
                                        data-price="{{ $item->product->price }}"
                                        oninput="handleQtyChange(this)">

                                    <button onclick="changeQty('{{ $item->id }}', 1)" class="increase items-count" type="button">
                                        <i class="lnr lnr-chevron-up"></i>
                                    </button>

                                    <button onclick="changeQty('{{ $item->id }}', -1)" class="reduced items-count" type="button">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <h5 class="currency-format" id="item-total-{{ $item->id }}">
                                    {{ $item->total }}
                                </h5>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link cart-delete-button" style="padding:0; border:none; background:none; color:red;">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @endforeach
                        @if (session('delete'))
                        <div class="alert alert-success">
                            {{ session('delete') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <!-- CSRF token -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn update-cart">Update Cart</a>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
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
                            <td></td>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5 id="total-cart" class="currency-format">0</h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td>

                            </td>
                            <td></td>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
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
                            <td></td>
                            <td></td>
                            <td></td>
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
    // ✅ Cập nhật số lượng khi thay đổi (input tay)
    function changeQty(id, delta) {
        const input = document.getElementById('qty-' + id);
        let newQty = parseInt(input.value) + delta;
        if (newQty < 1) newQty = 1;
        input.value = newQty;
        updateQuantity(id, newQty);
    }

    function handleQtyChange(input) {
        let id = input.dataset.id;
        let newQty = parseInt(input.value);
        if (isNaN(newQty) || newQty < 1) {
            input.value = 1;
            newQty = 1;
        }
        updateQuantity(id, newQty);
    }

    function updateQuantity(id, quantity) {
        fetch('/shop/cart/update-quantity', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: id,
                    quantity: quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                function formatCurrency(value) {
                    return new Intl.NumberFormat('vi-VN').format(value);
                }

                if (data.success) {
                    document.getElementById('item-total-' + id).innerText = formatCurrency(data.total);
                    document.getElementById('total-cart').innerText = formatCurrency(data.totalCart);
                } else {
                    alert('Lỗi cập nhật: ' + data.message);
                }
            })
            .catch(err => {
                alert('Lỗi kết nối: ' + err.message);
            });
    }



    // ✅ Xóa sản phẩm khỏi giỏ hàng
</script>
<script>
    function isLogined() {
        return @json(Auth::check());
    }

    function checkLoginAndAlert() {
        if (!window.isLogined) {
            Swal.fire({
                icon: 'warning',
                title: 'Bạn chưa đăng nhập',
                text: 'Vui lòng đăng nhập hoặc đăng ký để sử dụng giỏ hàng.',
                showDenyButton: true,
                confirmButtonText: 'Đăng nhập',
                denyButtonText: 'Đăng ký',
                cancelButtonText: 'Để sau',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('account.login') }}";
                } else if (result.isDenied) {
                    window.location.href = "{{ route('account.register') }}";
                }
            });
        }
    }
    document.querySelector('.cart-icon')?.addEventListener('click', function() {
        checkLoginAndAlert(); // Hiện alert nếu chưa login
        // Show cart UI logic phía sau vẫn thực thi
    });
    fetch('/shop/shoppingCart', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.loggedIn === false) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Not logged in',
                    text: data.message,
                    confirmButtonText: 'Login now'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/account/login';
                    }
                });
            } else {
                // Hiển thị cart nếu muốn render trên frontend
                console.log('Cart Data:', data);
            }
        })
</script>

// xóa items
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.cart-delete-button');

        deleteButtons.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); // Ngăn submit mặc định

                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    text: 'Sản phẩm sẽ bị xóa khỏi giỏ hàng!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tìm form cha của nút
                        const form = btn.closest('form');
                        if (form) {
                            form.submit();
                        }
                    }
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('select[name="size"]').forEach(select => {
            select.addEventListener('change', function() {
                const cartItemId = this.dataset.cartItemId;
                const size = this.value;

                fetch('/cart/update-size', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            cart_item_id: cartItemId,
                            size: size
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            console.log("✅ Cập nhật size thành công");
                        } else {
                            alert("❌ Lỗi: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Lỗi hệ thống:", error);
                    });
            });
        });
    });
</script>


@endsection