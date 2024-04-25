<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.pages.auth.loginForm');
    }

    public function loginProcess(Request $request)
    {
        // dd($request->all());

        // Validate the input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credential = $request->only(['email', 'password']);

        if (Auth::attempt($credential)) {
            if (auth()->user()->role == 'customer') {
                return redirect()->route('home');
            } elseif (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard')->withSuccess('Login Success');
            }
        } else {
           
            return redirect()->back()->with('success','Invalid credentials. Please try again.');
        
        }

        // Authentication failed
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);

    }

    public function logout()
    {

        Auth::logout();

        return redirect()->route('home');

    }

    public function registrationStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'name' => 'required',
            'password' => 'required|min:5',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->all());

        User::create([

            'email' => $request->email,

            'phone' => $request->phone,

            'address' => $request->address,

            'name' => $request->name,

            'password' => bcrypt($request->password),

            'role' => 'customer',

        ]);

        return back()->withSuccess('Registration Success');

    }

    public function showLoginFormFrontend()
    {
        return view('backend.pages.auth.loginFrontend');
    }
}
