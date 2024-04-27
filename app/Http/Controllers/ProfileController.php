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

    public function invoice($id){

        $inv = Booking::find($id);

        return view('frontend.profile.invoice',compact('inv'));
    }

    public function invoiceBackend($id){

        $inv = Booking::find($id);

        return view('frontend.profile.invoice-backend',compact('inv'));
    }
}
