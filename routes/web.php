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

Route::get('/', function () {return view('index');});

//------------------------------------------------USER-------------------------------------------------//
Route::prefix('user')->group(function() {
	Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('user.register');
	Route::post('/register', 'Auth\RegisterController@register')->name('user.register.submit');

	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
   	Route::post('/login', 'Auth\LoginController@login')->name('user.login.submit');
	Route::get('/home', 'userFXControllerv6@index')->name('user.home');
	Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout');

	Route::get('/getbalance','userFXControllerv6@getbalance');
});

//------------------------------------------------STAFF-------------------------------------------------//
Route::prefix('staff')->group(function() {
	Route::get('/staff/register', 'Auth\StaffRegisterController@showRegisterForm')->name('staff.register');
	Route::post('/staff/register', 'Auth\StaffRegisterController@register')->name('staff.register.submit');

	Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
   	Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
	Route::get('/dashboard', 'StaffFXControllerv6@index')->name('staff.dashboard');
	Route::get('/logout', '\App\Http\Controllers\Auth\StaffLoginController@logout')->name('staff.logout');

    Route::get('/nodeinfo','StaffFXControllerv6@getnodeinfo');
});
//------------------------------------------------ADMIN-------------------------------------------------//
Route::prefix('admin')->group(function() {
	Route::get('/pleaseinformadminfirstla/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
	Route::post('/pleaseinformadminfirstla/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard', 'AdminFXControllerv6@index')->name('admin.dashboard');
	Route::get('/logout', '\App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/nodeinfo','AdminFXControllerv6@getnodeinfo');
});