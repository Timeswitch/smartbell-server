<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class RingController extends Controller
{
    private $currentUser = null;

    public function __construct(){
        if (! $this->currentUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
    }

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
