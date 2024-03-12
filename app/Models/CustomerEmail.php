<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerEmail extends Model{

    protected $table = '2022_customer_emails';
    protected $fillable = ['customer_id', 'email'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
