<?php

namespace SmartBell;

use Illuminate\Database\Eloquent\Model;

class Bell extends Model
{

    protected $fillable = [
        'user_id', 'name', 'uuid', 'active'
    ];

    public function rings(){
        return $this->hasMany('SmartBell\Ring');
    }

    public function user(){
        return $this->belongsTo('SmartBell\User');
    }

    public function getActiveAttribute($value){
        return $value == 1;
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = (int)$value;
    }
}
