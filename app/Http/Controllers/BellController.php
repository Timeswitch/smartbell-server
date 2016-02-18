<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use Mockery\CountValidator\Exception;
use SmartBell\Bell;
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
            $obj['uuid'] = $bell->uuid;
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
        $result['uuid'] = $bell->uuid;
        $result['active'] = $bell->active;
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

    public function createRing($uuid, Request $request){
        try{
            $bell = Bell::where('uuid',$uuid)->first();

            $ring = Ring::create([
                'user_id' => $this->currentUser->id,
                'bell_id' => $bell->id,
                'file' => ''
            ]);

            $clients = $this->currentUser->push_clients;

            if(!$clients->isEmpty() && $bell->active == 1){

                $http = new \GuzzleHttp\Client();

                $res = $http->request('POST','https://gcm-http.googleapis.com/gcm/send',[
                    'headers' => ['Authorization' => env('SMARTBELL_GCM')],
                    'json' => [] //TODO weiter machen

                ]);

            }

            return ['success'];
        }catch(Exception $e){
            return ['failure'];
        }
    }


}
