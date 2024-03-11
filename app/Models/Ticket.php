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
}
