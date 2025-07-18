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
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="top" id="">
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img height="150px" src="{{ asset('user/nike-img/sample.png') }}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>Product name</p>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div>
                                    <select name="size">
                                        @for ($i = 36; $i <= 46; $i++)
                                            <option>
                                                {{ $i }}
                                            </option>
                                            @endfor
                                    </select>
                                </div>
                            </td>
                            <td>
                                <h5 class="currency-format">500000</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="text"
                                        name="qty"
                                        id="qty"
                                        min="1"
                                        value=""
                                        class="input-text qty"
                                        data-id=""
                                        data-price=""
                                        oninput="handleQtyChange(this)">

                                    <button onclick="changeQty('', 1)" class="increase items-count" type="button">
                                        <i class="lnr lnr-chevron-up"></i>
                                    </button>

                                    <button onclick="changeQty('', -1)" class="reduced items-count" type="button">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <h5 id="total">
                                    500000
                                </h5>
                            </td>
                            <td>
                                <i class="fa fa-close" onclick="removeItem('')"></i>
                            </td>
                        </tr>

                        <!-- CSRF token -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn update-cart">Update Cart</a>
                            </td>
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
                            <td>

                            </td>
                            <td></td>
                            <td></td>
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

    // ✅ Tính tổng phụ của toàn bộ giỏ hàng
    function updateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.qty').forEach(function(input) {
            const qty = parseInt(input.value) || 1;
            const price = parseFloat(input.dataset.price) || 0;
            subtotal += qty * price;
        });
        document.getElementById('subtotal').innerText = subtotal.toLocaleString('vi-VN');
    }

    // ✅ Gọi khi trang vừa load
    document.addEventListener('DOMContentLoaded', function() {
        updateSubtotal();
    });

    // ✅ Cập nhật tổng giá của từng item
    function updateTotalDisplay(id, qty) {
        const price = parseFloat(document.getElementById('qty-' + id).dataset.price);
        const total = qty * price;
        document.getElementById('total-' + id).innerText = total.toLocaleString('vi-VN');
    }

    // ✅ Cập nhật số lượng khi thay đổi (input tay)
    function handleQtyChange(input) {
        let qty = parseInt(input.value) || 1;
        if (qty < 1) qty = 1;
        input.value = qty;

        const id = input.dataset.id;
        updateTotalDisplay(id, qty);
        updateCartDB(id, qty);
        updateSubtotal();
    }

    // ✅ Tăng/giảm số lượng bằng nút
    function changeQty(id, delta) {
        const input = document.getElementById('qty-' + id);
        let qty = parseInt(input.value) || 1;

        qty += delta;
        if (qty < 1) qty = 1;

        input.value = qty;
        updateTotalDisplay(id, qty);
        updateCartDB(id, qty);
        updateSubtotal();
    }

    // ✅ Gửi số lượng mới lên server
    function updateCartDB(id, newQty) {
        fetch('/cart/update/' + id, {
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
                if (!data.success) {
                    alert('Không thể cập nhật số lượng');
                }
            })
            .catch(err => {
                console.error('🔴 Lỗi cập nhật giỏ hàng:', err);
            });
    }

    // ✅ Xóa sản phẩm khỏi giỏ hàng
    function removeItem(id) {
        Swal.fire({
            title: 'Xóa sản phẩm?',
            text: 'Hành động này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/cart/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(id).remove();
                            updateSubtotal();
                            Swal.fire('Đã xóa!', 'Sản phẩm đã được xóa khỏi giỏ hàng.', 'success');
                        } else {
                            Swal.fire('Thất bại', 'Không thể xóa sản phẩm.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('🔴 Lỗi xóa:', error);
                        Swal.fire('Lỗi máy chủ', 'Vui lòng thử lại sau.', 'error');
                    });
            }
        });
    }
</script>



@endsection