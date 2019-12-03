<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
		return redirect('staff/dashboard')->with('status', $message);
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

 		// dd($fullname, $bankname, $banknum, $defaultpay);

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
				return redirect('staff/viewaccount')->with('status', $message);
   			}
   			else {
	   			$message = "Only ONE account can be default at a time";
				return redirect('staff/viewaccount')->with('status', $message);
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
			return redirect('staff/viewaccount')->with('status', $message);
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
			return redirect('staff/viewaccount')->with('status', $message);
		}
	}	



//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function setting(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			//$stud = Student::where('primary_parentid', Auth::user()->id)->orwhere('secondary_parentid', Auth::user()->id)->get();
	      	return view('staff.setting'); //, compact('stud'));
	    }
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
		return redirect('staff/setting')->with('status', $message);
	}




//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewmenusinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menu = Menus::whereNotNull('staffid')->get();
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
			// $menus = Menus::where('staffid', Auth::guard('staff')->user()->id)->get();

			// foreach ($menus as $menu) {
			// 	$orders[] = Orders::where('menuid', $menu['id'])->get();
			// 	$totalqty = array_sum($orders['menuqty']);
			// }

	  		// return view('user.listorders', compact('orders'));
	  		$id = Auth::guard('staff')->user()->id;
	  		$orders = Orders::where('staffid', $id)->get();
	  		return view('staff.listorders', compact('orders'));
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
	      	//dd($id, $orders, $menus);
      		return view('staff.vieworders', compact('updata')); //, 'menus'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function takeordersinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			//$menuid = $request->menuid;
			//$menu = Menus::find($id)->first();
	      	//return view('staff.confirmmenu', compact('menu', 'menu'));
	      	$orders = Orders::where('staffid', '')->whereNotNull('txid')->get();
	      	return view('staff.pickorders', compact('orders'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function takeordersProc(Request $request){
   		$id = $request->id;
   		$staffid = $request->staffid;

   		$orders = Orders::where('id', $id)->update([
   			'staffid' => $staffid
   		]);
   		$message = "Orders Successfully Updated";
		return redirect('staff/listorder')->with('status', $message);
	}
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
			return redirect('staff/listorder')->with('status', $message);
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
   		$ordersdet = Orders::where('studentid', $studentid)->where('staffid', $staffid)->where('redeemstatus', 'NOTREDEEEMED')->get();
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
	   		$message = "Orders Redeemed";
	   		return view('staff.viewredeem', compact('redorder'))->with('status', $message);
   		}
   		else {
   			$message = "No Orders for Today";
			return redirect('staff/redeem')->with('status', $message);
   		}
   	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
