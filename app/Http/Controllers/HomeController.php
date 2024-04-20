<?php

namespace App\Http\Controllers;

use App\Models\Features;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $rooms = Room::all();
        Features::with('features')->get();
        return view('frontend.fixed.main',compact('rooms'));
    }
}
