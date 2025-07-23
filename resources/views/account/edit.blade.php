@extends('layout.user')

@section('content')
<section class="order_details section_gap">
    <div class="container">
        <h3 class="title_confirmation"></h3>
        <div class="row order_d_inner">
            <div class="col-lg-4">
            </div>
            <div class="order_details_table">
                <h2>My Infomation</h2>
                <form action="{{ route('account.update') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">FullName</th>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control">
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td>
                                        <label>Birthday</label>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="date" name="birthday" value="{{ $user->birthday }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address</label>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Phone</label>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Username</p>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="text" name="username" value="{{ $user->username }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Password</p>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="password" name="password" value="{{ $user->password }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="submit" class="primary-btn">Save</button></td>
                                    <td></td>
                                    <td><a href="{{url('account/userInfo')}}" class="primary-btn">Cancel</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
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