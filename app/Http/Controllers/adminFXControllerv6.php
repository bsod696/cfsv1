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
			$stud = Student::where('primary_parentid', Auth::user()->id)->orwhere('secondary_parentid', Auth::user()->id)->get();
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
     //Store student data in database
    public function stormenuinit(){
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
