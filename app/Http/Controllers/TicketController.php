<?php


namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function createTicket(Request $request){
        // Esegui la creazione del ticket con la categoria ricevuta dal client
        // Ad esempio, puoi salvarlo nel database con Eloquent
        $selectedCategory = $request->input('category');

        // Trova la categoria selezionata
        //$category = Category::findOrFail($selectedCategory);

        // Crea un nuovo ticket utilizzando il modello Eloquent
        /*$ticket =Ticket::create([
            'category' => $selectedCategory,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // Aggiungi altri campi necessari
        ]);

        return redirect()->route('ticket.show', ['id' => $ticket->id])
            ->with('success', 'Ticket creato con successo');*/

        return response()->json(['message' => 'Ticket creato con successo']);
    }

    /*public function show($id){
        // Recupera il ticket dal database utilizzando il modello Eloquent
        $ticket = Ticket::findOrFail($id);

        $team = $ticket->category->team;

        // Passa il ticket alla vista e visualizza la pagina del ticket
        return view('ticket.show', ['ticket' => $ticket]);
    }*/
}