<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function createTicket(Request $request)
    {
        // Esegui la creazione del ticket con la categoria ricevuta dal client
        // Ad esempio, puoi salvarlo nel database con Eloquent
        $selectedCategory = $request->input('category');

        // Qui dovresti implementare la logica per la creazione del ticket nel tuo sistema

        return response()->json(['message' => 'Ticket creato con successo']);
    }
}