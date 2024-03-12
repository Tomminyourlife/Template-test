<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = '2022_customers';

    public function tickets(){
        return $this->hasMany(Ticket::class, 'customer_id');
    }

    public function emails(){
        return $this->hasMany(CustomerEmail::class);
    }
}
