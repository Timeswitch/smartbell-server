<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;

class BellController extends APIController
{
    public function getIndex(Request $req){
        $bells = $this->currentUser->bells;
        $result = [];

        foreach($bells as $bell){
            $obj = [];

            $obj['id'] = $bell->id;
            $obj['name'] = $bell->name;
            $obj['active'] = $bell->active;

            $result[] = $obj;
        }

        return $result;
    }
}
