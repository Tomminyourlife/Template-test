<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'ticket_id',
        'filename',
        'path'
        // Aggiungi altri campi per la gestione degli allegati, se necessario
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'attachment_id');
    }
}

