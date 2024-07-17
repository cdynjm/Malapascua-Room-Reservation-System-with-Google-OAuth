<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Rooms;
use App\Models\User;
use App\Models\Reservation;
use App\Http\Controllers\AESCipher;

class PaymentController extends Controller
{
    public function gcash(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        $reservation = Reservation::where('id', $id)->first();

        $request->session()->put('amount', $reservation->total_payment);
        $request->session()->put('date', $reservation->paid_on);

        return view('gcash');
    }

    public function paymaya(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        $reservation = Reservation::where('id', $id)->first();

        $request->session()->put('amount', $reservation->total_payment);
        $request->session()->put('date', $reservation->paid_on);

        return view('paymaya');
    }

    public function payOnline(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);
        $payment_method = $aes->decrypt($request->payment_method);

        Reservation::where('id', $id)->update([
            'payment_method' => $payment_method,
            'paid_on' => Carbon::now()
        ]);
        
        if($payment_method == 1)
            return response()->json(['Error' => 0, 'Path' => '/gcash/'.$aes->encrypt($id).'/key='.\Str::random(50)]);
        if($payment_method == 2)
            return response()->json(['Error' => 0, 'Path' => '/paymaya/'.$aes->encrypt($id).'/key='.\Str::random(50)]);
    }
}
