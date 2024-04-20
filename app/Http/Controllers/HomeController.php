<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\About;

class HomeController extends Controller
{
    public function home()
    {
        $rooms = Room::all();
        $about = About::first();
        return view('frontend.fixed.main', compact('rooms','about'));
    }
}
