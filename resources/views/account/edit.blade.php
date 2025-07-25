@extends('layout.user')

@section('content')
<section class="order_details section_gap">
    <div class="container">
        <div class="row order_d_inner">
            <div class="col-lg-8 offset-lg-2">
                <div class="order_details_table">
                    <h2>My Information</h2>
                    <form action="{{ route('account.update') }}" id="userForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><label>Full Name</label></td>
                                        <td><input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Birthday</label></td>
                                        <td><input type="date" name="birthday" value="{{ $user->birthday }}" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Address</label></td>
                                        <td><input type="text" name="address" value="{{ $user->address }}" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Phone</label></td>
                                        <td><input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Username</label></td>
                                        <td><input type="text" name="username" value="{{ $user->username }}" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Current password</p>
                                        </td>
                                        <td>
                                            <input type="password" name="current_password" id="current_password" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>New password</p>
                                        </td>
                                        <td>
                                            <input type="password" name="new_password" id="new_password" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Confirm password</p>
                                        </td>

                                        <td>
                                            <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2">
                                            <input type="checkbox" id="togglePassword"> Show Password
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><button type="submit" class="primary-btn">Save</button></td>
                                        <td><a href="{{ url('account/userInfo') }}" class="primary-btn">Cancel</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
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

<<<<<<< HEAD
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
>>>>>>> e7a94005affc655a91f3d8334a2354b270ff50ac
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('userForm');
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const currentPasswordInput = document.getElementById('current_password');

        const toggle = document.getElementById('togglePassword');
        if (toggle) {
            toggle.addEventListener('change', function() {
                const type = this.checked ? 'text' : 'password';
                newPasswordInput.type = type;
                confirmPasswordInput.type = type;
                currentPasswordInput.type = type;
            });
        }

        form.addEventListener('submit', function(e) {
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const currentPassword = currentPasswordInput.value;

            console.log("New password:", newPassword);
            console.log("Confirm password:", confirmPassword);
            console.log("Current password:", currentPassword);

            if (newPassword !== '' && newPassword !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Mật khẩu xác nhận không khớp!',
                    confirmButtonText: 'OK'
                });
            } else if (newPassword === currentPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Mật khẩu mới bị trùng với mật khẩu cũ!',
                    confirmButtonText: 'OK'
                });
            } 
            else if (currentPassword === '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Vui lòng nhập mật khẩu hiện tại!',
                    confirmButtonText: 'OK'
                });
            } 
            else {
                e.preventDefault();
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Thay đổi mật khẩu thành công!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector('#userForm').submit();
                    }
                });
            }
        });
    });
</script>
@endsection