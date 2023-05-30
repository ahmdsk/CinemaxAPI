<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingMovie extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'booking_date', 'booking_time'];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'booking_movies_seats', 'booking_movie_id', 'seat_id');
    }
}
