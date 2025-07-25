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
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('userForm');
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('confirm_password');

        const toggle = document.getElementById('togglePassword');
        if (toggle) {
            toggle.addEventListener('change', function() {
                const type = this.checked ? 'text' : 'password';
                newPasswordInput.type = type;
                confirmPasswordInput.type = type;
            });
        }

        form.addEventListener('submit', function(e) {
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            console.log("New password:", newPassword);
            console.log("Confirm password:", confirmPassword);

            if (newPassword !== '' && newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Mật khẩu xác nhận không khớp!');
            }
        });
    });
</script>
@endsection