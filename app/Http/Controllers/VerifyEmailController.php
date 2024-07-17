<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function notVerified() {
        if(Auth::user()->email_verified_at == null)
            return view('not-verified');
        else {
            if(Auth::user()->role == 1)
                return redirect(RouteServiceProvider::ADMIN);
            if(Auth::user()->role == 2)
                return redirect(RouteServiceProvider::USER);
        }
            
    }

    public function verify(EmailVerificationRequest $request) {

        $request->fulfill($request);
        return view('verified');
    }
}
