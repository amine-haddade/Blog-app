<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function Register(RegisterUserRequest $request){
            $validatedData=$request->validated();
            $user=User::create($validatedData);

            // crèe une token a l‘aide de jwt
            $token=JWTAuth::fromUser($user);

            return  response()->json([
                "message"=>"register crèe avec succes",
                "user"=>$user,
                "token"=>$token
            ],201);


    }

    public function login(Request  $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where("email",$request->email)->first();
        if(!$user){
            return response()->json([
                'errors'=>[
                    'email'=>"email  incorect"
                ]
                ],404);
        }elseif(!Hash::check($request->password,$user->password)){
            return response()->json([
                'errors'=>[
                    'password'=>"password  incorect"
                ]
                ],404);
        };
        $token=JWTAuth::fromUser($user);
        return  response()->json([
            'message'=>'login et rèusse',
            'user'=>$user,
            'token'=>$token],200); // 200 === reposne rèussie

    }
}
