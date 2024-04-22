<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function about_page()
    {
        $about = About::first();

        return view('frontend.about.about-page', compact('about'));
    }

    public function about_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'tittle' => 'nullable',
            'image' => 'required|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $existingBannersCount = About::count();
        if ($existingBannersCount >= 2) {
            return back()->with('error', 'Something went wrong');
        }

        $imageName = time().'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('uploads'), $imageName);

        // dd($imageName);
        //dd($request->all());

        About::create([
            'description' => $request->description,
            'tittle' => $request->tittle,
            'image' => $imageName,

        ]);

        return back()->with('success', 'About Created Successfully!');

    }

    public function about_delete($id)
    {
        $delete = About::find($id);

        $delete->delete();

        return back()->with('success', 'About deleted successfully!!');
    }
}
