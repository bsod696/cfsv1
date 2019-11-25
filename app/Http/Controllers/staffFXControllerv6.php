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
	 //Store student data in database
	public function storeaccountinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('staff.addpayment');}
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
			'bankname'=>$cardtype,
			'banknum'=>$cardnum,
			'defaultpay'=>$defaultpay,
		]);
		$message = "New Account Details added";
		return view('staff.dashboard', compact('message'));
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
	      	return view('staff.viewmenus', compact('menu'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function takemenusinit(){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menuid = $request->menuid;
			$menu = Menus::find($id)->first();
	      	return view('staff.confirmmenus', compact('menu', 'menu'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function takemenusProc(Request $request){
   		$menuid = $request->menuid;
   		$staffid = $request->staffid;

   		$menusdet = Menus::where('', $menuid)->update([
   			'staffid' => $staffid
   		]);
   		$message = "Menus Successfully Updated";
			return view('staff.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function cancelmenusProc(Request $request){
		if (!Auth::guard('staff')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menuid = $request->menuid;
			$menusdet = Menus::where('id', $menuid)->update([
	   			'staffid' => ''
	   		]);
			$message = "Orders Cancelled";
			return view('staff.dashboard', compact('message'));
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
			$menus = Menus::where('staffid', Auth::guard('staff')->user()->id)->get();

			foreach ($menus as $menu) {
				$orders[] = Orders::where('menuid', $menu['id'])->get();
				$totalqty = array_sum($orders['menuqty']);
			}

	      	return view('user.listorders', compact('orders'));
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
			$orderid = $request->orderid;
			$orders = Transaction::where('orderid', $orderid)->get();
	      	return view('user.viewtrans', compact('trans'));
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
		else {return view('staff.redeem');}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
   	public function redeemProc(Request $request){
   		$studentid = $request->studentid;

   		$ordersdet = Orders::where('studentid', $studentid)->get();

   		foreach ($ordersdet as $orders) {
   			$menusdet  = Menus::where('id', $orders['menuid'])->first();
   			if($menusdet->staffid == Auth::guard('staff')->user()->id){
   				$ordersd = Orders::where('id', $ordersdet['id'])->update([
   					'redeemstatus'=>'REDEEMED',
   					'redeemdate'=>Carbon::now(),
   				]);
   			}
   		}
		$message = "Orders Redeemed";
		return view('staff.dashboard', compact('message'));
	}

//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
