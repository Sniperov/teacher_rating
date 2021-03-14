<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function editUser(Request $request , $id)
    {
        $data = $request->validate([
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => ['required','email', Rule::unique('users')->ignore($id, 'id'),],
            'role' => 'required|numeric|min:2',
            'password' => 'required|string|'
        ]);

        $user = User::findOrFail($id);

        $user->update($data);

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

        return response($user, 201 );

    }

    public function getAllUsers()
    {
        return response(User::all() , 201);
    }

}
