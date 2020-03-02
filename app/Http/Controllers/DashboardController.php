<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.admin.dashboard');
    }

    public function student()
    {
        return view('user.siswa.dashboard');
    }

    public function teacher()
    {
        return view('user.guru.dashboard');
    }
}
