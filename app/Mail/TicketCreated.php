<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket){
        $this->ticket = $ticket;
    }

    public function build(){
        return $this->subject('Nuovo ticket creato')->view('emails.ticket_created');
    }
}
