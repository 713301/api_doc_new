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


Route::group(['middleware' => ['api']], function() {
	/*route for response codes*/
    Route::get('/response/{id}',"Api\ResponseController@getResponseList");
    Route::patch('/response/{id}',"Api\ResponseController@updateResponse");
    Route::post('/response/new',"Api\ResponseController@createResponse");
    Route::delete('/response/delete/{id}',"Api\ResponseController@deleteResponse");

    /*route for api docs*/
    Route::post('/new',"Api\ApiController@createApi");
    Route::get('/list/category/{type}',"Api\ApiController@getListDetails");
    Route::patch('/list/{id}',"Api\ApiController@updateApi");
    Route::delete('/list/delete/{id}',"Api\ApiController@deleteApi");
});
