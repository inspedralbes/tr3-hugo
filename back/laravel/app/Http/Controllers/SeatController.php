<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index($movie_id)
    {
        // Obtener la lista de asientos disponibles para la película específica
        $seats = Seat::where('movie_id', $movie_id)->get();
        return response()->json($seats);
    }

    public function reserve($movie_id, $seat_id)
    {
        // Marcar el asiento como ocupado
        $seat = Seat::findOrFail($seat_id);
        $seat->occupied = true;
        $seat->save();

        return response()->json(['message' => 'Seat reserved successfully']);
    }

    public function addSeats($movie_id)
    {
        // Eliminar todos los asientos asociados a la película
        Seat::where('movie_id', $movie_id)->delete();

        // Agregar 12 filas de 10 columnas de asientos asociadas a la película
        for ($row = 1; $row <= 12; $row++) {
            for ($column = 1; $column <= 10; $column++) {
                Seat::create([
                    'movie_id' => $movie_id,
                    'row' => $row,
                    'column' => $column,
                    'occupied' => false, // Suponiendo que inicialmente todos los asientos están desocupados
                ]);
            }
        }

        return response()->json(['message' => 'Seats added successfully']);
    }

    public function removeSeats($movie_id)
    {
        // Eliminar todas las sillas asociadas a la película
        Seat::where('movie_id', $movie_id)->delete();

        return response()->json(['message' => 'Seats removed successfully']);
    }
    //add vip seats to a movie in the row 6
    public function addVipSeats($movie_id)
    {
        // Agregar asientos VIP para la fila 6
        for ($column = 1; $column <= 10; $column++) {
            Seat::create([
                'movie_id' => $movie_id,
                'row' => 6,
                'column' => $column,
                'vip' => true,
                'occupied' => false,
            ]);
        }

        return response()->json(['message' => 'VIP seats added successfully']);
    }
}
