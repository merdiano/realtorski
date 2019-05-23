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

Route::post('userLogin', 'UserController@userLogin');
Route::post('userRegister', 'UserController@userRegister');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('userDetails', 'UserController@userDetails');
});

Route::get('/location/{id?}', 'LocationController@index');
Route::get('/category/{id?}', 'CategoryController@index');

// /api/announcement/<main category id>/?subcategory=<3>&locationP=<location id>&locatinC
Route::post('/estate/create', 'EstateController@store');
Route::get('/estate/list', 'EstateController@list');
Route::get('/estate/item/{id}', 'EstateController@item');
Route::get('/estate/delete/{id}', 'EstateController@delete');

Route::post('/vehicle/create', 'VehicleController@store');
Route::get('/vehicle/list', 'VehicleController@list');
Route::get('/vehicle/item/{id}', 'VehicleController@item');
Route::get('/vehicle/delete/{id}', 'VehicleController@delete');

Route::get('/announcement/list', 'AnnouncementController@list');
Route::get('/announcement/item/{id}', 'AnnouncementController@item');
Route::get('/announcement/delete/{id}', 'AnnouncementController@delete');
Route::post('/announcement/create', 'AnnouncementController@store');
