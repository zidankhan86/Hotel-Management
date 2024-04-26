<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\facilities;
use App\Models\Features;
use App\Models\Room;
use App\Models\RoomFacilities;
use App\Models\RoomFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $features = Features::all();
        $facilities = facilities::all();
        $branch = Branch::all();
        $rooms = Room::simplePaginate(8);
        Room::with('branch')->get();

        return view('backend.room.room-table', compact('features', 'facilities', 'rooms', 'branch'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'category_name'     => 'required',
            'area'              => 'required',
            'price'             => 'required',
            'total_rooms'       => 'required',
            'adult'             => 'required',
            'children'          => 'required',
            'description'       => 'required',
            'image'             => 'required',
            'status'            => 'required',
            'features_id'       => 'nullable',
            'facilities_id'     => 'nullable',
            'branch_id'         => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        $imageName = time().'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('uploads'), $imageName);
        //dd($imageName);
        $room = Room::create([
            'category_name'     => $request->category_name,
            'area'              => $request->area,
            'price'             => $request->price,
            'total_rooms'       => $request->total_rooms,
            'available_rooms'   => $request->total_rooms,
            'adult'             => $request->adult,
            'children'          => $request->children,
            'description'       => $request->description,
            'image'             => $imageName,
            'status'            => $request->status,
            'branch_id'         => $request->branch_id,
        ]);

        if ($request->has('features_id')) {
            foreach ($request->features_id as $featureId) {
                RoomFeature::create([
                    'room_id' => $room->id,
                    'feature_id' => $featureId,
                ]);
            }
        }

        if ($request->has('facilities_id')) {
            foreach ($request->facilities_id as $facilitiesId) {
                RoomFacilities::create([
                    'room_id' => $room->id,
                    'facilities_id' => $facilitiesId,
                ]);
            }
        }

        return back()->with('success', 'Room Created successfully!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'area' => 'required',
            'price' => 'required',
            'total_rooms' => 'required',
            'adult' => 'required',
            'children' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update room details
        $room->update([
            'category_name' => $request->category_name,
            'area' => $request->area,
            'price' => $request->price,
            'total_rooms' => $request->total_rooms,
            'available_rooms' => $request->total_rooms,
            'adult' => $request->adult,
            'children' => $request->children,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $room->update(['image' => $imageName]);
        }


        return back()->with('success', 'Room updated successfully!');
    }

}
