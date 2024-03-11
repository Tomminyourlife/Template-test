<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    protected $table = 'categories';
    protected $primaryKey = 'id'; 
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
    ]; 

    public function team(){
        return $this->belongsToMany(Team::class, 'category_team', 'category_id', 'team_id');
    }

    public function tickets(){
        return $this->hasMany(Ticket::class, 'category_id');
    }
}
