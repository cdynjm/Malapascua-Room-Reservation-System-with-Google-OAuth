<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $fillable = [
        'room',
        'description',
        'price',
        'status',
        'maxguest',
        'picture',
        'checkout'
    ];

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }
}
