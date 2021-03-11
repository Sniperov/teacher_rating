<?php

Route::group(['namespace'  => 'Api', 'prefix' => '/'], function () {
  Route::post('/login', 'AuthController@login');
  Route::post('/register', 'AuthController@registration');
  Route::get('/profile', 'AuthController@me');
  Route::delete('/logout', 'AuthController@logout');
});
