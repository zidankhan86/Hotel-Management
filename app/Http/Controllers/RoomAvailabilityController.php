<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomAvailabilityController extends Controller
{
    public function checkRoomAvailability(Request $request)
    {
  
        // Get the input values from the form
        $room_id = $request->input('room_id');
        $check_in_date = date('Y-m-d H:i:s', strtotime($request->input('check_in_date')));
        $check_out_date = date('Y-m-d H:i:s', strtotime($request->input('check_out_date')));
        $total_rooms = $request->input('total_rooms');
     

        // Get the room details
        $room = Room::find($room_id);

        // Check if the room has enough available rooms for the booking
        if ($room->available_rooms >= $total_rooms) {
            Booking::create([
                'user_id' => auth()->user()->id,
                'room_id' => $request->room_id,
                'check_in' => $check_in_date,
                'check_out' => $check_out_date,
                'status' => 'pending',
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'note' => $request->note,
                'total_rooms' => $request->total_rooms,
            ]);

            return redirect()->route('home')->with('success','Booking successful');
        } else {
            return back()->with('error', 'No room available');
        }
    }
}
