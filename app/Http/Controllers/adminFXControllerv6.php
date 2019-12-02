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

   		if($primary == 'true'){
   			$primary_parentid = $request->parentid;
   			$secondary_parentid = '';
   		}
   		else{
   			$primary_parentid = '';
   			$secondary_parentid = $request->parentid;}
   		
   		$age = Carbon::parse($dob)->age;

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
			'primary_parentid'=>$primary_parentid,
			'secondary_parentid'=>$secondary_parentid,
		]);
		$message = "New Student added";
		return redirect('admin/dashboard')->with('status', $message);
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
			$id = $request->id;
			$updata = array('updata'=>Student::where('id', $id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
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

   		$primary_parentid = $request->primary_parentid;
   		$secondary_parentid = $request->secondary_parentid;
   		
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
			'primary_parentid'=>$primary_parentid,
			'secondary_parentid'=>$secondary_parentid,
		]);
		
		$message = "Student Data Updated";
		return redirect('admin/dashboard')->with('status', $message);
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
			$message = "Student Data Deleted";
			return redirect('admin/dashboard')->with('status', $message);
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
			$updata = array('updata'=>Admin::where('id', Auth::guard('admin')->user()->id)->first()); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
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

   		if($payflag == 'Y'){
   			$parentpaycheck = PaymentDet::where('parentid', $parentid)->where('defaultpay', 'Y')->count();
   			if($parentpaycheck < 1){
   				PaymentDet::create([  //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
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
				return redirect('admin/dashboard')->with('status', $message);
   			}
   			else {
	   			$message = "Only ONE card can be default at a time";
				return redirect('admin/dashboard')->with('status', $message);
	   		}	
   		}
   		else {
   			PaymentDet::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
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
			return redirect('admin/dashboard')->with('status', $message);
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
   		$cvvnum = $request->cvvnum;
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
					'cvvnum'=>$cvvnum,
					'expdate'=>$expdate,
					'defaultpay'=>$payflag,
				]);
				$message = "Payment Details Updated";
				return redirect('admin/dashboard')->with('status', $message);
   			}
   			else {
	   			$message = "Only ONE card can be default at a time";
				return redirect('admin/dashboard')->with('status', $message);
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
				'cvvnum'=>$cvvnum,
				'expdate'=>$expdate,
				'defaultpay'=>$payflag,
			]);
			$message = "Payment Details Updated";
			return redirect('admin/dashboard')->with('status', $message);
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
			return redirect('admin/dashboard')->with('status', $message);
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
		return redirect('admin/dashboard')->with('status', $message);
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function vieworderinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$orders = Orders::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
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
		return redirect('admin/dashboard')->with('status', $message);
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
   		$payflag = PaymentDet::where('parentid', $parent_id)->first(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
   		
   		if($payflag->defaultpay =='Y'){
   			$payment_txid = strtoupper('CFSP'.$parent_id.'D'.$order_id.'H'.Carbon::now()->timestamp.'TX'.getRandomString(5));
	   		
	   		if($payment_txid != ''){$txstatus = 'success';}
	   		else{$txstatus = 'fail';}

	   		$total = number_format($ordersdet->menu_price*$ordersdet->menu_qty, 2, '.', '');

	   		Orders::where('id', $order_id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
	   			'txid'=>$payment_txid,
			]);

			Transaction::create([ //stored procedures: create new row. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:746
				'menuid'=>$ordersdet->menu_id,
				'parentid'=>$parent_id,
				'orderid'=>$order_id, 
				'txstatus'=>$txstatus, 
				'txreference'=>'PAYORDERS', 
				'txamount'=>$total,
				'txid'=>$payment_txid, 
			]);

			$message = "Orders Successfully Paid";
			return redirect('admin/dashboard')->with('status', $message);
   		}
   		else {
   			$message = "No Default Payment Added";
			return redirect('admin/dashboard')->with('status', $message);
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
			return redirect('admin/dashboard')->with('status', $message);
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
			$trans = Transaction::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
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
			$trans = Transaction::where('txid', $payment_txid)->get(); //stored procedures: select * with specific arguments. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:329
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

        $allallergy = Allergy::all(); //stored procedures: select *. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:521
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

        $request->validate(['foodpic' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']);
        $file_name = hash('adler32',$foodname);
        $food = $request->file('foodpic');
        $picpath = $food->storeAs('images/admin/menup', $file_name.'/MENUP'.$file_name.'.'.$food->getClientOriginalExtension(), 'public');
        $fp1_path = 'storage/images/admin/menup/'.$file_name.'/MENUP'.$file_name.'.'.$food->getClientOriginalExtension();

        //dd($request->has('foodpic'), $request->file('foodpic'));
        //$food = $request->file('foodpic');
        //dd($food);
		//$picpath = $food->storeAs('images', $food->getClientOriginalName());

        //$imageName = time().'.'.file_get_contents($request->foodpic)->extension();
        //dd($imageName);
        //$request->foodpic->move(public_path('images'), $imageName);
        //return back()->with('success','You have successfully upload image.')->with('image',$imageName);

   //      dd(
   //      	asset('images/admin/menup/14ba03c7/MENUP14ba03c7.jpg'),
   //      	//$file_name,
   //      	//$imageName,
   //      	$foodname,
			// $fooddesc,
			// $foodtype,
			// $foodprice,
			// $foodcal,
			// $foodpic,
			// $picpath,
			// $fp1_path,
			// $allergy,
			// serialize($allcomp)
			// //$extensionfp1	
   //      );

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
	    return redirect('admin/dashboard')->with('status', $message);

   //      }
   //      else{
   //      	$message = "
			//     		Invalid file for Food Picture. 
			//     		Food Picture File Name: ".$foodpic->getClientOriginalName().". 
			//     		Expected: image.
			//     	";
			// return redirect('admin/dashboard')->with('status', $message);
   //      }
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

        Menus::find($id)->update([ //stored procedures: update rows. ref=vendor\laravel\frameworks\src\Illuminate\Database\Eloquent\Builder.php:772
	        'menuname'=>$foodname,
	        'menudesc'=>$fooddesc,
	        'menutype'=>$foodtype,
	        'menuprice'=>$foodprice,
	        'menucalories'=>$foodcal ,
	        'menupic'=>$fp1_path,
	        'allergyid'=>serialize($allcomp),
	    ]);
	    $message = "Menu data updated";
	    return redirect('admin/dashboard')->with('status', $message);
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
			return redirect('admin/dashboard')->with('status', $message);
		}
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
