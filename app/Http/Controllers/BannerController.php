<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
   
    public function bannerStore(Request $request){
        $validator = Validator::make($request->all(), [
            'tittle' => 'nullable',
            'image'  => 'required|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $existingBannersCount = Banner::count();
    if ($existingBannersCount >= 2) {
        return back()->with('error', 'Maximum number of banners reached');
    }

    $imageName = time() . '.' . $request->file('image')->extension();
         $request->file('image')->move(public_path('uploads'), $imageName);

       // dd($imageName);
        //dd($request->all());

        Banner::create([

        "tittle"=>$request->tittle,
        "image"=>$imageName

        ]);

        return back()->with('success','Hero banner Uploaded Successfully!');

    }

    public function bannerdelete($id){
        $banner = Banner::find($id);

    if ($banner) {
        $banner->delete();
        return redirect()->back()->with('success', 'Hero banner deleted successfully!');
    }

    return redirect()->back()->with('error', 'Banner not found.');

    }



public function banneredit($id){

    $edit = Banner::find($id);
    return view('backend.pages.banner.edit',compact('edit'));
}


    public function bannerupdate(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'tittle' => 'nullable',
            'image' => 'required|max:500',
        ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $imageName = time() . '.' . $request->file('image')->extension();
    $request->file('image')->move(public_path('uploads'), $imageName);

   // dd($imageName);
    //dd($request->all());

    $update = Banner::find($id);
    $update->update([

        "tittle"=>$request->tittle,
        "image"=>$imageName
    ]);

Alert::toast()->success('Banner Updated');
    return redirect()->route('banner.list');

}


}
