<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json($tickets);
    }

    public function create()
    {
        // Aquí podrías agregar lógica para crear un nuevo ticket
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'movie_id' => 'required',
            'user_id' => 'required',
            'total_seats' => 'required|integer',
            'seat_id' => 'required',
            'price_per_seat' => 'required|numeric',
        ]);

        // Crear un nuevo ticket
        Ticket::create($request->all());

        //devolver respuesta
        return response()->json(['message' => 'Ticket created successfully'], 201);

    }

        public function show($id)
        {
            $ticket = Ticket::findOrFail($id);
            return response()->json($ticket);
        }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'movie_id' => 'required',
            'user_id' => 'required',
            'total_seats' => 'required|integer',
            'seat_id' => 'required',
            'price_per_seat' => 'required|numeric',
        ]);

        // Actualizar el ticket
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        //respuesta
        return response()->json(['message' => 'Ticket updated successfully'], 200);
    }

    public function destroy($id)
    {
        // Eliminar el ticket
        Ticket::findOrFail($id)->delete();

        //respuesta
        return response()->json(['message' => 'Ticket deleted successfully'], 200);
    }
}
