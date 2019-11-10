<?php
    Route::view('/', 'welcome');
    //Auth::routes();

	//------------------------------------------------USER-------------------------------------------------//
	Route::prefix('user')->group(function() {
		Route::view('/home', 'user.home')->middleware('auth');
	});

	//------------------------------------------------ADMIN-------------------------------------------------//
	Route::prefix('admin')->group(function() {
		Route::get('/', 'Auth\LoginController@showAdminLoginForm');
		Route::post('/login', 'Auth\LoginController@adminLogin');
		Route::get('/register', 'Auth\RegisterController@showAdminRegisterForm');
		Route::post('/register', 'Auth\RegisterController@createAdmin');
		Route::view('/dashboard', 'admin.dashboard');

		// Route::get('/', 'Auth\StaffRegisterController@showRegisterForm')->name('staff.register');
		// Route::post('/staff/register', 'Auth\StaffRegisterController@register')->name('staff.register.submit');
		// Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
	 	// Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
		// Route::get('/dashboard', 'StaffControllerv1@index')->name('staff.dashboard');
		// Route::get('/logout', '\App\Http\Controllers\Auth\StaffLoginController@logout')->name('staff.logout');
	});

	//------------------------------------------------STAFF-------------------------------------------------//
	Route::prefix('staff')->group(function() {
		Route::get('/', 'Auth\LoginController@showStaffLoginForm');
		Route::post('/login', 'Auth\LoginController@staffLogin');
		Route::get('/register', 'Auth\RegisterController@showStaffRegisterForm');
		Route::post('/register', 'Auth\RegisterController@createStaff');
		Route::view('/dashboard', 'staff.dashboard');
	});