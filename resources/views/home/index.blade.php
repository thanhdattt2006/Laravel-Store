	@extends('layout.user')

	@section('content')
	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Nike New <br>Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Add to Bag</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="{{asset('user')}}/banner/Banner.png" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Nike New 1 <br>Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Add to Bag</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="{{asset('user')}}/banner/Banner1.png" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Nike New 2 <br>Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Add to Bag</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="{{asset('user')}}/banner/21.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('user')}}/img/features/f-icon1.png" alt="">
						</div>
						<h6>Free Delivery</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('user')}}/img/features/f-icon2.png" alt="">
						</div>
						<h6>Return Policy</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('user')}}/img/features/f-icon3.png" alt="">
						</div>
						<h6>24/7 Support</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="{{asset('user')}}/img/features/f-icon4.png" alt="">
						</div>
						<h6>Secure Payment</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('user')}}/nike-img/running-2-cam-5.png" alt="">
								<a href="{{url('/shop/shopCategory?cate_id=1')}}">
									<div class="deal-details">
										<h6 class="deal-title">Sneaker for Running</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('user')}}/nike-img/basketballzion4-cam-7.png" alt="">
								<a href="{{url('/shop/shopCategory?cate_id=3')}}">
									<div class="deal-details">
										<h6 class="deal-title">Sneaker for Basketball</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('user')}}/nike-img/football10-den-5.png" alt="">
								<a href="{{url('/shop/shopCategory?cate_id=2')}}">
									<div class="deal-details">
										<h6 class="deal-title">Sneaker for Football</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="{{asset('user')}}/nike-img/gym8-trang-5.png" alt="">
								<a href="{{url('/shop/shopCategory?cate_id=4')}}">
									<div class="deal-details">
										<h6 class="deal-title">Sneaker for Trainnig & Gym</h6>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-deal">
						<div class="overlay"></div>
						<img class="img-fluid w-100" src="{{asset('user')}}/img/category/c5.jpg" alt="">
						<a href="{{asset('user')}}/img/category/c5.jpg" class="img-pop-up" target="_blank">
							<div class="deal-details">
								<h6 class="deal-title">Sneaker for Sports</h6>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
								dolore magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					@foreach ($products -> take(8) as $product)
					@php
					$firstVariant = $product->variant->first();
					$colorId = $firstVariant?->colors_id ?? null;
					@endphp
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							@foreach ($product->variant as $photo)
							@if ($photo->photos->isNotEmpty())
							<a href="{{ url('/shop/productDetails/' . $product->id) }}"><img class="img-fluid" src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" alt=""></a>
							@break;
							@endif
							@endforeach
							<div class="product-details">
								<a href="{{url('/shop/productDetails')}}">
									<h6>{{$product->name}}</h6>
								</a>
								<div class="price">
									<h6 class="currency-format">{{$product->price}}</h6>
									<h6 class="l-through currency-format">{{$product -> price }}</h6>
								</div>
								<div class="prd-bottom">
									<a href="" class="social-info">
										<span data-id="{{ $product->id }}" data-color="{{ $colorId }}" class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="#" class="social-info add-to-wishlist" data-id="{{ $product->id }}">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>

									</a>
									<a href="#" class="social-info add-to-compare" data-id="{{ $product->id }}">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Coming Products</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
								dolore
								magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					@foreach ($products->slice(8, 8) as $product)
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							@foreach ($product->variant as $photo)
							@if ($photo->photos->isNotEmpty())
							<a href="{{ url('/shop/productDetails/' . $product->id) }}"><img class="img-fluid" src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" alt=""></a>
							@break;
							@endif
							@endforeach
							<div class="product-details">
								<a href="{{ url('/shop/productDetails/' . $product->id) }}">
									<h6>{{$product->name}}</h6>
								</a>
								<div class="price">
									<h6 class="currency-format">{{$product->price}}</h6>
									<h6 class="l-through currency-format">{{$product->price}}</h6>
								</div>
								<div class="prd-bottom">
									<a href="" class="social-info">
										<span data-id="{{ $product->id }}" class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="#" class="social-info add-to-wishlist" data-id="{{ $product->id }}">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>

									<a href="#" class="social-info add-to-compare" data-id="{{ $product->id }}">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
	<section class="exclusive-deal-area">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1>Exclusive Hot Deal Ends Soon!</h1>
							<p>Who are in extremely love with eco friendly system.</p>
						</div>
						<div class="col-lg-12">
							<div class="row clock-wrap">
								<div class="col clockinner1 clockinner">
									<h1 class="days">150</h1>
									<span class="smalltext">Days</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="hours">23</h1>
									<span class="smalltext">Hours</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="minutes">47</h1>
									<span class="smalltext">Mins</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="seconds">59</h1>
									<span class="smalltext">Secs</span>
								</div>
							</div>
						</div>
					</div>
					<a href="{{url('/shop/shopCategory')}}" class="primary-btn">Shop Now</a>
				</div>
				<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">
						<!-- single exclusive carousel -->
						@foreach ($products -> take(1-16) as $product)
						<div class="single-exclusive-slider">
							@foreach ($product->variant as $photo)
							@if ($photo->photos->isNotEmpty())
							<a href="{{ url('/shop/productDetails/' . $product->id) }}"><img class="img-fluid" src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}" alt=""></a>
							@break;
							@endif
							@endforeach
							<div class="product-details">
								<div class="price">
									<h6 class="currency-format">{{$product->price}}</h6>
									<h6 class="l-through currency-format">{{$product->price}}</h6>
								</div>
								<div>
									<h3><a href="{{ url('/shop/productDetails/' . $product->id) }}" style="color: orange;">{{$product->name}}</a></h3>
								</div>

							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('user')}}/img/brand/1.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('user')}}/img/brand/2.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('user')}}/img/brand/3.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('user')}}/img/brand/4.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="{{asset('user')}}/img/brand/5.png" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->

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
	<script src="{{asset('user/js/countdown.js')}}"></script>
	<script src="{{asset('user/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
	<!--gmaps Js-->
	<script src="{{asset('user/js/gmaps.min.js')}}"></script>
	<script src="{{asset('user/js/main.js')}}"></script>
	<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


		function sendAddToCartRequest(productId, colorId = null) {
			const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

			// Check login
			if (!isLogined()) {
				Swal.fire({
					icon: 'warning',
					title: 'Login Required',
					text: 'You need to login or register to add products to your cart.',
					showCancelButton: true,
					confirmButtonText: 'Login / Register',
					cancelButtonText: 'Maybe later'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = '/account/login'; // hoặc route tương ứng
					}
				});
				return;
			}

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
						color_id: colorId
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
					const colorId = this.dataset.color || this.closest('[data-color]')?.dataset.color;

					if (productId) {
						sendAddToCartRequest(productId, colorId); // ✅ phải truyền cả colorId
					} else {
						showError('Error', 'Cannot find product ID. Please try again.');
					}
				});
			});
		});
	</script>


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
								text: data.message,
								confirmButtonText: 'OK'
							});
						});
				});
			});
		});
	</script>

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
								title: 'Product added',
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
	@endsection