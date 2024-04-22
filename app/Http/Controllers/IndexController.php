<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;

class IndexController extends Controller
{
    public function dashboard()
    {
        $total_rooms = Room::count();
        $total_book = Booking::count();
        $total_users = User::count();

        return view('backend.dashboard.dashboard', compact('total_rooms', 'total_book', 'total_users'));
    }
}
