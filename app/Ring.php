<?php

namespace SmartBell;

use Illuminate\Database\Eloquent\Model;

class Ring extends Model
{
    public function user(){
        return $this->belongsTo('SmartBell\User');
    }

    public function bell(){
        return $this->belongsTo('SmartBell\Bell');
    }
}
