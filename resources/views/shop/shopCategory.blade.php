@extends('layout.user')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1>Shop Category Page</h1>
				<nav class="d-flex align-items-center">
					<a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
					<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
					<a href="#">Shop Category</a>

				</nav>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-md-5">
			<form method="GET" action="{{ route('shop.category') }}">
				<div class="sidebar-categories">
					<div class="head">Categories</div>
					@foreach ($cates as $cate)
					<ul class="main-categories">
						<li class="main-nav-list">
							<label style='text-transform: capitalize;'>
								<a class="page-item">
									<input type="radio" class="pixel-radio" name="cate_id" value="{{ $cate->id }}"
										{{ request('cate_id') == $cate->id ? 'checked' : '' }}>
									{{ $cate->name }}
								</a>
							</label>
						</li>
					</ul>
					@endforeach
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Color Filters</div>
					<div class="common-filter">
						<div class="sidebar-categories">
							@foreach($colors as $color)
							<ul class="main-categories">
								<li class="main-nav-list">
									<label style='text-transform: capitalize;'>
										<a class="page-item">
											<input type="radio" class="pixel-radio" name="color_id[]" value="{{ $color->id }}"
												{{ is_array(request('color_id')) && in_array($color->id, request('color_id')) ? 'checked' : '' }}>
											{{ $color->name }}
										</a>
									</label>
								</li>
							</ul>
							@endforeach
						</div>
					</div>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Price</div>
					<div class="common-filter">
						<div class="sidebar-categories">
							<select name="price_range" onchange="this.form.submit()">
								<option value="0">-- Select Price --</option>
								<option value="1000000-2000000" {{ request('price_range') == '1000000-2000000' ? 'selected' : '' }}>1.000.000đ - 2.000.000đ</option>
								<option value="2000000-3000000" {{ request('price_range') == '2000000-3000000' ? 'selected' : '' }}>2.000.000đ - 3.000.000đ</option>
								<option value="3000000-4000000" {{ request('price_range') == '3000000-4000000' ? 'selected' : '' }}>3.000.000đ - 4.000.000đ</option>
								<option value="4000000-5000000" {{ request('price_range') == '4000000-5000000' ? 'selected' : '' }}>4.000.000đ - 5.000.000đ</option>
								<option value="5000000-6000000" {{ request('price_range') == '5000000-6000000' ? 'selected' : '' }}>5.000.000đ - 6.000.000đ</option>
								<option value="6000000-7000000" {{ request('price_range') == '6000000-7000000' ? 'selected' : '' }}>6.000.000đ - 7.000.000đ</option>
								<option value="7000000-8000000" {{ request('price_range') == '7000000-8000000' ? 'selected' : '' }}>7.000.000đ - 8.000.000đ</option>
								<option value="8000000-9000000" {{ request('price_range') == '8000000-9000000' ? 'selected' : '' }}>8.000.000đ - 9.000.000đ</option>
							</select>
						</div>
					</div>
				</div>
				<br><br>
				<button type="submit" class="btn">Filter</button>
			</form>
		</div>
		<div class="col-xl-9 col-lg-8 col-md-7">
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting">
					<select>
						<option value="1">Default sorting</option>

					</select>
				</div>
				<div class="sorting mr-auto">
					<select>
						<option value="1">Show 6</option>
					</select>
				</div>
			</div>
			<!-- End Filter Bar -->
			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					<!-- single product -->
					@if(isset($productsfilter) && $productsfilter->count())
					@foreach ($productsfilter as $product)
					@php
					$firstVariant = $product->variant->first();
					$colorId = $firstVariant?->colors_id ?? null;
					@endphp
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							@foreach ($product->variant as $photo)
							@if ($photo->photos->isNotEmpty())
							<img src="{{asset('user')}}/nike-img/{{ $photo->photos->first()->name}}">
							@break;
							@endif
							@endforeach
							<div class="product-details">
								<a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
									<h6>{{$product->name}}</h6>
								</a>
								<div class="price ">
									<h6 class="currency-format">{{$product->price}}</h6>
									<h6 class="l-through currency-format">{{$product->price}}</h6>
								</div>
								<div class="prd-bottom">
									<a href="" class="social-info">
										<span data-id="{{$product->id}}" data-color="{{ $colorId }}" class="ti-bag"></span>
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
					<br><br>
					@endforeach
					<div class="filter-bar d-flex flex-wrap align-items-center">
						<div class="pagination">
							{{ $productsfilter->links() }}
						</div>
					</div>
					@else
					<div>
						<h4>Không có sản phẩm nào</h4>
					</div>
					@endif

				</div>
			</section>
		</div>
	</div>
	</div>

	<!-- Start related-product Area -->

	<!-- End related-product Area -->

	@endsection

	<script>
		// Kiểm tra đăng nhập
		

		

		


		function sendAddToCartRequest(productId, colorId = null) {
			const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

			// Chặn admin
			if (isAdmin()) {
				console.log('🔒 Admin cannot add products to cart.');
				Swal.fire({
					icon: 'info',
					title: 'Admin account',
					text: 'Admin cannot perform customer actions like adding products to cart.'
				});
				return;
			}

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
						window.location.href = '/account';
					}
				});
				return;
			}

			ApiService.post('/shop/shoppingCart', {
				product_id: productId,
				color_id: colorId
			})
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
	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			document.querySelectorAll('.add-to-compare').forEach(btn => {
				btn.addEventListener('click', function(e) {
					e.preventDefault();

					if (!isLogined()) {
						Swal.fire({
							icon: 'warning',
							title: 'Login required',
							text: 'Please log in to use the compare feature.',
							confirmButtonText: 'Login',
							showCancelButton: true
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = '/account';
							}
						});
						return;
					}

					if (isAdmin()) {
						console.log('🚫 Admin is not allowed to compare products.');
						Swal.fire({
							icon: 'info',
							title: 'Admin account',
							text: 'Admin is not allowed to use the compare feature.'
						});
						return;
					}

					const productId = this.dataset.id;

					ApiService.get('/shop/compare/' + productId)
						.then(data => {
							Swal.fire({
								icon: data.success ? 'success' : 'info',
								title: data.success ? 'Product added' : 'Notification!',
								text: data.message,
								confirmButtonText: 'OK'
							});
						})
						.catch(err => {
							showError('Connection error!', 'Could not connect to server.');
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

				if (!isLogined()) {
					Swal.fire({
						icon: 'warning',
						title: 'Login required',
						text: 'Please log in to use the wishlist feature.',
						showCancelButton: true,
						confirmButtonText: 'Login',
						cancelButtonText: 'Later'
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = '/account';
						}
					});
					return;
				}

				if (isAdmin()) {
					console.log('❌ Admin cannot add to wishlist.');
					Swal.fire({
						icon: 'info',
						title: 'Admin account',
						text: 'Admin is not allowed to use the wishlist feature.'
					});
					return;
				}

				var productId = $(this).data('id');

				ApiService.post("{{ route('wishlist.ajaxAdd') }}", { product_id: productId })
					.then(response => {
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
					})
					.catch(err => {
						showError('Error!', 'Cannot add the product to the wishlist.');
					});
			});
		});
	</script>


	@endsection