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

Route::post('/signin', 'UserController@userLogin');
Route::post('/signup', 'UserController@userRegister');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/details', 'UserController@userDetails');

    Route::post('/estate/create', 'EstateController@store');
    Route::get('/estate/delete/{id}', 'EstateController@delete');

    Route::post('/vehicle/create', 'VehicleController@store');
    Route::get('/vehicle/delete/{id}', 'VehicleController@delete');

    Route::get('/announcement/delete/{id}', 'AnnouncementController@delete');
    Route::post('/announcement/create', 'AnnouncementController@store');
});

Route::get('/location/{id?}', 'LocationController@index');
Route::get('/category/{id?}', 'CategoryController@index');

// /api/announcement/<main category id>/?subcategory=<3>&locationP=<location id>&locatinC
Route::get('/estate/list', 'EstateController@list');
Route::get('/estate/item/{id}', 'EstateController@item');

Route::get('/vehicle/list', 'VehicleController@list');
Route::get('/vehicle/item/{id}', 'VehicleController@item');

Route::get('/announcement/list', 'AnnouncementController@list');
Route::get('/announcement/item/{id}', 'AnnouncementController@item');
