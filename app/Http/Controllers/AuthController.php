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
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard');
            } elseif (auth()->user()->role == 'siswa') {
                return redirect('/student/dashboard');
            } else {
                return redirect('/teacher/dashboard');
            }
        }

        return redirect('/')->with('status', 'username atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
