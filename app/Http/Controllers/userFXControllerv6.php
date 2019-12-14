<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
use App\Years;
use App\Months;

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

   		$parentid = $request->parentid;
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
			'parentid'=>$parentid,
		]);
		$message = "New Child added";
		return redirect('user/viewstudent')->with('success',$message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewstudent(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$stud = Student::where('parentid', Auth::user()->id)->get();
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

   		$parentid = $request->parentid;

   		Student::where('id', $id)->update([
			'class'=>$class,
			'school_session'=>$school_session,
			'height'=>$height,
			'weight'=>$weight,
			'bmi'=>$bmi,
			'target_calories'=>$target_calories,
			'allergies'=>serialize($allcomp), //unserialize  = string array to array
			'parentid'=>$parentid,
		]);
		
		$message = "Child Updated";
		return redirect('user/viewstudent')->with('success',$message);
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
				return redirect('user/home')->with('status', $message);
   			}
   			else {
	   			$message = "Only ONE card can be default at a time";
				return redirect('user/home')->with('error',$message);
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
			return redirect('user/viewpayment')->with('success',$message);
   		}
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

   		

   		if($payflag == 'Y'){
   			$parentpaycheck = PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->count();
   			if($parentpaycheck < 1){
   				PaymentDet::where('id', $id)->update([
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
				return redirect('user/editpayment')->with('success',$message);
   			}
   			else {
	   			$message = "Only ONE card can be default at a time";
				return redirect('user/home')->with('error',$message);
	   		}	
   		}
   		else {
   			PaymentDet::where('id', $id)->update([
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
			return redirect('user/viewpayment')->with('success',$message);
   		}	
	}


//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function setting(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('user.setting');}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editparentinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = Auth::user()->id;
			$updata = array('updata'=>User::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('user.editparent', compact('updata'));
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
		return redirect('user/home')->with('success',$message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function changepasswordinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
	      	return view('user.changepassword');
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
   		$userdet = User::where('id', $id)->first();

   		if(Hash::check($cpassword, $userdet->password) == true){
   			User::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
				'password'=>$passwordhashed,
			]);	
			$message = "Password Updated";
			return redirect('user/home')->with('success',$message);
   		}
   		else {
   			$message = "Incorrect Current Password";
			return redirect('user/changepass')->with('error',$message);
   		}
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
			$stud = Student::where('parentid', Auth::user()->id)->get();
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
   		$menudate = $request->dateserve;
   		$price = $menuselect->menuprice;

   		$currenttimestamp = Carbon::now();

   		if($currenttimestamp->isWeekend()){
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
			return redirect('user/menuselect')->with('success',$message);
   		}
   		else{
   			$message = "Orders to be made on weekend only to avoid mishandling";
			return redirect('user/home')->with('error',$message);
   		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function vieworderinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::where('parentid', Auth::user()->id)->where('txid' , '')->get();
			// $ordersp = Orders::where('parentid', Auth::user()->id)->where('txid' ,'!=', '')->orderBy('updated_at', 'desc')->get();
			// $orders = Orders::where('parentid', Auth::user()->id)->where('txid' , '')
	  // 			->orderby('menudate', 'asc')
	  // 			->get()
	  // 			->groupBy(function($date) {
	  // 				return Carbon::parse($date->menudate)->format('W');
			// 	});
			// $weeknumorders = array_keys($orders->toArray());

			$ordersp = Orders::where('parentid', Auth::user()->id)->where('txid' ,'!=', '')
	  			->orderby('menudate', 'asc')
	  			->get()
	  			->groupBy(function($date) {
	  				return Carbon::parse($date->menudate)->format('W');
				});
	  		$weeknumordersp = array_keys($ordersp->toArray());
	      	return view('user.vieworders', compact('orders', 'ordersp', 'weeknumordersp'));
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
		return redirect('user/vieworder')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function payorderinit(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$paymentscheck = PaymentDet::where('parentid', Auth::user()->id)->count();
			if($paymentscheck >= 1){
				$id = $request->selectorder;
				if(empty($id)){
					$message = "Please select Orders before making a payment";
					return redirect('user/vieworder')->with('error', $message);
				}
				else {
					$payments = PaymentDet::where('parentid', Auth::user()->id)->get();
					$grandtotal = 0;
					$total = null;
					foreach ($id as $oid) {
						$orders[] = Orders::where('id', $oid)->get();
						foreach ($orders as $ord) {
							foreach ($ord as $o) {
							}
						}
						$total[] = $o->menuprice*$o->menuqty;
					}
					$grandtotal = array_sum($total);
		      		return view('user.payorders', compact('orders', 'payments', 'grandtotal'));
				}
			}
			else {
				$message = "No Credit/Debit cards added. Please add card before making a payment";
				return redirect('user/vieworder')->with('error', $message);
			}
			
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function payorderProc(Request $request){
   		$order_id = $request->selectorder;
   		$parent_id = $request->parentid;
   		$payment_id = $request->paymentid;
   		$gtotal = $request->gtotal;

   		$bulkorderid = serialize($order_id);
   		$paydet = PaymentDet::where('id', $payment_id)->first();
	   	$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$paydet->id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
	   	if($payment_txid != ''){$txstatus = 'success';}
	   	else{$txstatus = 'fail';}

	   	foreach ($order_id as $id) {
	   		Orders::where('id', $id)->update([
			   	'txid'=>$payment_txid,
			   	'staffid'=>'1',
			]);
	   	}
		Transaction::create([
			'parentid'=>$parent_id,
			'paymentid'=>(int)$paydet->id,
			'orderid'=>$bulkorderid, 
			'txstatus'=>$txstatus, 
			'txreference'=>'PAYORDERS', 
			'txamount'=>$gtotal,
			'txid'=>$payment_txid, 
		]);
		// $arr = array(
		// 	'parentid'=>$parent_id,
		// 	'paymentid'=>(int)$paydet->id,
		// 	'orderid'=>$bulkorderid, 
		// 	'txstatus'=>$txstatus, 
		// 	'txreference'=>'PAYORDERS', 
		// 	'txamount'=>$gtotal,
		// 	'txid'=>$payment_txid, 
		// );
		// dd($bulkorderid, $arr);

   		$message = "Orders Successfully Paid";
		return redirect('user/vieworder')->with('success', $message);

  //  		foreach ($order_id as $id) {
  //  			$ordersdet = Orders::where('id', $id)->get();
  //  			foreach ($ordersdet as $orders) {
  //  				$paydet = PaymentDet::where('id', $payment_id)->first();
	 //   			$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$orders->id.'P'.$paydet->id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
		   		
		//    		if($payment_txid != ''){$txstatus = 'success';}
		//    		else{$txstatus = 'fail';}

		//    		$total = number_format($orders->menuprice*$orders->menuqty, 2, '.', '');

		//    		Orders::where('id', $orders['id'])->update([
		//    			'txid'=>$payment_txid,
		// 		]);

		// 		Transaction::create([
		// 			'menuid'=>$orders->menuid,
		// 			'parentid'=>$parent_id,
		// 			'paymentid'=>$paydet->id,
		// 			'orderid'=>$orders->id, 
		// 			'txstatus'=>$txstatus, 
		// 			'txreference'=>'PAYORDERS', 
		// 			'txamount'=>$total,
		// 			'txid'=>$payment_txid, 
		// 		]);
  //  			}
  //  		}
  //  		$message = "Orders Successfully Paid";
		// return redirect('user/vieworder')->with('status', $message);




   		//$payflag = PaymentDet::where('parentid', Auth::user()->id)->where('defaultpay', 'Y')->count();

   		//if($payflag >= 1){


   // 			$paydet = PaymentDet::where('id', $payment_id)->first();
   // 			$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$order_id.'P'.$paydet->id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
	   		
	  //  		if($payment_txid != ''){$txstatus = 'success';}
	  //  		else{$txstatus = 'fail';}

	  //  		$total = number_format($ordersdet->menuprice*$ordersdet->menuqty, 2, '.', '');

	  //  		Orders::where('id', $order_id)->update([
	  //  			'txid'=>$payment_txid,
			// ]);

			// Transaction::create([
			// 	'menuid'=>$ordersdet->menuid,
			// 	'parentid'=>$parent_id,
			// 	'paymentid'=>$paydet->id,
			// 	'orderid'=>$order_id, 
			// 	'txstatus'=>$txstatus, 
			// 	'txreference'=>'PAYORDERS', 
			// 	'txamount'=>$total,
			// 	'txid'=>$payment_txid, 
			// ]);

			// $message = "Orders Successfully Paid";
			// return redirect('user/vieworder')->with('status', $message);



   		//}
   		//else {
   		//	$message = "No Default Payment Added";
		//	return redirect('user/vieworder')->with('status', $message);
   		//}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function deleteorderinit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::where('parentid', Auth::user()->id)->where('txid' , '')->get();
	      	return view('user.manageorders', compact('orders'));
	    }
	}	
	public function deleteorderProc(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->deleteid;
			Orders::find($id)->delete();
			$message = "Orders Data Deleted";
			return redirect('user/deleteorder')->with('success', $message);
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
			$trans = Transaction::where('parentid', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
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
			$txdate = Transaction::where('txid', $payment_txid)->first()->created_at;
			$trans = Transaction::where('txid', $payment_txid)
				->leftJoin('payment_details', 'transaction.paymentid', '=', 'payment_details.id')
				->first();
			$updata = array('updata'=>$trans);
			$singorderid = unserialize($trans->orderid);
			foreach ($singorderid as $orderid) {
				$orders[] = Orders::where('id', $orderid)->first();
			}
			return view('user.viewtrans', compact('txdate', 'updata', 'orders'));
	    }
	}



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function debug(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menu = Menus::all();
			$stud = Student::where('parentid', Auth::user()->id)->get();
	      	return view('user.selectdates', compact('menu', 'stud'));
		}
	}	

//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
