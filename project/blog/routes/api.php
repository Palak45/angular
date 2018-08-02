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
header('Access-Control-Allow-Origin: *');

/*header("Access-Control-Allow-Credentials", "true");*/
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Cache-Control,Origin, X-Requested-With, token, Content-Type, x-xsrf-token, Accept, Authorization');
/*header('Access-Control-Allow-Origin: http://localhost:4200', '*');
header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token, Authorization, X-Requested-With');
*/
Route::resource('user_data','AuthController');
Route::post('register','AuthController@register');
Route::post('search','AuthController@search');
Route::get('login','AuthController@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
