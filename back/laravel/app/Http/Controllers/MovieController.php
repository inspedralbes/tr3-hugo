<?php

// app/Http/Controllers/MovieController.php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }
    public function show($id)
    {
        $movie = Movie::find($id);
        return response()->json($movie);
    }
}
