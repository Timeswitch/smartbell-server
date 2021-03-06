<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use Mockery\CountValidator\Exception;
use SmartBell\Bell;
use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use SmartBell\Ring;
use Webpatser\Uuid\Uuid;

class BellController extends APIController
{
    public function index(){

        $bells = $this->currentUser->bells;

        $result = [];

        foreach($bells as $bell){
            $obj = [];

            $obj['id'] = $bell->id;
            $obj['name'] = $bell->name;
            $obj['uuid'] = $bell->uuid;
            $obj['active'] = $bell->active;

            $result[] = $obj;
        }

        return $result;
    }

    public function post(Request $req){
        $bell = Bell::create([
            'user_id' => $this->currentUser->id,
            'name' => $req->get('name'),
            'active' => '1',
            'uuid' => Uuid::generate(1)->string
        ]);

        return $bell;
    }

    public function show($id) {
        $bell = $this->currentUser->bells()->where('id',$id)->get()->first();

        $result = [];

        $result['id'] = $bell->id;
        $result['name'] = $bell->name;
        $result['uuid'] = $bell->uuid;
        $result['active'] = $bell->active;
        $result['rings'] = [];

        foreach($bell->rings as $ring){
            $obj = [];

            $obj['id'] = $ring->id;
            $obj['date'] = $ring->created_at->toDateTimeString();;
            $obj['image'] = $ring->file;

            $result['rings'][] = $obj;

        }

        return $result;

    }

    public function update($id, Request $req){
        $bell = $this->currentUser->bells()->where('id',$id)->get()->first();

        if($req->has('name')){
            $bell->name = $req->get('name');
        }

        if($req->has('active')){
            $bell->active = $req->get('active');
        }

        $bell->save();

        return $this->show($id);

    }

    public function destroy($id){
        $bell = $this->currentUser->bells()->where('id',$id)->get()->first();

        $bell->rings()->delete();
        $bell->delete();
    }


}
