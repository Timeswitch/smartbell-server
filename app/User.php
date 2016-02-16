<?php

namespace SmartBell;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bells(){
        return $this->hasMany('SmartBell\Bell');
    }

    public function push_clients(){
        return $this->hasMany('SmartBell\PushClient');
    }

    public function rings(){
        return $this->hasMany('SmartBell\Ring');
    }
}
