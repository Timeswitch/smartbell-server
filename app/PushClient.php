<?php

namespace SmartBell;

use Illuminate\Database\Eloquent\Model;

class PushClient extends Model
{
    public function user(){
        return $this->belongsTo('SmartBell\User');
    }
}
