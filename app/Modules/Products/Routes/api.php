<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/categories', 'ProductController@getCategories');
Route::post('/categories', 'ProductController@storeCategory');

Route::get('', 'ProductController@get');
Route::get('/{productId}', 'ProductController@get');
Route::post('', 'ProductController@store');
Route::put('', 'ProductController@update');
Route::delete('', 'ProductController@delete');
