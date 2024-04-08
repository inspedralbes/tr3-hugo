<?php

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
            'date' => 'required|date',
            'trailer' => 'required|string',
            'total_seats' => 'required|integer',
        ]);

        $movie = Movie::create($validatedData);
        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
            'date' => 'required|date',
            'trailer' => 'required|string',
            'total_seats' => 'required|integer',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validatedData);
        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json(null, 204);
    }
}
