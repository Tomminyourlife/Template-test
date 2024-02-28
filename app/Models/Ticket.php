<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id'; 
    public $timestamps = true;
    protected $fillable = [
        'title',
        'description',
        //file?
    ]; 

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
