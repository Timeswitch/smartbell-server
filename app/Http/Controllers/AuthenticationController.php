<?php

namespace SmartBell\Http\Controllers;

use Illuminate\Http\Request;

use SmartBell\Http\Requests;
use SmartBell\Http\Controllers\Controller;
use SmartBell\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{

    public function postSignup(Request $req){

        $data = $req->all();

        if($data['password'] != $data['passwordRepeat'] && $data['password'] != '' && $data['email'] != ''){
            return response()->json(['input_error'],400);
        }

        try{
            User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        }catch(\Exception $e){
            return response()->json(['db_error'],400);
        }


    }

    public function postLogin(Request $req){
        $credentials = $req->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function postLogout(Request $req){
        //TODO implement
    }
}
