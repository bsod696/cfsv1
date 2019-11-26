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
	
	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

	//STUDENT
	Route::get('/storestudent','userFXControllerv6@storestudentinit');
	Route::post('/submit/storestudent','userFXControllerv6@storestudentProc')->name('user.submit.storestudent');

	Route::get('/viewstudent','userFXControllerv6@viewstudent');

	Route::post('/editstudent','userFXControllerv6@editstudentinit')->name('user.editstudent');
	Route::post('/submit/editstudent','userFXControllerv6@editstudentProc')->name('user.submit.editstudent');

	Route::post('/submit/deletestudent','userFXControllerv6@deletestudentProc')->name('user.submit.deletestudent');

	//PAYMENT
	Route::get('/storepayment','userFXControllerv6@storepaymentinit')->name('user.storepayment');
	Route::post('/submit/storepayment','userFXControllerv6@storepaymentProc')->name('user.submit.storepayment');

	Route::get('/viewpayment','userFXControllerv6@viewpayment');

	Route::post('/editpayment','userFXControllerv6@editpaymentinit')->name('user.editpayment');
	Route::post('/submit/editpayment','userFXControllerv6@editpaymentProc')->name('user.submit.editpayment');


	//MENU
	Route::get('/menuselect','userFXControllerv6@menuselectinit');
	Route::post('/submit/menuselect','userFXControllerv6@menuselectProc')->name('user.submit.menuselect');

	Route::get('/vieworder','userFXControllerv6@vieworderinit');

	Route::get('/editorder','userFXControllerv6@editorderinit');
	Route::post('/submit/editorder','userFXControllerv6@editorderProc')->name('user.submit.editorder');

	Route::get('/deleteorder','userFXControllerv6@deleteorderinit');
	Route::post('/submit/deleteorder','userFXControllerv6@deleteorderProc')->name('user.submit.deleteorder');

	Route::get('/payorder','userFXControllerv6@payorderinit')->name('user.payorder');
	Route::post('/submit/payorder','userFXControllerv6@payorderProc')->name('user.submit.payorder');

	Route::get('/listtrans','userFXControllerv6@listtransinit');
	Route::post('/viewtrans','userFXControllerv6@viewtransinit')->name('user.submit.viewtrans');

	Route::post('/submit/deleteorder','userFXControllerv6@deleteorderProc')->name('user.submit.deleteorder');

});

//-----------------------------------------------------------ADMIN-----------------------------------------------------------------------------//
Route::prefix('admin')->group(function() {
	//Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
	//Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard', 'adminFXControllerv6@index')->name('admin.dashboard');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');

	//STUDENT
	Route::get('/storestudent','adminFXControllerv6@storestudentinit');
	Route::post('/submit/storestudent','adminFXControllerv6@storestudentProc')->name('admin.submit.storestudent');

	Route::get('/viewstudent','adminFXControllerv6@viewstudent');

	Route::post('/editstudent','adminFXControllerv6@editstudentinit')->name('admin.editstudent');
	Route::post('/submit/editstudent','adminFXControllerv6@editstudentProc')->name('admin.submit.editstudent');

	Route::post('/submit/deletestudent','adminFXControllerv6@deletestudentProc')->name('admin.submit.deletestudent');

	//PAYMENT
	Route::get('/storepayment','adminFXControllerv6@storepaymentinit')->name('admin.storepayment');
	Route::post('/submit/storepayment','adminFXControllerv6@storepaymentProc')->name('admin.submit.storepayment');

	Route::get('/viewpayment','adminFXControllerv6@viewpayment');

	Route::post('/editpayment','adminFXControllerv6@editpaymentinit')->name('admin.editpayment');
	Route::post('/submit/editpayment','adminFXControllerv6@editpaymentProc')->name('admin.submit.editpayment');

	Route::post('/submit/deletepayment','adminFXControllerv6@deletepaymentProc')->name('admin.submit.deletepayment');


	//MENU
	Route::get('/storemenu','adminFXControllerv6@storemenuinit');
	Route::post('/submit/storemenu','adminFXControllerv6@storemenuProc')->name('admin.submit.storemenu');

	Route::get('/menuselect','adminFXControllerv6@menuselectinit');
	Route::post('/submit/menuselect','adminFXControllerv6@menuselectProc')->name('admin.submit.menuselect');

	Route::get('/vieworder','adminFXControllerv6@vieworderinit');

	Route::get('/editorder','adminFXControllerv6@editorderinit');
	Route::post('/submit/editorder','adminFXControllerv6@editorderProc')->name('admin.submit.editorder');

	Route::get('/deleteorder','adminFXControllerv6@deleteorderinit');
	Route::post('/submit/deleteorder','adminFXControllerv6@deleteorderProc')->name('admin.submit.deleteorder');

	Route::get('/payorder','adminFXControllerv6@payorderinit')->name('admin.payorder');
	Route::post('/submit/payorder','adminFXControllerv6@payorderProc')->name('admin.submit.payorder');

	Route::get('/listtrans','adminFXControllerv6@listtransinit');
	Route::post('/viewtrans','adminFXControllerv6@viewtransinit')->name('admin.submit.viewtrans');

	Route::post('/submit/deleteorder','adminFXControllerv6@deleteorderProc')->name('admin.submit.deleteorder');

});

//-----------------------------------------------------------Staff-----------------------------------------------------------------------------//
Route::prefix('staff')->group(function() {
	Route::get('/register', 'Auth\StaffRegisterController@showRegisterForm')->name('staff.register');
	Route::post('/register', 'Auth\StaffRegisterController@register')->name('staff.register.submit');
	Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
   	Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
	Route::get('/dashboard', 'staffFXControllerv6@index')->name('staff.dashboard');
	Route::post('/logout', 'Auth\StaffLoginController@logout')->name('staff.logout');

	Route::post('/password/email', 'Auth\StaffForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\StaffForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\StaffResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\StaffResetPasswordController@showResetForm')->name('password.reset');
});
