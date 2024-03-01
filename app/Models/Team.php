<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // Definisci la relazione tra il team e le categorie
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // Relazione molti a molti con il modello User
    public function users() {
        return $this->belongsToMany(User::class, 'teamsusers');
    }
}