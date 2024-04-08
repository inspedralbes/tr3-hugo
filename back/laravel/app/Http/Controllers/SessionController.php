<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Movie; 

class SessionController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'start_time' => 'required|date',
            // Agrega otras validaciones según sea necesario
        ]);

        $session = new Session($validatedData);
        $movie->sessions()->save($session);

        return response()->json(['message' => 'Session created successfully'], 201);
    }
    
    public function index(Movie $movie)
    {
        $sessions = $movie->sessions;
        return response()->json($sessions);
    } 

    public function show(Movie $movie, Session $session)
    {
        return response()->json($session);
    }

    public function update(Request $request, Movie $movie, Session $session)
    {
        $validatedData = $request->validate([
            'start_time' => 'required|date',
            // Agrega otras validaciones según sea necesario
        ]);

        $session->update($validatedData);

        return response()->json(['message' => 'Session updated successfully'], 200);
    }

    public function destroy(Movie $movie, Session $session)
    {
        $session->delete();

        return response()->json(['message' => 'Session deleted successfully'], 200);
    }
}
