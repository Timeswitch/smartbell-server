<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use Mockery\CountValidator\Exception;
use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use SmartBell\Ring;

class BellController extends APIController
{
    public function index(){

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

    public function post(Request $req){
        //TODO implementieren
    }

    public function show($id) {
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

    public function update($id, Request $req){
        $bell = $this->currentUser->bells()->where('id',$id)->get()->first();
        //TODO implementieren
    }

    public function createRing($id, Request $request){
        try{
            $bell = $this->currentUser->bells()->where('id',$id)->get()->first();

            $ring = Ring::create([
                'user_id' => $this->currentUser->id,
                'bell_id' => $bell->id,
                'file' => ''
            ]);

            //TODO Push, etc

            return ['success'];
        }catch(Exception $e){
            return ['failure'];
        }
    }


}
