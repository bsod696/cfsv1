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
   		// $primary = $request->primary;
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

   		// if($primary == 'true'){
   		// 	$primary_parentid = $request->parentid;
   		// 	$secondary_parentid = '';
   		// }
   		// else{
   		// 	$primary_parentid = '';
   		// 	$secondary_parentid = $request->parentid;
   		// }
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
			// 'primary_parentid'=>$primary_parentid,
			// 'secondary_parentid'=>$secondary_parentid,
		]);
		$message = "New Student added";
		return redirect('user/viewstudent')->with('status', $message);
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
   		// $primary = $request->primary;
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

   		// if($primary == 'true'){
   		// 	$primary_parentid = $request->parentid;
   		// 	$secondary_parentid = '';
   		// }
   		// else{
   		// 	$primary_parentid = '';
   		// 	$secondary_parentid = $request->parentid;
   		// }
   		$primary_parentid = $request->parentid;

   		Student::where('id', $id)->update([
			'class'=>$class,
			'school_session'=>$school_session,
			'height'=>$height,
			'weight'=>$weight,
			'bmi'=>$bmi,
			'target_calories'=>$target_calories,
			'allergies'=>serialize($allcomp), //unserialize  = string array to array
			'parentid'=>$parentid,
			// 'primary_parentid'=>$primary_parentid,
			// 'secondary_parentid'=>$secondary_parentid,
		]);
		
		$message = "Student Updated";
		return redirect('user/viewstudent')->with('status', $message);
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
				$message = "Payment Details Added";
				return redirect('user/home')->with('status', $message);
   			}
   			else {
	   			$message = "Only ONE card can be default at a time";
				return redirect('user/home')->with('status', $message);
	   		}	
   		}
   		else {
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
			$message = "Payment Details Added";
			return redirect('user/viewpayment')->with('status', $message);
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
			// $years = Years::all();
			// $months = Months::all();
			// $updata = array('updata'=>PaymentDet::where('id', $id)->first());
   //    		return view('user.editpayment', compact('years', 'months', 'updata'));
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
				return redirect('user/home')->with('status', $message);
   			}
   			else {
	   			$message = "Only ONE card can be default at a time";
				return redirect('user/home')->with('status', $message);
	   		}	
   		}
   		else {
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
			return redirect('user/viewpayment')->with('status', $message);
   		}	
	}


//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function setting(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			//$stud = Student::where('primary_parentid', Auth::user()->id)->orwhere('secondary_parentid', Auth::user()->id)->get();
	      	return view('user.setting'); //, compact('stud'));
	    }
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
			//dd($id, $updata);
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
		return redirect('user/home')->with('status', $message);
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
		return redirect('user/menuselect')->with('status', $message);
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
		return redirect('user/vieworder')->with('status', $message);
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
				$id = $request->id;
				$payments = PaymentDet::where('parentid', Auth::user()->id)->get();
				$orders = Orders::where('id', $id)->get();
	      		return view('user.payorders', compact('orders', 'payments'));
			}
			else {
				$message = "No Credit/Debit cards added. Please add card before making a payment";
				return redirect('user/vieworder')->with('status', $message);
			}
			
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function payorderProc(Request $request){
   		$order_id = $request->id;
   		$parent_id = $request->parentid;
   		$payment_id = $request->paymentid;

   		$ordersdet = Orders::where('id', $order_id)->first();
   		//$payflag = PaymentDet::where('parentid', Auth::user()->id)->where('defaultpay', 'Y')->count();

   		//if($payflag >= 1){
   			$paydet = PaymentDet::where('id', $payment_id)->first();
   			$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$order_id.'P'.$paydet->id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
	   		
	   		if($payment_txid != ''){$txstatus = 'success';}
	   		else{$txstatus = 'fail';}

	   		$total = number_format($ordersdet->menu_price*$ordersdet->menu_qty, 2, '.', '');

	   		Orders::where('id', $order_id)->update([
	   			'txid'=>$payment_txid,
			]);

			Transaction::create([
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
			return redirect('user/vieworder')->with('status', $message);
   		//}
   		//else {
   		//	$message = "No Default Payment Added";
		//	return redirect('user/vieworder')->with('status', $message);
   		//}
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
			return redirect('user/vieworder')->with('status', $message);
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
			$trans = Transaction::where('parentid', Auth::user()->id)->get();
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
			$orders = Orders::where('txid', $payment_txid)->get();
			$trans = Transaction::where('txid', $payment_txid)->get();
			foreach ($trans as $tr) {
				$payments[] = PaymentDet::where('id', $tr['paymentid'])->first();
			}
	      	return view('user.viewtrans', compact('trans', 'orders', 'payments'));
	    }
	}

//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
