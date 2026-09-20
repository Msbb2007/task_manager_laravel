<?php

namespace App\Http\Controllers;

use App\Http\Requests\userLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('');
    }

    public function login(userLoginRequest $request){

        $user=User::query()->where('email',$request->email)->first();
        if(Hash::check($request->password,$user->password)){
            Auth::login($user);
            return redirect()->intended('');
        }
        return redirect()->back()->with('message','ایمیل یا رمز عبور نادرست است');
    }


    public function showRegister()
    {
        return view('');

    }

    public function register(userLoginRequest $request)
    {
        $user = User::query()->create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('')->with('success', 'ثبت‌ نام با موفقیت انجام شد.');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
    }
}
