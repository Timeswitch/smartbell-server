<?php

namespace SmartBell;

use Illuminate\Database\Eloquent\Model;

class Bell extends Model
{

    public function rings(){
        $this->hasMany('SmartBell\Ring');
    }

    public function user(){
        return $this->belongsTo('SmartBell\User');
    }
}
