<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketingController extends Controller{
      
    public function index(Request $request){
        $customer = $request->session()->get('customer');

        if ($customer) {
            $tickets = $customer->tickets()->orderBy('created_at', 'desc')->get(); 
    
            return view('index2', compact('tickets'));
        } else {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to view this page');
        }
    }

    public function showComments(Ticket $ticket) {
        return view('comments', ['ticket' => $ticket]);
    }

    public function store(Request $request){
        $customer = $request->session()->get('customer');
        // Validazione dei dati del modulo
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'content' => 'required|string',
        ]);

        // Creazione di un nuovo commento
        $comment = new TicketComment();
        $comment->ticket_id = $request->ticket_id;
        $comment->content = $request->content;
        $comment->customer_id = $customer->id;
        $comment->save();

        // Redirect alla pagina dei commenti del ticket appena commentato
        return redirect()->route('ticket.comments', $request->ticket_id)->with('success', 'Comment added successfully.');
    }
}