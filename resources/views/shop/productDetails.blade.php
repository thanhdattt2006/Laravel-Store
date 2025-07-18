@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Product Details Page</h1>
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
<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">

                <div class="ConTaiNer">
                    <div class="Main">
                        @php
                        $mainPhoto = null;
                        @endphp

                        @foreach ($photos as $photo)
                        @php
                        $variant = \App\Models\Product_variant::find($photo->product_variant_id);
                        @endphp
                        @if ($variant && $variant->colors_id == $selectedColorId)
                        @php $mainPhoto = $photo; break; @endphp
                        @endif
                        @endforeach

                        @if ($mainPhoto)
                        <img src="{{ asset('user/nike-img/' . $mainPhoto->name) }}" alt="{{ $mainPhoto->name }}" class="imgFeature">
                        @endif
                        <div class="control prev"><i class='bx  bx-arrow-left-stroke'></i> </div>
                        <div class="control next"><i class='bx  bx-arrow-right-stroke'></i> </div>
                    </div>

                    <!-- <div class="listImage">
                        @foreach($photos as $photo)
                        @php
                        $variant = \App\Models\Product_variant::find($photo->product_variant_id);
                        @endphp

                        @if($variant && $variant->colors_id == $selectedColorId)
                        <div><img src="{{ asset('user/nike-img/' . $photo->name ) }}" /></div>
                        @endif
                        @endforeach
                    </div> -->
                    <div class="listImage">
                        @foreach($photos as $photo)
                        @php
                        $variant = \App\Models\Product_variant::find($photo->product_variant_id);
                        @endphp

                        @if($variant)
                        <div class="image-wrapper color-{{ $variant->colors_id }}" style="{{ $variant->colors_id == $selectedColorId ? '' : 'display:none;' }}">
                            <img src="{{ asset('user/nike-img/' . $photo->name ) }}" />
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
                <!-- <script>
                    // Lấy ảnh chính
                    const imgFeature = document.querySelector('.imgFeature');
                    // Lấy toàn bộ thumbnail
                    const thumbnails = document.querySelectorAll('.listImage img');
                    // Danh sách src ảnh
                    const images = Array.from(thumbnails).map(img => img.getAttribute('src'));
                    let currentIndex = 0;

                    // Click vào ảnh nhỏ → hiển thị ảnh lớn
                    thumbnails.forEach((img, index) => {
                        img.addEventListener('click', () => {
                            imgFeature.src = images[index];
                            currentIndex = index;
                        });
                    });

                    // Prev button
                    document.querySelector('.control.prev').addEventListener('click', () => {
                        currentIndex = (currentIndex - 1 + images.length) % images.length;
                        imgFeature.src = images[currentIndex];
                    });

                    // Next button
                    document.querySelector('.control.next').addEventListener('click', () => {
                        currentIndex = (currentIndex + 1) % images.length;
                        imgFeature.src = images[currentIndex];
                    });
                </script> -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const imgFeature = document.querySelector('.imgFeature');
                        const colorButtons = document.querySelectorAll('.color-item');
                        const allImageWrappers = document.querySelectorAll('.image-wrapper');

                        // Bắt sự kiện chọn màu
                        colorButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const selectedColorId = this.getAttribute('data-id');

                                // Ẩn tất cả ảnh
                                allImageWrappers.forEach(wrapper => {
                                    wrapper.style.display = 'none';
                                });

                                // Hiện ảnh của màu đã chọn
                                const selectedImages = document.querySelectorAll('.color-' + selectedColorId);
                                selectedImages.forEach((wrapper, index) => {
                                    wrapper.style.display = 'block';

                                    // Gán lại ảnh chính là ảnh đầu tiên của màu
                                    if (index === 0) {
                                        const newSrc = wrapper.querySelector('img').getAttribute('src');
                                        imgFeature.src = newSrc;
                                    }
                                });
                            });
                        });

                        // Xử lý click vào thumbnail để đổi ảnh chính
                        document.querySelectorAll('.listImage').forEach(container => {
                            container.addEventListener('click', function(e) {
                                if (e.target.tagName === 'IMG') {
                                    imgFeature.src = e.target.src;
                                }
                            });
                        });

                        // Prev/Next button
                        let currentIndex = 0;
                        const updateMainImage = () => {
                            const visibleImages = Array.from(document.querySelectorAll('.image-wrapper'))
                                .filter(div => div.style.display !== 'none')
                                .map(div => div.querySelector('img'));
                            if (visibleImages.length > 0) {
                                imgFeature.src = visibleImages[currentIndex].src;
                            }
                        };

                        document.querySelector('.control.prev').addEventListener('click', () => {
                            const visible = document.querySelectorAll('.image-wrapper:not([style*="display: none"])');
                            if (visible.length === 0) return;
                            currentIndex = (currentIndex - 1 + visible.length) % visible.length;
                            updateMainImage();
                        });

                        document.querySelector('.control.next').addEventListener('click', () => {
                            const visible = document.querySelectorAll('.image-wrapper:not([style*="display: none"])');
                            if (visible.length === 0) return;
                            currentIndex = (currentIndex + 1) % visible.length;
                            updateMainImage();
                        });
                    });
                </script>


            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product->name }}</h3>
                    <h2 class="currency-format">{{ $product->price }}</h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Category</span> : {{$product->cate->name}}</a></li>
                        <li>@foreach ($product_variant as $v )
                            @if ($v->stock > 0 )
                            <span>Availibility:</span> In Stock
                            @else
                            <span>Availibility:</span> Out of Stock
                            @endif
                            @endforeach
                        </li>
                    </ul>
                    <div>{{$product->description }}</div>
                    <br>

                    <div class="container-color">
                        <ul class="color-list">
                            <label for="">Color: </label>
                            <div id="colorForm" method="GET" action="">
                                <input type="hidden" name="color_id" id="colorIdInput">
                                @foreach($colors as $color)
                                <button class="color-item" data-id="{{ $color->id }}" style="background:<?= $color->name ?>; opacity:0.8;"></button>
                                @endforeach
                            </div>
                            <!-- Size -->
                            <label>Size : </label>
                            <li class="size">
                                <div style="display: flex; align-items: center; justify-content: center;">
                                    <select name="" id="" style="text-align: center; text-align-last: center; height: 35px; padding: 5px;">
                                        @for ($i = 36; $i <= 46; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                   
                    <br>

                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="number" name="qty" id="qty" min="1" value="1" title="Quantity:" class="input-text qty">

                        <button type="button" class="items-count" onclick="document.getElementById('qty').stepUp();">

                        </button>

                        <button type="button" class="items-count" onclick="let qty = document.getElementById('qty'); if (parseInt(qty.value) > 1) qty.stepDown();">

                        </button>
                    </div>

                    <div class="card_area d-flex align-items-center">
                        <a class="primary-btn"
                            href="#"
                            id="add-to-cart-btn"
                            data-id="{{ $product->id }}"
                            data-color="{{ $selectedColorId ?? '' }}">
                            Add to Cart
                        </a>
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                    aria-selected="false">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                    aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('user')}}/img/product/review-1.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <h5>12th Feb, 2018 at 05:56 pm</h5>
                                        <a class="reply_btn" href="#">Reply</a>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                            <div class="review_item reply">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('user')}}/img/product/review-2.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <h5>12th Feb, 2018 at 05:56 pm</h5>
                                        <a class="reply_btn" href="#">Reply</a>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('user')}}/img/product/review-3.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <h5>12th Feb, 2018 at 05:56 pm</h5>
                                        <a class="reply_btn" href="#">Reply</a>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Post a comment</h4>
                            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn primary-btn skip-add-to-cart">Submit Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Overall</h5>
                                    <h4>4.0</h4>
                                    <h6>(03 Reviews)</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Based on 3 Reviews</h3>
                                    <ul class="list">
                                        <li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                        <li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('user')}}/img/product/review-1.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('user')}}/img/product/review-2.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('user')}}/img/product/review-3.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Blake Ruiz</h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Review</h4>
                            <p>Your Rating:</p>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <p>Outstanding</p>
                            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Full name'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn skip-add-to-cart">Submit Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Deals of the Week</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($products -> take(9) as $product)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="{{ url('/shop/productDetails/' . $product->id) }}"><img src="{{asset('user')}}/nike-img/{{$product->photo}}" width="70" height="70"></a>
                            <div class="desc">
                                <a href="{{ url('/shop/productDetails/' . $product->id) }}" class="title">{{$product->name}}</a>
                                <div class="price">
                                    <h6 class="currency-format">{{$product->price}}</h6>
                                    <h6 class="l-through currency-format">{{$product->price}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="{{asset('user')}}/img/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // color-picker

    // waitng DOM complete loading
    document.addEventListener("DOMContentLoaded", function() {
        // choose all button had class color-item
        const colorButtons = document.querySelectorAll('.color-item');

        colorButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const colorId = this.getAttribute('data-id');
                console.log("Selected Color ID:", colorId); // show ID trong console
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.color-item');
        const colorForm = document.getElementById('colorForm');
        const colorIdInput = document.getElementById('colorIdInput');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const colorId = this.getAttribute('data-id');
                colorIdInput.value = colorId;
                colorForm.submit(); // sent form
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- End related-product Area -->

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

<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
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

        document.querySelectorAll('.primary-btn:not(.skip-add-to-cart)').forEach(button => {
            button.addEventListener('click', function(e) {
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