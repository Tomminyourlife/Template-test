<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller{
    public function index(){
        // Recupera tutti i ticket dal database
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        
        $statusCounts = $tickets->groupBy('status')->map(function ($tickets) {
            return $tickets->count();
        });

        $titleCounts = $tickets->groupBy('title')->map(function ($tickets) {
            return $tickets->count();
        });

        // Passa i ticket alla vista
        return view('index', compact('tickets', 'statusCounts', 'titleCounts'));
    }

    public function show($id){
        $ticket = Ticket::findOrFail($id);
        return view('show', compact('ticket'));
    }

    public function addComment(Request $request, $ticketId) {
        $request->validate([
            'content' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($ticketId);
        $comment = new TicketComment();
        $comment->content = $request->input('content');
        $comment->ticket_id = $ticketId;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('tickets.show', $ticketId)->with('success', 'Commento aggiunto con successo.');
    }

    public function update(Request $request, $id){
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Stato del ticket aggiornato con successo.');
    }
}
