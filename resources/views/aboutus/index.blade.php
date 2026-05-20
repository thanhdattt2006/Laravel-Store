	@extends('layout.user')

	@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>About Us Page</h1>
					<nav class="d-flex align-items-center">
						<a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">About Us</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<section class="blog_categorie_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="categories_post">
						<img src="{{asset('user')}}/banner/aboutus1.png" alt="post">
						<div class="categories_details">
							<div class="categories_text">
								<a href="#">
									<h5>ATHLETIC LIFE</h5>
								</a>
								<div class="border_line"></div>
								<p>Live strong. Train stronger.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="categories_post">
						<img src="{{asset('user')}}/banner/aboutus2.png" alt="post">
						<div class="categories_details">
							<div class="categories_text">
								<a href="#">
									<h5>INNOVATION</h5>
								</a>
								<div class="border_line"></div>
								<p>Designed for performance and style.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="categories_post">
						<img src="{{asset('user')}}/banner/aboutus3.png" alt="post">
						<div class="categories_details">
							<div class="categories_text">
								<a href="#">
									<h5>STYLE & CULTURE</h5>
								</a>
								<div class="border_line"></div>
								<p>Where fashion meets functionality.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="blog_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="blog_left_sidebar">
						@foreach ($titles as $title)
						<article class="row blog_item">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<div class="blog_post">
									<img src="{{asset('user')}}/aboutus/{{$title -> photo}}" alt="">
									<div class="blog_details">
										<a href="{{url('/aboutus/aboutUsDetail')}}">
											<h2>{{$title -> title}}</h2>
										</a>
										<p>{{$title -> description}}</p>
										<a href="{{url('/aboutus/aboutUsDetail' . '/' .$title->id)}}" class="white_bg_btn">View More</a>
									</div>
								</div>
							</div>
						</article>
						@endforeach
						<div class="filter-bar d-flex flex-wrap align-items-center"  style="width: 400px; margin-left: 190px"> 
							<div class="pagination" style="margin-left: 100px;">
								{{ $titles->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@endsection

	@section('scripts')
	
	
	
	
	
	
	
	
	
	
	
	

	@endsection