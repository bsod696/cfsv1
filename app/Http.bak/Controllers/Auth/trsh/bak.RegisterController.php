<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:staff');
    }

    public function showRegisterForm(){return view('auth.register');}
    public function showAdminRegisterForm(){return view('auth.register', ['url' => 'admin']);}
    public function showStaffRegisterForm(){return view('auth.register', ['url' => 'staff']);}

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all(), 'admins')->validate();
        $admin = Admin::create([
            'username' => $request['username'],
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'phonenum' => $request['phonenum'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('/admin/login');
    }

    protected function createStaff(Request $request)
    {
        $this->validator($request->all(), 'staffs')->validate();
        $staff = Staff::create([
            'username' => $request['username'],
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'phonenum' => $request['phonenum'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('/staff/login');
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phonenum' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\User
    //  */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'username' => $data['username'],
    //         'fullname' => $data['fullname'],
    //         'email' => $data['email'],
    //         'phonenum' => $data['phonenum'],
    //         'password' => Hash::make($data['password']),
    //         'usrrole' => 'parent',
    //     ]);
    // }
}
