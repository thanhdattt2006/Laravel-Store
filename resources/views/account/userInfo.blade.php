@extends('layout.user')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>User Infomation</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="category.html">User Infomation</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Order Details Area =================-->
<section class="order_details section_gap">
    <div class="container">
        <h3 class="title_confirmation"></h3>
        <div class="row order_d_inner">
            <div class="col-lg-4">
            </div>
            <div class="order_details_table">
                <h2>My Infomation</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">FullName</th>
                                <th scope="col">|</th>
                                <th scope="col">
                                    <h5>{{$user -> fullname}}</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>Birthday</p>
                                </td>
                                <td>|</td>
                                <td>
                                    <h5>{{$user -> birthday}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Address</p>
                                </td>
                                <td>|</td>
                                <td>
                                    <h5 style="text-wrap-style: balance;">{{$user -> address}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Phone</p>
                                </td>
                                <td>|</td>
                                <td>
                                    <h5>{{$user -> phone}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Username</p>
                                </td>
                                <td>|</td>
                                <td>
                                    <h5>{{$user -> username}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><a href="{{ route('account.edit') }}" class="primary-btn">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
<!--================End Order Details Area =================-->

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