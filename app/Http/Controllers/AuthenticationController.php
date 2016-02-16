<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;

class AuthenticationController extends Controller
{

    public function postSignup(Request $req){

        $data = $req->all();

        //TODO Validation

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postLogin(Request $req){
        //TODO implement
    }

    public function postLogout(Request $req){
        //TODO implement
    }
}
