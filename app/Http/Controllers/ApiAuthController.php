<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAuthController extends Controller
{
    
    public function register(Request $req){


        $validatedData = $req->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($req->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);

    }


    public function login(Request $req){

        $loginData = $req->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message' => 'Invalid credentials']);
        };

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }


    public function returnUsers(){
        
        $userList = User::paginate(5);
        return $userList;
    }
}
