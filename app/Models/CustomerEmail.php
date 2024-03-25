<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class CustomerEmail extends Authenticatable implements AuthenticatableContract{

    protected $table = '2022_customer_emails';
    protected $fillable = ['customer_id', 'email'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
