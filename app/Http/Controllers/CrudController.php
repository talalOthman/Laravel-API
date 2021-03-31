<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $req)
    {
        //
        $validatedData = $req->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($req->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['status' => 'success','user' => $user, 'new_access_token' => $accessToken], 201);
    }


    public function getAllUsers(){
        
        $userList = User::paginate(2);
        return $userList;
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserById($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return response(['message' => 'User not found'], 404);
        }

        return response($user::find($id), 200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return response(['message' => 'User not found'], 404);
        }

        $vaidatedData = $request->validate([
            'email' => 'email',
            'password' => 'min:6'
        ]);
        

        $user->update($request->all());
        return response(['message' => 'User has been updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return response(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response(['message' => 'User deleted'], 200);
    }
}
