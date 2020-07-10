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


Route::resource('kelas', 'KelasAPIController');

/*Route::resource('servers', 'ServerAPIController');

Route::resource('sesis', 'SesiAPIController');
//hanya sekedar mencoba

Route::resource('materis', 'MateriAPIController');*/

Route::resource('jurusans', 'JurusanAPIController');

Route::resource('posts', 'PostAPIController');