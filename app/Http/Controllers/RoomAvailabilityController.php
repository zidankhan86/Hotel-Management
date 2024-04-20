<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomAvailabilityController extends Controller
{
    public function checkRoomAvailability(Request $request)
    {
        // Get user ID of the logged-in user
        $user_id = Auth::user()->id;

        // Get the input values from the form
        $room_id = $request->input('room_id');
        $check_in_date = date('Y-m-d H:i:s', strtotime($request->input('check_in_date')));
        $check_out_date = date('Y-m-d H:i:s', strtotime($request->input('check_out_date')));
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $note = $request->input('note');

        // Check if the room is already booked for the given dates
        $existing_booking = Booking::where('room_id', $room_id)
            ->where(function ($query) use ($check_in_date, $check_out_date) {
                $query->whereBetween('check_in', [$check_in_date, $check_out_date])
                    ->orWhereBetween('check_out', [$check_in_date, $check_out_date])
                    ->orWhere(function ($q) use ($check_in_date, $check_out_date) {
                        $q->where('check_in', '<=', $check_in_date)
                            ->where('check_out', '>=', $check_out_date);
                    });
            })
            ->latest()
            ->first();

        if ($existing_booking) {
            return back()->with('error', 'Time of booking already exists');
        } else {
            Booking::create([
                'user_id' => $user_id,
                'room_id' => $room_id,
                'check_in' => $check_in_date,
                'check_out' => $check_out_date,
                'status' => 'pending',
                'name' => $name,
                'address' => $address,
                'phone' => $phone,
                'note' => $note,
            ]);

            return back()->with('success', 'Booking successful');
        }
    }
}
