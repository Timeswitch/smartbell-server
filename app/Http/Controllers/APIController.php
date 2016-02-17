<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIController extends Controller
{
    protected $currentUser = null;

    public function __construct(){
        if (! $this->currentUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
    }
}
