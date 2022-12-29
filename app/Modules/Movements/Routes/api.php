<?php
use Illuminate\Support\Facades\Route;

Route::get('', 'MovementController@get');
Route::post('', 'MovementController@store');
Route::get('/type', 'MovementController@getTypes');
Route::get('/type/{typeId}', 'MovementController@getMovementsByType');
Route::post('/type', 'MovementController@storeType');
