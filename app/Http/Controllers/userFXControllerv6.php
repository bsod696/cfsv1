<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Session;
use Carbon\Carbon;

use App\User;
use App\Student;
use App\Allergy;
use App\Menus;
use App\Orders;
use App\Transaction;
use App\PaymentDet;

class userFXControllerv6 extends Controller
{
use AuthenticatesUsers;
//-----------------------------------------------------------------------------------------------------------------------------------------------//
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){$this->middleware('auth');}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){return view('user.home');}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Add student data in database
	public function storestudentinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('user.addstudent');}
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
   		$primary = $request->primary;
   		$allergy = $request->allergy;

   		$allallergy = Allergy::all();
   		foreach ($allallergy as $allall) {
   			$allergytype[] = $allall['allergies'];
   		}
   		foreach ($allergytype as $type) {
   			if(in_array($type, $allergy)){$value = true;}
   			else{$value = false;}
			$allcomp[$type]=$value;
   		}

   		if($primary == 'true'){
   			$primary_parentid = $request->parentid;
   			$secondary_parentid = '';
   		}
   		else{
   			$primary_parentid = '';
   			$secondary_parentid = $request->parentid;}
   		
   		$age = Carbon::parse($dob)->age;

   		Student::create([
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
			'primary_parentid'=>$primary_parentid,
			'secondary_parentid'=>$secondary_parentid,
		]);
		$message = "New Student added";
		return view('user.home', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewstudent(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$stud = Student::where('primary_parentid', Auth::user()->id)->orwhere('secondary_parentid', Auth::user()->id)->get();
	      	return view('user.viewstudent', compact('stud'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editstudentinit(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>Student::where('id', $id)->first());
      		return view('user.editstudent', compact('updata'));
      	}
	}
   	public function editstudentProc(Request $request){
   		$id = $request->id;
   		$class = $request->class;
   		$school_session = $request->school_session;
   		$height = $request->height;
   		$weight = $request->weight;
   		$bmi = $request->bmi;
   		$target_calories = $request->target_calories;
   		$primary = $request->primary;
   		$allergy = $request->allergy;

   		$allallergy = Allergy::all();
   		foreach ($allallergy as $allall) {
   			$allergytype[] = $allall['allergies'];
   		}
   		foreach ($allergytype as $type) {
   			if(in_array($type, $allergy)){$value = true;}
   			else{$value = false;}
			$allcomp[$type]=$value;
   		}

   		if($primary == 'true'){
   			$primary_parentid = $request->parentid;
   			$secondary_parentid = '';
   		}
   		else{
   			$primary_parentid = '';
   			$secondary_parentid = $request->parentid;}
   		
   		$age = Carbon::parse($dob)->age;

   		Student::where('id', $id)->update([
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
			'primary_parentid'=>$primary_parentid,
			'secondary_parentid'=>$secondary_parentid,
		]);
		
		$message = "Student Updated";
		return view('user.home', compact('message'));
	}




//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Store Payment details in database
	public function storepaymentinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$updata = array('updata'=>User::where('id', Auth::user()->id)->first());
			return view('user.addpayment', compact('updata'));
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

   		PaymentDet::create([
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
			'cvvnum'=>$cvvnum,
			'expdate'=>$expdate,
			'defaultpay'=>$payflag,
		]);
		$message = "Payment Details added";
		return view('user.home', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewpayment(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$pay = PaymentDet::where('parentid', Auth::user()->id)->get();
	      	return view('user.viewpayment', compact('pay'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Payment details in database
	public function editpaymentinit(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>PaymentDet::where('id', $id)->first());
      		return view('user.editpayment', compact('updata'));
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
   		$cvvnum = $request->cvvnum;
   		$expdate = $request->expdate;
   		$defaultpay = $request->defaultpay;

   		if($defaultpay == 'defaultpay'){$payflag = 'Y';}
   		else{$payflag = 'N';}

   		PaymentDet::where('id', $id)->update([
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
			'cvvnum'=>$cvvnum,
			'expdate'=>$expdate,
			'defaultpay'=>$payflag,
		]);
		$message = "Payment Details Updated";
		return view('user.home', compact('message'));
	}



//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Menu selection in database
	public function menuselectinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menu = Menus::all();
			$stud = Student::where('primary_parentid', Auth::user()->id)->orwhere('secondary_parentid', Auth::user()->id)->get();
	      	return view('user.menuselection', compact('menu', 'stud'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function menuselectProc(Request $request){
   		$menu_id = $request->id;
   		$parent_id = $request->parentid;
   		$student_id = $request->studentid;

   		$stud = Student::where('studentid', $student_id)->first();
   		$student_name = $stud->fullname;
   		$menuselect = Menus::where('id', $menu_id)->first();
   		$menuname = $menuselect->menuname;
   		$foodqty = $request->foodqty;
   		$menudate = $menuselect->created_at;
   		$price = $menuselect->menuprice;

   		Orders::create([
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
		return view('user.home', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function vieworderinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::where('parentid', Auth::user()->id)->get();
	      	return view('user.vieworders', compact('orders'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editorderinit(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>Orders::where('id', $id)->first());
      		return view('user.editorders', compact('updata'));
      	}
	}
   	public function editorderProc(Request $request){
   		$id = $request->id;
   		$studentid = $request->studentid;
   		$menuqty = $request->menuqty;

   		$studdet = Student::where('studentid', $studentid)->first();
   		$studentname = $studdet->fullname;

   		Orders::where('id', $id)->update([
			'studentid'=>$studentid,
			'studentname'=>$studentname,
			'menuqty'=>$menuqty,
		]);
		
		$message = "Orders Updated";
		return view('user.home', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function payorderinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::where('parentid', Auth::user()->id)->get();
	      	return view('user.vieworders', compact('orders', 'menu'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function payorderProc(Request $request){
   		$order_id = $request->id;
   		$parent_id = $request->parentid;

   		$ordersdet = Orders::where('id', $order_id)->first();
   		$payflag = PaymentDet::where('parentid', $parent_id)->first();
   		
   		if($payflag->defaultpay =='Y'){
   			$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$order_id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
	   		
	   		if($payment_txid != ''){$txstatus = 'success';}
	   		else{$txstatus = 'fail';}

	   		$total = number_format($ordersdet->menu_price*$ordersdet->menu_qty, 2, '.', '');

	   		Orders::where('id', $order_id)->update([
	   			'txid'=>$payment_txid,
			]);

			Transaction::create([
				'menuid'=>$ordersdet->menu_id,
				'parentid'=>$parent_id,
				'orderid'=>$order_id, 
				'txstatus'=>$txstatus, 
				'txreference'=>'PAYORDERS', 
				'txamount'=>$total,
				'txid'=>$payment_txid, 
			]);

			$message = "Orders Successfully Paid";
			return view('user.home', compact('message'));
   		}
   		else {
   			$message = "No Default Payment Added";
			return view('user.home', compact('message'));
   		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function deleteorderProc(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			Orders::find($id)->delete();
			$message = "Orders Data Deleted";
			return view('user.home', compact('message'));
		}
	}



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function listtransinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$trans = Transaction::where('parentuid', Auth::user()->id)->get();
	      	return view('user.listtrans', compact('trans'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewtransinit(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$payment_txid = $request->txid;
			$trans = Transaction::where('txid', $payment_txid)->get();
	      	return view('user.viewtrans', compact('trans'));
	    }
	}

//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
