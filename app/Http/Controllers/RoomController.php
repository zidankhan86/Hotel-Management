<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Features;
use App\Models\facilities;
use App\Models\RoomFeature;
use Illuminate\Http\Request;
use App\Models\RoomFacilities;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
   
    public function index()
    {
        $features = Features::all();
        $facilities = facilities::all();
        $rooms = Room::simplePaginate(8);

        return view('backend.room.room-table', compact('features', 'facilities','rooms'));
    }

    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'category_name'     => 'required',
            'area'              => 'required',
            'price'             => 'required',
            'quantity'          => 'required',
            'adult'             => 'required',
            'children'          => 'required',
            'description'       => 'required',
            'image'             => 'required',
            'status'            => 'required',
            'features_id'       => 'nullable',
            'facilities_id'     => 'nullable',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = date('Ymdhis').'.'.$request->image->extension();
            $request->image->storeAs('uploads', $imageName, 'public');
        }

        $room = Room::create([
            'category_name' => $request->category_name,
            'area'          => $request->area,
            'price'         => $request->price,
            'quantity'      => $request->quantity,
            'adult'         => $request->adult,
            'children'      => $request->children,
            'description'   => $request->description,
            'image'         => $imageName,
            'status'        => $request->status,
        ]);

        if ($request->has('features_id')) {
            $names = $request->input('names', []); 
            foreach ($request->features_id as $key => $featureId) {
                $name = isset($names[$key]) ? $names[$key] : null; 
                RoomFeature::create([
                    'room_id' => $room->id,
                    'feature_id' => $featureId,
                    'name' => $name 
                ]);
            }
        }
        

        if ($request->has('facilities_id')) {
            $names = $request->input('names', []); 
            foreach ($request->facilities_id as $key=> $facilitiesId) {
                $name = isset($names[$key]) ? $names[$key] : null; 
                RoomFacilities::create([
                    'room_id' => $room->id,
                    'facilities_id' => $facilitiesId,
                    'name' => $name 
                ]);
            }
        }

        return back()->with('success','Room Created successfully!!');
    }

    

    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
