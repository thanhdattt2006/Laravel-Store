<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

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
                return redirect('/admin/index')->with('success', 'Logged in successfully as admin!');
            } elseif ($user->role_id == 2) {
                return redirect('/home');
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

        return redirect('/home')->with('success', 'Logged out successfully!');
    }
}
