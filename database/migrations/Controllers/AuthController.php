<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.login.login-page');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credential = $request->only(['email', 'password']);

        if (Auth::attempt($credential)) {
            if (auth()->user()->role == 'customer') {
                return redirect()->route('dashboard');
            } elseif (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard')->withSuccess('Login Success');
            }
        } else {
            // toastr()->error('Invalid credentials. Please try again.');
            return redirect()->back();
        }
    }
}
