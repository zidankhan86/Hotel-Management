<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('frontend.pages.profile');
    }

    public function adminProfile()
    {
        return view('backend.pages.profile.profile');
    }
}
