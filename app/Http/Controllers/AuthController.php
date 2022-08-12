<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetRequest;
use App\Mail\ResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

/* use Laravel\Socialite\Facades\Socialite; */

class AuthController extends Controller
{
    //
    public function loginForm()
    {
        return view('web.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            return redirect()->route('home');
        } else {
            return redirect()->route('web.auth.loginForm')->with('error', 'Sai Tài Khoản Hoặc Mật Khẩu !');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // 2 câu lệnh bên dưới có ở laravel 8 và 9
        // Huỷ toàn bộ session đi
        $request->session()->invalidate();
        // Tạo token mới
        $request->session()->regenerateToken();
        // Quay về màn login
        return redirect()->route('web.auth.loginForm');
    }

    public function registerForm()
    {
        return view('web.auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $emailExist = User::select('users.*')
            ->where('email', '=', $request->email)
            ->exists();
        $phoneExist = User::select('users.*')
            ->where('phone_number', '=', $request->phone_number)
            ->exists();
        if ($emailExist == true || $phoneExist == true) {
            return redirect()->route('web.auth.registerForm')->with('exist', 'Email Hoặc Số Điện Thoại Đã Tồn Tại !');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->role_id = 3;
        $user->status = 1;
        if ($request->avatar) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $user->avatar = $avatar->storeAs('images/users', $avatarName);
        } else {
            $user->avatar = 'images/users/NgszeyUUlBQpKIGjzOlfgRC1CFYDaBM0WKXbVftW.png';
        }
        $user->save();
        return redirect()->route('web.auth.loginForm');
    }

    // Quên Mật Khẩu

    public function forgotForm()
    {
        return view('web.auth.forgot');
    }

    public function postForgot(Request $request)
    {
        $user = User::select('users.*')
            ->where('email', '=', $request->email)
            ->get();
        $user_count = $user->count();
        foreach ($user as $u) {
            $user_id = $u->id;
        }
        if ($user_count == 0) {
            return redirect()->route('web.auth.forgotForm')->with('notExist', 'Email Chưa Được Đăng Ký !');
        } else {
            $token_random = Str::random(10);
            $user = User::find($user_id);
            $user->remember_token = $token_random;
            $user->email_verified_at = date("Y/m/d");
            $user->save();

            $name = $user->name;
            $email = $user->email;
            $code = mt_rand(100000, 999999);
            $data = array('name' => $name, 'email' => $email, 'code' => $code);

            Mail::send('web.auth.notify', ['data' => $data], function ($email) use ($data) {
                $email->subject('PH SHOP - Thay Đổi Mật Khẩu');
                $email->to($data['email'], $data['name']);
            });

            $confirm_code = setcookie('code', $code, time() + 60);
            $confirm_email = setcookie('email', $email, time() + 60);
            return redirect()->route('web.auth.confirmForm');
        }
    }
    public function confirmForm()
    {
        return view('web.auth.confirm');
    }
    public function postConfirm(Request $request)
    {
        if (!isset($_COOKIE['code'])) {
            return redirect()->route('web.auth.forgotForm')->with('error_confirm', 'Mã Xác Nhận Đã Hết Hạn !');
        } else {
            if ($request->confirm == $_COOKIE['code']) {
                return redirect()->route('web.auth.resetForm');
            } else return redirect()->route('web.auth.confirmForm')->with('error_confirm', 'Mã Xác Nhận Không Chính Xác !');
        }
    }
    public function resetForm()
    {
        return view('web.auth.reset');
    }

    public function postReset(ResetRequest $request)
    {
        if ($request->password != $request->re_password) {
            return redirect()->route('web.auth.resetForm')->with('error_reset', 'Nhập Lại Mật Khẩu Không Khớp !');
        }

        if (!isset($_COOKIE['email'])) {
            return redirect()->route('web.auth.forgotForm')->with('error_confirm', 'Mã Xác Nhận Đã Hết Hạn !');
        } else {
            $user = User::select('users.*')
                ->where('email', '=', $_COOKIE['email'])
                ->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('web.auth.loginForm')->with('success', 'Đổi Mật Khẩu Thành Công !');
        }
    }

    public function contact()
    {
        return view('web.auth.contact');
    }
    public function info()
    {
        return view('web.auth.info');
    }
    public function updateUser(Request $request)
    {
        if (trim(strlen($request->name)) == 0 || trim(strlen($request->email)) == 0 || trim(strlen($request->phone_number)) == 0 || trim(strlen($request->address)) == 0) {
            return redirect()->route('web.order.pay');
        }
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('web.order.pay');
    }

    public function update_u(Request $request)
    {
        $emailExist = User::select('users.*')
            ->where('email', '=', $request->email)
            ->exists();
        $phoneExist = User::select('users.*')
            ->where('phone_number', '=', $request->phone_number)
            ->exists();
        if (trim(strlen($request->email)) == 0 || trim(strlen($request->phone_number)) == 0 || trim(strlen($request->address)) == 0) {
            return redirect()->route('web.auth.info')->with('error_update', 'Không Được Bỏ Trống !');
        }
        if($emailExist == true || $emailExist == true){
            return redirect()->route('web.auth.info')->with('error_update', 'Email Hoặc Số Điện Thoại Đã Được Đăng Ký !');
        }
        $user = User::find(Auth::user()->id);
        if ($request->avatar) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $user->avatar = $avatar->storeAs('images/users', $avatarName);
        } else {
            $user->avatar = $user->avatar;
        }
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('web.auth.info');
    }
}
