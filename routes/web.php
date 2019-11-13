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

//-----------------------------------------------------------GUEST------------------------------------------------------------------------------//
Route::get('/', function () {return view('index');});

//-----------------------------------------------------------USER------------------------------------------------------------------------------//
Route::prefix('user')->group(function() {
	Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('user.register');
	Route::post('/register', 'Auth\RegisterController@register')->name('user.register.submit');
	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
   	Route::post('/login', 'Auth\LoginController@login')->name('user.login.submit');
	Route::get('/home', 'userFXControllerv6@index')->name('user.home');
	Route::post('/logout', 'Auth\LoginController@logout')->name('user.logout');

	//STUDENT
	Route::get('/storestudent','userFXControllerv6@storestudentinit');
	Route::post('/submit/storestudent','userFXControllerv6@storestudentProc')->name('user.submit.storestudent');

	Route::get('/viewstudent','userFXControllerv6@viewstudent');
	//Route::post('/submit/viewstudent','userFXControllerv6@viewstudentProc')->name('user.submit.vewstudent');

	Route::post('/editstudent','userFXControllerv6@editstudentinit')->name('user.editstudent');
	Route::post('/submit/editstudent','userFXControllerv6@editstudentProc')->name('user.submit.editstudent');

	//Route::get('/deletestudent','userFXControllerv6@deletestudentinit');
	Route::post('/submit/deletestudent','userFXControllerv6@deletestudentProc')->name('user.submit.deletestudent');

	//MENU
	Route::get('/orderfood','userFXControllerv6@orderfoodinit');
	Route::post('/submit/orderfood','userFXControllerv6@orderfoodProc')->name('user.submit.orderfood');

	Route::get('/vieworder','userFXControllerv6@vieworderinit');
	//Route::post('/submit/vieworder','userFXControllerv6@vieworderProc')->name('user.submit.vieworder');

	Route::get('/editorder','userFXControllerv6@editorderinit');
	Route::post('/submit/editorder','userFXControllerv6@editorderProc')->name('user.submit.editorder');

	Route::get('/deleteorder','userFXControllerv6@deleteorderinit');
	Route::post('/submit/deleteorder','userFXControllerv6@deleteorderProc')->name('user.submit.deleteorder');

	Route::post('/payorder','userFXControllerv6@payorderinit')->name('user.payorder');
	Route::post('/submit/payorder','userFXControllerv6@payorderProc')->name('user.submit.payorder');

});

//-----------------------------------------------------------ADMIN-----------------------------------------------------------------------------//
Route::prefix('admin')->group(function() {
	//Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
	//Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard', 'adminFXControllerv6@index')->name('admin.dashboard');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

});

//-----------------------------------------------------------Staff-----------------------------------------------------------------------------//
Route::prefix('staff')->group(function() {
	Route::get('/register', 'Auth\StaffRegisterController@showRegisterForm')->name('staff.register');
	Route::post('/register', 'Auth\StaffRegisterController@register')->name('staff.register.submit');
	Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
   	Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
	Route::get('/dashboard', 'staffFXControllerv6@index')->name('staff.dashboard');
	Route::post('/logout', 'Auth\StaffLoginController@logout')->name('staff.logout');
});
