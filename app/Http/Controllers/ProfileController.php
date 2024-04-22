<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class ProfileController extends Controller
{
    public function profile()
    {
        $booked_hotel = Booking::with('room', 'user')->where('user_id', auth()->user()->id)->get();

        return view('frontend.profile.profile', compact('booked_hotel'));
    }
}
