<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;

class AuthController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api', ['except' => ['login', 'registration']]);
  }

  /**
   * Get a JWT via given credentials.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(LoginRequest $request)
  {
      $data = $request->validated();
      $credentials = [$data['email'], $data['password']];

      if (! $token = auth()->attempt($data)) {
          return response()->json(['error' => 'Unauthorized'], 401);
      }

      return response(['token' => $token], 200);
  }

  /**
   * User registration
   */
  public function registration(RegisterRequest $request)
  {
      $data = $request->validated();

      User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'role' => User::ROLE_TEACHER,
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
      ]);

      return response(['success' => true] , 201);
  }
  public function createAtAdminUser(UserRequest $request)
  {

    $data = $request->validated();

    User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'role' => $data['role'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
      ]);

      return response(['success' => true] , 201);

  }

  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function me()
  {
      return response()->json(auth()->user());
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
      auth()->logout();

      return response()->json(['message' => 'Successfully logged out']);
  }
}
