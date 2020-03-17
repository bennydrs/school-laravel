<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Admin
    public function index()
    {
        return view('user.admin.dashboard');
    }
    //end admin

    // siswa
    public function student()
    {
        $informations = Information::all()->take(3);
        return view('user.siswa.dashboard', compact('informations'));
    }

    public function showInformation($information_id)
    {
        $information = Information::find($information_id);
        return view('user.siswa.showInformation', compact('information'));
    }
    //end siswa

    // guru
    public function teacher()
    {
        return view('user.guru.dashboard');
    }
    // end guru
}
