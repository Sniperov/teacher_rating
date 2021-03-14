<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\User;

class RoleController extends Controller
{
    
    public function getAllRoles()
    {
        $roles = [User::ROLE_TEACHER => 'Преподователь' , User::ROLE_ADMIN => 'Админ', User::ROLE_MODERATOR => 'Модератор'];

        return response(['success' => $roles]);
    }
}
