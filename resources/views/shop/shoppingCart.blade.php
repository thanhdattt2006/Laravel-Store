    @extends('layout.user')

    @section('content')
    <!-- Start Banner Area -->
    <style>
        .custom-select-box {
            position: relative;
            width: 68px;
            user-select: none;
            font-family: sans-serif;
        }

        .custom-selected {
            border: 1px solid #ccc;
            padding: 10px 14px;
            border-radius: 6px;
            background: #fff;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            border: 1px solid #ccc;
            border-top: none;
            background: white;
            z-index: 10;
        }

        .custom-option {
            padding: 7px 9fpx;
            cursor: pointer;
        }

        .custom-option:hover,
        .custom-option.selected {
            background-color: #f0f0f0;
        }
    </style>
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
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $item->product->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: inline; align-items: center; justify-content: center;">
                                        <div class="custom-select-box color-dropdown" data-cart-item-id="{{ $item->id }}">
                                            <div class="custom-selected">
                                                <span class="custom-selected-text">
                                                    {{ optional($item->product->variant->firstWhere('color_id', $item->color_id) ?? $item->product->variant->first())->colors->name ?? 'Select color' }}
                                                </span>
                                                <span class="custom-arrow">&#9662;</span>
                                            </div>
                                            <div class="custom-options">
                                                @foreach($item->product->variant as $product_variant)
                                                <div class="custom-option {{ $item->color_id == $product_variant->color_id ? 'selected' : '' }}"
                                                    data-value="{{ $product_variant->colors_id }}">
                                                    {{ $product_variant->colors->name }}
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>

                                </td>

<<<<<<< HEAD
                            <td>
                                <div class="sidebar-categories">

                                    <select class="cart-size-select" data-cart-item-id="{{ $item->id }}">
                                        @for ($i = 36; $i <= 46; $i++)
                                            <option value="{{ $i }}" {{ $item->size == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                            </option>
=======
                                <td>
                                    <div>
                                        <div class="custom-select-box size-dropdown" data-cart-item-id="{{ $item->id }}" style="width: 53px">
                                            <div class="custom-selected">
                                                <span class="custom-selected-text">{{ $item->size }}</span>
                                                <span class="custom-arrow">&#9662;</span>
                                            </div>
                                            <div class="custom-options">
                                                @for ($i = 36; $i <= 46; $i++)
                                                    <div class="custom-option {{ $item->size == $i ? 'selected' : '' }}" data-value="{{ $i }}">{{ $i }}</div>
>>>>>>> 71babd7aa1654df6aad49d16a5b5296837734d15
                                            @endfor
                                        </div>
                                    </div>

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

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>

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
                            <a class="primary-btn" id="proceed-checkout-btn" href="{{url('shop/productCheckout')}}">Proceed to checkout</a>
                        </div>
<<<<<<< HEAD
                    </td>
                </tr>
                </tbody>
=======
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
                                    <a class="gray_btn" href="#" id="close-voucher-btn" style="width: 300px">Close Coupon</a>
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
                                    <a class="gray_btn" href="{{url('home/index')}}" style="width: 300px">Continue Shopping</a>
                                    <a class="primary-btn" href="{{url('shop/productCheckout')}}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
>>>>>>> 6dc2762a31c67a285f8649bfdcfd8c8e6cae7190
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
        // ✅ Hàm check đăng nhập + role
        function isLogined() {
            return @json(Auth::check());
        }

        function getRoleId() {
            return @json(optional(Auth::user())->role_id);
        }

        function isAdmin() {
            return isLogined() && getRoleId() === 1;
        }

        // ✅ Kiểm tra login và role khi vào trang cart
        document.addEventListener('DOMContentLoaded', function() {
            if (!isLogined()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'You are not logged in',
                    text: 'Please log in to access your cart.',
                    confirmButtonText: 'Go to Login'
                }).then(() => {
                    window.location.href = "{{ route('account.login') }}";
                });
                return;
            }

            if (isAdmin()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Access Denied',
                    text: 'Admins are not allowed to access the cart.',
                    confirmButtonText: 'Go back'
                }).then(() => {
                    window.location.href = document.referrer || "{{ route('home') }}";
                });
            }
        });

        // ✅ Khi nhấn icon cart
        document.querySelector('.cart-icon')?.addEventListener('click', function() {
            if (!isLogined()) {
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
        });

        // ✅ Cập nhật giỏ hàng từ backend nếu đang login
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
                    }).then(() => {
                        window.location.href = '/account/login';
                    });
                } else {
                    updateSubtotal(data.subtotal);
                    console.log('Cart Data:', data);
                }
            });

        // ✅ Xóa item
        document.querySelectorAll('.cart-delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
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

        // ✅ Update size
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.size-dropdown').forEach(selectBox => {
                const selected = selectBox.querySelector(".custom-selected");
                const selectedText = selected.querySelector(".custom-selected-text");
                const options = selectBox.querySelector(".custom-options");
                const optionItems = options.querySelectorAll(".custom-option");
                const cartItemId = selectBox.dataset.cartItemId;

                selected.addEventListener("click", () => {
                    const isOpen = options.style.display === "block";
                    options.style.display = isOpen ? "none" : "block";
                    selected.classList.toggle("open");
                });

                optionItems.forEach(option => {
                    option.addEventListener("click", async () => {
                        // UI update
                        optionItems.forEach(o => o.classList.remove("selected"));
                        option.classList.add("selected");

                        const size = option.dataset.value;
                        selectedText.textContent = option.textContent;
                        options.style.display = "none";
                        selected.classList.remove("open");

                        console.log("[Size Dropdown] CartItem:", cartItemId, "→ Size:", size);

                        // AJAX request
                        try {
                            const res = await fetch('/shop/cart/update-size', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    cart_item_id: cartItemId,
                                    size: size
                                })
                            });

                            const data = await res.json();
                            if (!data.success) {
                                alert("❌ " + data.message);
                            } else {
                                console.log("✅ Size updated successfully.");
                            }
                        } catch (err) {
                            console.error("❌ JS Error:", err);
                        }
                    });
                });

                // Close dropdown if clicked outside
                document.addEventListener("click", e => {
                    if (!selectBox.contains(e.target)) {
                        options.style.display = "none";
                        selected.classList.remove("open");
                    }
                });
            });
        });

        // ✅ Update color
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.color-dropdown').forEach(selectBox => {
                const selected = selectBox.querySelector(".custom-selected");
                const selectedText = selected.querySelector(".custom-selected-text");
                const options = selectBox.querySelector(".custom-options");
                const optionItems = options.querySelectorAll(".custom-option");
                const cartItemId = selectBox.dataset.cartItemId;

                selected.addEventListener("click", () => {
                    const isOpen = options.style.display === "block";
                    options.style.display = isOpen ? "none" : "block";
                    selected.classList.toggle("open");
                });

                optionItems.forEach(option => {
                    option.addEventListener("click", async () => {
                        // UI update
                        optionItems.forEach(o => o.classList.remove("selected"));
                        option.classList.add("selected");

                        const colorId = option.dataset.value;
                        selectedText.textContent = option.textContent;
                        options.style.display = "none";
                        selected.classList.remove("open");

                        console.log("[Color Dropdown] CartItem:", cartItemId, "→ ColorID:", colorId);

                        // AJAX update
                        try {
                            const res = await fetch('/shop/cart/update-color', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    cart_item_id: cartItemId,
                                    color_id: colorId
                                })
                            });

                            const data = await res.json();
                            if (!data.success) {
                                alert("❌ " + data.message);
                            } else {
                                console.log("✅ Color updated successfully.");
                            }
                        } catch (err) {
                            console.error("❌ JS Error:", err);
                        }
                    });
                });

                // Close on outside click
                document.addEventListener("click", e => {
                    if (!selectBox.contains(e.target)) {
                        options.style.display = "none";
                        selected.classList.remove("open");
                    }
                });
            });
        });

        // ✅ Áp dụng voucher
        document.getElementById('apply-voucher-btn')?.addEventListener('click', function(e) {
            e.preventDefault();
            const code = document.getElementById('coupon-code').value;

            fetch(`shop/checkout/apply-voucher?keyword=${encodeURIComponent(code)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('subtotal').innerText = data.subtotal;

                        let hidden = document.getElementById('voucher-id');
                        if (!hidden) {
                            hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'voucher_discount_id';
                            hidden.id = 'voucher-id';
                            document.querySelector('form').appendChild(hidden);
                        }
                        hidden.value = data.voucher_id;

                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                });
        });

        // ✅ Cập nhật lại tổng tiền
        function updateSubtotal(subtotalValue) {
            const subtotalEl = document.getElementById('subtotal');
            if (subtotalEl) {
                subtotalEl.innerText = subtotalValue.toLocaleString() + ' VND';
            }
        }
    </script>

    <script>
        const cartIsEmpty = {{ $cartItems->isEmpty() ? 'true' : 'false' }};

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('proceed-checkout-btn')?.addEventListener('click', function(e) {
            if (cartIsEmpty) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Your cart is empty!',
                    text: 'Please add some items before proceeding to checkout.',
                    showCancelButton: true,
                    confirmButtonText: 'Go to Shop',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('shop/shopCategory') }}";
                    }
                });
            }
        });
    });
    </script>



    @endsection