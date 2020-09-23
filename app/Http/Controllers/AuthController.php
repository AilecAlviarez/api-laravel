<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends ApiController
{
    //


    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request){
        $credentials=$this->getCredentials($request);
       $this->validateRequest($credentials);


           if(!$token=$this->validateToken($credentials)){
                return $this->errorResponse('unathorize',401);
           }
           return $this->respondWithToken($token,$credentials);

    }
    public function validateToken($credentials){
       return  JWTAuth::attempt($credentials);
    }
    public function getCredentials($request){
        return $credentials=$request->only(['email','password']);
    }
    public function validateRequest($credentials){
        $validate=Validator::make($credentials,['email'=>'required|string','password'=>'required|string|min:6']);
        return ($validate->fails())?$this->errorResponse($validate->errors,401):true;
    }
    public function respondWithToken($token,$credentials)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],200);
    }
}
