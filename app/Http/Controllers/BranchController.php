<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'branch_name' => 'required',
            'location' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Branch::create([
            'branch_name' => $request->branch_name,
            "location"=> $request->location
        ]);

        return back()->with('success', 'Branch created successfully!!');
    }

   
}
