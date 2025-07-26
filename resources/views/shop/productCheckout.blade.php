@extends('layout.user')

@section('content')
<!-- css -->
<style>
    .custom-select-box {
        max-width: 750px;
        position: relative;
        font-family: 'Segoe UI', sans-serif;
        margin: 18px 0px;
    }

    .custom-selected {
        border: 1px solid #ced4da;
        border-radius: 6px;
        padding: 10px 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .custom-selected:hover {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .25);
    }

    .custom-selected-text {
        flex-grow: 1;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .custom-arrow {
        margin-left: 10px;
        font-size: 12px;
    }

    .custom-options {
        position: absolute;
        width: 100%;
        top: calc(100% + 4px);
        left: 0;
        background: white;
        border: 1px solid #ced4da;
        border-radius: 6px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 100;
        display: none;
    }

    .custom-option {
        padding: 10px 14px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .custom-option:hover {
        background-color: #f1f1f1;
    }

    .custom-option.selected {
        background-color: #e9f5ff;
        font-weight: bold;
    }
</style>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Checkout</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <form action="{{ route('checkout.store') }}" method="post">
            @csrf
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Bill Details</h3>
                        <div class="row contact_form">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your name">
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="number" placeholder="Phone number">


                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address">

                            </div>

                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <input type="checkbox" id="f-option3" name="selector">
                                    <label for="f-option3">Ship to a different address?</label>
                                </div>
                                <textarea class="form-control" name="note" id="note" rows="1" style="height: 128px;" placeholder="Order Notes"></textarea>
                            </div>
                        </div>
                        <div class="cupon_area">
                            <div class="check_title">
                                <h2>Have a coupon? Choose your voucher here</h2>
                            </div>


                            <!-- dropdown chọn voucher -->
                            <div class="custom-select-box">
                                <div class="custom-selected">
                                    <span class="custom-selected-text">Choose your discount voucher</span>
                                    <span class="custom-arrow">&#9662;</span>
                                </div>
                                <div class="custom-options">
                                    <div class="custom-option"
                                        data-discount="0"
                                        data-value="0">
                                        I dont want to use voucher right now!
                                    </div>
                                    @foreach($vouchers as $voucher)
                                    <div class="custom-option"
                                        data-discount="{{ $voucher->discount_value }}"
                                        data-value="{{ $voucher->id }}">
                                        {{ $voucher->code_name }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a style="cursor:pointer">Product <span>Total</span></a></li>
                                @foreach ($cartItems as $item)
                                <li>
                                    <a>
                                        <input type="hidden" name="product_id[]" value="{{$item->product->id}}">
                                        <input type="hidden" name="product_name[]" value="{{ $item->product->name }}">
                                        {{ Str::limit($item->product->name, 12) }}
                                        <span class="middle" style="margin-left: 25px;">
                                            <input type="hidden" name="product_quantity[]" value="{{ $item->quantity }}">
                                            x{{ $item->quantity }}
                                        </span>
                                        <span class="last">
                                            <input type="hidden" name="total[]" value="{{ $item->total }}">
                                            {{ number_format($item->total, 0, ',', '.') }} VND
                                        </span>
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                            <ul class="list list_2">
                                <li><a style="cursor:pointer">Subtotal <input type="hidden" name="subtotal" value="{{ $subtotal }}"> <span>{{ number_format($subtotal, 0, ',', '.') }} VND</span></a></li>
                                <li><a style="cursor:pointer">Shipping <span>Free ship</span></a></li>
                                <li><a style="cursor:pointer">Discount <input type="hidden" name="voucher" value="0"> <span class="discount-amount">- 0%</span></a></li>
                                <li><a style="cursor:pointer">Grand Price<input type="hidden" name="grand_price" value="{{ $grand_price }}"> <span class="grand-price">{{ number_format($grand_price, 0, ',', '.') }} VND</span></a></li>
                            </ul>
                            @foreach ($payments as $payment)
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="payment{{$payment->id}}" name="payment" value="{{ $payment->name }}">
                                    <label for="payment{{$payment->id}}">{{ $payment->name }}</label>
                                    <div class="check"></div>
                                </div>

                            </div>
                            @endforeach

                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector">
                                <label for="f-option4">I have read and accept the </label>
                                <a style="cursor:pointer" required>terms & conditions*</a>
                            </div>
                            <button type="submit" class="primary-btn">Buy</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--================End Checkout Area =================-->

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

<!-- js cho dropdown -->

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const selectBox = document.querySelector(".custom-select-box");
        const selected = selectBox.querySelector(".custom-selected");
        const selectedText = selected.querySelector(".custom-selected-text");
        const options = selectBox.querySelector(".custom-options");
        const optionItems = options.querySelectorAll(".custom-option");

        const subtotal = parseInt("{{ $subtotal }}"); // Lấy subtotal từ PHP

        selected.addEventListener("click", () => {
            const isOpen = options.style.display === "block";
            options.style.display = isOpen ? "none" : "block";
            selected.classList.toggle("open");
        });

        optionItems.forEach(option => {
            option.addEventListener("click", () => {
                // Highlight selected
                optionItems.forEach(o => o.classList.remove("selected"));
                option.classList.add("selected");

                const discountPercent = parseFloat(option.dataset.discount || 0);
                const voucherId = option.dataset.value;

                const discountAmount = Math.round((subtotal * discountPercent) / 100);
                const grandPrice = subtotal - discountAmount;

                // Update UI
                selectedText.textContent = option.textContent;
                selected.dataset.discount = discountPercent;
                selected.dataset.value = voucherId;
                options.style.display = "none";
                selected.classList.remove("open");

                // Update giá tiền hiển thị
                const discountAmountEl = document.querySelector(".discount-amount");
                const grandPriceEl = document.querySelector(".grand-price");

                if (discountAmountEl && grandPriceEl) {
                    discountAmountEl.textContent = `- ${discountPercent}% (-${discountAmount.toLocaleString()} VND)`;
                    grandPriceEl.textContent = `${grandPrice.toLocaleString()} VND`;

                    // Gán giá trị vào input hidden
                    document.querySelector('input[name="voucher"]').value = voucherId;
                    document.querySelector('input[name="grand_price"]').value = grandPrice;
                }

                // Debug ra console
                console.log("[Voucher Selected]");
                console.log("→ ID:", voucherId);
                console.log("→ Discount %:", discountPercent);
                console.log("→ Subtotal:", subtotal);
                console.log("→ Discount amount:", discountAmount);
                console.log("→ Grand price:", grandPrice);
            });
        });

        // Đóng nếu click ra ngoài
        document.addEventListener("click", (e) => {
            if (!selectBox.contains(e.target)) {
                options.style.display = "none";
                selected.classList.remove("open");
            }
        });
    });
</script>



@endsection