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
Route::get('/announcement/{mainCategory}', 'AnnouncementController@index');
