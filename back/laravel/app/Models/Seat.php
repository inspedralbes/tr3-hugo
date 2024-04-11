<?php

namespace App\Models;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'occupied',
        'row',
        'column',
        'vip',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
