<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Definisci la relazione tra la categoria e i team
    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
