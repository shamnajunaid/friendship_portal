<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Friend_request;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getUserGenderAttribute()
    {
        if($this->gender=='M'){
            return 'Male';
        }else{
            return 'Female';
        }
        
    }
    
    public function getCheckRequestAttribute()
    {
        
       $requests = Friend_request::where(function ($query) {
    $query->where('sender_id', '=', Auth::id())
          ->Where('receiver_id', '=', $this->id);
})->orwhere(function ($query) {
    $query->where('receiver_id', '=', Auth::id())
          ->Where('sender_id', '=', $this->id);
})->first();
       if(empty($requests)){
        return 0;
       }elseif($requests->sender_id==Auth::id()&&$requests->status==1){

        return 1;
       }
       elseif($requests->sender_id==$this->id&&$requests->status==1){
        return 2;
       }elseif($requests->status==2){
        return 3;
       }else{
        return 4;
       }
    }
}
