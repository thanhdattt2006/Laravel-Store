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
			<div class="sidebar-categories">
				<div class="head">Browse Categories</div>
				@foreach ($cates as $cate)
				<ul class="main-categories">
					<li class="main-nav-list"><a data-toggle="collapse" href="{{$cate->name}}" aria-expanded="false" aria-controls="fruitsVegetable"><span
								class="lnr lnr-arrow-right"></span>{{$cate->name}}<span class="number">(02)</span></a>
					</li>
				</ul>
				@endforeach
			</div>
			<div class="sidebar-filter mt-50">
				<div class="top-filter-head">Color Filters</div>
				<div class="common-filter">
					<form action="#">
						@foreach ($colors as $color)
						<ul>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="{{ $color }}" name="color"><label style="text-transform: capitalize;">{{ $color }}<span>(02)</span></label></li>
						</ul>
						@endforeach
					</form>
				</div>
				<div class="common-filter">
					<div class="head">Price</div>
					<div class="price-range-area">
						<div id="price-range"></div>
						<div class="value-wrapper d-flex">
							<div class="price">Price:</div>
							<span>đ</span>
							<div id="lower-value"></div>
							<div class="to">to</div>
							<span>đ</span>
							<div id="upper-value"></div>
						</div>
					</div>
				</div>
			</div>
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
				<div class="pagination">
					<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<a href="#" class="active">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<a href="#">6</a>
					<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<!-- End Filter Bar -->
			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					<!-- single product -->
					@foreach($products -> take(6) as $product)
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img src="{{asset('user')}}/nike-img/{{$product->photo}}">
							<div class="product-details">
								<a href="{{url('/shop/productDetails')}}">
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
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</section>
			<!-- End Best Seller -->
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting mr-auto">
					<select>
						<option value="1">Show 6</option>

					</select>
				</div>
				<div class="pagination">
					<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<a href="#" class="active">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<a href="#">6</a>
					<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<!-- End Filter Bar -->
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
					@foreach ($products ->take(6) as $product)
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