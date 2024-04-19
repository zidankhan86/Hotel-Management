<?php

namespace App\Http\Controllers;

use App\Models\Room;

class IndexController extends Controller
{
    public function dashboard()
    {
        $total_rooms = Room::count();
        return view('backend.dashboard.dashboard',compact('total_rooms'));
    }
}
