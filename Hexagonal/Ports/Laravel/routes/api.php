<?php

use Illuminate\Support\Facades\Route;

Route::post('/signup', 'LaravelApp\Http\Controllers\Api\SignUpController@execute');
Route::get('/users', 'LaravelApp\Http\Controllers\Api\UserController@index');
