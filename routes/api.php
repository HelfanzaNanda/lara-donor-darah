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

// Route::middleware('auth:api')->get('/user/profile', function (Request $request) {
//     return $request->user();
// });

Route::post('/user/register', 'APIController@userRegister');//url api register
Route::post('/user/login', 'APIController@userLogin');//url api login
Route::get('/user/profile', 'APIController@profile');// url api untuk detail profile
Route::post('/user/update', 'APIController@updateUser');//url api unntuk update profile
Route::post('/user/upload', 'APIController@upload');//url api upload foto profile
Route::post('/forgotpassword', 'APIController@forgotPassword');//forgot password

//ini url untuk nampilin informasi, secara default ketika akses akan diarahkan ke
//http://domain/donor-darah/public/api/
//lalu tinggal tambahin aja setelah api/
//contoh : http://192.168.42.251/donor-darah/public/api/information-show
Route::get('/information', 'APIController@getInformation');
Route::get('/news', 'APIController@getBerita');

Route::get('/schedulle', 'APIController@getJadwal');
Route::post('/submission/add', 'APIController@createPengajuan');
Route::get('/submission', 'APIController@getPengajuan');
Route::post('/submission/{id}/update', 'APIController@updatePengajuan');
Route::post('/submission/{id}/delete', 'APIController@deletePengajuan');

Route::get('/stock', 'APIController@getStockDarah');

Route::post('/pendonor/add', 'APIController@addPendonor');
Route::get('/pendonor', 'APIController@getPendonor');
Route::post('/pendonor/{id}/update', 'APIController@updatePendonor');
