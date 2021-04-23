<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Friend_request extends Model
{
     protected $fillable = [
        'sender_id', 'receiver_id', 'status'
    ];
    public function sender(){
    	return $this->belongsTo('\App\User','sender_id');
    }
    public function receiver(){
    	return $this->belongsTo('\App\User','receiver_id');
    }

}
