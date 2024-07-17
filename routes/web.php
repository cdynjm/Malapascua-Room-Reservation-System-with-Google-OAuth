<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'verified'], function () {

        Route::get('/', function () {
            return redirect('/sign-in');
        });
        Route::get('/gcash/{id}/{key}', [PaymentController::class, 'gcash'])->name('gcash');
		Route::get('/paymaya/{id}/{key}', [PaymentController::class, 'paymaya'])->name('paymaya');

        Route::group(['middleware' => 'admin'], function () {

            Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
            Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
            Route::get('/pending-reservations', [AdminController::class, 'pendingReservations'])->name('pending-reservations');
            Route::get('/approved-reservations', [AdminController::class, 'approvedReservations'])->name('approved-reservations');
            Route::get('/history', [AdminController::class, 'history'])->name('history');

            Route::group(['prefix' => 'create'], function () {
                Route::post('/room', [AdminController::class, 'createRoom']);
            });

            Route::group(['prefix' => 'update'], function () {
                Route::put('/room', [AdminController::class, 'updateRoom']);
                Route::patch('/approved-reservation', [AdminController::class, 'approvedReservation']);
                Route::patch('/finish-reservation', [AdminController::class, 'finishReservation']);
                Route::patch('/check-in', [AdminController::class, 'checkIn']);
                Route::patch('/check-out', [AdminController::class, 'checkOut']);
            });

            Route::group(['prefix' => 'delete'], function () {
                Route::delete('/room', [AdminController::class, 'deleteRoom']);
                Route::delete('/client-reservation', [AdminController::class, 'deleteReservation']);
            });
        });

        Route::group(['middleware' => 'user'], function () {

            Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
            Route::get('/myreservations', [UserController::class, 'myreservations'])->name('myreservations');
            Route::get('/myhistory', [UserController::class, 'myHistory'])->name('myhistory');
            Route::post('/pay-online', [PaymentController::class, 'payOnline']);
            Route::post('/search/room', [UserController::class, 'search']);

            Route::group(['prefix' => 'create'], function () {
                Route::post('/reservation', [UserController::class, 'createReservation']);
            });

            Route::group(['prefix' => 'delete'], function () {
                Route::delete('/reservation', [UserController::class, 'deleteReservation']);
            });
        });

    });

    Route::get('/email/verify', [VerifyEmailController::class, 'notVerified'])->name('verification.notice');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

});

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware('signed')->name('verification.verify');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/sign-up', [RegisterController::class, 'create'])->name('sign-up');
    Route::post('/sign-up', [RegisterController::class, 'store']);
    Route::get('/sign-in', [LoginController::class, 'create'])->name('sign-in');
    Route::post('/sign-in', [LoginController::class, 'store']);
    Route::post('/sign-in-with-google', [LoginController::class, 'handleGoogleCallback']);
});






