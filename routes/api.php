<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controller\AuthController;
use app\Http\Controller\PublicationController;

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

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');



Route::post('/publication', 'App\Http\Controllers\PublicationController@store');
Route::get('/publication', 'App\Http\Controllers\PublicationController@index');
Route::get('//publication/{id}', 'App\Http\Controllers\PublicationController@show');
Route::put('/publication/{id}', 'App\Http\Controllers\PublicationController@update');
Route::delete('/publication/{id}', 'App\Http\Controllers\PublicationController@destroy');




Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {


    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

