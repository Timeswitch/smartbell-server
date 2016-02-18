<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;

class RingController extends APIController
{

    public function index(){
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

    public function show($id){
        $ring = $this->currentUser->rings()->where('id',$id)->get()->first();
        //TODO machen
    }

    public function destroy($id){
        $ring = $this->currentUser->rings()->where('id',$id)->get()->first();
        $ring->delete();

        return ['success'];
    }
}
