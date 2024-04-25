<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Branch;
use App\Models\Room;

class HomeController extends Controller
{
    public function home()
    {
        $rooms =  Room::with('branch')->get();
        $about = About::first();
       

        return view('frontend.fixed.main', compact('rooms', 'about'));
    }
}
