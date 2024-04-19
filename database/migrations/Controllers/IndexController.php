<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function dashboard()
    {
        return view('backend.dashboard.dashboard');
    }
}
