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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
    ], function(){
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

Route::post('/registration', 'Auth\RegisterController@addNewUser');
Route::post('/search', 'MessagesController@messageSearch');

Route::group([
        'middleware' => 'jwt_check'
    ], function(){
    Route::post('/info', 'UserController@info');
    Route::post('/send', 'ChatController@sendMessage');
    Route::post('/chatData', 'ChatController@chatData');
});

