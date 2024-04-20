<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Order;

class OrderController extends Controller
{
    public function booking_list()
    {

        $orders = Booking::latest()->get();

        return view('backend.pages.order.bookin-list', compact('orders'));
    }

   
}
