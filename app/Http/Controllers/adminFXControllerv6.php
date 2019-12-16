<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;
use Auth;
use Session;
use Carbon\Carbon;

use App\Admin;
use App\User;
use App\Staff;
use App\Student;
use App\Allergy;
use App\Menus;
use App\Orders;
use App\Transaction;
use App\PaymentDet;
use App\AccountDet;


class adminFXControllerv6 extends Controller
{
use AuthenticatesUsers;
//-----------------------------------------------------------------------------------------------------------------------------------------------//
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){$this->middleware('auth:admin');}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){return view('admin.dashboard');}



//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Store student data in database
	public function storestudentinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$parent = User::all();
			return view('admin.addstudent', compact('parent'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function storestudentProc(Request $request){
   		$studentid = $request->studentid;
   		$fullname = $request->fullname;
   		$gender = $request->gender;
   		$dob = $request->dob;
   		$class = $request->class;
   		$school_session = $request->school_session;
   		$height = $request->height;
   		$weight = $request->weight;
   		$bmi = $request->bmi;
   		$target_calories = $request->target_calories;
   		$allergy = $request->allergy;

   		$allallergy = Allergy::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
   		foreach ($allallergy as $allall) {
   			$allergytype[] = $allall['allergies'];
   		}
   		foreach ($allergytype as $type) {
   			if(in_array($type, $allergy)){$value = true;}
   			else{$value = false;}
			$allcomp[$type]=$value;
   		}

   		$parentid = $request->parentid;
   		$age = Carbon::parse($dob)->age;

   		$studentcheck = Student::where('studentid', $studentid)->count();
   		if($studentcheck > 0){
   			$message = "Another Child has registered with that Student ID.";
			return redirect('user/storestudent')->with('error',$message);
   		}
   		else{
	   		Student::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
				'studentid'=>$studentid,
				'fullname'=>$fullname,
				'gender'=>$gender,
				'dob'=>$dob,
				'age'=>$age	,
				'class'=>$class,
				'school_session'=>$school_session,
				'height'=>$height,
				'weight'=>$weight,
				'bmi'=>$bmi,
				'target_calories'=>$target_calories,
				'allergies'=>serialize($allcomp), //unserialize  = string array to array
				'parentid'=>$parentid,
			]);
			$message = "New Child added";
			return redirect('admin/viewstudent')->with('success', $message);
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Store Payment details in database
	public function storepaymentinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$parent = User::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
			return view('admin.addpayment', compact('parent'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function storepaymentProc(Request $request){
   		$parentid = $request->parentid;
   		$fullname = $request->fullname;
   		$billaddr1 = $request->billaddr1;
   		$billaddr2 = $request->billaddr2;
   		$city = $request->city;
   		$zipcode = $request->zipcode;
   		$state = $request->state;
   		$country = $request->country;
   		$cardtype = $request->cardtype;
   		$cardnum = $request->cardnum;
   		$cvvnum = $request->cvvnum;
   		$expdate = $request->expdate;
   		$defaultpay = $request->defaultpay;

   		if($defaultpay == 'on'){$payflag = 'Y';}
   		else{$payflag = 'N';}

   		if($payflag == 'Y'){
   			$parentpaycheck = PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->count();
   			if($parentpaycheck < 1){
   				PaymentDet::create([
					'parentid'=>(int)$parentid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'cardtype'=>$cardtype,
					'cardnum'=>$cardnum,
					'cvvnum'=>$cvvnum,
					'expdate'=>$expdate,
					'defaultpay'=>$payflag,
				]);
				$message = "Payment Details Added";
				return redirect('admin/viewpayment')->with('success', $message);
   			}
   			else {
	   			PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->update([
						'defaultpay'=>'N'
				]);
	   			PaymentDet::create([
					'parentid'=>(int)$parentid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'cardtype'=>$cardtype,
					'cardnum'=>$cardnum,
					'cvvnum'=>$cvvnum,
					'expdate'=>$expdate,
					'defaultpay'=>$payflag,
				]);
				$message = "Payment Details Added";
				return redirect('admin/viewpayment')->with('success',$message);
	   		}
   		}
   		else {
   			PaymentDet::create([
					'parentid'=>(int)$parentid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'cardtype'=>$cardtype,
					'cardnum'=>$cardnum,
					'cvvnum'=>$cvvnum,
					'expdate'=>$expdate,
					'defaultpay'=>$payflag,
				]);
				$message = "Payment Details Added";
				return redirect('admin/viewpayment')->with('success',$message);
   		}
  
   // 		if($payflag == 'Y'){
   // 			$parentpaycheck = PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->count();
   // 			if($parentpaycheck < 1){
   // 				PaymentDet::create([  //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
			// 		'parentid'=>$parentid,
			// 		'fullname'=>$fullname,
			// 		'billaddr1'=>$billaddr1,
			// 		'billaddr2'=>$billaddr2,
			// 		'city'=>$city,
			// 		'zipcode'=>$zipcode,
			// 		'state'=>$state,
			// 		'country'=>$country,
			// 		'cardtype'=>$cardtype,
			// 		'cardnum'=>$cardnum,
			// 		'cvvnum'=>$cvvnum,
			// 		'expdate'=>$expdate,
			// 		'defaultpay'=>$payflag,
			// 	]);
			// 	$message = "Payment Details Added";
			// 	return redirect('admin/dashboard')->with('success', $message);
   // 			}
   // 			else {
	  //  			$message = "Only ONE card can be default at a time";
			// 	return redirect('admin/dashboard')->with('error', $message);
	  //  		}	
   // 		}
   // 		else {
   // 			PaymentDet::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
			// 	'parentid'=>$parentid,
			// 	'fullname'=>$fullname,
			// 	'billaddr1'=>$billaddr1,
			// 	'billaddr2'=>$billaddr2,
			// 	'city'=>$city,
			// 	'zipcode'=>$zipcode,
			// 	'state'=>$state,
			// 	'country'=>$country,
			// 	'cardtype'=>$cardtype,
			// 	'cardnum'=>$cardnum,
			// 	'cvvnum'=>$cvvnum,
			// 	'expdate'=>$expdate,
			// 	'defaultpay'=>$payflag,
			// ]);
			// $message = "Payment Details Added";
			// return redirect('admin/viewpayment')->with('success', $message);
   // 		}	
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Store Account details in database
	public function storeaccountinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$staff = Staff::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
			return view('admin.addaccount', compact('staff'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function storeaccountProc(Request $request){
		$id = $request->id;
   		$staffid = $request->staffid;
   		$fullname = $request->fullname;
   		$billaddr1 = $request->billaddr1;
   		$billaddr2 = $request->billaddr2;
   		$city = $request->city;
   		$zipcode = $request->zipcode;
   		$state = $request->state;
   		$country = $request->country;
   		$bankname = $request->bankname;
   		$banknum = $request->banknum;
 		$defaultpay = $request->defaultpay;

   		if($defaultpay == 'on'){$payflag = 'Y';}
   		else{$payflag = 'N';}

   		if($payflag == 'Y'){
   			$parentpaycheck = AccountDet::where('staffid', $staffid)->where('defaultpay', 'Y')->count();
   			if($parentpaycheck < 1){
   				AccountDet::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
					'staffid'=>$staffid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'bankname'=>$bankname,
					'banknum'=>$banknum,
					'defaultpay'=>$payflag,
				]);
				$message = "Account Details Updated";
				return redirect('admin/viewaccount')->with('success', $message);
   			}
   			else {
	   			$message = "Only ONE account can be default at a time";
				return redirect('admin/viewaccount')->with('error', $message);
	   		}	
   		}
   		else {
   			AccountDet::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
				'staffid'=>$staffid,
				'fullname'=>$fullname,
				'billaddr1'=>$billaddr1,
				'billaddr2'=>$billaddr2,
				'city'=>$city,
				'zipcode'=>$zipcode,
				'state'=>$state,
				'country'=>$country,
				'bankname'=>$bankname,
				'banknum'=>$banknum,
				'defaultpay'=>$payflag,
			]);
			$message = "New Account Added";
			return redirect('admin/viewaccount')->with('success', $message);
   		}	
	}




//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function changepasswordinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
	      	return view('admin.changepassword');
	    }
	}
	public function changepasswordProc(Request $request){
   		$id = $request->id;
   		$cpassword = $request->cpassword;
   		$password = $request->password;
   		$confirm_password = $request->password_confirmation;
   		$cpasswordhashed = Hash::make($cpassword);
   		$passwordhashed = Hash::make($password);

   		$request->validate(['password' => ['required', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'confirmed']]);
   		$admindet = Admin::where('id', $id)->first();
   		
   		if($cpassword == $password){
   			$message = "New Password cannot be same as Old Password";
			return redirect('admin/changepass')->with('error',$message);
   		}
   		else{
   			if(Hash::check($cpassword, $admindet->password) == true){
	   			Admin::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
					'password'=>$passwordhashed,
				]);	
				$message = "Password Updated";
				return redirect('admin/dashboard')->with('success',$message);
	   		}
	   		else {
	   			$message = "Incorrect Current Password";
				return redirect('admin/changepass')->with('error',$message);
	   		}
   		}
	}



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewpayment(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$pay = PaymentDet::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.viewpayment', compact('pay'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Payment details in database
	public function editpaymentinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>PaymentDet::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editpayment', compact('updata'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function editpaymentProc(Request $request){
   		$id = $request->id;
   		$parentid = $request->parentid;
   		$fullname = $request->fullname;
   		$billaddr1 = $request->billaddr1;
   		$billaddr2 = $request->billaddr2;
   		$city = $request->city;
   		$zipcode = $request->zipcode;
   		$state = $request->state;
   		$country = $request->country;
   		$cardtype = $request->cardtype;
   		$cardnum = $request->cardnum;
   		$expdate = $request->expdate;
   		$defaultpay = $request->defaultpay;

   		if($defaultpay == 'defaultpay'){$payflag = 'Y';}
   		else{$payflag = 'N';}

   		if($payflag == 'Y'){
   			$parentpaycheck = PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->count();
   			if($parentpaycheck < 1){
   				PaymentDet::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
					'parentid'=>$parentid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'cardtype'=>$cardtype,
					'cardnum'=>$cardnum,
					'expdate'=>$expdate,
					'defaultpay'=>$payflag,
				]);
				$message = "Payment Details Updated";
				return redirect('admin/dashboard')->with('success', $message);
   			}
   			else {
	   			PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
						'defaultpay'=>'N'
				]);
	   			PaymentDet::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
					'parentid'=>(int)$parentid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'cardtype'=>$cardtype,
					'cardnum'=>$cardnum,
					'cvvnum'=>$cvvnum,
					'expdate'=>$expdate,
					'defaultpay'=>$payflag,
				]);
				$message = "Payment Details Updated";
				return redirect('admin/viewpayment')->with('success',$message);
	   		}	
   		}
   		else {
   			PaymentDet::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
				'parentid'=>$parentid,
				'fullname'=>$fullname,
				'billaddr1'=>$billaddr1,
				'billaddr2'=>$billaddr2,
				'city'=>$city,
				'zipcode'=>$zipcode,
				'state'=>$state,
				'country'=>$country,
				'cardtype'=>$cardtype,
				'cardnum'=>$cardnum,
				//'cvvnum'=>$cvvnum,
				'expdate'=>$expdate,
				'defaultpay'=>$payflag,
			]);
			$message = "Payment Details Updated";
			return redirect('admin/viewpayment')->with('success', $message);
   		}	
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Payment data in database
	public function deletepaymentProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			PaymentDet::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Payment Data Deleted";
			return redirect('admin/viewpayment')->with('success', $message);
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewaccount(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$acc = AccountDet::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.viewaccount', compact('acc'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Payment details in database
	public function editaccountinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>AccountDet::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editaccount', compact('updata'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function editaccountProc(Request $request){
   		$id = $request->id;
   		$staffid = $request->staffid;
   		$fullname = $request->fullname;
   		$billaddr1 = $request->billaddr1;
   		$billaddr2 = $request->billaddr2;
   		$city = $request->city;
   		$zipcode = $request->zipcode;
   		$state = $request->state;
   		$country = $request->country;
   		$bankname = $request->bankname;
   		$banknum = $request->banknum;
 		$defaultpay = $request->defaultpay;

   		if($defaultpay == 'defaultpay'){$payflag = 'Y';}
   		else{$payflag = 'N';}

   		if($payflag == 'Y'){
   			$parentpaycheck = AccountDet::where('staffid', $staffid)->where('defaultpay', 'Y')->count();
   			if($parentpaycheck < 1){
   				AccountDet::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
					'staffid'=>$staffid,
					'fullname'=>$fullname,
					'billaddr1'=>$billaddr1,
					'billaddr2'=>$billaddr2,
					'city'=>$city,
					'zipcode'=>$zipcode,
					'state'=>$state,
					'country'=>$country,
					'bankname'=>$bankname,
					'banknum'=>$banknum,
					'defaultpay'=>$payflag,
				]);
				$message = "Account Details Updated";
				return redirect('admin/viewaccount')->with('success', $message);
   			}
   			else {
	   			$message = "Only ONE account can be default at a time";
				return redirect('admin/viewaccount')->with('error', $message);
	   		}	
   		}
   		else {
   			AccountDet::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
				'staffid'=>$staffid,
				'fullname'=>$fullname,
				'billaddr1'=>$billaddr1,
				'billaddr2'=>$billaddr2,
				'city'=>$city,
				'zipcode'=>$zipcode,
				'state'=>$state,
				'country'=>$country,
				'bankname'=>$bankname,
				'banknum'=>$banknum,
				'defaultpay'=>$payflag,
			]);
			$message = "Account Details Updated";
			return redirect('admin/viewaccount')->with('success', $message);
   		}	
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Payment data in database
	public function deleteaccountProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			AccountDet::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Account Data Deleted";
			return redirect('admin/viewaccount')->with('success', $message);
		}
	}	



//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Menu selection in database
	public function menuselectinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menu = Menus::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
			$stud = Student::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.menuselection', compact('menu', 'stud'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function menuselectProc(Request $request){
   		$menu_id = $request->id;
   		$parent_id = $request->parentid;
   		$student_id = $request->studentid;

   		$stud = Student::where('studentid', $student_id)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
   		$student_name = $stud->fullname;
   		$menuselect = Menus::where('id', $menu_id)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
   		$menuname = $menuselect->menuname;
   		$foodqty = $request->foodqty;
   		$menudate = $menuselect->created_at;
   		$price = $menuselect->menuprice;

   		Orders::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
   			'parentid'=>$parent_id,
			'studentid'=>$student_id,
			'studentname'=>$student_name,
			'menuid'=>$menu_id,
			'menuname'=>$menuname,
			'menudate'=>$menudate,
			'menuqty'=>$foodqty,
			'menuprice'=>$price,
			'redeemstatus'=>'NOTREDEEEMED',
			'redeemdate'=> '',
			'txid'=> '',
			'staffid'=>'',
		]);

		$message = "Orders added";
		return redirect('admin/dashboard')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function vieworderinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			// $orders = Orders::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	  //     	return view('admin.vieworders', compact('orders'));
	      	$orders = Orders::orderby('menudate', 'desc')
	  			->get()
	  			->groupBy(function($date) {
	  				return Carbon::parse($date->menudate)->format('W');
				});
	  		$weeknum = array_keys($orders->toArray());
	      	return view('admin.vieworders', compact('orders', 'weeknum'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Order data in database
	public function editorderinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>Orders::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editorders', compact('updata'));
      	}
	}
   	public function editorderProc(Request $request){
   		$id = $request->id;
   		$studentid = $request->studentid;
   		$menuqty = $request->menuqty;

   		$studdet = Student::where('studentid', $studentid)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
   		$studentname = $studdet->fullname;

   		Orders::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
			'studentid'=>$studentid,
			'studentname'=>$studentname,
			'menuqty'=>$menuqty,
		]);
		
		$message = "Orders Updated";
		return redirect('admin/dashboard')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function payorderinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.vieworders', compact('orders', 'menu'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function payorderProc(Request $request){
   		$order_id = $request->id;
   		$parent_id = $request->parentid;

   		$ordersdet = Orders::where('id', $order_id)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
   		$payflag = PaymentDet::where('parentid', $parent_id)->where('defaultpay', 'Y')->count();
   		
   		if($payflag >= 1){
   			$paydet = PaymentDet::where('parentid', $parent_id)->where('defaultpay', 'Y')->first();
   			$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$order_id.'P'.$paydet->id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
	   		
	   		if($payment_txid != ''){$txstatus = 'success';}
	   		else{$txstatus = 'fail';}

	   		$total = number_format($ordersdet->menu_price*$ordersdet->menu_qty, 2, '.', '');

	   		Orders::where('id', $order_id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
	   			'txid'=>$payment_txid,
	   			'staffid'=>'10',
			]);

			Transaction::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
				'menuid'=>$ordersdet->menuid,
				'parentid'=>$parent_id,
				'paymentid'=>$paydet->id,
				'orderid'=>$order_id, 
				'txstatus'=>$txstatus, 
				'txreference'=>'PAYORDERS', 
				'txamount'=>$total,
				'txid'=>$payment_txid, 
			]);
			$message = "Orders Successfully Paid";
			return redirect('admin/vieworder')->with('success', $message);
   		}
   		else {
   			$message = "No Default Payment Added";
			return redirect('admin/vieworder')->with('error', $message);
   		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function deleteorderProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			Orders::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Orders Data Deleted";
			return redirect('admin/vieworder')->with('success', $message);
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function ordersummaryinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$nextday = date_format(Carbon::now()->tomorrow(), 'd/m/Y');

	  		$orderscheck = Orders::where('redeemstatus', 'NOTREDEEEMED')->count();
	  		if($orderscheck > 0){
	  			$orders = Orders::where('redeemstatus', 'NOTREDEEEMED')->get();
	  			$tmp = array();
	  			foreach ($orders as $ord) {
	  				if(date_format(date_create($ord['menudate']), 'd/m/Y') == $nextday){
	  					$tmp[$ord['menuname']][] = $ord['menuqty'];
	  				}
	  			}
	  			$output = array();
		  		foreach ($tmp as $menuname => $menuqty) {
		  			$output[] = array(
				        'menuname' => $menuname,
				        'menuqty' => array_sum($menuqty)
				    );
		  		}
		  		$ordersorg = array();
		  		foreach($output as $out){
		  			$menudet = Menus::where('menuname', $out['menuname'])->first();
		  			$ordersorg[] = array(
		  				'menudate' => $nextday,
		  				'menuname' => $out['menuname'],
		  				'menuprice' => $menudet->menuprice,
				        'menuqty' => $out['menuqty'],
				        'totalpermenu' => number_format($out['menuqty']*$menudet->menuprice, 2, '.', '')
		  			);
				}
				$sum = 0;
				foreach ($ordersorg as $ord) {
					$sum += $ord['totalpermenu'];
				}
				$totalsales = number_format($sum, 2, '.', '');
				$dateselected = $nextday;
			  	return view('admin.orderssummary', compact('ordersorg', 'dateselected', 'totalsales'));
	  		}
	  		else {
	  			$dateselected = $nextday;
	  			return view('admin.orderssummary', compact('dateselected'));
	  		}
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function ordersummaryProc(Request $request){
   		$servedate = date_format(date_create($request->servedate), 'd/m/Y');
   		// $staffid = Auth::guard('staff')->user()->id; 

   		$orderscheck = Orders::where('redeemstatus', 'NOTREDEEEMED')->count();
   		if($orderscheck > 0){
	  		$orders = Orders::where('redeemstatus', 'NOTREDEEEMED')->get();
	  		$tmp = array();
	  		foreach ($orders as $ord) {
	  			if(date_format(date_create($ord['menudate']), 'd/m/Y') == $servedate){
	  				$tmp[$ord['menuname']][] = $ord['menuqty'];
	  			}
	  		}
	  		$output = array();
		  	foreach ($tmp as $menuname => $menuqty) {
		  		$output[] = array(
			        'menuname' => $menuname,
			        'menuqty' => array_sum($menuqty)
			    );
		  	}
		  	$ordersorg = array();
		  	foreach($output as $out){
		  		$menudet = Menus::where('menuname', $out['menuname'])->first();
		  		$ordersorg[] = array(
		  			'menudate' => $servedate,
		  			'menuname' => $out['menuname'],
		  			'menuprice' => $menudet->menuprice,
			        'menuqty' => $out['menuqty'],
			        'totalpermenu' => number_format($out['menuqty']*$menudet->menuprice, 2, '.', '')
		  		);
			}
			$sum = 0;
			foreach ($ordersorg as $ord) {
				$sum += $ord['totalpermenu'];
			}
			$totalsales = number_format($sum, 2, '.', '');
			$dateselected = $servedate;
		  	return view('admin.orderssummary', compact('ordersorg', 'dateselected', 'totalsales'));
	  	}
	  	else {
	  		$dateselected = $servedate;
	  		return view('admin.orderssummary', compact('dateselected'));
	  	}
   	}	



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function listtransinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$trans = Transaction::orderBy('updated_at', 'desc')->get(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.listtrans', compact('trans'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewtransinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$payment_txid = $request->txid;
			$txdate = Transaction::where('txid', $payment_txid)->first()->created_at;
			$trans = Transaction::where('txid', $payment_txid)
				->leftJoin('payment_details', 'transaction.paymentid', '=', 'payment_details.id')
				->first();
			$updata = array('updata'=>$trans);
			$singorderid = unserialize($trans->orderid);
			foreach ($singorderid as $orderid) {
				$orders[] = Orders::where('id', $orderid)->first();
			}
			return view('admin.viewtrans', compact('txdate', 'updata', 'orders'));
	    }
	}




//---------------------------------------------------------------------------------------------------------------------------------------------//
     //Store Menu data in database
    public function storemenuinit(){
        if (!Auth::guard('admin')) {
            Session::flash('message', trans('errors.session_label'));
            Session::flash('type', 'warning');
            return redirect()->route('');
        }
        else {return view('admin.addmenu');}
    }
//---------------------------------------------------------------------------------------------------------------------------------------------//
    public function storemenuProc(Request $request){
        $foodname = $request->foodname;
        $fooddesc = $request->fooddesc;
        $foodtype = $request->foodtype;
        $foodprice = $request->foodprice;
        $foodcal = $request->foodcal;
        $foodpic = $request->foodpic;
        $allergy = $request->allergy;

        $allallergy = Allergy::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
        foreach ($allallergy as $allall) {
            $allergytype[] = $allall['allergies'];
        }
        foreach ($allergytype as $type) {
            if(in_array($type, $allergy)){$value = true;}
            else{$value = false;}
            $allcomp[$type]=$value;
        }

        $request->validate(['foodpic' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']);
        $file_name = hash('adler32',$foodname);
        $food = $request->file('foodpic');
        $picpath = $food->storeAs('images/admin/menup', $file_name.'/MENUP'.$file_name.'.'.$food->getClientOriginalExtension(), 'public');
        $fp1_path = 'storage/images/admin/menup/'.$file_name.'/MENUP'.$file_name.'.'.$food->getClientOriginalExtension();

		Menus::create([  //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
	        'menuname'=>$foodname,
	        'menudesc'=>$fooddesc,
	        'menutype'=>$foodtype,
	        'menuprice'=>$foodprice,
	        'menucalories'=>$foodcal ,
	        'menupic'=>$fp1_path,
	        'allergyid'=>serialize($allcomp),
	    ]);
	    $message = "New Menu added";
	    return redirect('admin/menuselect')->with('success', $message);
    }
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewmenu(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menus = Menus::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.viewmenu', compact('menus'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editmenuinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>Menus::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editmenu', compact('updata'));
      	}
	}
   	public function editmenuProc(Request $request){
   		$id = $request->id;
   		$foodname = $request->foodname;
        $fooddesc = $request->fooddesc;
        $foodtype = $request->foodtype;
        $foodprice = $request->foodprice;
        $foodcal = $request->foodcal;
        $allergy = $request->allergy;

        $allallergy = Allergy::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
        foreach ($allallergy as $allall) {
            $allergytype[] = $allall['allergies'];
        }
        foreach ($allergytype as $type) {
            if(in_array($type, $allergy)){$value = true;}
            else{$value = false;}
            $allcomp[$type]=$value;
        }

        Menus::find($id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
	        'menuname'=>$foodname,
	        'menudesc'=>$fooddesc,
	        'menutype'=>$foodtype,
	        'menuprice'=>$foodprice,
	        'menucalories'=>$foodcal ,
	        //'menupic'=>$fp1_path,
	        'allergyid'=>serialize($allcomp),
	    ]);
	    $message = "Menu data updated";
	    return redirect('admin/menuselect')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editmenuimageinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>Menus::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editmenuimage', compact('updata'));
      	}
	}
   	public function editmenuimageProc(Request $request){
   		$id = $request->id;
   		$foodname = $request->foodname;
        $foodpic = $request->foodpic;

        $request->validate(['foodpic' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']);
        $file_name = hash('adler32',$foodname);
        $food = $request->file('foodpic');
        $picpath = $food->storeAs('images/admin/menup', $file_name.'/MENUP'.$file_name.'.'.$food->getClientOriginalExtension(), 'public');
        $fp1_path = 'storage/images/admin/menup/'.$file_name.'/MENUP'.$file_name.'.'.$food->getClientOriginalExtension();

        Menus::find($id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
	        'menupic'=>$fp1_path,
	    ]);
	    $message = "Menu image updated";
	    return redirect('admin/menuselect')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Student data in database
	public function deletemenuProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			Menus::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Menu Data Deleted";
			return redirect('admin/menuselect')->with('success', $message);
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewparent(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$parent = User::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.viewparent', compact('parent'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editparentinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>User::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editparent', compact('updata'));
      	}
	}
   	public function editparentProc(Request $request){
   		$id = $request->id;
   		$fullname = $request->fullname;
   		$email = $request->email;
   		$phonenum = $request->phonenum;

   		User::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
			'fullname'=>$fullname,
			'email'=>$email,
			'phonenum'=>$phonenum,
		]);
		
		$message = "Parent Data Updated";
		return redirect('admin/viewparent')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Student data in database
	public function deleteparentProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			PaymentDet::where('parentid', $id)->delete();
			User::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Parent Data Deleted";
			return redirect('admin/viewparent')->with('success', $message);
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewstudent(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$stud = Student::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.viewstudent', compact('stud'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editstudentinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$parent = User::all();
			$id = $request->id;
			$updata = array('updata'=>Student::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editstudent', compact('updata', 'parent'));
      	}
	}
   	public function editstudentProc(Request $request){
   		$id = $request->id;
   		$studentid = $request->studentid;
   		$fullname = $request->fullname;
   		$gender = $request->gender;
   		$dob = $request->dob;
   		$class = $request->class;
   		$school_session = $request->school_session;
   		$height = $request->height;
   		$weight = $request->weight;
   		$bmi = $request->bmi;
   		$target_calories = $request->target_calories;
   		$allergy = $request->allergy;

   		$allallergy = Allergy::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
   		foreach ($allallergy as $allall) {
   			$allergytype[] = $allall['allergies'];
   		}
   		foreach ($allergytype as $type) {
   			if(in_array($type, $allergy)){$value = true;}
   			else{$value = false;}
			$allcomp[$type]=$value;
   		}

   		$parentid = $request->parentid;
   		$age = Carbon::parse($dob)->age;

   		Student::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
			'studentid'=>$studentid,
			'fullname'=>$fullname,
			'gender'=>$gender,
			'dob'=>$dob,
			'age'=>$age	,
			'class'=>$class,
			'school_session'=>$school_session,
			'height'=>$height,
			'weight'=>$weight,
			'bmi'=>$bmi,
			'target_calories'=>$target_calories,
			'allergies'=>serialize($allcomp), //unserialize  = string array to array
			'parentid'=>$parentid,
		]);
		
		$message = "Child Data Updated";
		return redirect('admin/viewstudent')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Student data in database
	public function deletestudentProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			Student::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Child Data Deleted";
			return redirect('admin/viewstudent')->with('success', $message);
		}
	}	
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewstaff(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$staff = Staff::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
	      	return view('admin.viewstaff', compact('staff'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editstaffinit(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>Staff::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('admin.editstaff', compact('updata'));
      	}
	}
   	public function editstaffProc(Request $request){
   		$id = $request->id;
   		$fullname = $request->fullname;
   		$email = $request->email;
   		$phonenum = $request->phonenum;

   		Staff::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
			'fullname'=>$fullname,
			'email'=>$email,
			'phonenum'=>$phonenum,
		]);
		
		$message = "Staff Data Updated";
		return redirect('admin/viewstaff')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Student data in database
	public function deletestaffProc(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			Staff::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Staff Data Deleted";
			return redirect('admin/viewstaff')->with('success', $message);
		}
	}		
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
