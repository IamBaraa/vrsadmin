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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('/index');
});

    Route::group(['middleware' => ['auth', 'Manager']], function() {
        Route::get('/create', 'AdminsController@create');
        Route::post('/store', 'AdminsController@store');
        Route::get('/manageAdmins', 'PagesController@manageAdmins');
        Route::get('/destroyAdmins/{id}', 'AdminsController@destroyAdmins');
    });

    Route::get('/index', 'PagesController@index');
    Route::get('/manageUsers', 'PagesController@manageUsers');
    Route::get('/manageVehicles', 'PagesController@manageVehicles');
    Route::get('/rentalRecords', 'PagesController@rentalRecords');
    Route::get('/updateUserStatus/{customer}', 'AdminsController@updateUserStatus');
    Route::get('/updateAdminRole/{admin}', 'AdminsController@updateAdminRole');
    Route::get('/updateAds/{vehicle}', 'AdminsController@updateAds');
    Route::get('/profitReceived/{record}', 'AdminsController@profitReceived');
    Route::resource('entity', 'AdminsController');

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
