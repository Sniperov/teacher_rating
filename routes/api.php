<?php

Route::group(['namespace'  => 'Api', 'prefix' => '/'], function () {
  Route::post('/login', 'AuthController@login');
  Route::post('/register', 'AuthController@registration');
  Route::get('/profile', 'AuthController@me')->middleware('auth');
  Route::delete('/logout', 'AuthController@logout')->middleware('auth');

  Route::middleware(['isModerator'])->group(function(){
    Route::get('requests', 'RatingRequestController@getRequests');
    Route::post('requests/{id}/accept', 'RatingRequestController@acceptRequest');
    Route::post('requests/{id}/reject', 'RatingRequestController@rejectRequest');
  });

  Route::middleware(['isAdmin'])->group(function(){
    Route::post('users/create', 'AuthController@createAtAdminUser');
    Route::put('users/{id}/edit', 'UserController@editUser');
    Route::delete('users/{id}/delete', 'UserController@deleteUser');
    Route::get('users', 'UserController@getAllUsers');
    Route::get('users/{id}', 'UserController@getUserById');
  });
});
