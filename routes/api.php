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

Route::post('/user-register', 'APIController@userRegister');
Route::post('/user-login', 'APIController@userLogin');
Route::post('/user-detail', 'APIController@detailUser');
Route::post('/user-update', 'APIController@updateUser');
Route::post('/user-upload', 'APIController@upload');


Route::get('/information-show', 'APIController@getInformation');

Route::get('/jadwal-show', 'APIController@getJadwal');
Route::post('/pengajuan-add', 'APIController@createPengajuan');
Route::post('/pengajuan-show', 'APIController@getPengajuan');

Route::get('/stock-show', 'APIController@getStockDarah');

Route::post('/pendonor-add', 'APIController@addPendonor');
Route::post('/pendonor-get', 'APIController@getPendonor');
Route::post('/pendonor-update', 'APIController@updatePendonor');