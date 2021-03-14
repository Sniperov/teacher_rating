<?php
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\isModerator;

Route::group(['namespace'  => 'Api', 'prefix' => '/'], function () {
  Route::post('/login', 'AuthController@login');
  Route::post('/register', 'AuthController@registration');

  Route::middleware(['auth'])->group(function(){
    Route::get('/profile', 'AuthController@me');
    Route::delete('/logout', 'AuthController@logout');
  });

  Route::middleware([isModerator::class])->group(function(){
    Route::get('requests', 'RatingRequestController@getRequests');
    Route::post('requests/{id}/accept', 'RatingRequestController@acceptRequest');
    Route::post('requests/{id}/reject', 'RatingRequestController@rejectRequest');
  });

  Route::middleware([IsAdmin::class])->group(function(){
    Route::post('users/create', 'AuthController@createAtAdminUser');
    Route::put('users/{id}/edit', 'UserController@editUser');
    Route::delete('users/{id}/delete', 'UserController@deleteUser');
    Route::get('users', 'UserController@getAllUsers');
    Route::get('users/{id}', 'UserController@getUserById');
  });
});
