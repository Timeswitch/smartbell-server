<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;

class RingController extends APIController
{

    public function getIndex(){
        $rings = $this->currentUser->rings;
        $result = [];

        foreach($rings as $ring){
            $obj = [];

            $obj['date'] = $ring->created_at;
            $obj['bell'] = $ring->bell->name;
            $obj['bell_id'] = $ring->bell_id;
            $obj['image'] = '';

            $result[] = $obj;

        }

        return $result;

    }
}
