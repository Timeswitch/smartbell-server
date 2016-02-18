<?php

namespace SmartBell;

use Illuminate\Database\Eloquent\Model;

class Bell extends Model
{

    public function rings(){
        return $this->hasMany('SmartBell\Ring');
    }

    public function user(){
        return $this->belongsTo('SmartBell\User');
    }
}
