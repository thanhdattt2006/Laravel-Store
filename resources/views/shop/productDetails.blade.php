@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<style>
    .color-item.selected-color {
        border: 2px solid black;
        opacity: 1 !important;
    }
</style>
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
                            <input type="hidden" name="color_id" id="colorIdInput">
                            @foreach($colors as $color)
                            <button type="button" class="color-item" data-id="{{ $color->id }}" style="background:{{ $color->name }}; opacity:0.8;"></button>
                            @endforeach

                            <label>Size : </label>
                            <li class="size">
                                <div style="display: flex; align-items: center; justify-content: center;">
                                    <select id="size" style="text-align: center; text-align-last: center; height: 35px; padding: 5px;">
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
        <ul class="nav nav-tabs active" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                    aria-selected="false">Review</a>
            </li>

        </ul>
        <div class="tab-content " id="myTabContent">


            <div class="tab-pane fade  show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h4 id="average-rating" style="position: sticky; top: 0; background: white; z-index: 99; font-size: 24px; font-weight: bold; color: #f39c12;">
                    Average rating: ({{ number_format($averageRating, 1) }}/5)
                </h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">


                            @foreach($review as $re)
                            <div class="review_item">
                                <div class="media">

                                    <div class="media-body">

                                        <h4>{{ $re->account->fullname ?? 'Tài khoản ẩn' }}</h4>
                                        <h5>{{ $re->created_at->format('d/m/Y H:i') }}</h5>
                                        <a class="reply_btn" href="#">Reply</a>
                                        @for ($i = 1; $i <= $re->rating; $i++)
                                            &#9733;
                                            @endfor
                                    </div>

                                </div>
                                <p>{{ $re->comment }}</p>
                            </div>
                            @endforeach
                        </div>
                        <br>
                        @auth

                        <form id="review-form" action="#" method="POST">
                            <label for="rating">Your Rating:</label>
                            @for ($i = 1; $i <= 5; $i++)
                                <div>
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                <label for="star{{ $i }}">
                                    @for ($j = 1; $j <= $i; $j++)
                                        &#9733;
                                        @endfor
                                        </label>
                    </div>
                    @endfor
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="text" name="comment" placeholder="Enter a comment..." required>
                    <button type="submit">Submit</button>
                    </form>


                    <div id="review-msg" style="color: green; margin-top: 10px;"></div>
                    <ul id="review-list">
                        {{-- Review sẽ thêm vào đây --}}
                    </ul>
                    @endauth

                    @guest
                    <div class="alert alert-warning">
                        Vui lòng <a href="{{ route('account.login') }}">đăng nhập</a> để bình luận
                    </div>
                    @endguest
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
                            @foreach ($product->variant as $photo)
                            @if ($photo->photos->isNotEmpty())
                            <a href="{{ url('/shop/productDetails/' . $product->id) }}"><img src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" width="70" height="70"></a>
                            @break;
                            @endif
                            @endforeach

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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('review-form');
        const msgBox = document.getElementById('review-msg');
        const avgRatingBox = document.getElementById('average-rating');

        if (!form) return;

        if (form.dataset.bound === 'true') return;
        form.dataset.bound = 'true';

        let isSubmitting = false;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (isSubmitting) return;
            isSubmitting = true;
            msgBox.innerHTML = '';

            const data = {
                product_id: form.querySelector('[name="product_id"]').value,
                comment: form.querySelector('[name="comment"]').value,
                rating: form.querySelector('[name="rating"]:checked')?.value || null
            };

            if (!data.rating) {
                msgBox.innerHTML = `<div class="alert alert-danger">Vui lòng chọn số sao.</div>`;
                isSubmitting = false;
                return;
            }

            try {
                const response = await fetch("{{ route('product.review') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error');
                }

                msgBox.innerHTML = `<div class="alert alert-success">${result.message}</div>`;
                form.reset();

                // Tạo HTML sao
                let stars = '';
                for (let i = 1; i <= result.review.rating; i++) {
                    stars += '&#9733;';
                }

                const commentHTML = `
                    <div class="review_item">
                        <div class="media">
                            <div class="media-body">
                                <h4>${result.review.fullname}</h4>
                                <h5>${result.review.created_at}</h5>
                                <a class="reply_btn" href="#">Reply</a>
                                <div style="color: gold;">${stars}</div>
                            </div>
                        </div>
                        <p><strong>${result.review.comment}</strong></p>
                    </div>
                `;

                const commentList = document.querySelector('.comment_list');
                if (commentList) {
                    commentList.insertAdjacentHTML('afterbegin', commentHTML);
                }

                //  Cập nhật lại Average Rating ngay
                if (avgRatingBox && result.average_rating) {
                    avgRatingBox.textContent = `Average rating: (${result.average_rating}/5)`;
                }


            } catch (error) {
                console.error('Error:', error);
                const msg = error.message.toLowerCase();
                if (msg.includes('login')) {
                    window.location.href = "{{ route('account.login') }}";
                } else {
                    msgBox.innerHTML = `<div class="alert alert-danger">${error.message}</div>`;
                }
            } finally {
                isSubmitting = false;
            }
        });
    });
</script>









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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#review-form').on('submit', function(e) {
        e.preventDefault(); // không reload trang

        let form = $(this);
        let url = "{{ route('product.review') }}";
        let data = form.serialize(); // lấy toàn bộ input

        $.post(url, data, function(response) {
            $('#review-success').text('Đã gửi bình luận!');
            let commentText = form.find('input[name="cmt"]').val();

            // Thêm bình luận mới vào danh sách
            $('#review-list').prepend(`<li>${commentText}</li>`);

            // Reset ô nhập
            form[0].reset();
        }).fail(function(xhr) {
            $('#review-success').text('Lỗi khi gửi bình luận!');
        });
    });
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
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorButtons = document.querySelectorAll('.color-item');
        const colorIdInput = document.getElementById('colorIdInput');

        colorButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                colorButtons.forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                colorIdInput.value = this.dataset.id;
            });
        });

        document.querySelectorAll('.primary-btn:not(.skip-add-to-cart), #add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const productId = this.dataset.id || this.closest('[data-id]')?.dataset.id;
                const colorId = document.getElementById('colorIdInput')?.value || null;
                const size = document.getElementById('size')?.value || 36;
                const quantity = document.getElementById('qty')?.value || 1;

                console.log("Product:", productId, "Color:", colorId, "Size:", size, "Quantity:", quantity);

                if (!colorId) {
                    Swal.fire('Warning', 'Please select a color.', 'warning');
                    return;
                }

                addToCart(productId, colorId, size, quantity);
            });
        });

        function addToCart(productId, colorId, size, quantity) {
            if (!isLogined()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'You need to log in',
                    text: 'Please log in to add products to the cart.',
                    showCancelButton: true,
                    confirmButtonText: 'Login / Register',
                    cancelButtonText: 'Maybe later'
                }).then(result => {
                    if (result.isConfirmed) window.location.href = "/account";
                });
                return;
            }
            sendAddToCartRequest(productId, colorId, size, quantity); // ✅ Thêm quantity ở đây
        }

        function sendAddToCartRequest(productId, colorId = null, size = 36, quantity = 1) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                console.error("Missing CSRF token");
                showError('Error', 'CSRF token not found. Please reload.');
                return;
            }

            Swal.fire({
                icon: 'info',
                title: 'Adding product...',
                text: 'Please wait…',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });

            fetch('/shop/shoppingCart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        color_id: colorId,
                        size: size,
                        quantity: quantity
                    }) // ✅ quantity
                })
                .then(r => r.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Added' : 'Error',
                        text: data.message
                    });
                })
                .catch(err => {
                    console.error(err);
                    showError('System Error', 'Cannot add product. Please try later.');
                });
        }
    });
</script>

@endsection