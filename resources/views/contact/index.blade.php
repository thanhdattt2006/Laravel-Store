	@extends('layout.user')

	@section('content')
	<!-- Start Banner Area -->

	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Contact Us</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Contact</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container">
			<!-- <div id="mapBox" class="mapBox" data-lat="10.80671" data-lon="106.71421" data-zoom="20" data-info="D5 Street, Bình Thạnh District, Saigon"
				data-mlat="10.80671" data-mlon="106.71421">
			</div> -->
				<div class="mapBox">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0603332566184!2d106.71161967583865!3d10.806691158633125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529ed00409f09%3A0x11f7708a5c77d777!2zQXB0ZWNoIENvbXB1dGVyIEVkdWNhdGlvbiAtIEjhu4cgVGjhu5FuZyDEkMOgbyB04bqhbyBM4bqtcCBUcsOsbmggVmnDqm4gUXXhu5FjIHThur8gQXB0ZWNo!5e0!3m2!1svi!2s!4v1752320658554!5m2!1sen!2s"
						width="100%"
						height="400"
						style="border:0;"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade">
						
					</iframe>
				</div>

		
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6>Saigon, Vietnam</h6>
							<p>Aptech D5 Bình Thạnh</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6><a href="#">0775255721</a></h6>
							<p>Monday to Friday (9am to 6 pm)</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6><a href="#">thanhdattt2006@gmail.com</a></h6>
							<p>Send us your query anytime!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="submit" value="submit" class="primary-btn">Send Message</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--================Contact Area =================-->

	<!--gmaps Js-->

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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE&callback=initMap" async defer></script>
	<script src="{{asset('user/js/gmaps.min.js')}}"></script>
	<script src="{{asset('user/js/main.js')}}"></script>
	<script>
		function initMap() {
			if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
				console.error("Google Maps chưa sẵn sàng");
				return;
			}

			const map = new GMaps({
				el: '#map',
				lat: 10.762622,
				lng: 106.660172,
				zoom: 15,
				mapType: 'ROADMAP'
			});

			map.addMarker({
				lat: 10.762622,
				lng: 106.660172,
				title: 'Vị trí cửa hàng'
			});
		}
	</script>


	@endsection