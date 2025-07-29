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

    public function login(Request $request)
{
    // Lấy dữ liệu login
    $credentials = $request->only('username', 'password');

    // Kiểm tra đăng nhập có "remember me"
    if (Auth::attempt($credentials, $request->has('remember'))) {
        // Chống session fixation
        $request->session()->regenerate();

        // Lưu account_id vào session (nếu cần)
        $user = Auth::user();
        session(['account_id' => $user->id]);

        // Phân quyền theo role_id
        switch ($user->role_id) {
            case 1:
                return redirect('/admin/index')->with('okay', 'Logged in successfully as admin!');
            case 2:
                return redirect('/home')->with('login_success', true);
            default:
                Auth::logout();
                return back()->withErrors(['login' => 'Account does not have access rights.']);
        }
    }

    // Sai thông tin đăng nhập
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
        $user = Auth::user();
        $roleId = $user->role_id;


        $users = Account::where('role_id', $roleId)->get();

        return view('account/userInfo', compact('user', 'users'));
    }
    public function edit()
    {
        $user = auth()->user();
        return view('account.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'username' => 'required|string|max:50',
            'new_password' => 'nullable|string|min:3|confirmed',
            'current_password' => 'required',
        ]);
        /** @var \App\Models\Account $user */
        $user = auth()->user();

        $user->fullname = $request->fullname;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->username = $request->username;

        if ($request->filled('new_password')) {
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Mật khẩu hiện tại không đúng!');
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('account.userInfo')->with('success', 'Cập nhật thành công!');

    }
}
