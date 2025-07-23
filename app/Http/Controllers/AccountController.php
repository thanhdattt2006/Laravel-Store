<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // Hiển thị trang login
    public function index()
    {
        return view('account/login'); // Giao diện form login
    }

    // Xử lý login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Thêm remember vào đây
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect('/admin/index')->with('okay', 'Logged in successfully as admin!');
            } elseif ($user->role_id == 2) {
                return redirect('/home')->with('login_success', true);
            } else {
                Auth::logout();
                return back()->withErrors(['login' => 'Account does not have access rights.']);
            }
        }

        return back()->withErrors([
            'login' => 'Username or password is incorrect.',
        ])->withInput();
    }



    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home')->with('oke', 'Logged out successfully!');
    }


    // Hiển thị trang đăng ký
    public function register()
    {
        return view('/account/login');
    }

    // Xử lý đăng ký
    public function registerHandle(Request $request)
    {
        $user = $request->post();
        $user['password'] = Hash::make($user['password']);
        Account::create($user);
        return redirect('/account')->with('ok', 'Account created successfully! Now you can login.');
    }
    public function userInfo()
    {
        $user = Auth::user(); // lấy user hiện tại
        $roleId = $user->role_id;

        // Lấy tất cả user cùng role (hoặc thay đổi tùy theo logic của bạn)
        $users = Account::where('role_id', $roleId)->get();

        return view('account/userInfo', compact('user', 'users'));
    }

}
