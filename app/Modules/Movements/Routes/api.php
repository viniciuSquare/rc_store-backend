<?php
use Illuminate\Support\Facades\Route;

Route::get('', 'MovementController@get');
Route::post('', 'MovementController@store');
Route::get('/types', 'MovementController@getTypes');
Route::post('/types', 'MovementController@storeType');
