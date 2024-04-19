<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
   public function room_page(){
    // $rooms = Room::with('','')->where('')->get();
    return view('frontend.fixed.room-page');
   }
}
