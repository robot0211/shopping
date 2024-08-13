<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('loginAdmin')->withErrors([
                'email' => 'Email hoặc mật khẩu không đúng.'
            ]);
        }

        // $email = $request->email;
        // $password = $request->password;

        // $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        // $result = DB::select($query);

        // if (count($result) > 0) {
        //     return redirect()->route('dashboard');
        // } else {
        //     return redirect()->route('loginAdmin')->withErrors([
        //         'email' => 'Email hoặc mật khẩu không đúng.'
        //     ]);
        // }
    }

    public function logoutAdmin(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate(); // Xóa session hiện tại
        $request->session()->regenerateToken(); // Tạo token mới để tránh CSRF

        return redirect()->route('loginAdmin'); // Chuyển hướng về trang login
    }
}
