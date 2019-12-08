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
Route::get('/mission', function () {return view('mission');});
Route::get('/solution', function () {return view('solution');});

//-----------------------------------------------------------USER------------------------------------------------------------------------------//
Route::prefix('user')->group(function() {
	Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('user.register');
	Route::post('/register', 'Auth\RegisterController@register')->name('user.register.submit');
	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
   	Route::post('/login', 'Auth\LoginController@login')->name('user.login.submit');
	Route::get('/home', 'userFXControllerv6@index')->name('user.home');
	Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout');
	
	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::get('/setting','userFXControllerv6@setting')->name('user.setting');
    Route::get('/editparent','userFXControllerv6@editparentinit')->name('user.editparent');
	Route::post('/submit/editparent','userFXControllerv6@editparentProc')->name('user.submit.editparent');
	Route::get('/changepass','userFXControllerv6@changepasswordinit')->name('user.password');
	Route::post('/submit/changepass','userFXControllerv6@changepasswordProc')->name('user.submit.password');

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

	//ORDER
	Route::get('/vieworder','userFXControllerv6@vieworderinit')->name('user.vieworder');
	Route::get('/editorder','userFXControllerv6@editorderinit');
	Route::post('/submit/editorder','userFXControllerv6@editorderProc')->name('user.submit.editorder');
	Route::get('/deleteorder','userFXControllerv6@deleteorderinit');
	Route::post('/submit/deleteorder','userFXControllerv6@deleteorderProc')->name('user.submit.deleteorder');
	Route::post('/payorder','userFXControllerv6@payorderinit')->name('user.payorder');
	Route::post('/submit/payorder','userFXControllerv6@payorderProc')->name('user.submit.payorder');
	Route::post('/submit/deleteorder','userFXControllerv6@deleteorderProc')->name('user.submit.deleteorder');

	//TRANSACTION
	Route::get('/listtrans','userFXControllerv6@listtransinit');
	Route::post('/viewtrans','userFXControllerv6@viewtransinit')->name('user.submit.viewtrans');
});

//-----------------------------------------------------------ADMIN-----------------------------------------------------------------------------//
Route::prefix('admin')->group(function() {
	//Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
	//Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard', 'adminFXControllerv6@index')->name('admin.dashboard');
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');

    Route::get('/changepass','adminFXControllerv6@changepasswordinit')->name('admin.password');
	Route::post('/submit/changepass','adminFXControllerv6@changepasswordProc')->name('admin.submit.password');

    //PARENT
    Route::get('/viewparent','adminFXControllerv6@viewparent');
	Route::post('/editparent','adminFXControllerv6@editparentinit')->name('admin.editparent');
	Route::post('/submit/editparent','adminFXControllerv6@editparentProc')->name('admin.submit.editparent');
	Route::post('/submit/deleteparent','adminFXControllerv6@deleteparentProc')->name('admin.submit.deleteparent');
   
	//STUDENT
	Route::get('/storestudent','adminFXControllerv6@storestudentinit');
	Route::post('/submit/storestudent','adminFXControllerv6@storestudentProc')->name('admin.submit.storestudent');
	Route::get('/viewstudent','adminFXControllerv6@viewstudent');
	Route::post('/editstudent','adminFXControllerv6@editstudentinit')->name('admin.editstudent');
	Route::post('/submit/editstudent','adminFXControllerv6@editstudentProc')->name('admin.submit.editstudent');
	Route::post('/submit/deletestudent','adminFXControllerv6@deletestudentProc')->name('admin.submit.deletestudent');

	//STAFF
	Route::get('/viewstaff','adminFXControllerv6@viewstaff');
	Route::post('/editstaff','adminFXControllerv6@editstaffinit')->name('admin.editstaff');
	Route::post('/submit/editstaff','adminFXControllerv6@editstaffProc')->name('admin.submit.editstaff');
	Route::post('/submit/deletestaff','adminFXControllerv6@deletestaffProc')->name('admin.submit.deletestaff');

	//PAYMENT
	Route::get('/storepayment','adminFXControllerv6@storepaymentinit')->name('admin.storepayment');
	Route::post('/submit/storepayment','adminFXControllerv6@storepaymentProc')->name('admin.submit.storepayment');
	Route::get('/viewpayment','adminFXControllerv6@viewpayment');
	Route::post('/editpayment','adminFXControllerv6@editpaymentinit')->name('admin.editpayment');
	Route::post('/submit/editpayment','adminFXControllerv6@editpaymentProc')->name('admin.submit.editpayment');
	Route::post('/submit/deletepayment','adminFXControllerv6@deletepaymentProc')->name('admin.submit.deletepayment');

	//ACCOUNT
	Route::get('/storeaccount','adminFXControllerv6@storeaccountinit')->name('admin.storeaccount');
	Route::post('/submit/storeaccount','adminFXControllerv6@storeaccountProc')->name('admin.submit.storeaccount');
	Route::get('/viewaccount','adminFXControllerv6@viewaccount');
	Route::post('/editaccount','adminFXControllerv6@editaccountinit')->name('admin.editaccount');
	Route::post('/submit/editaccount','adminFXControllerv6@editaccountProc')->name('admin.submit.editaccount');
	Route::post('/submit/deleteaccount','adminFXControllerv6@deleteaccountProc')->name('admin.submit.deleteaccount');

	//MENU
	Route::get('/storemenu','adminFXControllerv6@storemenuinit');
	Route::post('/submit/storemenu','adminFXControllerv6@storemenuProc')->name('admin.submit.storemenu');
	Route::get('/menuselect','adminFXControllerv6@menuselectinit');
	Route::post('/submit/menuselect','adminFXControllerv6@menuselectProc')->name('admin.submit.menuselect');
	Route::post('/editmenu','adminFXControllerv6@editmenuinit')->name('admin.editmenu');
	Route::post('/submit/editmenu','adminFXControllerv6@editmenuProc')->name('admin.submit.editmenu');
	Route::post('/editmenuimage','adminFXControllerv6@editmenuimageinit')->name('admin.editmenuimage');
	Route::post('/submit/editmenuimage','adminFXControllerv6@editmenuimageProc')->name('admin.submit.editmenuimage');
	Route::post('/submit/deletemenu','adminFXControllerv6@deletemenuProc')->name('admin.submit.deletemenu');

	//ORDER
	Route::get('/vieworder','adminFXControllerv6@vieworderinit');
	Route::get('/editorder','adminFXControllerv6@editorderinit');
	Route::post('/submit/editorder','adminFXControllerv6@editorderProc')->name('admin.submit.editorder');
	Route::get('/deleteorder','adminFXControllerv6@deleteorderinit');
	Route::post('/submit/deleteorder','adminFXControllerv6@deleteorderProc')->name('admin.submit.deleteorder');
	Route::get('/payorder','adminFXControllerv6@payorderinit')->name('admin.payorder');
	Route::post('/submit/payorder','adminFXControllerv6@payorderProc')->name('admin.submit.payorder');

	//TRANSACTION
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
	Route::get('/logout', 'Auth\StaffLoginController@logout')->name('staff.logout');

	Route::post('/password/email', 'Auth\StaffForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\StaffForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\StaffResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\StaffResetPasswordController@showResetForm')->name('password.reset');

    Route::get('/setting','staffFXControllerv6@setting')->name('staff.setting');
    Route::get('/editstaff','staffFXControllerv6@editstaffinit')->name('staff.editstaff');
	Route::post('/submit/editstaff','staffFXControllerv6@editstaffProc')->name('staff.submit.editstaff');
	Route::get('/changepass','staffFXControllerv6@changepasswordinit')->name('staff.password');
	Route::post('/submit/changepass','staffFXControllerv6@changepasswordProc')->name('staff.submit.password');

	//ACCOUNT
	Route::get('/storeaccount','staffFXControllerv6@storeaccountinit')->name('staff.storeaccount');
	Route::post('/submit/storeaccount','staffFXControllerv6@storeaccountProc')->name('staff.submit.storeaccount');
	Route::get('/viewaccount','staffFXControllerv6@viewaccount');
	Route::post('/editaccount','staffFXControllerv6@editaccountinit')->name('staff.editaccount');
	Route::post('/submit/editaccount','staffFXControllerv6@editaccountProc')->name('staff.submit.editaccount');
	Route::post('/submit/deleteaccount','staffFXControllerv6@deleteaccountProc')->name('staff.submit.deleteaccount');

	//MENU
	Route::get('/viewmenu','staffFXControllerv6@viewmenusinit');
	Route::get('/takemenu','staffFXControllerv6@takemenusinit');
	Route::post('/submit/takemenu','staffFXControllerv6@takemenusProc')->name('staff.takemenu');
	Route::post('/submit/cancelmenu','staffFXControllerv6@cancelmenusProc')->name('staff.submit.cancelmenu');

	//ORDER
	Route::get('/listorder','staffFXControllerv6@listordersinit');
	Route::post('/vieworder','staffFXControllerv6@viewordersinit')->name('staff.vieworder');
	Route::get('/takeorder','staffFXControllerv6@takeordersinit');
	Route::post('/submit/takeorder','staffFXControllerv6@takeordersProc')->name('staff.submit.takeorder');
	Route::post('/submit/cancelorder','staffFXControllerv6@cancelordersProc')->name('staff.submit.cancelorder');
	Route::get('/ordersummary','staffFXControllerv6@ordersummaryinit');
	Route::post('/submit/ordersummary','staffFXControllerv6@ordersummaryProc')->name('staff.submit.ordersummary');
	
	// Route::post('/submit/deleteorder','staffFXControllerv6@deleteorderProc')->name('staff.submit.deleteorder');
	// Route::get('/payorder','staffFXControllerv6@payorderinit')->name('staff.payorder');
	// Route::post('/submit/payorder','staffFXControllerv6@payorderProc')->name('staff.submit.payorder');

	//TRANSACTION
	Route::get('/listtrans','staffFXControllerv6@listtransinit');
	Route::post('/viewtrans','staffFXControllerv6@viewtransinit')->name('staff.submit.viewtrans');
	Route::post('/submit/deleteorder','staffFXControllerv6@deleteorderProc')->name('staff.submit.deleteorder');

	//REDEEM
	Route::get('/redeem','staffFXControllerv6@redeeminit')->name('staff.redeem');
	Route::post('/submit/redeem','staffFXControllerv6@redeemProc')->name('staff.submit.redeem');
});
