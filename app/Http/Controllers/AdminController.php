<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Rooms;
use App\Models\User;
use App\Models\Reservation;
use App\Http\Controllers\AESCipher;

class AdminController extends Controller
{
    public function dashboard() {
        $rooms = Rooms::count();
        $pending = Reservation::where('status', 1)->count();
        $approved = Reservation::where('status', 2)->count();
        return view('admin.dashboard', compact('rooms', 'pending', 'approved'));
    }

    public function rooms() {

        $rooms = Rooms::orderBy('room', 'ASC')->get();
        return view('admin.rooms', ['rooms' => $rooms]);
    }

    public function pendingReservations() {
        $reservations = Reservation::where('status', 1)->get();
        return view('admin.pending-reservations', ['reservations' => $reservations]);
    }

    public function approvedReservations() {
        $reservations = Reservation::where('status', 2)->get();
        return view('admin.approved-reservations', ['reservations' => $reservations]);
    }

    public function history() {
        $reservations = Reservation::where('status', 3)->get();
        return view('admin.history', ['reservations' => $reservations]);
    }

    public function createRoom(Request $request) {
        $aes = new AESCipher();

        $filename = \Str::slug($request->room.'-'.Carbon::now()).'.'.$request->image->extension(); 
        $transferfile = $request->file('image')->storeAs('public/rooms/', $filename);

        Rooms::create([
            'room' => $request->room,
            'description' => $request->description,
            'price' => $request->price,
            'status' => 1,
            'maxguest' => $request->maxguest,
            'picture' => $filename,
        ]);

        $rooms = Rooms::orderBy('room', 'ASC')->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Room added successfully',
            'Rooms' => view('data.rooms-data', ['rooms' => $rooms, 'aes' => $aes])->render()
        ]);
    }

    public function updateRoom(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        if(!empty($request->image)) {

            $image = Rooms::where(['id' => $id])->first();
            File::delete(public_path('storage/rooms/'.$image->picture.''));

            $filename = \Str::slug($request->room.'-'.Carbon::now()).'.'.$request->image->extension(); 
            $transferfile = $request->file('image')->storeAs('public/rooms/', $filename);

            Rooms::where('id', $id)->update([
                'room' => $request->room,
                'description' => $request->description,
                'price' => $request->price,
                'status' => 1,
                'maxguest' => $request->maxguest,
                'picture' => $filename,
            ]);
        }
        else {
            Rooms::where('id', $id)->update([
                'room' => $request->room,
                'description' => $request->description,
                'price' => $request->price,
                'status' => 1,
                'maxguest' => $request->maxguest,
            ]);
        }

        $rooms = Rooms::orderBy('room', 'ASC')->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Room updated successfully',
            'Rooms' => view('data.rooms-data', ['rooms' => $rooms, 'aes' => $aes])->render()
        ]);
    }

    public function deleteRoom(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        $image = Rooms::where(['id' => $id])->first();
        File::delete(public_path('storage/rooms/'.$image->picture.''));
        Rooms::where('id', $id)->delete();

        $rooms = Rooms::orderBy('room', 'ASC')->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Room deleted successfully',
            'Rooms' => view('data.rooms-data', ['rooms' => $rooms, 'aes' => $aes])->render()
        ]);
    }

    public function approvedReservation(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        Reservation::where('id', $id)->update(['status' => 2]);
        $reservations = Reservation::where('status', 1)->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Reservation approved successfully',
            'Reservations' => view('data.pending-reservations-data', ['reservations' => $reservations, 'aes' => $aes])->render()
        ]);
    }

    public function finishReservation(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        Reservation::where('id', $id)->update(['status' => 3]);
        $reservations = Reservation::where('status', 2)->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Reservation finished successfully',
            'Reservations' => view('data.approved-reservations-data', ['reservations' => $reservations, 'aes' => $aes])->render()
        ]);
    }

    public function deleteReservation(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        Reservation::where('id', $id)->delete();
        $reservations = Reservation::where('status', 1)->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Reservation cancelled successfully',
            'Reservations' => view('data.pending-reservations-data', ['reservations' => $reservations, 'aes' => $aes])->render()
        ]);
    }

    public function checkIn(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        Reservation::where('id', $id)->update(['time_in' => Carbon::now()]);
        $reservations = Reservation::where('status', 2)->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Customer checked in successfully',
            'Reservations' => view('data.approved-reservations-data', ['reservations' => $reservations, 'aes' => $aes])->render()
        ]);
    }

    public function checkOut(Request $request) {
        $aes = new AESCipher();
        $id = $aes->decrypt($request->id);

        Reservation::where('id', $id)->update(['time_out' => Carbon::now()]);
        $reservations = Reservation::where('status', 2)->get();

        return response()->json([
            'Error' => 0, 
            'Message' => 'Customer checked out successfully',
            'Reservations' => view('data.approved-reservations-data', ['reservations' => $reservations, 'aes' => $aes])->render()
        ]);
    }
}
