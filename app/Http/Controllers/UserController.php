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

class UserController extends Controller
{
    public function dashboard()
    {
        $rooms = Rooms::with('reservation')->orderBy('room', 'ASC')->get();
        return view('users.dashboard', ['rooms' => $rooms]);
    }   

    public function myreservations() {
        $reservations = Reservation::where('name', Auth::user()->id)
        ->where(function($query) {
            $query->where('status', 1)
                ->orWhere('status', 2);
        })->get();
        return view('users.myreservations', ['reservations' => $reservations]);

    }

    public function myHistory() {
        $reservations = Reservation::where('name', Auth::user()->id)->where('status', 3)->get();
        return view('users.history', ['reservations' => $reservations]);
    }

    public function createReservation(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        foreach($reservations = Reservation::where('rooms_id', $id)
                    ->where(function($query) {
                        $query->where('status', 1)
                            ->orWhere('status', 2);
                    })->get()
                as $get) {
            if
            (
                (date('Y-m-d', strtotime($request->checkin)) >= $get->checkin && date('Y-m-d', strtotime($request->checkin)) <= $get->checkout) || 
                (date('Y-m-d', strtotime($request->checkout)) >= $get->checkin && date('Y-m-d', strtotime($request->checkout)) <= $get->checkout)
            ) 
            {
                return response()->json(['Error' => 1, 'Message' => 'Selected days are conflict, please try again']);
            }
        }

        Reservation::create([
            'name' => Auth::user()->id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'rooms_id' => $id,
            'days' => $request->days,
            'total_payment' => $request->total_payment,
            'status' => 1
        ]);

        $rooms = Rooms::with('reservation')->orderBy('room', 'ASC')->get();
        return response()->json([
            'Error' => 0, 
            'Message' => 'Reserved Successfully',
            'Dashboard' => view('data.dashboard-data', ['rooms' => $rooms, 'aes' => $aes])->render()
        ]);
    }

    public function deleteReservation(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        Reservation::where('id', $id)->delete();

        $reservations = Reservation::where('name', Auth::user()->id)
        ->where(function($query) {
            $query->where('status', 1)
                ->orWhere('status', 2);
        })->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Reservation cancelled successfully',
            'MyReservations' => view('data.myreservations-data', ['reservations' => $reservations, 'aes' => $aes])->render()
        ]);

    }

    public function search(Request $request) {
        $aes = new AESCipher();

        $rooms = Rooms::where('room', 'LIKE', '%'.$request->room.'%')->get();

        return response()->json([
            'Error' => 0, 
            'Dashboard' => view('data.dashboard-data', ['rooms' => $rooms, 'aes' => $aes])->render()
        ]);

    }
}
