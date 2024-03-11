<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id'; 
    public $timestamps = true;
    protected $fillable = [
        'customer_id',
        'category_id',
        'description',
        'title',
    ]; 
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function attachments(){
        return $this->hasMany(Attachment::class, 'ticket_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function team(){
    return $this->belongsTo(Team::class);
    }
    
// GESTIONE STATI TICKET
    /*const STATUS_OPEN = 'aperto';
    const STATUS_CLOSED = 'chiuso';
    const STATUS_WORKING = 'in_corso';

    public static function getStatuses(){
        return [
            self::STATUS_OPEN,
            self::STATUS_CLOSED,
            self::STATUS_WORKING,
            // Aggiungi altri stati se necessario
        ];
    }

    public function close(){
        $this->status = self::STATUS_CLOSED;
        $this->save();
    }*/
}
