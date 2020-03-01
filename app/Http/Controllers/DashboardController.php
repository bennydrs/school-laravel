<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function student()
    {
        return view('user.dashboard');
    }

    public function teacher()
    {
        return view('guru.dashboard');
    }
}
