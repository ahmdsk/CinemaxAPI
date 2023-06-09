<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img', 'movie_id'];

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
