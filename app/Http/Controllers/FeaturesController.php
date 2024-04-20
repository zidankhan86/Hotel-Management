<?php

namespace App\Http\Controllers;

use App\Models\Features;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features= Features::all();
        return view('backend.features_and_facilities.features',compact('features'));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'name' => 'required',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Features::create([
            'name' => $request->name,
        ]);

        return back()->with('success','Features created successfully!!');
    }

    
    public function edit(Features $features)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Features $features)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function features_delete($id)
    {
        $delete = Features::find($id);

        $delete->delete();

        return back()->with('success','Features deleted successfully!!');
    }
}
