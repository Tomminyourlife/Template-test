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
        //file?
    ]; 

    /*protected $casts = [
        'attachments' => 'array',
    ];

    public function addAttachment($path){
        $attachments = $this->attachments ?? [];
        $attachments[] = $path;
        $this->attachments = $attachments;
        $this->save();
    }*/

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class, 'attachment_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
