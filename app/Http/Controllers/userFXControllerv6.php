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
	 //Store student data in database
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
   		// $allerdet[] = Allergy::where('allergies', $request->allergy)->first();

   		if($primary == 'true'){
   			$primary_parentid = $request->parentid;
   			$secondary_parentid = '';
   		}
   		else{
   			$primary_parentid = '';
   			$secondary_parentid = $request->parentid;}
   		
   		$age = Carbon::parse($dob)->age;

   // 		dd(
   // 			array(
			// 	'studentid'=>$studentid,
			// 	'fullname'=>$fullname,
			// 	'gender'=>$gender,
			// 	'dob'=>$dob,
			// 	'age'=>$age	,
			// 	'class'=>$class,
			// 	'school_session'=>$school_session,
			// 	'height'=>$height,
			// 	'weight'=>$weight,
			// 	'bmi'=>$bmi,
			// 	'target_calories'=>$target_calories,
			// 	'allergies'=>serialize($allcomp), //unserialize  = string array to array
			// 	'primary_parentid'=>$primary_parentid,
			// 	'secondary_parentid'=>$secondary_parentid,
			// ),
			// unserialize(serialize($allcomp))
   // 		);

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
			//dd($stud, empty($stud), compact('stud'));
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
			//dd($updata);
      		return view('user.editstudent', compact('updata'));
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
		
		$message = "Student Data Updated";
		return view('user.home', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Student data in database
	public function deletestudentProc(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			Student::find($id)->delete();
			$message = "Student Data Deleted";
			return view('user.home', compact('message'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Menu selection in database
	public function orderfoodinit(){
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
   	public function orderfoodProc(Request $request){
   		$menu_id = $request->id;
   		$parent_id = $request->parentid;
   		$student_id = $request->studentid;

   		$stud = Student::where('studentid', $student_id)->first();
   		$student_name = $stud->fullname;
   		$menuselect = Menus::where('id', $menu_id)->first();
   		$menuname = $menuselect->name;
   		$foodqty = $request->foodqty;
   		$menudate = $menuselect->created_at;
   		$price = $menuselect->price;

   // 		dd(
   // 			$menuselect,
   // 			array(
	  //  			'parentid'=>$parent_id,
			// 	'studentid'=>$student_id,
			// 	'studentname'=>$student_name,
			// 	'menu_id'=>$menu_id,
			// 	'menu_name'=>$menuname,
			// 	'menu_date'=>$menudate,
			// 	'menu_qty'=>$foodqty,
			// 	'menu_price'=>$price,
			// 	'redeem_status'=>'NOTREDEEEMED',
			// 	'redeem_date'=> '',
			// 	'txid'=> '',
			// )
   // 		);

   		Orders::create([
   			'parentid'=>$parent_id,
			'studentid'=>$student_id,
			'studentname'=>$student_name,
			'menu_id'=>$menu_id,
			'menu_name'=>$menuname,
			'menu_date'=>$menudate,
			'menu_qty'=>$foodqty,
			'menu_price'=>$price,
			'redeem_status'=>'NOTREDEEEMED',
			'redeem_date'=> '',
			'txid'=> '',
		]);

		Menus::where('id', $menu_id)->update([
			'stock'=>$menuselect->stock - $foodqty,
		]);

		$message = "New Orders added";
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

   		$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$order_id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
   		if($payment_txid != ''){$txstatus = 'success';}
   		else{$txstatus = 'fail';}

   		$total = number_format($ordersdet->menu_price*$ordersdet->menu_qty, 2, '.', '');

  //  		dd(
  //  			array(
		// 		'menu_id'=>$ordersdet->menu_id,
		// 		'parentuid'=>$parent_id,
		// 		'order_id'=>$order_id, 
		// 		'tx_status'=>$txstatus, 
		// 		'tx_reference'=>'PAYORDERS', 
		// 		'tx_amount'=>$total,
		// 		'txid'=>$payment_txid, 
		// 	)
		// );

   		Orders::where('id', $order_id)->update([
   			'txid'=>$payment_txid,
		]);

		Transaction::create([
			'menu_id'=>$ordersdet->menu_id,
			'parentuid'=>$parent_id,
			'order_id'=>$order_id, 
			'tx_status'=>$txstatus, 
			'tx_reference'=>'PAYORDERS', 
			'tx_amount'=>$total,
			'txid'=>$payment_txid, 
		]);

		$message = "Orders Successfully Paid";
		return view('user.home', compact('message'));
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
