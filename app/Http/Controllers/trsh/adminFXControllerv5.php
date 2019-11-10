<?php

namespace App\Http\Controllers;

use NemAPI\Apostille;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\AssetBlockData;
use App\AssetData;
use App\AssetTransaction;
use App\IdentityBlockData;
use App\IdentityData;
use App\IdentityTransaction;
use PDF;
use Auth;
use Session;
use Carbon\Carbon;

class adminFXControllerv5 extends Controller
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
//-----------------------------------------------------------------------------------------------------------------------------------------------//
	//NEM Infra
	public function getnodeinfo(){
    if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
      Session::flash('type', 'warning');
      return redirect()->route('');
    }
    else {
      $json_url = "http://178.128.104.194:7890/node/extended-info";
      //get JSON data
      $json = file_get_contents($json_url);
      $data = json_decode($json);
      print_r ($json);
    }
  }
	public function getblockheight(){
    if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
      Session::flash('type', 'warning');
      return redirect()->route('');
    }
    else {
    	$json_url = "http://178.128.104.194:7890/chain/height";
      //get JSON data
      $json = file_get_contents($json_url);
      $data = json_decode($json);
      print_r ($json);
    }
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------//
	//Store Identity data in database
	public function storeidentityinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
	    	$countrylist = array('countrylist' =>  DB::table('currency')->get());
	    	return view('admin.formaddidentity', $countrylist);
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function storeidentity(){return view('admin.formaddidentity');}
   	public function storeidentityProc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$usrname = $request->usrname;
   		$fullname = $request->fname;
   		$idtype = $request->idtype;
   		$idnum = $request->idnum;
   		$gender = $request->gender;
   		$dob = $request->dob;
   		$addrline1 = $request->addrline1;
   		$addrline2 = $request->addrline2;
   		$postcode = $request->postcode;
   		$city = $request->city;
   		$state = $request->state;
   		$country = $request->country;
   		$iddocs1 = $request->iddocs1;
   		$iddocs2 = $request->iddocs2;
   		$bankname1 = $request->bankname1;
   		$bankaccnum1 = $request->bankaccnum1;
   		$banknation1 = $request->banknation1;
   		$accdocs1 = $request->accdocs1;
   		$selfie_usr = $request->selfie_user;

   		$json_url = "http://178.128.104.194:7890/account/generate";
        $json = file_get_contents($json_url);
        $data = json_decode($json);
        $addr = $data->address;
        $pubk = $data->publicKey;
        $privk = $data->privateKey;

   		//Uploaded file extension grabber
   		$extensionid1 = strtolower($iddocs1->getClientOriginalExtension());
   		$extensionid2 = strtolower($iddocs2->getClientOriginalExtension());
		$extensionacc1 = strtolower($accdocs1->getClientOriginalExtension());
		$extensionselfie = strtolower($selfie_usr->getClientOriginalExtension());
		//Filter by file extension
		if(($extensionid1 == "jpeg" || $extensionid1 == "jpg" || $extensionid1 == "png") && ($extensionid2 == "jpeg" || $extensionid2 == "jpg" || $extensionid2 == "png")){
	    	if($extensionacc1 == "jpeg" || $extensionacc1 == "jpg" || $extensionacc1 == "png" || $extensionacc1 == "pdf"){
	    		if($extensionselfie == "jpeg" || $extensionselfie == "jpg" || $extensionselfie == "png"){
	    			$file_name = hash('sha1',$idnum);
	    			$base_url = "http://localhost/chainsetv1/public/storage/";

		    		//ID Front
		    		$request->iddocs1->storeAs('upidentity/'.$file_name,'ID_1FRONT'.$file_name.'.'.$extensionid1);
		            $iddocs1path = public_path('storage/upidentity/'.$file_name.'/ID_1FRONT'.$file_name.'.'.$extensionid1);
			        $sourceiddocs1 = \Tinify\fromFile($iddocs1path);
	    			$sourceiddocs1->toFile($iddocs1path);
	    			$iddocs1 = file_get_contents($iddocs1->getRealPath());
	    			$id1str = (string)Image::make($iddocs1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionid1);
		            $encid1 = "upidentity/".$file_name."/ID_1FRONT".$file_name.".".$extensionid1; //base64_encode($id1str);

		            //ID bACK
		            $request->iddocs2->storeAs('upidentity/'.$file_name,'ID_2BACK'.$file_name.'.'.$extensionid2);
		            $iddocs2path = public_path('storage/upidentity/'.$file_name.'/ID_2BACK'.$file_name.'.'.$extensionid2);
			        $sourceiddocs2 = \Tinify\fromFile($iddocs2path);
	    			$sourceiddocs2->toFile($iddocs2path);
			        $iddocs2 = file_get_contents($iddocs2->getRealPath());
		           	$id2str = (string)Image::make( $iddocs2 )->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionid2);
		            $encid2 = "upidentity/".$file_name."/ID_2BACK".$file_name.".".$extensionid2; //base64_encode($id2str);

		            //Bank docs1
		            $request->accdocs1->storeAs('upidentity/'.$file_name,'ACC_1STATE'.$file_name.'.'.$extensionacc1);
		            $accdocs1path = public_path('storage/upidentity/'.$file_name.'/ACC_1STATE'.$file_name.'.'.$extensionacc1);
		            if($extensionacc1 != "pdf"){
			            $sourceaccdocs1 = \Tinify\fromFile($accdocs1path);
	    				$sourceaccdocs1->toFile($accdocs1path);
			            $accdocs1 = file_get_contents($accdocs1->getRealPath());
		           		$acc1str = (string)Image::make($accdocs1)->resize( 300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionacc1);
		           	}
		            $encacc1 ="upidentity/".$file_name."/ACC_1STATE".$file_name.".".$extensionacc1; //base64_encode($acc1str);

		            //Selfie picture
		            $request->selfie_user->storeAs('upidentity/'.$file_name,'SELFIE'.$file_name.'.'.$extensionselfie);
		            $selfie_usrpath = public_path('storage/upidentity/'.$file_name.'/SELFIE'.$file_name.'.'.$extensionselfie);
			        $sourceselfie_usr = \Tinify\fromFile($selfie_usrpath);
	    			$sourceselfie_usr->toFile($selfie_usrpath);
			        $selfie_usr = file_get_contents($selfie_usr->getRealPath());
		           	$selfstr = (string) Image::make($selfie_usr)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionselfie);
		            $encselfie = "upidentity/".$file_name."/SELFIE".$file_name.".".$extensionselfie; //base64_encode($selfstr);

			    	IdentityData::create([
			    			'usrname'=>$usrname,
		                    'fname'=>$fullname,
							'idType'=>$idtype,
							'idNum'=>$idnum,
							'gender'=>$gender,
							'dob'=>$dob,
							'addrline1'=>$addrline1,
							'addrline2'=>$addrline2,
							'postcode'=>$postcode,
							'city'=>$city,
							'state'=>$state,
							'country'=>$country,
							'iddocs_front'=> $encid1,
							'iddocs_back'=> $encid2,
							'bankname1'=> $bankname1,
							'bankaccnum1'=>$bankaccnum1,
							'banknation1'=> $banknation1,
							'accdocs1'=> $encacc1,
							'selfie_user'=> $encselfie,
							'upfile_name'=> $file_name
					]);

					IdentityBlockData::create([
			    			'usrname'=>$usrname,
		                    'fname'=>$fullname,
		                    'idType'=>$idtype,
		                    'idNum'=>$idnum,
		                    'gender'=>$gender,
							'idaddress'=>$addr,
							'idpub'=>bin2hex($pubk),
							'idpriv'=>bin2hex($privk)
							
					]);

		            $message = "New Identity added";
		            return view('admin.dashboard', compact('message'));
	        	}
	    		else{
			    	$message = "
			    					<br />Invalid file for Selfie
			    					<br />Selfie File Name: $selfie_usr->getClientOriginalName()
			    					<br />Expected: image
			    				";
			    	return view('admin.dashboard', compact('message'));
	    		} 
	    	}
	    	else{
		    	$message = "
		    					<br />Invalid file for Account Statement
		    					<br />Account Statement File Name: $accdocs->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
	    	} 
	    } 
	    else{
		    $message = "
		    				<br />Invalid file for ID Front and Back Photo
		    				<br />ID Back Photo File Name: $iddocs2->getClientOriginalName()
		    				<br />ID Back File Name: '.$iddocs2->getClientOriginalName()
		    				<br />Expected: image
		    			";
		    return view('admin.dashboard', compact('message'));
	    }
	}
//-------------------------------------------------------------------------------------------------------------------------------------------//
//Update Identity data in database
	public function updateidentitydata(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('identity_listing')->where('id', $id)->first());
      		return view('admin.formsubsupdateidentityDATA', compact('updata'));
      	}
	}
   	public function updateidentitydataProc(Request $request){
   		$id = $request->id;
   		$fullname = $request->fname;
   		$idtype = $request->idtype;
   		$idnum = $request->idnum;
   		$gender = $request->gender;
   		$dob = $request->dob;
   		$addrline1 = $request->addrline1;
   		$addrline2 = $request->addrline2;
   		$postcode = $request->postcode;
   		$city = $request->city;
   		$state = $request->state;
   		$country = $request->country;
   		$bankname1 = $request->bankname1;
   		$bankaccnum1 = $request->bankaccnum1;
   		$banknation1 = $request->banknation1;

	    DB::table('identity_listing')->where('id', $id)->update([
			'fname'=>$fullname,
			'idType'=>$idtype,
			'idNum'=>$idnum,
			'gender'=>$gender,
			'dob'=>$dob,
			'addrline1'=>$addrline1,
			'addrline2'=>$addrline2,
			'postcode'=>$postcode,
			'city'=>$city,
			'state'=>$state,
			'country'=>$country,
			'bankname1'=> $bankname1,
			'bankaccnum1'=>$bankaccnum1,
			'banknation1'=> $banknation1,
		]);

		$message = "Identity Data Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update user ID Front image in database
	public function updateimgid1(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('identity_listing')-where('id', $id)->first());
      		return view('admin.formsubsupdateIMGid1', compact('updata'));
      	}
	}
   	public function updateimgid1Proc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$id = $request->id;
   		$idnum = $request->idnum;
   		$iddocs1 = $request->iddocs1;
   		//Upload file if not empty
   		$file_name = hash('sha1',$idnum);
   		//ID Front
   		if($iddocs1 != ''){
   			$extensionid1 = strtolower($iddocs1->getClientOriginalExtension());
   			if($extensionid1 == "jpeg" || $extensionid1 == "jpg" || $extensionid1 == "png"){
		            $request->iddocs1->storeAs('upidentity/'.$file_name,'ID_1FRONT'.$file_name.'.'.$extensionid1);
		            $iddocs1path = public_path('storage/upidentity/'.$file_name.'/ID_1FRONT'.$file_name.'.'.$extensionid1);
			        $sourceiddocs1 = \Tinify\fromFile($iddocs1path);
	    			$sourceiddocs1->toFile($iddocs1path);
	    			$iddocs1 = file_get_contents($iddocs1->getRealPath());
	    			$id1str = (string)Image::make($iddocs1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionid1);
		            $encid1 = "upidentity/".$file_name."/ID_1FRONT".$file_name.".".$extassetphoto1; //base64_encode($id1str);
   			}
   			else{
		    	$message = "
		    					<br />Invalid file for ID Front Photo
		    					<br />ID Back Photo File Name: '.$iddocs1->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
	    	} 
   		}
   		else{$encid1 = $request->iddocs1;}
		DB::table('identity_listing')
			->where('id', $id)
		    ->update([
				'iddocs_front'=> $encid1,
				'upfile_name'=> $file_name
		    ]);
		$message = "ID Front Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update user ID Back image in database
	public function updateimgid2(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('identity_listing')->where('id', $id)->first());
      		return view('admin.formsubsupdateIMGid2', compact('updata'));
      	}
	}
   	public function updateimgid2Proc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$id = $request->id;
   		$idnum = $request->idnum;
   		$iddocs2 = $request->iddocs2;
   		//Upload file if not empty
   		$file_name = hash('sha1',$idnum);
   		//ID Back
   		if($iddocs2 != ''){
   			$extensionid2 = strtolower($iddocs2->getClientOriginalExtension());
   			if($extensionid2 == "jpeg" || $extensionid2 == "jpg" || $extensionid2 == "png"){
		         	$request->iddocs2->storeAs('upidentity/'.$file_name,'ID_2BACK'.$file_name.'.'.$extensionid2);
		            $iddocs2path = public_path('storage/upidentity/'.$file_name.'/ID_2BACK'.$file_name.'.'.$extensionid2);
			        $sourceiddocs2 = \Tinify\fromFile($iddocs2path);
	    			$sourceiddocs2->toFile($iddocs2path);
			        $iddocs2 = file_get_contents($iddocs2->getRealPath());
		           	$id2str = (string)Image::make( $iddocs2 )->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionid2);
		            $encid2 = "upidentity/".$file_name."/ID_2BACK".$file_name.".".$extensionid2; //base64_encode($id2str);
		    }
		    else{
		    	$message = "
		    					<br />Invalid file for ID Back Photo
		    					<br />ID Back Photo File Name: '.$iddocs2->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
	    	}
   		}
   		else{$encid2 = $request->iddocs2;}
		DB::table('identity_listing')
			->where('id', $id)
		    ->update([
				'iddocs_back'=> $encid2,
				'upfile_name'=> $file_name
		    ]);
		$message = "ID Back Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update user Account Statement image in database
	public function updateimgacc1(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('identity_listing')->where('id', $id)->first());
      		return view('admin.formsubsupdateIMGacc1', compact('updata'));
      	}
	}
   	public function updateimgacc1Proc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$id = $request->id;
   		$idnum = $request->idnum;
   		$accdocs1 = $request->accdocs1;
   		//Upload file if not empty
   		$file_name = hash('sha1',$idnum);
   		//Bank docs1
		if($accdocs1 != ''){
			$extensionacc1 = strtolower($accdocs1->getClientOriginalExtension());
			if($extensionacc1 == "jpeg" || $extensionacc1 == "jpg" || $extensionacc1 == "png" || $extensionacc1 == "pdf"){
		         	$request->accdocs1->storeAs('upidentity/'.$file_name,'ACC_1STATE'.$file_name.'.'.$extensionacc1);
		            $accdocs1path = public_path('storage/upidentity/'.$file_name.'/ACC_1STATE'.$file_name.'.'.$extensionacc1);
		            if($extensionacc1 != "pdf"){
			            $sourceaccdocs1 = \Tinify\fromFile($accdocs1path);
	    				$sourceaccdocs1->toFile($accdocs1path);
			            $accdocs1 = file_get_contents($accdocs1->getRealPath());
		           		$acc1str = (string)Image::make($accdocs1)->resize( 300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionacc1);
		           	}
		            $encacc1 ="upidentity/".$file_name."/ACC_1STATE".$file_name.".".$extensionacc1; //base64_encode($acc1str);
		    }
		    else{
		    	$message = "
		    					<br />Invalid file for Bank1 Account Statement
		    					<br />Account Statement File Name: '.$accdocs1->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
		    }
		}
		DB::table('identity_listing')
			->where('id', $id)
		    ->update([
				'accdocs1'=> $encacc1,
				'upfile_name'=> $file_name
		    ]);
		$message = "Account Statement for Bank1 Updated";
		return view('admin.dashboard', compact('message'));
		//return redirect()->back();//->with('success', 'File uploaded successfully.');
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update user Selfie image in database
	public function updateimgself(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('identity_listing')-where('id', $id)->first());
      		return view('admin.formsubsupdateIMGself', compact('updata'));
      	}
	}
   	public function updateimgselfProc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$id = $request->id;
   		$idnum = $request->idnum;
   		$selfie_usr = $request->selfie_user;
   		//Upload file if not empty
   		$file_name = hash('sha1',$idnum);
		//Selfie picture
		if($selfie_usr != ''){
			$extensionselfie = strtolower($selfie_usr->getClientOriginalExtension());
			if($extensionselfie == "jpeg" || $extensionselfie == "jpg" || $extensionselfie == "png"){
		        $request->selfie_user->storeAs('upidentity/'.$file_name,'SELFIE'.$file_name.'.'.$extensionselfie);
		        $selfie_usrpath = public_path('storage/upidentity/'.$file_name.'/SELFIE'.$file_name.'.'.$extensionselfie);
		        $sourceselfie_usr = \Tinify\fromFile($selfie_usrpath);
    			$sourceselfie_usr->toFile($selfie_usrpath);
		        $selfie_usr = file_get_contents($selfie_usr->getRealPath());
		        $selfstr = (string) Image::make($selfie_usr)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionselfie);
		        $encselfie = "upidentity/".$file_name."/SELFIE".$file_name.".".$extensionselfie; //base64_encode($selfstr);
		    }
		    else{
		    	$message = "
		    					<br />Invalid file for Selfie
		    					<br />Selfie File Name: '.$selfie_usr->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
	    	}
		}
		else{$encselfie = $request->selfie_user;}
		DB::table('identity_listing')
			->where('id', $id)
		    ->update([
				'selfie_user'=> $encselfie,
				'upfile_name'=> $file_name
		    ]);
		$message = "Selfie Image Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
  //Update User Submission Status
  public function viewuserIdentity(){
    if (!Auth::guard('admin')) {
	 Session::flash('message', trans('errors.session_label'));
     Session::flash('type', 'warning');
	 return redirect()->route('');
	}
    else {
      $submiss = DB::table('identity_listing')->get();
      return view('admin.admin-identityView', compact('submiss'));
    }
  }
  public function updateidentitystatus(Request $request){
    $id = $request->id;
    $submissbyid = array('submissbyid'=>DB::table('identity_listing')->where('id', $id)->first());
    return view('admin.formupdateidentitystat', compact('submissbyid'));
  }
   public function updateidentitystatusProc(Request $request){
    $id = $request->id;
    $status = $request->status;
    DB::table('identity_listing')->where('id', $id)->update(['status'=>$status]);
    $message = "User Identity Status Updated";
    return view('admin.dashboard', compact('message'));
  }
//---------------------------------------------------------------------------------------------------------------------------------------------//
  //Encode user data from database to JSON
  public function viewuseridentitytoencode(){
    if (!Auth::guard('admin')) {
	 Session::flash('message', trans('errors.session_label'));
	 Session::flash('type', 'warning');
	 return redirect()->route('');
	}
    else {
      $submissenc = DB::table('identity_listing')->where('status', 'CHECKED')->get();
      return view('admin.admin-identityViewenc', compact('submissenc'));
    }
  }
	public function encidentityJSON(Request $request){
    $id = $request->id;
    $submissencbyid = array('submissencbyid'=>DB::table('identity_listing')->where('id', $id)->first());
    return view('admin.formencodeidentitydat', compact('submissencbyid'));
  }
	public function encidentityJSONProc(Request $request){
      $id = $request->id;
      $usrname = $request->usrname;
      DB::table('identity_listing')->where('id', $id)->update(['status'=>'READY']);
      $usr_verify = DB::table('identity_listing')->where('id', $id)->first();
      $fullname = $usr_verify->fname;
   		$idtype = $usr_verify->idType;
   		$idnum = $usr_verify->idNum;
   		$gender = $usr_verify->gender;
   		$dob = $usr_verify->dob;
   		$addrline1 = $usr_verify->addrline1;
   		$addrline2 = $usr_verify->addrline2;
   		$postcode = $usr_verify->postcode;
   		$city = $usr_verify->city;
   		$state = $usr_verify->state;
   		$country = $usr_verify->country;
   		$iddocs1 = $usr_verify->iddocs_front;
   		$iddocs2 = $usr_verify->iddocs_back;
   		$bankname1 = $usr_verify->bankname1;
   		$bankaccnum1 = $usr_verify->bankaccnum1;
   		$banknation1 = $usr_verify->banknation1;
   		$accdocs1 = $usr_verify->accdocs1;
   		$selfie_usr = $usr_verify->selfie_user;
   		$file_name = $usr_verify->upfile_name;
      $usr_jsondat = json_encode($usr_verify); //original data
      $encdat = bin2hex($usr_jsondat);
      $userblock = DB::table('identity_transaction')->where('idNum', $idnum)->first();
      if($userblock != ''){
        DB::table('identity_transaction')->where('idNum', $idnum)
          ->update([
            'usrname'=>$usrname,
            'fname'=>$fullname,
            'idType'=>$idtype,
            'idNum'=>$idnum,
            'usrpayload'=>$encdat
        ]);
        $message = "Identity Submission Successfully Encoded";
        return view('admin.dashboard', compact('message'));
      }
      else{
        IdentityTransaction::create([
          'usrname'=>$usrname,
          'fname'=>$fullname,
          'idType'=>$idtype,
          'idNum'=>$idnum,
          'usrpayload'=>$encdat    
        ]);
        $message = "Identity Submission Successfully Encoded";
        return view('admin.dashboard', compact('message'));
      }
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------//
    //Sign data to a block
    public function viewuseridentitytosign(){
      if (!Auth::guard('admin')) {
		Session::flash('message', trans('errors.session_label'));
		Session::flash('type', 'warning');
		return redirect()->route('');
	  }
      else {
        $submisssign = DB::table('identity_listing')->where('status', 'READY')->get();
        return view('admin.admin-identityViewsign', compact('submisssign'));
      }
    }
    public function signidentityBlock(Request $request) {
      $id = $request->id;
      $submisssignbyid = array('submisssignbyid'=>DB::table('identity_listing')->where('id', $id)->first());
      return view('admin.formsignidentity', compact('submisssignbyid'));
    }
    public function signidentityBlockProc(Request $request) {
      $id = $request->id;
      DB::table('identity_listing')->where('idNum', $id)->update(['status'=>'SIGNED']);
      $chainsetv1 = DB::table('identity_blockdet')->where('id', $id)->first();
      
    	$net = 'testnet';
	    $NEMpubkey = $chainsetv->idpub;//'d786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = $chainsetv->idpriv;//'300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $address = $chainsetv->idaddress;//'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $nem = new TransactionBuilder($net);
	    $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	    $nem->ImportAddr($address);
	    $nem->amount = 0.000001; // 1XEM
		  $nem->payload = 'fe'.$chainsetv1->usrpayload;
	    $fee = $nem->EstimateFee();
	    $result = $nem->SendNEMver1();
	   	if($result != false){
		    $analysis = $nem->analysis($result);
        $txstatus = $analysis['status'];
		    $txhash = $analysis['txid'];
        $txcost = floatval($nem->amount + $fee);
		    if ($analysis['status']) {
		    	$chainsetv1 = DB::table('identity_transaction')->where('idNum', $idnum)->first();
	            DB::table('identity_transaction')
	                ->where('idNum', $idnum)
	                ->update([
                    'usrtxhash' => $txhash,
                    'usrtxcost' => $txcost
                  ]);
          $message = "
                        <b>RESULT</b>
                        <br />Transaction Success !
                        <br />FEE : $fee XEM
                        <br />TXID : <a href='http://bob.nem.ninja:8765/#/transfer/$txhash' target='blank'>$txhash</a>
                        <br />Please wait for for a few minutes before clicking the link to view the transaction above
                      ";
          return view('admin.dashboard', compact('message'));
		    } 
        else {
            $message = "
                          <b>RESULT</b>
                          <br />Transaction Failed !
                          <br />Status Message : $txstatus
                        ";
            return view('admin.dashboard', compact('message'));
        }
		  }
      else {
        $message = "
                      <b>RESULTS</b>
                      <br />You are not authorized to process this function
                    ";
        return view('admin.dashboard', compact('message'));
      }
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------//
















//ASSET
//-----------------------------------------------------------------------------------------------------------------------------------------------//
	//Store asset data in database
	public function storeassetinit(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
	    	$countrylist = array('countrylist' =>  DB::table('currency')->get());
	    	return view('admin.formaddasset', $countrylist);
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function storeassetinfo(){return view('admin.formaddasset');}
   	public function storeassetinfoProc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$usrname = $request->usrname;

   		$json_url = "http://178.128.104.194:7890/account/generate";
        $json = file_get_contents($json_url);
        $data = json_decode($json);
        $addr = $data->address;
        $pubk = $data->publicKey;
        $privk = $data->privateKey;

   		$prodID = $request->prodID;
   		$serialNum = $addr;
   		$manufacDate = $request->manufacDate;
   		$manufacOrigin = $request->manufacOrigin;
   		$assetphoto1 = $request->assetphoto1;
   		$assetphoto2 = $request->assetphoto2;
   		$assettype = $request->assettype;
   		$assetdetails = $request->assetdetails;
   		$assetupdate = $request->assetupdate;
   		$assetowner = $request->assetowner;
   		$assetcolor = $request->assetcolor;
   		$assetvalue = $request->assetvalue;

   		//Uploaded file extension grabber
   		$extassetphoto1 = strtolower($assetphoto1->getClientOriginalExtension());
   		$extassetphoto2 = strtolower($assetphoto2->getClientOriginalExtension());
		
		//Filter by file extension
		if(($extassetphoto1 == "jpeg" || $extassetphoto1 == "jpg" || $extassetphoto1 == "png" || $extassetphoto1 == "pdf") && ($extassetphoto2 == "jpeg" || $extassetphoto2 == "jpg" || $extassetphoto2 == "png" || $extassetphoto2 == "pdf")){

	    			$file_name = hash('sha1',$prodID);
	    			$base_url = "http://localhost/chainsetv1/public/storage/";

		    		//Asset Front
		            $request->assetphoto1->storeAs('upasset/'.$file_name,'PHOTO_FRONT'.$file_name.'.'.$extassetphoto1);
		            $asset1path = public_path('storage/upasset/'.$file_name.'/PHOTO_FRONT'.$file_name.'.'.$extassetphoto1);
		            $sourceasset1 = \Tinify\fromFile($asset1path);
    				$sourceasset1->toFile($asset1path);
    				$assetphoto1 = file_get_contents($assetphoto1->getRealPath());
		            $id1str = (string)Image::make($assetphoto1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extassetphoto1);
		            $encasset1 = "upasset/".$file_name."/PHOTO_FRONT".$file_name.".".$extassetphoto1; //base64_encode($id1str);


		            //Asset Back
		            $request->assetphoto2->storeAs('upasset/'.$file_name,'PHOTO_BACK'.$file_name.'.'.$extassetphoto2);
		            $asset2path = public_path('storage/upasset/'.$file_name.'/PHOTO_BACK'.$file_name.'.'.$extassetphoto2);
		            $sourceasset2 = \Tinify\fromFile($asset2path);
    				$sourceasset2->toFile($asset2path);
    				$assetphoto1 = file_get_contents($assetphoto2->getRealPath());
		            $id2str = (string)Image::make($assetphoto2)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extassetphoto2);
		            $encasset2 = "upasset/".$file_name."/PHOTO_BACK".$file_name.".".$extassetphoto2; //base64_encode($id1str);

			    	AssetData::create([
			    			'contributor'=>$usrname,
		                    'prodID'=>$prodID,
		                    'serialNum'=>$serialNum,
							'manufacDate'=>$manufacDate,
							'manufacOrigin'=>$manufacOrigin,
							'assetphoto1'=>$encasset1,
							'assetphoto2'=>$encasset2,
							'assettype'=>$assettype,
							'assetdetails'=>$assetdetails,
							'assetupdate'=>$assetupdate,
							'assetowner'=>$assetowner,
							'assetcolor'=>$assetcolor,
							'assetvalue'=>$assetvalue,
							'upfile_name'=> $file_name,
							'status'=>'INCOMPLETE'
					]);

					AssetBlockData::create([
			    			'contributor'=>$usrname,
		                    'prodID'=>$prodID,
		                    'serialNum'=>$serialNum,
		                    'assettype'=>$assettype,
							'assetpub'=>bin2hex($pubk),
							'assetpriv'=>bin2hex($privk)
							
					]);

		            $message = "New Asset added";
		            return view('admin.dashboard', compact('message'));
	    }
	    else{
		    $message = "
		    				<br />Invalid file for Asset Front and Back Photo
		    				<br />Asset Back Photo File Name: $assetphoto1->getClientOriginalName()
		    				<br />Asset Back File Name: '.$assetphoto2->getClientOriginalName()
		    				<br />Expected: image/pdf
		    			";
		    return view('admin.dashboard', compact('message'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Asset data in database
	public function updateassetdata(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('asset_listing')->where('id', $id)->where('status', '!=' ,'SIGNED')->first());
      		return view('admin.formsubsupdateassetDATA', compact('updata'));
      	}
	}
   	public function updateassetdataProc(Request $request){
   		$id = $request->id;
   		$contributor = $request->contributor;
   		$prodID = $request->prodID;
   		$manufacDate = $request->manufacDate;
   		$manufacOrigin = $request->manufacOrigin;
   		$assettype = $request->assettype;
   		$assetdetails = $request->assetdetails;
   		$assetupdate = $request->assetupdate;
   		$assetowner = $request->assetowner;
   		$assetcolor = $request->assetcolor;
   		$assetvalue = $request->assetvalue;
	    DB::table('asset_listing')->where('id', $id)->update([
			'contributor'=>$contributor,
			'prodID'=>$prodID,
			'manufacDate'=>$manufacDate,
			'manufacOrigin'=>$manufacOrigin,
			'assettype'=>$assettype,
			'assetdetails'=>$assetdetails,
			'assetupdate'=>$assetupdate,
			'assetowner'=>$assetowner,
			'assetcolor'=>$assetcolor,
			'assetvalue'=>$assetvalue
		]);
		$message = "Asset Data Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Asset Front image in database
	public function updateassimg1(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('asset_listing')->where('id', $id)->first());
      		return view('admin.formsubsupdateIMGassetfront', compact('updata'));
      	}
	}
   	public function updateassimg1Proc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$id = $request->id;
   		$prodID = $request->prodID;
   		$assetphoto1 = $request->assetphoto1;
   		//Upload file if not empty
   		//Asset Front
   		if($assetphoto1 != ''){
   			$extassetphoto1 = strtolower($assetphoto1->getClientOriginalExtension());
   			if($extassetphoto1 == "jpeg" || $extassetphoto1 == "jpg" || $extassetphoto1 == "png" || $extassetphoto1 == "pdf"){
		            $file_name = hash('sha1',$prodID);
	    			$base_url = "http://localhost/chainsetv1/public/storage/";
		    		//Asset Front
		            $request->assetphoto1->storeAs('upasset/'.$file_name,'PHOTO_FRONT'.$file_name.'.'.$extassetphoto1);
		            $asset1path = public_path('storage/upasset/'.$file_name.'/PHOTO_FRONT'.$file_name.'.'.$extassetphoto1);
		            $sourceasset1 = \Tinify\fromFile($asset1path);
    				$sourceasset1->toFile($asset1path);
    				$assetphoto1 = file_get_contents($assetphoto1->getRealPath());
		            $id1str = (string)Image::make($assetphoto1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extassetphoto1);
		            $encasset1 = "upasset/".$file_name."/PHOTO_FRONT".$file_name.".".$extassetphoto1; //base64_encode($id1str);
   			}
   			else{
		    	$message = "
		    					<br />Invalid file for Asset Front Photo
		    					<br />Asset Front Photo File Name: '.$assetphoto1->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
	    	} 
   		}
   		else{$encid1 = $request->iddocs1;}
		DB::table('asset_listing')
			->where('id', $id)
		    ->update([
				'assetphoto1'=> $encasset1,
				'upfile_name'=> $file_name
		    ]);
		$message = "Asset Front Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update Asset Back image in database
	public function updateassimg2(Request $request){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$id = $request->id;
			$updata = array('updata'=>DB::table('asset_listing')->where('id', $id)->first());
      		return view('admin.formsubsupdateIMGassetback', compact('updata'));
      	}
	}
   	public function updateassimg2Proc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$id = $request->id;
   		$prodID = $request->prodID;
   		$assetphoto2 = $request->assetphoto2;
   		//Upload file if not empty
   		//Asset Back
   		if($assetphoto2 != ''){
   			$extassetphoto2 = strtolower($assetphoto2->getClientOriginalExtension());
   			if($extassetphoto2 == "jpeg" || $extassetphoto2 == "jpg" || $extassetphoto2 == "png" || $extassetphoto2 == "pdf"){
		            $file_name = hash('sha1',$prodID);
	    			$base_url = "http://localhost/chainsetv1/public/storage/";
		    		//Asset Back
		            $request->assetphoto2->storeAs('upasset/'.$file_name,'PHOTO_BACK'.$file_name.'.'.$extassetphoto2);
		            $asset1path = public_path('storage/upasset/'.$file_name.'/PHOTO_BACK'.$file_name.'.'.$extassetphoto2);
		            $sourceasset1 = \Tinify\fromFile($asset1path);
    				$sourceasset1->toFile($asset1path);
    				$assetphoto2 = file_get_contents($assetphoto2->getRealPath());
		            $id1str = (string)Image::make($assetphoto2)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extassetphoto2);
		            $encasset1 = "upasset/".$file_name."/PHOTO_BACK".$file_name.".".$extassetphoto2; //base64_encode($id1str);
   			}
   			else{
		    	$message = "
		    					<br />Invalid file for Asset Back Photo
		    					<br />Asset Back Photo File Name: '.$assetphoto2->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('admin.dashboard', compact('message'));
	    	} 
   		}
   		else{$encid1 = $request->iddocs1;}
		DB::table('asset_listing')
			->where('id', $id)
		    ->update([
				'assetphoto2'=> $encasset1,
				'upfile_name'=> $file_name
		    ]);
		$message = "Asset Back Updated";
		return view('admin.dashboard', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
 //Update Asset Submission Status
  public function viewasset(){
    if (!Auth::guard('admin')) {
		Session::flash('message', trans('errors.session_label'));
		Session::flash('type', 'warning');
		return redirect()->route('');
	}
    else {
      $submiss = DB::table('asset_listing')->get();
      return view('admin.admin-assetView', compact('submiss'));
    }
  }
  public function updateassetstatus(Request $request){
    $id = $request->id;
    $submissbyid = array('submissbyid'=>DB::table('asset_listing')->where('id', $id)->first());
    return view('admin.formupdateassetstat', compact('submissbyid'));
  }
   public function updateassetstatusProc(Request $request){
    $id = $request->id;
    $status = $request->status;
    DB::table('asset_listing')->where('id', $id)->update(['status'=>$status]);
    $message = "Asset details Status Updated";
    return view('admin.dashboard', compact('message'));
  }
//---------------------------------------------------------------------------------------------------------------------------------------------//
  //Encode user data from database to JSON
  public function viewassettoencode(){
    if (!Auth::guard('admin')) {
		Session::flash('message', trans('errors.session_label'));
		Session::flash('type', 'warning');
		return redirect()->route('');
	}
    else {
      $submissenc = DB::table('asset_listing')->where('status', 'CHECKED')->get();
      return view('admin.admin-assetViewenc', compact('submissenc'));
    }
  }
  public function encassetJSON(Request $request){
    $id = $request->id;
    $submissencbyid = array('submissencbyid'=>DB::table('asset_listing')->where('id', $id)->first());
    return view('admin.formencodeassetdat', compact('submissencbyid'));
  }
	public function encassetJSONProc(Request $request){
      $id = $request->id;
      DB::table('asset_listing')->where('id', $id)->update(['status'=>'READY']);
      $usr_verify = DB::table('asset_listing')->where('id', $id)->first();
      	$contributor = $usr_verify->contributor;
   		$prodID = $usr_verify->prodID;
   		$serialNum = $usr_verify->serialNum;
   		$manufacDate = $usr_verify->manufacDate;
   		$manufacOrigin = $usr_verify->manufacOrigin;
   		$assetphoto1 = $usr_verify->assetphoto1;
   		$assetphoto2 = $usr_verify->assetphoto2;
   		$assettype = $usr_verify->assettype;
   		$assetdetails = $usr_verify->assetdetails;
   		$assetupdate = $usr_verify->assetupdate;
   		$assetowner = $usr_verify->assetowner;
   		$assetcolor = $usr_verify->assetcolor;
   		$assetvalue = $usr_verify->assetvalue;
   		$file_name = $usr_verify->upfile_name;
      $usr_jsondat = json_encode($usr_verify); //original data
      $encdat = bin2hex($usr_jsondat);
      $assetblock = DB::table('asset_transaction')->where('id', $id)->first();
      if($assetblock != ''){
        DB::table('asset_transaction')->where('id', $id)
          ->update([
        	'contributor'=>$contributor,
			'prodID'=>$prodID,
			'serialNum'=>$serialNum,
			'assettype'=>$assettype,
			'assetdetails'=>$assetdetails,
			'assetupdate'=>$assetupdate,
			'assetowner'=>$assetowner,
			'assetpayload'=>$encdat
        ]);

        $message = "Asset Submission Successfully Encoded";
        return view('admin.dashboard', compact('message'));
      }
      else{

        AssetTransaction::create([
          	'contributor'=>$contributor,
			'prodID'=>$prodID,
			'serialNum'=>$serialNum,
			'assettype'=>$assettype,
			'assetdetails'=>$assetdetails,
			'assetupdate'=>$assetupdate,
			'assetowner'=>$assetowner,
			'assetpayload'=>$encdat    
        ]);

        $message = "Asset Submission Successfully Encoded";
        return view('admin.dashboard', compact('message'));
      }
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------//
    //Sign data to a block
    public function viewuserassettosign(){
      if (!Auth::guard('admin')) {
		Session::flash('message', trans('errors.session_label'));
		Session::flash('type', 'warning');
		return redirect()->route('');
	  }
      else {
        $submisssign = DB::table('asset_listing')->where('status', 'READY')->get();
        return view('admin.admin-assetViewsign', compact('submisssign'));
      }
    }
    public function signassetBlock(Request $request) {
      $id = $request->id;
      $submisssignbyid = array('submisssignbyid'=>DB::table('asset_listing')->where('id', $id)->first());
      return view('admin.formsignasset', compact('submisssignbyid'));
    }
    public function signassetBlockProc(Request $request) {
      $id = $request->id;
      DB::table('asset_listing')->where('id', $id)->update(['status'=>'SIGNED']);
      $chainsetv1 = DB::table('asset_blockdet')->where('id', $id)->first();
      
    	$net = 'testnet';
	    $NEMpubkey = $chainsetv1->assetpub;//'d786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = $chainsetv1->assetpriv;//'300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $address = $chainsetv1->serialNum;//'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $nem = new TransactionBuilder($net);
	    $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	    $nem->ImportAddr($address);
	    $nem->amount = 0.000001; // 1XEM
		  $nem->payload = 'fe'.$chainsetv1->usrpayload;
	    $fee = $nem->EstimateFee();
	    $result = $nem->SendNEMver1();
	   	if($result != false){
		    $analysis = $nem->analysis($result);
        $txstatus = $analysis['status'];
		    $txhash = $analysis['txid'];
        $txcost = floatval($nem->amount + $fee);
		    if ($analysis['status']) {
		    	$chainsetv1 = DB::table('identity_transaction')->where('idNum', $idnum)->first();
	            DB::table('identity_transaction')
	                ->where('idNum', $idnum)
	                ->update([
                    'usrtxhash' => $txhash,
                    'usrtxcost' => $txcost
                  ]);
          $message = "
                        <b>RESULT</b>
                        <br />Transaction Success !
                        <br />FEE : $fee XEM
                        <br />TXID : <a href='http://bob.nem.ninja:8765/#/transfer/$txhash' target='blank'>$txhash</a>
                        <br />Please wait for for a few minutes before clicking the link to view the transaction above
                      ";
          return view('admin.dashboard', compact('message'));
		    } 
        else {
            $message = "
                          <b>RESULT</b>
                          <br />Transaction Failed !
                          <br />Status Message : $txstatus
                        ";
            return view('admin.dashboard', compact('message'));
        }
		  }
      else {
        $message = "
                      <b>RESULTS</b>
                      <br />You are not authorized to process this function
                    ";
        return view('admin.dashboard', compact('message'));
      }
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------//

// //---------------------------------------------------------------------------------------------------------------------------------------------//
//     //Verify user data in block
//     public function verifydocs(){
//     	if (!Auth::check()) {
// 	        Session::flash('message', trans('errors.session_label'));
// 	        Session::flash('type', 'warning');
// 	        return redirect()->route('');
// 	     }
// 	     else {return view('admin.formverifydocsv3');}
// 	 }
//      public function viewDocs(Request $request){
//       	$txhash = $request->txhash; // This hash will only exist only after it past deadline based on explorer.
//    		$json_url = "http://178.128.104.194:7890/transaction/get?hash=".$txhash;
//    		//get JSON data
//         $json = file_get_contents($json_url);
//         $data = json_decode($json);

//         $block = $data->meta->height;
//         $nemaddr = $data->transaction->recipient;
//         $timestampUNIXuncalib = intval($data->transaction->deadline)+1427630785; //recalibrated from NEM to Current Timestamp + 12 hours correction
//         $timestamp = gmdate("Y-m-d H:i:s", strval($timestampUNIXuncalib));
//         $signature = $data->transaction->signer;
//         DB::table('user_block')
// 			->where('usr_txhash', $txhash)
// 		    ->update([
// 		    	'usr_block'=>$block,
// 				'usr_nemaddr'=>$nemaddr,
// 				'usr_deadline'=>$timestamp,
// 				'usr_signature'=>$signature
// 		    ]);
//         $verifydat = array('verifydat'=>DB::table('user_block')->where('usr_txhash', $txhash)->first());
//         return view('admin.user-verifyblock', compact('verifydat'));
//      }
//    	public function viewDocsProc(Request $request){
//    		$txhash = $request->txhash; // This hash will only exist only after it past deadline based on explorer.
//    		$json_url = "http://178.128.104.194:7890/transaction/get?hash=".$txhash;
//    		//get JSON data
//         $json = file_get_contents($json_url);
//         $data = json_decode($json);

//         $payload = $data->transaction->message->payload;
//         $strpayload = str_replace('fe', '',strval($payload));
//        	$conv_hex = hex2bin($strpayload);
// 		$json_hex = json_decode($conv_hex);
// 		$json_dat = $json_hex;
// 		$name = $json_dat->fname;
// 		$gender = $json_dat->gender;
// 		$dob = $json_dat->dob;
// 		$idtype = $json_dat->idType;
// 		$idnum = $json_dat->idNum;
// 		$iddoc1 = $json_dat->iddocs_front;
// 		$iddoc2 = $json_dat->iddocs_back;
// 		$addrline1 = $json_dat->addrline1;
// 		$addrline2 = $json_dat->addrline2;
// 		$postcode = $json_dat->postcode;
// 		$city = $json_dat->city;
// 		$state = $json_dat->state;
// 		$country = $json_dat->country;
// 		$bank1 = $json_dat->bankname1;
// 		$bankacc1 = $json_dat->bankaccnum1;
// 		$banknation1 = $json_dat->banknation1;
// 		$bankdoc1 = $json_dat->accdocs1;
// 		$selfie_usr = $json_dat->selfie_user;
     	
//      	$verifiedblocks = DB::table('verified_blocks')->where('veridnum', $idnum)->first();
//      	if($verifiedblocks != ''){
//      		DB::table('verified_blocks')
// 	   			->where('veridnum', $idnum)
// 	            ->update([
// 	             'vername'=>$name,
// 				 'vergender'=>$gender,
// 				 'verdob'=>$dob,
// 				 'veridtype'=>$idtype,
// 				 'veridnum'=>$idnum,
// 				 'veriddoc1'=>$iddoc1,
// 				 'veriddoc2'=>$iddoc2,
// 				 'veraddrline1'=>$addrline1,
// 				 'veraddrline2'=>$addrline2,
// 				 'verpostcode'=>$postcode,
// 				 'vercity'=>$city,
// 				 'verstate'=>$state,
// 				 'vercountry'=>$country,
// 				 'verbank1'=>$bank1,
// 				 'verbankacc1'=>$bankacc1,
// 				 'verbanknation1'=>$banknation1,
// 				 'verbankdoc1'=>$bankdoc1,
// 				 'verselfie_usr'=>$selfie_usr,
// 				 'vertxhash'=>$txhash
// 	        	]);
// 	        $kyc = array('kyc'=>DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
//         	return view('admin.kycinfov2', compact('kyc'));
// 	    }
// 	    else {
//        		$kycdocs = new KYCDocs ([
// 				'vername'=>$name,
// 				'vergender'=>$gender,
// 				'verdob'=>$dob,
// 				'veridtype'=>$idtype,
// 				'veridnum'=>$idnum,
// 				'veriddoc1'=>$iddoc1,
// 				'veriddoc2'=>$iddoc2,
// 				'veraddrline1'=>$addrline1,
// 				'veraddrline2'=>$addrline2,
// 				'verpostcode'=>$postcode,
// 				'vercity'=>$city,
// 				'verstate'=>$state,
// 				'vercountry'=>$country,
// 				'verbank1'=>$bank1,
// 				'verbankacc1'=>$bankacc1,
// 				'verbanknation1'=>$banknation1,
// 				'verbankdoc1'=>$bankdoc1,
// 				'verselfie_usr'=>$selfie_usr,
// 				'vertxhash'=>$txhash
// 			]);
// 			$kycdocs->save();
// 	        $kyc = array('kyc'=>DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
//         	return view('admin.kycinfov2', compact('kyc'));
//        	}
//     }
// //---------------------------------------------------------------------------------------------------------------------------------------------//
// 	public function genpdf(Request $request){
// 		$txhash = $request->txhash;
// 		$kyc = array ( 'kyc' => DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
// 		//dd($kyc);
// 		//$kyc = KYCDocs::All();
//       	return view('admin.kycinfo', compact('kyc'));
// 	}
// //---------------------------------------------------------------------------------------------------------------------------------------------//
}
