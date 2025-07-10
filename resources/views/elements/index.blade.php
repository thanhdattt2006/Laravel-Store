@extends('layout.user')
@section ('content')
    <section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Element Page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Element</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
	<section class="sample-text-area">
		<div class="container">
			<h3 class="text-heading">Text Sample</h3>
			<p class="sample-text">
				Every avid independent filmmaker has <b>Bold</b> about making that <i>Italic</i> interest documentary, or short
				film to show off their creative prowess. Many have great ideas and want to “wow” the<sup>Superscript</sup> scene,
				or video renters with their big project. But once you have the<sub>Subscript</sub> “in the can” (no easy feat), how
				do you move from a <del>Strike</del> through of master DVDs with the <u>“Underline”</u> marked hand-written title
				inside a secondhand CD case, to a pile of cardboard boxes full of shiny new, retail-ready DVDs, with UPC barcodes
				and polywrap sitting on your doorstep? You need to create eye-popping artwork and have your project replicated.
				Using a reputable full service DVD Replication company like PacificDisc, Inc. to partner with is certainly a
				helpful option to ensure a professional end result, but to help with your DVD replication project, here are 4 easy
				steps to follow for good DVD replication results:

			</p>
		</div>
	</section>
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

@endsection