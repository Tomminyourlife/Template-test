<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketAssignedToTeam extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket){
        $this->ticket = $ticket;
    }

    public function build(){
        return $this->subject('Ticket assegnato al team')->view('emails.ticket_assigned_to_team');
    }
}
