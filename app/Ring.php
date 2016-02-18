<?php

namespace SmartBell;

use Illuminate\Database\Eloquent\Model;

class Ring extends Model
{
    protected $fillable = [
        'user_id', 'bell_id', 'file'
    ];

    public function user(){
        return $this->belongsTo('SmartBell\User');
    }

    public function bell(){
        return $this->belongsTo('SmartBell\Bell');
    }
}
