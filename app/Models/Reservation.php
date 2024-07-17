<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = "reservation";

    protected $fillable = [
        'name',
        'location',
        'phone',
        'checkin',
        'checkout',
        'rooms_id',
        'days',
        'total_payment',
        'payment_method',
        'time_in',
        'time_out',
        'paid_on',
        'status'
    ];

    public function User() {
        return $this->hasOne(User::class, 'id', 'name');
    }

    public function Rooms() {
        return $this->belongsTo(Rooms::class, 'rooms_id');
    }
    
}
