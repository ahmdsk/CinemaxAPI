<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    
    protected $fillable = ['seat_code'];

    public function booking_movies()
    {
        return $this->belongsToMany(BookingMovie::class, 'booking_movies_seats', 'seat_id', 'booking_movie_id');
    }
}
