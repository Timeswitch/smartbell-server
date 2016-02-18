<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Bell;
use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use SmartBell\PushClient;
use SmartBell\Ring;
use Tymon\JWTAuth\Facades\JWTAuth;

class NotificationController extends Controller
{
    public function ring($uuid, Request $request){
        try{
            $bell = Bell::where('uuid',$uuid)->first();
            $user = $bell->user;

            $ring = Ring::create([
                'user_id' => $user->id,
                'bell_id' => $bell->id,
                'file' => ''
            ]);

            $ring->save();

            $clients = $user->push_clients;

            if(!$clients->isEmpty() && $bell->active == 1){

                $token = [];

                foreach($clients as $client){
                    $token[] = $client->token;
                }

                $http = new \GuzzleHttp\Client();

                $res = $http->request('POST','https://android.googleapis.com/gcm/send',[
                    'headers' => ['Authorization' => 'key='.env('SMARTBELL_GCM')],
                    'json' => [
                        "registration_ids" => $token
                    ] //TODO weiter machen

                ]);

            }

            return ['success'];
        }catch(Exception $e){
            return ['failure'];
        }
    }

    public function subscribe(Request $req){
        if (! $currentUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $client = new PushClient();
        $client->user_id = $currentUser->id;

        if($req->has('token')){
            $client->token = $req->get('token');
            $client->save();

            return $client;
        }

    }

    public function refresh($id, Request $req){
        if (! $currentUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $client = $currentUser->push_clients()->where('id',$id)->first();

        if($req->has('token')){
            $client->token = $req->get('token');
            $client->save();

            return $client;
        }
    }
}
