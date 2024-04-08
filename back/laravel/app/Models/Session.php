<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['movie_id', 'start_time'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

