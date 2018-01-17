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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'User\DashboardController@index')->name('home');


Route::group(['namespace' => 'Admin','prefix' => 'admin', 'middleware' => ['web', 'auth', 'admin']], function () {

	Route::get('/users', 'UserController@index');
	Route::get('/users/{user}', 'UserController@show');
});

Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth','web']], function () {


	Route::get('dashboard', 'DashboardController@index');
	
	Route::get('pay_periods', 'PayPeriodController@index');
	
	Route::put('work_periods/{workPeriod}', 'WorkPeriodController@update');

});



