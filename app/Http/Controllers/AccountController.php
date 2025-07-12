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
        return view('login/index'); // Giao diện form login
    }

    // Xử lý login
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                // Đăng nhập thành công
                return redirect('home/index'); // hoặc trang bạn muốn
            } else {
                // Sai thông tin đăng nhập
                return back()->withErrors([
                    'login' => 'Tài khoản hoặc mật khẩu không đúng!',
                ])->withInput();
            }
        } catch (Exception $ex) {
            return back()->withErrors([
                'login' => 'Lỗi hệ thống: ' . $ex->getMessage(),
            ]);
        }
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}
