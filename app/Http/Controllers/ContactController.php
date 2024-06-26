<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contact_us()
    {
        return view('frontend.contactUs.contact-us');
    }

    public function contact_store(Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'required',
        ]);

        // If validation fails, redirect back with error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Contact::create([

            'name'      => $request->name,
            'email'     => $request->email,
            'message'   => $request->message,

        ]);

        return back()->with('success', 'Thank you for your feedback.');

    }

    public function contactlist(){

        $feedback = Contact::all();

        return view('backend.contact.contact-list',compact('feedback'));
    }

    public function contactview($id){

        $messages = Contact::find($id);

        return view('backend.contact.contact-view',compact('messages'));
    }
}
