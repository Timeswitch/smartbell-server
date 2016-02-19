<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Bell;
use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use SmartBell\PushClient;
use SmartBell\Ring;
use Tymon\JWTAuth\Facades\JWTAuth;
use Webpatser\Uuid\Uuid;

class NotificationController extends Controller
{
    public function postRing($uuid, Request $req){
        try{
            $bell = Bell::where('uuid',$uuid)->first();
            $user = $bell->user;

            $file = '';
            if($req->hasFile('image')){
                $image = $req->file('image');
                if($image->isValid()){
                    $file = Uuid::generate(1)->string;
                    $image->move(public_path() . '/img/uploads/',$file);
                }
            }

            $ring = Ring::create([
                'user_id' => $user->id,
                'bell_id' => $bell->id,
                'file' => $file
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
                        "registration_ids" => $token,
                        "data" => [
                            "image" => $file,
                            "name" => $bell->name
                        ]
                    ]

                ]);

            }

            return ['success'];
        }catch(\Exception $e){
            return ['failure'];
        }
    }

    public function getRing($token){
//        try{
            $user = PushClient::where('token',$token)->first()->user;
            $ring = $user->rings->last();

            $result = [];

            $result['id'] = $ring->id;
            $result['bell_id'] = $ring->bell_id;
            $result['bell'] = $ring->bell->name;
            $result['image'] = $ring->file;
            $result['date'] = $ring->created_at->toDateTimeString();

            return $result;

//        }catch(\Exception $e){
//            return response()->json(['resource_not_found'], 404);
//        }


    }

    public function subscribe(Request $req){
        if (! $currentUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $client = new PushClient();
        $client->user_id = $currentUser->id;

        if($req->has('push_token')){
            $client->token = $req->get('push_token');
            $client->save();

            return $client;
        }

    }

    public function unsubscribe(Request $req){
        try{
            if($req->has('push_token')){
                $client = PushClient::where('token',$req->get('push_token'))->first();
                $client->delete();

                return ['success'];
            }
        }catch(\Exception $e){
            return response()->json(['resource_not_found'], 404);
        }
    }

    public function refresh($id, Request $req){
        if (! $currentUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $client = $currentUser->push_clients()->where('id',$id)->first();

        if($req->has('push_token')){
            $client->token = $req->get('push_token');
            $client->save();

            return $client;
        }
    }
}
