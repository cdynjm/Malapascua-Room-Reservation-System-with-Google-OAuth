<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

use Mail;
use App\Mail\VerifyEmail;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = \Str::random(60);

        $request->validate([

            'name' => 'required|min:3|max:255',
            'phone' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:7|max:255',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone Number is required',
            'address.required' => 'Address is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'terms.accepted' => 'You must accept the terms and conditions'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->address,
            'password' => Hash::make($request->password),
            'remember_token' => $token,
            'role' => 2
        ]);

        Auth::login($user);

        event(new Registered($user));
        
        return redirect('/email/verify');
        
    }
}
