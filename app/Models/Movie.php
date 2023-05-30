<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_name', 'movie_duration', 'movie_status', 'release_date', 'movie_img', 'description'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genres', 'movie_id', 'genre_id');
    }

    public function actors()
    {
        return $this->hasMany(Actor::class, 'movie_id');
    }
}
