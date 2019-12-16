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

use App\User;
use App\Student;
use App\Staff;
use App\Allergy;
use App\Menus;
use App\Orders;
use App\Transaction;
use App\AccountDet;

use Mail;
use App\Mail\RedeemNotify;

class staffFXControllerv6 extends Controller
{
use AuthenticatesUsers;
//-----------------------------------------------------------------------------------------------------------------------------------------------//
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){$this->middleware('auth:staff');}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){return view('staff.dashboard');}




//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Store account data in database
	public function storeaccountinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('staff.addaccount');}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function storeaccountProc(Request $request){
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

   		AccountDet::create([
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
			'defaultpay'=>$defaultpay,
		]);
		$message = "New Account Details added";
		return redirect('staff/dashboard')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewaccount(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = Auth::guard('staff')->user()->id;
			$acc = AccountDet::where('staffid', $id)->get(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
	      	return view('staff.viewaccount', compact('acc'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Payment details in database
	public function editaccountinit(Request $request){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>AccountDet::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
      		return view('staff.editaccount', compact('updata'));
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
				return redirect('staff/viewaccount')->with('success', $message);
   			}
   			else {
	   			$message = "Only ONE account can be default at a time";
				return redirect('staff/viewaccount')->with('error', $message);
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
			return redirect('staff/viewaccount')->with('success', $message);
   		}	
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Delete Payment data in database
	public function deleteaccountProc(Request $request){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			AccountDet::find($id)->delete(); //stored procedures: delete row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:843
			$message = "Account Data Deleted";
			return redirect('staff/viewaccount')->with('success', $message);
		}
	}	



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function setting(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('staff.setting');}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Student data in database
	public function editstaffinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = Auth::guard('staff')->user()->id;
			$updata = array('updata'=>Staff::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
			// dd($id, $updata);
      		return view('staff.editstaff', compact('updata'));
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
		return redirect('staff/dashboard')->with('success', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function changepasswordinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
	      	return view('staff.changepassword');
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
   		$staffdet = Staff::where('id', $id)->first();
   		
   		if($cpassword == $password){
   			$message = "New Password cannot be same as Old Password";
			return redirect('staff/changepass')->with('error',$message);
   		}
   		else{
   			if(Hash::check($cpassword, $staffdet->password) == true){
	   			Staff::where('id', $id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
					'password'=>$passwordhashed,
				]);	
				$message = "Password Updated";
				return redirect('staff/dashboard')->with('success',$message);
	   		}
	   		else {
	   			$message = "Incorrect Current Password";
				return redirect('staff/changepass')->with('error',$message);
	   		}
   		}
	}



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewmenusinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menu = Menus::all();
	      	return view('staff.viewmenu', compact('menu'));
	    }
	}


//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function listordersinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
	  		$id = Auth::guard('staff')->user()->id;
	  		// $orders = Orders::where('staffid', $id)->orderby('menudate', 'desc')->get();
	  		$orders = Orders::orderby('menudate', 'desc')
	  			->get()
	  			->groupBy(function($date) {
	  				return Carbon::parse($date->menudate)->format('W');
			        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
			        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
				});
			// $week = 45;
	  //$year = 2019;

	  //$timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week * 7 * 24 * 60 * 60 );

	  //$timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) -1 );
	  //$date_for_monday = date( 'Y-m-d', $timestamp_for_monday );

	  //$timestamp_for_friday = $timestamp - 86400 * ( date( 'N', $timestamp ) -5 );
	  //$date_for_friday = date( 'Y-m-d', $timestamp_for_friday );
	        // dd($orders->toArray(), date('d/m/Y',strtotime('2019W46')), date_format(Carbon::parse(date('d/m/Y',strtotime('2019W46')))->addDays(4), 'd/m/Y'));
	        // dd(date_format(Carbon::parse('02/12/2019')->addDays(4), 'd/m/Y'), Carbon::parse(date('d/m/Y',strtotime(Carbon\Carbon::now()->format('Y').'W46')))->addDays(4));
	        // dd( date('d/m/Y',strtotime(Carbon\Carbon::now()->format('Y').'W46') ' + 4 days') );
	        // $Date = "02/12/2019";
			// dd(date('d/m/Y', strtotime(date_format(date_create($Date), 'Y-m-d'). ' + 4 days')));
			// $w = 49;
			// $f = date('Y/m/d',strtotime(Carbon::now()->format('Y').'W'.$w));
			// $f1 = date_format(date_create(date('Y/m/d',strtotime(Carbon::now()->format('Y').'W'.$w))), 'd/m/Y');

			// $l = date_format(date_add(date_create($f),date_interval_create_from_date_string("4 days")), 'Y/m/d');
			// $l1 = date_format(date_add(date_create(date('Y/m/d',strtotime(Carbon::now()->format('Y').'W'.$w))),date_interval_create_from_date_string("4 days")), 'd/m/Y');
			//dd($f, $l, $f1, $l1);
			// dd( date('d/m/Y', strtotime( date('d/m/Y',strtotime(Carbon::now()->format('Y').'W'.$w)). ' + 4 days')) );
			//dd(Carbon::now()->format('Y'));
			//dd( date('d/m/Y',strtotime(Carbon::now()->format('Y').'W'.$w)) );
	  		$weeknum = array_keys($orders->toArray());
	  		return view('staff.listorders', compact('orders', 'weeknum'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewordersinit(Request $request){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$orders = Orders::where('id', $id)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
			$menus = Menus::where('id', $orders->menuid)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
	      	$updata = array(
	      		'orders'=>$orders,
	      		'menus'=>$menus
	      	); 
      		return view('staff.vieworders', compact('updata'));
	    }
	}
// //---------------------------------------------------------------------------------------------------------------------------------------------//
// 	public function takeordersinit(){
// 		if (!Auth::guard('staff')) {
// 			Session::flash('message', trans('errors.session_label'));
// 		  	Session::flash('type', 'warning');
// 		  	return redirect()->route('');
// 		}
// 		else {
// 	      	$orders = Orders::where('staffid', '')->whereNotNull('txid')->orderby('created_at', 'desc')->get();
// 	      	return view('staff.pickorders', compact('orders'));
// 	    }
// 	}
// //---------------------------------------------------------------------------------------------------------------------------------------------//
//    	public function takeordersProc(Request $request){
//    		$id = $request->id;
//    		$staffid = $request->staffid;

//    		$orders = Orders::where('id', $id)->update([
//    			'staffid' => $staffid
//    		]);
//    		$message = "Orders Successfully Updated";
// 		return redirect('staff/listorder')->with('status', $message);
// 	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function cancelordersProc(Request $request){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$orders = Orders::where('id', $id)->update([
	   			'staffid' => ''
	   		]);
			$message = "Orders Cancelled";
			return redirect('staff/listorder')->with('success', $message);
		}
	}	
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function ordersummaryinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$nextday = date_format(Carbon::now()->tomorrow(), 'd/m/Y');
			$staffid = Auth::guard('staff')->user()->id; 

	  		$orderscheck = Orders::where('staffid', $staffid)->where('redeemstatus', 'NOTREDEEEMED')->count();
	  		if($orderscheck > 0){
	  			$orders = Orders::where('staffid', $staffid)->where('redeemstatus', 'NOTREDEEEMED')->get();
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
			  	return view('staff.orderssummary', compact('ordersorg', 'dateselected', 'totalsales'));
	  		}
	  		else {
	  			$dateselected = $nextday;
	  			return view('staff.orderssummary', compact('dateselected'));
	  		}
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function ordersummaryProc(Request $request){
   		$servedate = date_format(date_create($request->servedate), 'd/m/Y');
   		$staffid = Auth::guard('staff')->user()->id; 

   		$orderscheck = Orders::where('staffid', $staffid)->where('redeemstatus', 'NOTREDEEEMED')->count();
   		if($orderscheck > 0){
	  		$orders = Orders::where('staffid', $staffid)->where('redeemstatus', 'NOTREDEEEMED')->get();
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
		  	return view('staff.orderssummary', compact('ordersorg', 'dateselected', 'totalsales'));
	  	}
	  	else {
	  		$dateselected = $servedate;
	  		return view('staff.orderssummary', compact('dateselected'));
	  	}
   	}	



//---------------------------------------------------------------------------------------------------------------------------------------------//
	 //Store student data in database
	public function redeeminit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('staff.redeemscanner');}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function redeemProc(Request $request){
   		$studentid = strtoupper($request->studentid);
   		$staffid = Auth::guard('staff')->user()->id; 
   		$currdate = date_format(Carbon::now(), 'd/m/Y');
   		$ordersdet = Orders::where('studentid', $studentid)->where('redeemstatus', 'NOTREDEEEMED')->get();
   		$redorder = null;

   		foreach ($ordersdet as $orders) {
   			$servedate = date_format(date_create($orders->menudate), 'd/m/Y');
   			if ($servedate == $currdate) {$redorder[] = $orders;}
   		}

   		if(!empty($redorder)){
   			foreach ($redorder as $red) {
	   			Orders::where('id', $red['id'])->update([
	   				'redeemstatus'=>'REDEEMED',
	   				'redeemdate'=>Carbon::now(),
	   			]);
	   		}
	   		$studentdet = Student::where('studentid', $studentid)->first();
	   		$parentdet = User::where('id', $studentdet->parentid)->first();
	   		$redeemdetails = $redorder;
	   		Mail::to($parentdet->email, $parentdet->username)->send(new RedeemNotify($parentdet, $redeemdetails));
	   		$message = "Orders Redeemed and notified to Parents";
	   		return view('staff.viewredeem', compact('redorder'))->with('success', $message);
   		}
   		else {
   			$message = "No Today Orders for ".$studentid;
			return redirect('staff/redeem')->with('error', $message);
   		}
   	}
   	public function debug(){
   		$parentdet = User::where('id', 20)->first();
   		$orderid = array(23, 24, 25);
   		foreach ($orderid as $id) {
   			$orders[] = Orders::where('id', $id)->first();
   		}
   		$redeemdetails = $orders;
	   	Mail::to($parentdet->email, $parentdet->username)->send(new RedeemNotify($parentdet, $redeemdetails));
   	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
