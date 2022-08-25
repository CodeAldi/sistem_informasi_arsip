<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function index()
    {
        return view('userlogin');
    }

    public function handlelogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            if (Auth::guard('admin')->user()->level == 0) {
                return redirect()->intended('/dashboard');
                # code...
            }
            elseif(Auth::guard('admin')->user()->level == 1){
                return redirect()->intended('/dosenpj/dashboard');
            }
            elseif (Auth::guard('admin')->user()->level == 2) {
                return redirect()->intended('/kabag/dashboard');
                # code...
            }
        }
        elseif (Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect()->intended('/mahasiswa/home');
        }
        return back()->with('loginError', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
