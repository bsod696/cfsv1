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
		else {return view('admin.addstudent');}
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
			'primary_parentid'=>$primary_parentid,
			'secondary_parentid'=>$secondary_parentid,
		]);
		$message = "New Student added";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewstudent(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$stud = Student::all();
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
			$id = $request->id;
			$updata = array('updata'=>Student::where('id', $id)->first());
      		return view('admin.editstudent', compact('updata'));
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
			'primary_parentid'=>$primary_parentid,
			'secondary_parentid'=>$secondary_parentid,
		]);
		
		$message = "Student Data Updated";
		return view('admin.dashboard', compact('message'));
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
			Student::find($id)->delete();
			$message = "Student Data Deleted";
			return view('admin.dashboard', compact('message'));
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
			$updata = array('updata'=>Admin::where('id', Auth::guard('admin')->user()->id)->first());
			return view('admin.addpayment', compact('updata'));
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
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewpayment(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$pay = PaymentDet::all();
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
			$updata = array('updata'=>PaymentDet::where('id', $id)->first());
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
		return view('admin.dashboard', compact('message'));
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
			PaymentDet::find($id)->delete();
			$message = "Payment Data Deleted";
			return view('admin.dashboard', compact('message'));
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
			$menu = Menus::all();
			$stud = Student::all();
	      	return view('admin.menuselection', compact('menu', 'stud'));
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
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function vieworderinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::all();
	      	return view('admin.vieworders', compact('orders'));
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
			$updata = array('updata'=>Orders::where('id', $id)->first());
      		return view('admin.editorders', compact('updata'));
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
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function payorderinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::all();
	      	return view('admin.vieworders', compact('orders', 'menu'));
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
			return view('admin.dashboard', compact('message'));
   		}
   		else {
   			$message = "No Default Payment Added";
			return view('admin.dashboard', compact('message'));
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
			Orders::find($id)->delete();
			$message = "Orders Data Deleted";
			return view('admin.dashboard', compact('message'));
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
			$trans = Transaction::all();
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
			$trans = Transaction::where('txid', $payment_txid)->get();
	      	return view('admin.viewtrans', compact('trans'));
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

        $allallergy = Allergy::all();
        foreach ($allallergy as $allall) {
            $allergytype[] = $allall['allergies'];
        }
        foreach ($allergytype as $type) {
            if(in_array($type, $allergy)){$value = true;}
            else{$value = false;}
            $allcomp[$type]=$value;
        }

        //$request->validate([
        //    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //]);
        //$file_name = hash('adler32',$foodname);
        //$imageName = 'FOODP'.$file_name.time().'.'.$request->foodpic->getClientOriginalExtension();
        //$request->foodpic->move(public_path('images/admin_storage'), $imageName);
        
        //$extensionfp1 = strtolower($foodpic->getClientOriginalExtension());

        dd(
        	//$file_name,
        	//$imageName,
        	$foodname,
			$fooddesc,
			$foodtype,
			$foodprice,
			$foodcal,
			$foodpic,
			$allergy,
			serialize($allcomp)
			//$extensionfp1	
        );

        if($extensionfp1 == "jpeg" || $extensionfp1 == "jpg" || $extensionfp1 == "png"){
        	$file_name = hash('adler32',$foodname);
        	$base_url = "http://localhost/cfsv1/public/storage/";

		    $request->foodpic->storeAs('admin_storage/'.$file_name,'FOODP'.$file_name.'.'.$extensionfp1);
		    $fp1_path = public_path('storage/admin_storage/'.$file_name.'/FOODP'.$file_name.'.'.$extensionfp1);

		    Menus::create([
	            'menuname'=>$foodname,
	            'menudesc'=>$fooddesc,
	            'menutype'=>$foodtype,
	            'menuprice'=>$foodprice,
	            'menucalories'=>$foodcal ,
	            'menupic'=>$fp1_path,
	            'allergyid'=>serialize($allcomp),
	        ]);
	        $message = "New Menu added";
	        return view('admin.dashboard', compact('message'));

        }
        else{
        	$message = "
			    		Invalid file for Food Picture. 
			    		Food Picture File Name: ".$foodpic->getClientOriginalName().". 
			    		Expected: image.
			    	";
			return view('admin.dashboard', compact('message'));
        }
    }
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewmenu(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$menus = Menus::all();
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
			$updata = array('updata'=>Menus::where('id', $id)->first());
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
        $foodpic = $request->foodpic;
       
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

        $extensionfp1 = strtolower($foodpic->getClientOriginalExtension());

        if($extensionfp1 == "jpeg" || $extensionfp1 == "jpg" || $extensionfp1 == "png"){
        	$file_name = hash('adler32',$foodname);
        	$base_url = "http://localhost/cfsv1/public/storage/";

		    $request->foodpic->storeAs('admin_storage/'.$file_name,'FOODP'.$file_name.'.'.$extensionfp1);
		    $fp1_path = public_path('storage/admin_storage/'.$file_name.'/FOODP'.$file_name.'.'.$extensionfp1);

		    Menus::create([
	            'menuname'=>$foodname,
	            'menudesc'=>$fooddesc,
	            'menutype'=>$foodtype,
	            'menuprice'=>$foodprice,
	            'menucalories'=>$foodcal ,
	            'menupic'=>$fp1_path,
	            'allergyid'=>serialize($allcomp),
	        ]);
	        $message = "Menu Updated";
	        return view('admin.dashboard', compact('message'));

        }
        else{
        	$message = "
			    		Invalid file for Food Picture. 
			    		Food Picture File Name: ".$foodpic->getClientOriginalName().". 
			    		Expected: image.
			    	";
			return view('admin.dashboard', compact('message'));
        }
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
			Menus::find($id)->delete();
			$message = "Menu Data Deleted";
			return view('admin.dashboard', compact('message'));
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
