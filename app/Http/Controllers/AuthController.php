<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function proses(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/dashboard');
        }

        return redirect('/')->with('status', 'username atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
