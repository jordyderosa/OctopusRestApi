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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/



//List ads
Route::get('ads','AdsController@index');

//list single ads
Route::get('ads/{id}','AdsController@show');

//create new ads
Route::post('ads','AdsController@store');

//update ads
Route::put('ads','AdsController@store');

//delete ads
Route::delete('ads/{id}','AdsController@destroy');

