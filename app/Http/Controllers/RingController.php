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

            $obj['date'] = $ring->created_at->toDateTimeString();
            $obj['bell'] = $ring->bell->name;
            $obj['bell_id'] = $ring->bell_id;
            $obj['image'] = $ring->file;
            $obj['id'] = $ring->id;

            $result[] = $obj;

        }

        return $result;

    }

    public function show($id){
        $ring = $this->currentUser->rings()->where('id',$id)->get()->first();

        $result = [];

        $result['id'] = $ring->id;
        $result['image'] = $ring->file;
        $result['date'] = $ring->created_at->toDateTimeString();

        return $result;
    }

    public function destroy($id){
        $ring = $this->currentUser->rings()->where('id',$id)->get()->first();
        $ring->delete();

        return ['success'];
    }
}
