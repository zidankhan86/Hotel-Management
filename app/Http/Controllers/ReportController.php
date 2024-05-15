<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function report()
    {
        //dd('yes');
        $booking = Booking::all();

        return view('backend.pages.report.report', compact('booking'));
    }

    public function reportSearch(Request $request)
    {

        //dd('yes');
        $validator = Validator::make($request->all(), [
            'from_date' => 'required|date',
            'to_date' => 'required|date|after:from_date',
        ]);

        if ($validator->fails()) {

            Alert::toast()->error('From date and to date required and to should greater then from date.');

            return redirect()->back();
        }

        $from = $request->from_date;
        $to = $request->to_date;

        //       $status=$request->status;

        $booking = Booking::whereBetween('created_at', [$from, $to])->get();

        return view('backend.pages.report.report', compact('booking'));

    }
}
