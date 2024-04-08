<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'date','trailer'];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
