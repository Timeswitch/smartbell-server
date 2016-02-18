<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;

class BellController extends APIController
{
    public function getIndex(){

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

    public function getShow($id) {
        $bell = $this->currentUser->bells()->where('id',$id)->get()->first();

        $result = [];

        $result['id'] = $bell->id;
        $result['name'] = $bell->name;
        $result['rings'] = [];

        foreach($bell->rings as $ring){
            $obj = [];

            $obj['id'] = $ring->id;
            $obj['date'] = $ring->created_at;
            $obj['image'] = '';

            $result['rings'][] = $obj;

        }

        return $result;

    }


}
