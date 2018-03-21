<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//USER
Route::post('/user', "UserController@Create");
Route::get('/user', "UserController@all");
Route::delete('/user/{id}', "UserController@delete");
Route::put('/user/{id}', "UserController@update");
Route::get('/useritem/{id}', "UserController@useritem");
Route::get('/alluseritem', "UserController@alluseritem");
//ITEM
Route::post('/items', "ItemsController@Create");
Route::get('/items', "ItemsController@all");
Route::delete('/items/{id}', "ItemsController@delete");
Route::put('/items/{id}', "ItemsController@update");
