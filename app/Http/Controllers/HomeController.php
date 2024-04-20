<?php

namespace App\Http\Controllers;

use App\Models\Room;

class HomeController extends Controller
{
    public function home()
    {
        $rooms = Room::all();

        return view('frontend.fixed.main', compact('rooms'));
    }
}
