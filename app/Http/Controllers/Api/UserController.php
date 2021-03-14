<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function editUser(UserRequest $request , $id)
    {

        $data = $request->validated();

        $user = User::findOrFail($id);

        $user->update($user->all());

        return response(['success' => true ] , 201 );
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response(['success' => true ] , 201 );

    }

    public function getUserById($id)
    {
        $user = User::findOrFail($id);

        return response(['success' => $user ] , 201 );

    }

    public function getAllUsers()
    {
        return response(['success' => User::all()] , 201);
    }

}
