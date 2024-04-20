<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function room_page()
    {
        $rooms = Room::all();

        return view('frontend.fixed.room-page', compact('rooms'));
    }

    public function room_details_page($id)
    {

        $room_details = Room::find($id);

        return view('frontend.room.room-details', compact('room_details'));
    }
}
