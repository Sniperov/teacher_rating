<?php

Route::group(['namespace'  => 'Api', 'prefix' => '/'], function () {
  Route::post('/login', 'AuthController@login');
  Route::post('/register', 'AuthController@registration');
  Route::get('/profile', 'AuthController@me');
  Route::delete('/logout', 'AuthController@logout');

  Route::middleware(['isModerator'])->group(function(){
    Route::get('requests', 'RatingRequestController@getRequests');
    Route::post('requests/{id}/accept', 'RatingRequestController@acceptRequest');
    Route::post('requests/{id}/reject', 'RatingRequestController@rejectRequest');
  });
});
