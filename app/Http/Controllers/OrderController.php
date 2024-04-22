<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function booking_list()
    {

        $orders = Booking::latest()->get();

        return view('backend.pages.order.bookin-list', compact('orders'));
    }

    public function StatusUpdate(Request $request, $id)
    {

        $room = Booking::find($id);
        $room->status = $request->status;
        $room->save();

        return redirect()->back()->with('success', 'Status updated successfully!');

    }
}
