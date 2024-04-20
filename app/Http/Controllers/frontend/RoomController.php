<?php

namespace App\Http\Controllers\frontend;

use App\Models\Room;
use App\Models\Features;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
   public function room_page(){
    $rooms = Room::with('features','facilities')->get();
    Features::with('features')->get();
    return view('frontend.fixed.room-page',compact('rooms'));
   }


   public function room_details_page($id){

      $room_details = Room::find($id);
      return view('frontend.room.room-details',compact('room_details'));
   }
}
