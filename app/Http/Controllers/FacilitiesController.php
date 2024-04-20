<?php

namespace App\Http\Controllers;

use App\Models\facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = facilities::all();

        return view('backend.features_and_facilities.facilities', compact('facilities'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        facilities::create([
            'name' => $request->name,
            'description' => $request->description,

        ]);

        return back()->with('success', 'Facilities created successfully!!');
    }

    public function edit($id)
    {
        $facility = facilities::findOrFail($id);

        return view('backend.features_and_facilities.edit-facilities', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, facilities $facilities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function facilities_delete( $id)
    {
        $delete = facilities::find($id);

        $delete->delete();

        return back()->with('success','Facilities deleted successfully!!');
    }
}
