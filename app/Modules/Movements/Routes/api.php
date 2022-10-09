<?php
use Illuminate\Support\Facades\Route;

Route::get('', 'MovementController@get');
Route::post('', 'MovementController@store');
Route::get('/type', 'MovementController@getTypes');
Route::post('/type', 'MovementController@storeType');
