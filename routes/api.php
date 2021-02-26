<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('login',"v1\UsersController@login");
Route::group([
    'prefix' => 'auth'
],function(){
    Route::post('login','auth\CheckUserController@login');
    Route::post('register','auth\CheckUserController@register');
});

Route::group([
    'prefix' => 'user',
    'middleware' =>['checkToken','CheckUserPromission']
],function(){
    Route::get('getUserList','v1\UsersController@getUserList');
});
