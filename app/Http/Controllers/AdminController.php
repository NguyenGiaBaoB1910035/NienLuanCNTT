<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login', 'loginSubmit']);
    }

    public function index() {

        return view('admin.pages.dashboard');
    }

    public function login() {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }

        return view('admin.auth.login');
    }

    public function loginSubmit(Request $request) {
        $login_email = [
            'email' => $request->username,
            'password' => $request->password
        ];

        $login_phone = [
            'phone' => $request->username,
            'password' => $request->password,
        ];

        $remember = (request()->rememberme) ? true : false;

        if ((Auth::attempt($login_email, $remember) || Auth::attempt($login_phone, $remember))){
            return redirect()->route('admin.home');
        } else {
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
        }
    }

    public function register() {
        if (Auth::check()) {
            return view('admin.index');
        }
        return view('admin.auth.register');
    }

    public function registerSubmit(Request $request) {
        $checkTK = BD::table('users')
            ->where('phone', $request->phone)
            ->orWhere('email', $request->email)
            ->get();

        if(count($checkTK) > 0) {
            return back()->with('error','số điện thoại hoặc email đã tồn tại');
        }

        if($request->password != $request->repass) {
            return back()->with('error','Mật khẩu xác nhận không chính xác');
        }

        $createTK = User::crate([
            'name' => $request->name,
            'email' => $requests->email,
            'phone' => $requests->phone,
            'password' => bcrypt($requests->password),
        ]);

        if($createTK) {
            Auth::login($createTK);
            return back()->with('sccess', 'Tạo tài khoản thành công!!');
        } else {
            return back()->with('error', 'Lỗi tạo tài khoản không thành công!!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.home');
    }

}
