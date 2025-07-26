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
                                        @foreach ($item->product->variant as $photo)
                                        @if ($photo->photos->isNotEmpty())
                                        <img height="150px" src="{{ asset('user/nike-img/' . $photo->photos->first()->name  ) }}" alt="{{ $item->product->name }}">
                                        <!-- <a href="#"><img src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" width="70" height="70"></a> -->
                                        @break;
                                        @endif
                                        @endforeach
                                        <!-- <img height="150px" src="{{ asset('user/nike-img/' . $item->product->photo  ) }}" alt="{{ $item->product->name }}"> -->
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $item->product->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="display: inline; align-items: center; justify-content: center;">
                                    <select name="color" class="color-select" data-cart-item-id="{{ $item->id }}">
                                        @foreach($item->product->variant as $product_variant)
                                        <option value="{{ $product_variant->colors_id }}"
                                            {{ $item->color_id == $product_variant->color_id ? 'selected' : '' }}>
                                            {{ $product_variant->colors->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </td>

                            <td>
                                <div>

                                    <select class="cart-size-select" data-cart-item-id="{{ $item->id }}">
                                        @for ($i = 36; $i <= 46; $i++)
                                            <option value="{{ $i }}" {{ $item->size == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                            </option>
                                            @endfor
                                    </select>


                                </div>
                            </td>
                            <td>
                                <h5 class="currency-format">{{ number_format($item->product->price, 0, ',', '.') }} VND
                                </h5>
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
                                    {{ number_format($item->total, 0, ',', '.') }} VND
                                </h5>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="cart-delete-form" data-id="{{ $item->id }}" style="display:inline;">
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
                                <a class="gray_btn" href="#">Update Cart</a>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="cupon_text d-flex align-items-center">
                                    <input type="text" id="coupon-code" placeholder="Coupon Code">
                                    <a class="primary-btn" href="#" id="apply-voucher-btn">Apply</a>
                                    <a class="gray_btn" href="#" id="close-voucher-btn">Close Coupon</a>
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
                                <h5 id="subtotal" class="currency-format">{{ number_format($subtotal, 0, ',', '.') }}</h5>
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

                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">

                                        <li class="active"><a>Free ship</a></li>
                                    </ul>

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
                    document.getElementById('item-total-' + id).innerText = formatCurrency(data.total) + ' VND';

                    // ✅ Sửa dòng này: chỉ update nếu tồn tại
                    if (document.getElementById('subtotal')) {
                        document.getElementById('subtotal').innerText = formatCurrency(data.subtotal) + ' VND';
                    }
                } else {
                    alert('Lỗi cập nhật: ' + data.message);
                }
            })
            .catch(err => {
                alert('Lỗi kết nối: ' + err.message);
            });

    }




</script>
<script>
    function updateSubtotal(subtotalValue) {
        const subtotalEl = document.getElementById('subtotal');
        if (subtotalEl) {
            subtotalEl.innerText = subtotalValue.toLocaleString() + ' VND';
        } else {
            console.warn('⚠️ Không tìm thấy phần tử #subtotal');
        }
    }
</script>
<script>
    function isLogined() {
        return @json(Auth::check());
    }

    function checkLoginAndAlert() {
        if (!window.isLogined) {
            Swal.fire({
                icon: 'warning',
                title: 'You have not logged in',
                text: 'Please log in or register to use the cart.',
                showDenyButton: true,
                confirmButtonText: 'Log in',
                denyButtonText: 'Register',
                cancelButtonText: 'Later',
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
                updateSubtotal(data.subtotal); // ✅ Cập nhật subtotal
                console.log('Cart Data:', data);
            }
        })
</script>

<!-- // xóa items -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.cart-delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Chặn hành vi submit mặc định

                const itemId = form.dataset.id;

                Swal.fire({
                    title: 'Are you sure you want to delete this item?',
                    text: 'This product will be removed from your cart.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(form.action, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    // Xoá dòng trong bảng (table row)
                                    const row = document.getElementById(`cart-item-${itemId}`);
                                    if (row) row.remove();

                                    Swal.fire('Done!', data.message, 'success');
                                } else {
                                    Swal.fire('Error!', data.message, 'error');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error!', 'Cant delete product!', 'error');
                            });
                    }
                });
            });
        });
    });
</script>


<!-- update size -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.cart-size-select').forEach(select => {
            select.addEventListener('change', async () => {
                const cartItemId = select.dataset.cartItemId;
                const size = select.value;

                try {
                    console.log('🧪 Sending size update...', cartItemId, size);

                    const res = await fetch('/shop/cart/update-size', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            cart_item_id: cartItemId,
                            size
                        })
                    });

                    const data = await res.json();

                    if (data.success) {
                        console.log("✅ Cập nhật size thành công");
                    } else {
                        alert("❌ Lỗi: " + data.message);
                    }
                } catch (err) {
                    console.error("❌ JS Error:", err);
                }
            });
        });
    });
</script>


<!-- update color -->
<script>
    document.querySelectorAll('.color-select').forEach(select => {
        select.addEventListener('change', function() {
            const cartItemId = this.dataset.cartItemId;
            const colorId = this.value;

            fetch('/shop/cart/update-color', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        cart_item_id: cartItemId,
                        color_id: colorId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Lỗi:', error));
        });
    });
</script>

<!-- voucher -->

<script>
    document.getElementById('apply-voucher-btn').addEventListener('click', function(e) {
        e.preventDefault();
        const code = document.getElementById('coupon-code').value;

        fetch(`shop/checkout/apply-voucher?keyword=${encodeURIComponent(code)}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('subtotal').innerText = data.subtotal;

                    // Lưu voucher_id vào input ẩn để gửi khi đặt hàng
                    if (!document.getElementById('voucher-id')) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'voucher_discount_id';
                        input.id = 'voucher-id';
                        input.value = data.voucher_id;
                        document.querySelector('form').appendChild(input);
                    } else {
                        document.getElementById('voucher-id').value = data.voucher_id;
                    }

                    alert(data.message);
                } else {
                    alert(data.message);
                }
            });
    });
</script>


@endsection