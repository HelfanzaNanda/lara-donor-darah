<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Auth::routes();
Route::get('kabupaten/kecamatan/{id}', 'PendonorController@getKecamatan');
Route::get('kecamatan/desa/{id}', 'PendonorController@getDesa');

Route::get('/', 'DashboardController@index')->name('dashboard.index');
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('home', 'DashboardController@dashboard')->name('dashboard');

    Route::get('profile', 'UserController@profile')->name('profile');
    Route::put('profile', 'UserController@profileUpdate')->name('profile.update');

    
    Route::group(['prefix' => 'informasi', 'middleware' => 'auth.isPmi'], function(){
        Route::get('/', 'InformasiController@index')->name('informasi.index');
        Route::get('create', 'InformasiController@create')->name('informasi.create');
        Route::post('create', 'InformasiController@store')->name('informasi.store');
        Route::get('edit/{id}', 'InformasiController@edit')->name('informasi.edit');
        Route::put('edit/{id}', 'InformasiController@update')->name('informasi.update');
        Route::get('{id}/delete', 'InformasiController@destroy')->name('informasi.delete');
        Route::get('data-informasi', 'InformasiController@getData')->name('informasi.getdata');
    });

    Route::group(['prefix' => 'pendonor', 'middleware' => 'auth.isPmi'], function(){
        Route::get('/', 'PendonorController@index')->name('pendonor.index');
        Route::get('create', 'PendonorController@create')->name('pendonor.create');
        Route::post('create', 'PendonorController@store')->name('pendonor.store');
        Route::get('edit/{id}', 'PendonorController@edit')->name('pendonor.edit');
        Route::put('edit/{id}', 'PendonorController@update')->name('pendonor.update');
        Route::get('{id}/delete', 'PendonorController@destroy')->name('pendonor.delete');
        Route::get('data-pendonor', 'PendonorController@getdata')->name('pendonor.getdata');
    });

    Route::group(['prefix' => 'darah', 'middleware' => 'auth.isPmi'], function(){
        Route::group(['prefix' => 'order'], function(){
            Route::get('/', 'PermintaanController@index')->name('permintaan.index');
            Route::get('create', 'PermintaanController@create')->name('permintaan.create');
            Route::post('create', 'PermintaanController@store')->name('permintaan.store');
        });
        Route::group(['prefix' => 'stock'], function(){
            Route::get('/', 'StockDarahController@index')->name('stock.index');
            Route::get('create', 'StockDarahController@create')->name('stock.create');
            Route::post('create', 'StockDarahController@store')->name('stock.store');
            Route::get('edit/{id}', 'StockDarahController@edit')->name('stock.edit');
            Route::put('update/{id}', 'StockDarahController@update')->name('stock.update');
            Route::get('{id}/delete', 'StockDarahController@destroy')->name('stock.delete');
            Route::get('data-stock', 'StockDarahController@getdata')->name('stock.getdata');
            // Route::get('change', 'StockDarahController@stockChange')->name('stock.change');
            // Route::post('change', 'StockDarahController@stockChangeUpdate')->name('stock.changeupdate');
        });
    });
    
    Route::group(['prefix' => 'jadwal', 'middleware' => 'auth.isPmi'], function(){
        Route::get('/', 'JadwalController@index')->name('jadwal.index');
        Route::get('create', 'JadwalController@create')->name('jadwal.create');
        Route::post('create', 'JadwalController@store')->name('jadwal.store');
        Route::get('edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
        Route::put('update/{id}', 'JadwalController@update')->name('jadwal.update');
        Route::get('{id}/delete', 'JadwalController@destroy')->name('jadwal.delete');
        Route::get('data-jadwal', 'JadwalController@getdata')->name('jadwal.getdata');
    });
    
    Route::group(['prefix' => 'pengajuan', 'middleware' => 'auth.isPmi'], function(){
        Route::get('/', 'PengajuanController@index')->name('pengajuan.index');
        Route::get('create', 'PengajuanController@create')->name('pengajuan.create');
        Route::post('create', 'PengajuanController@store')->name('pengajuan.store');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'auth.isPmi'], function(){
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('create', 'UserController@create')->name('user.create');
        Route::post('create', 'UserController@store')->name('user.store');
        Route::get('data', 'UserController@getData')->name('user.getdata');
        Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
        Route::get('delete/{id}', 'UserController@destroy')->name('user.delete');
    });

    Route::group(['prefix' => 'rs', 'middleware' => 'role:isRs'], function(){
        Route::group(['prefix' => 'cari'], function(){
            Route::get('/', 'CariDarahController@index')->name('cari.index');
            Route::get('show', 'CariDarahController@show')->name('cari.show');
            Route::get('data-darah', 'CariDarahController@getData')->name('cari.getdata');
        });
    });
});

