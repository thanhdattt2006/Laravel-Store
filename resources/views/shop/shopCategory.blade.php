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
<<div class="container">
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
								<option value="0">-- Chọn giá --</option>
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
					@if(isset($productsfilter) && count($productsfilter))
					@foreach($productsfilter as $product)
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img src="{{asset('user')}}/nike-img/{{$product->photo}}">
							<div class="product-details">
								<a href="{{ url('/shop/productDetails/' . $product->id) }}" class="social-info">
									<h6>{{$product->name}}</h6>
								</a>
								<div class="price">
									<h6>{{$product->price}}</h6>
									<h6 class="l-through">{{$product->price}}</h6>
								</div>
								<div class="prd-bottom">
									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="{{ route('compare.add', $product->id) }}" class="social-info">
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
					<div class="filter-bar d-flex flex-wrap align-items-center"><h4>Không có sản phẩm nào</h4></div>
					@endif
				</div>
			</section>
		</div>
	</div>
	</div>

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap">
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
						@foreach ($products as $product)
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="{{asset('user')}}/nike-img/{{$product->photo}}" width="70" height="70"></a>
								<div class="desc">
									<a href="#" class="title">{{$product->name}}</a>
									<div class="price">
										<h6>{{$product->price}}</h6>
										<h6 class="l-through">{{$product->price}}</h6>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-lg-2">
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
	<script src="{{asset('user/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
	<!--gmaps Js-->
	<script src="{{asset('user/js/gmaps.min.js')}}"></script>
	<script src="{{asset('user/js/main.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		console.log("Login status: ", isLogined());

		function isLogined() {
			return @json(Auth::check());
		}

		function addToCart(productId) {
			if (!isLogined()) {
				Swal.fire({
					icon: 'warning',
					title: 'You need to login',
					text: 'Please login to add products to your cart.',
					showCancelButton: true,
					confirmButtonText: 'Login now',
					cancelButtonText: 'Maybe later',
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = "{{ route('account.login') }}";
					}
				});
				return;
			}

			const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

			fetch('/shop/shoppingCart', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': csrfToken
					},
					body: JSON.stringify({
						id: productId
					})
				})
				.then(res => res.json())
				.then(data => {
					Swal.fire({
						icon: data.success ? 'success' : 'error',
						title: data.success ? 'Product added' : 'Error',
						text: data.message,
						confirmButtonText: 'OK'
					});
				})
				.catch(err => {
					console.error("Error sending request:", err);
					Swal.fire({
						icon: 'error',
						title: 'An error occurred',
						text: 'Unable to add product. Please try again later.',
					});
				});
		}

		document.addEventListener('DOMContentLoaded', function() {
			// Sự kiện click thêm sản phẩm
			document.querySelectorAll('.ti-bag').forEach(button => {
				button.addEventListener('click', function(e) {
					if (this.classList.contains('skip-add-to-cart')) return;
					e.preventDefault();
					const productId = this.dataset.id;
					addToCart(productId);
				});
			});

			// SweetAlert hiện khi thêm thành công qua session
			@if(session('success'))
			Swal.fire({
				icon: 'success',
				title: 'Success',
				text: 'Product has been added to the cart.',
				confirmButtonText: 'OK'
			});
			@endif

			// Alert chào mừng (chỉ hiển thị 1 lần)
			if (!sessionStorage.getItem('welcomeShown')) {
				Swal.fire({
					icon: 'success',
					title: 'Welcome to our Shop',
					text: 'You can now register an account to enjoy more features.',
					confirmButtonText: 'Login or Register',
					cancelButtonText: 'Maybe later',
					showCancelButton: true,
					customClass: {
						actions: 'swal2-actions-vertical'
					}
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = '/account';
					}
				});
				sessionStorage.setItem('welcomeShown', 'true');
			}
		});
	</script>
	@endsection