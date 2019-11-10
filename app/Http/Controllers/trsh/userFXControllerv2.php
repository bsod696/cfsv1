<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\KYCDat;
use App\KYCReg;
use App\KYCDocs;
use PDF;
use Auth;
use Session;
class userFXControllerv2 extends Controller
{
//---------------------------------------------------------------------------------------------------------------------------------------------//
	use AuthenticatesUsers;
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function countrylist(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('home');
		}
		else {
	    	$countrylist = array('countrylist' =>  DB::table('currency')->get());
	    	return view('user.formuploadv2', $countrylist);
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
    //Store user data in database
	public function storedocs(){return view('user.formuploadv2');}
   	public function store(Request $request){
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
   		//Uploaded file extension grabber
   		$extensionid1 = strtolower($iddocs1->getClientOriginalExtension());
   		$extensionid2 = strtolower($iddocs2->getClientOriginalExtension());
		$extensionacc1 = strtolower($accdocs1->getClientOriginalExtension());
		$extensionselfie = strtolower($selfie_usr->getClientOriginalExtension());
		//Filter by file extension
		if(($extensionid1 == "jpeg" || $extensionid1 == "jpg" || $extensionid1 == "png" || $extensionid1 == "pdf") && ($extensionid2 == "jpeg" || $extensionid2 == "jpg" || $extensionid2 == "png" || $extensionid2 == "pdf")){
	    	if($extensionacc1 == "jpeg" || $extensionacc1 == "jpg" || $extensionacc1 == "png" || $extensionacc1 == "pdf"){
	    		if($extensionselfie == "jpeg" || $extensionselfie == "jpg" || $extensionselfie == "png" || $extensionselfie == "pdf"){
	    			$file_name = hash('sha1',$idnum);
	    			$base_url = "http://localhost/kycblockv1/public/storage/";
		    		//ID Front
		            $request->iddocs1->storeAs('upID','ID_1FRONT'.$file_name.'.'.$extensionid1);
		            $iddocs1path = public_path('storage/upID/ID_1FRONT'.$file_name.'.'.$extensionid1);
		            $sourceiddocs1 = \Tinify\fromFile($iddocs1path);
    				$sourceiddocs1->toFile($iddocs1path);
    				$iddocs1 = file_get_contents($iddocs1->getRealPath());
		            $id1str = (string)Image::make($iddocs1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionid1);
		            $encid1 = "upID/ID_1FRONT".$file_name.".".$extensionid1; //base64_encode($id1str);
		            //ID Back
		            $request->iddocs2->storeAs('upID','ID_2BACK'.$file_name.'.'.$extensionid2);
		            $iddocs2path = public_path('storage/upID/ID_2BACK'.$file_name.'.'.$extensionid2);
		            $sourceiddocs2 = \Tinify\fromFile($iddocs2path);
    				$sourceiddocs2->toFile($iddocs2path);
		            $iddocs2 = file_get_contents($iddocs2->getRealPath());
		            $id2str = (string)Image::make( $iddocs2 )->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionid2);
		            $encid2 = "upID/ID_2BACK".$file_name.".".$extensionid2; //base64_encode($id2str);
		            //Bank docs1
		            $request->accdocs1->storeAs('upAcc', 'ACC_1STATE'.$file_name.'.'.$extensionacc1);
		            $accdocs1path = public_path('storage/upAcc/ACC_1STATE'.$file_name.'.'.$extensionacc1);
		            $sourceaccdocs1 = \Tinify\fromFile($accdocs1path);
    				$sourceaccdocs1->toFile($accdocs1path);
		            $accdocs1 = file_get_contents($accdocs1->getRealPath());
		            $acc1str = (string)Image::make($accdocs1)->resize( 300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionacc1);
		            $encacc1 = "upAcc/ACC_1STATE".$file_name.".".$extensionacc1; //base64_encode($acc1str);
		            //Selfie picture
		            $request->selfie_user->storeAs('upSelfie', 'SELFIE'.$file_name.'.'.$extensionselfie);
		            $selfie_usrpath = public_path('storage/upSelfie/SELFIE'.$file_name.'.'.$extensionselfie);
		            $sourceselfie_usr = \Tinify\fromFile($selfie_usrpath);
    				$sourceselfie_usr->toFile($selfie_usrpath);
		            $selfie_usr = file_get_contents($selfie_usr->getRealPath());
		            $selfstr = (string) Image::make($selfie_usr)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionselfie);
		            $encselfie = "upSelfie/SELFIE".$file_name.".".$extensionselfie; //base64_encode($selfstr);
			    	KYCDat::create([
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
							'accdocs_1'=> $encacc1,
							'selfie_user'=> $encselfie,
							'upfile_name'=> $file_name
					]);
		            echo '<br />new data added<br>';
		            return redirect('/home');
	        	}
	        	else{
			    	echo "<br /><br />Invalid file for Selfie";
			    	echo '<br />Selfie File Name: '.$selfie_usr->getClientOriginalName();
			    	echo '<br />Expected: image/pdf<br />';
	    		} 
	    	}
	        else{
		    	echo "<br /><br />Invalid file for Account Statement";
		    	echo '<br />Account Statement File Name: '.$accdocs->getClientOriginalName();
		    	echo '<br />Expected: image/pdf<br />';
	    	} 
	    }
	    else{
	    	echo "<br />Invalid file for ID document Front or Back";
		    echo '<br />ID Front File Name: '.$iddocs1->getClientOriginalName();
		    echo '<br />ID Back File Name: '.$iddocs2->getClientOriginalName();
		    echo '<br />Expected: image/pdf<br />';
	    } 
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function viewsubmit(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('home');
		}
		else {
			$submiss = array('submiss'=>DB::table('user_verification')->where('usrname', Auth::user()->usrname)->first());
	      	return view('user.submView', compact('submiss'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update user data in database
	public function updatedata(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('home');
		}
		else {
			$updata = array('updata'=>DB::table('user_verification')->where('usrname', Auth::user()->usrname)->first());
      		return view('user.formsubsupdateDATA', compact('updata'));
      	}
	}
   	public function updatedataProc(Request $request){
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
   		$bankname1 = $request->bankname1;
   		$bankaccnum1 = $request->bankaccnum1;
   		$banknation1 = $request->banknation1;
	    DB::table('user_verification')->where('usrname', $usrname)->update([
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
		echo "<br />User Data Updated<br /";
		return redirect('/home');
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//Update user document image in database
	public function updateimg(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('home');
		}
		else {
			$updata = array('updata'=>DB::table('user_verification')->where('usrname', Auth::user()->usrname)->first());
      		return view('user.formsubsupdateIMG', compact('updata'));
      	}
	}
   	public function updateimgProc(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$usrname = $request->usrname;
   		$idnum = $request->idnum;
   		//dd($idnum);
   		$iddocs1 = $request->iddocs1;
   		$iddocs2 = $request->iddocs2;
   		dd($iddocs2);
   		$accdocs1 = $request->accdocs1;
   		$selfie_usr = $request->selfie_user;
   		//Upload file if not empty
   		$file_name = hash('sha1',$idnum);
   		//ID Front
   		if($iddocs1 != ''){
   			$extensionid1 = strtolower($iddocs1->getClientOriginalExtension());
   			if($extensionid1 == "jpeg" || $extensionid1 == "jpg" || $extensionid1 == "png" || $extensionid1 == "pdf"){
		            $request->iddocs1->storeAs('upID','ID_1FRONT'.$file_name.'.'.$extensionid1);
		            $iddocs1path = public_path('storage/upID/ID_1FRONT'.$file_name.'.'.$extensionid1);
		            $sourceiddocs1 = \Tinify\fromFile($iddocs1path);
    				$sourceiddocs1->toFile($iddocs1path);
    				$iddocs1 = file_get_contents($iddocs1->getRealPath());
		            $id1str = (string)Image::make($iddocs1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionid1);
		            $encid1 = "upID/ID_1FRONT".$file_name.".".$extensionid1; //base64_encode($id1str);
   			}
   			else{
		    	echo "<br />Invalid file for ID document Front";
			    echo '<br />ID Front File Name: '.$iddocs1->getClientOriginalName();
			    echo '<br />Expected: image/pdf<br />';
	    	} 
   		}
   		else{$encid1 = $request->iddocs1;}
   		//ID Back
   		if($iddocs2 != ''){
   			$extensionid2 = strtolower($iddocs2->getClientOriginalExtension());
   			if($extensionid2 == "jpeg" || $extensionid2 == "jpg" || $extensionid2 == "png" || $extensionid2 == "pdf"){
		        $request->iddocs2->storeAs('upID','ID_2BACK'.$file_name.'.'.$extensionid2);
		        $iddocs2path = public_path('storage/upID/ID_2BACK'.$file_name.'.'.$extensionid2);
		        $sourceiddocs2 = \Tinify\fromFile($iddocs2path);
    			$sourceiddocs2->toFile($iddocs2path);
		        $iddocs2 = file_get_contents($iddocs2->getRealPath());
		        $id2str = (string)Image::make( $iddocs2 )->resize(300,null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionid2);
		        $encid2 = "upID/ID_2BACK".$file_name.".".$extensionid2; //base64_encode($id2str);
		    }
		    else{
		    	echo "<br />Invalid file for ID document Back";
			    echo '<br />ID Front File Name: '.$iddocs2->getClientOriginalName();
			    echo '<br />Expected: image/pdf<br />';
	    	} 
   		}
   		else{
   			 $encid2 = $request->iddocs2;
   			 //dd($encid2);
   		}
   		//Bank docs1
		if($accdocs1 != ''){
			$extensionacc1 = strtolower($accdocs1->getClientOriginalExtension());
			if($extensionacc1 == "jpeg" || $extensionacc1 == "jpg" || $extensionacc1 == "png" || $extensionacc1 == "pdf"){
		        $request->accdocs1->storeAs('upAcc', 'ACC_1STATE'.$file_name.'.'.$extensionacc1);
		        $accdocs1path = public_path('storage/upAcc/ACC_1STATE'.$file_name.'.'.$extensionacc1);
		        $sourceaccdocs1 = \Tinify\fromFile($accdocs1path);
    			$sourceaccdocs1->toFile($accdocs1path);
		        $accdocs1 = file_get_contents($accdocs1->getRealPath());
		        $acc1str = (string)Image::make($accdocs1)->resize(300,null,function ($constraint) {$constraint->aspectRatio();})->encode($extensionacc1);
		        $encacc1 = "upAcc/ACC_1STATE".$file_name.".".$extensionacc1; //base64_encode($acc1str);
		    }
		    else{
		    	echo "<br /><br />Invalid file for Account Statement";
		    	echo '<br />Account Statement File Name: '.$accdocs->getClientOriginalName();
		    	echo '<br />Expected: image/pdf<br />';
	    	} 
		}
		else{$encacc1 = $request->accdocs1;}
		if($selfie_usr != ''){
			$extensionselfie = strtolower($selfie_usr->getClientOriginalExtension());
			if($extensionselfie == "jpeg" || $extensionselfie == "jpg" || $extensionselfie == "png" || $extensionselfie == "pdf"){
				//Selfie picture
		        $request->selfie_user->storeAs('upSelfie', 'SELFIE'.$file_name.'.'.$extensionselfie);
		        $selfie_usrpath = public_path('storage/upSelfie/SELFIE'.$file_name.'.'.$extensionselfie);
		        $sourceselfie_usr = \Tinify\fromFile($selfie_usrpath);
    			$sourceselfie_usr->toFile($selfie_usrpath);
		        $selfie_usr = file_get_contents($selfie_usr->getRealPath());
		        $selfstr = (string) Image::make($selfie_usr)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionselfie);
		        $encselfie = "upSelfie/SELFIE".$file_name.".".$extensionselfie; //base64_encode($selfstr);
		    }
		    else{
			    echo "<br /><br />Invalid file for Selfie";
			    echo '<br />Selfie File Name: '.$selfie_usr->getClientOriginalName();
			    echo '<br />Expected: image/pdf<br />';
	    	}
		}
		else{$encselfie = $request->selfie_user;}
		DB::table('user_verification')
			->where('usrname', $usrname)
		    ->update([
				'iddocs_front'=> $encid1,
				'iddocs_back'=> $encid2,
				'accdocs_1'=> $encacc1,
				'selfie_user'=> $encselfie,
				'upfile_name'=> $file_name
		    ]);
		echo "<br />User Data Updated<br /";
		return redirect('/home');
		// //Filter by file extension
		// if(($extensionid1 == "jpeg" || $extensionid1 == "jpg" || $extensionid1 == "png" || $extensionid1 == "pdf") && ($extensionid2 == "jpeg" || $extensionid2 == "jpg" || $extensionid2 == "png" || $extensionid2 == "pdf")){
	 //    	if($extensionacc1 == "jpeg" || $extensionacc1 == "jpg" || $extensionacc1 == "png" || $extensionacc1 == "pdf"){
	 //    		if($extensionselfie == "jpeg" || $extensionselfie == "jpg" || $extensionselfie == "png" || $extensionselfie == "pdf"){
	 //    			$file_name = hash('sha1',$idnum);
	 //    			$base_url = "http://localhost/kycblockv1/public/storage/";
		//     		//ID Front
		//             $request->iddocs1->storeAs('upID','ID_1FRONT'.$file_name.'.'.$extensionid1);
		//             $iddocs1path = public_path('storage/upID/ID_1FRONT'.$file_name.'.'.$extensionid1);
		//             $sourceiddocs1 = \Tinify\fromFile($iddocs1path);
  //   				$sourceiddocs1->toFile($iddocs1path);
  //   				$iddocs1 = file_get_contents($iddocs1->getRealPath());
		//             $id1str = (string)Image::make($iddocs1)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionid1);
		//             $encid1 = "upID/ID_1FRONT".$file_name.".".$extensionid1; //base64_encode($id1str);
		//             //ID Back
		//             $request->iddocs2->storeAs('upID','ID_2BACK'.$file_name.'.'.$extensionid2);
		//             $iddocs2path = public_path('storage/upID/ID_2BACK'.$file_name.'.'.$extensionid2);
		//             $sourceiddocs2 = \Tinify\fromFile($iddocs2path);
  //   				$sourceiddocs2->toFile($iddocs2path);
		//             $iddocs2 = file_get_contents($iddocs2->getRealPath());
		//             $id2str = (string)Image::make( $iddocs2 )->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionid2);
		//             $encid2 = "upID/ID_2BACK".$file_name.".".$extensionid2; //base64_encode($id2str);
		//             //Bank docs1
		//             $request->accdocs1->storeAs('upAcc', 'ACC_1STATE'.$file_name.'.'.$extensionacc1);
		//             $accdocs1path = public_path('storage/upAcc/ACC_1STATE'.$file_name.'.'.$extensionacc1);
		//             $sourceaccdocs1 = \Tinify\fromFile($accdocs1path);
  //   				$sourceaccdocs1->toFile($accdocs1path);
		//             $accdocs1 = file_get_contents($accdocs1->getRealPath());
		//             $acc1str = (string)Image::make($accdocs1)->resize( 300, null, function ($constraint) {$constraint->aspectRatio();})->encode($extensionacc1);
		//             $encacc1 = "upAcc/ACC_1STATE".$file_name.".".$extensionacc1; //base64_encode($acc1str);
		//             //Selfie picture
		//             $request->selfie_user->storeAs('upSelfie', 'SELFIE'.$file_name.'.'.$extensionselfie);
		//             $selfie_usrpath = public_path('storage/upSelfie/SELFIE'.$file_name.'.'.$extensionselfie);
		//             $sourceselfie_usr = \Tinify\fromFile($selfie_usrpath);
  //   				$sourceselfie_usr->toFile($selfie_usrpath);
		//             $selfie_usr = file_get_contents($selfie_usr->getRealPath());
		//             $selfstr = (string) Image::make($selfie_usr)->resize(300,null,function($constraint){$constraint->aspectRatio();})->encode($extensionselfie);
		//             $encselfie = "upSelfie/SELFIE".$file_name.".".$extensionselfie; //base64_encode($selfstr);
	 //       			DB::table('user_verification')
		//     			->where('usrname', $usrname)
		//                 ->update([
		// 					'iddocs_front'=> $encid1,
		// 					'iddocs_back'=> $encid2,
		// 					'accdocs_1'=> $encacc1,
		// 					'selfie_user'=> $encselfie,
		// 					'upfile_name'=> $file_name
		//                 ]);
		//             echo "<br />User Data Updated<br /";
		//             return redirect('/home');
	 //        	}
	 //        	else{
		// 	    	echo "<br /><br />Invalid file for Selfie";
		// 	    	echo '<br />Selfie File Name: '.$selfie_usr->getClientOriginalName();
		// 	    	echo '<br />Expected: image/pdf<br />';
	 //    		} 
	 //    	}
	 //        else{
		//     	echo "<br /><br />Invalid file for Account Statement";
		//     	echo '<br />Account Statement File Name: '.$accdocs->getClientOriginalName();
		//     	echo '<br />Expected: image/pdf<br />';
	 //    	} 
	 //    }
	 //    else{
	 //    	echo "<br />Invalid file for ID document Front or Back";
		//     echo '<br />ID Front File Name: '.$iddocs1->getClientOriginalName();
		//     echo '<br />ID Back File Name: '.$iddocs2->getClientOriginalName();
		//     echo '<br />Expected: image/pdf<br />';
	 //    } 
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
    //Verify user data in block
    public function verifydocs(){return view('user.formverifydocsv2');}
   	public function verifydocsProc(Request $request){
   		$nemaddress ="TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB";
   		$txhash = $request->txhash; // This hash will only exist only after it past deadline based on explorer.
   		$json_url = "http://178.128.104.194:7890/account/transfers/incoming?address=".$nemaddress;
   		//get JSON data
        $json = file_get_contents($json_url);
        $data = json_decode($json);
        $arrdat = $data->data;
        for($x = 0; $x < sizeof($arrdat); $x++){
        	$data = $arrdat[$x];
        	$hashfound = strval($data->meta->hash->data);
        	if($hashfound == $txhash){
        		$payload = $data->transaction->message->payload;
        		$strpayload = str_replace('fe', '',strval($payload));
       			$conv_hex = hex2bin($strpayload);
		        $json_hex = json_decode($conv_hex);
		        $json_dat = $json_hex;

		        $name = $json_dat->fname;
		   		$gender = $json_dat->gender;
		   		$dob = $json_dat->dob;
		   		$idtype = $json_dat->idType;
		   		$idnum = $json_dat->idNum;
		   		$iddoc1 = $json_dat->iddocs_front;
		   		$iddoc2 = $json_dat->iddocs_back;
		   		$addrline1 = $json_dat->addrline1;
		   		$addrline2 = $json_dat->addrline2;
		   		$postcode = $json_dat->postcode;
		   		$city = $json_dat->city;
		   		$state = $json_dat->state;
		   		$country = $json_dat->country;
		   		$bank1 = $json_dat->bankname1;
		   		$bankacc1 = $json_dat->bankaccnum1;
		   		$banknation1 = $json_dat->banknation1;
		   		$bankdoc1 = $json_dat->accdocs_1;
		   		$selfie_usr = $json_dat->selfie_user;
       			$kycblockv1 = DB::table('verified_blocks')->where('veridnum', $idnum)->first();

       			if($kycblockv1->veridnum == $idnum){
       				DB::table('verified_blocks')
	    			->where('veridnum', $idnum)
	                ->update([
	                	'vername'=>$name,
				    	'vergender'=>$gender,
				    	'verdob'=>$dob,
				    	'veridtype'=>$idtype,
				    	'veridnum'=>$idnum,
				    	'veriddoc1'=>$iddoc1,
				    	'veriddoc2'=>$iddoc2,
				    	'veraddrline1'=>$addrline1,
				    	'veraddrline2'=>$addrline2,
				    	'verpostcode'=>$postcode,
				    	'vercity'=>$city,
				    	'verstate'=>$state,
				    	'vercountry'=>$country,
				    	'verbank1'=>$bank1,
				    	'verbankacc1'=>$bankacc1,
				    	'verbanknation1'=>$banknation1,
				    	'verbankdoc1'=>$bankdoc1,
				    	'verselfie_usr'=>$selfie_usr
	                ]);
       			}
       			else {
       				 $kycdocs = new KYCDocs ([
				    	'vername'=>$name,
				    	'vergender'=>$gender,
				    	'verdob'=>$dob,
				    	'veridtype'=>$idtype,
				    	'veridnum'=>$idnum,
				    	'veriddoc1'=>$iddoc1,
				    	'veriddoc2'=>$iddoc2,
				    	'veraddrline1'=>$addrline1,
				    	'veraddrline2'=>$addrline2,
				    	'verpostcode'=>$postcode,
				    	'vercity'=>$city,
				    	'verstate'=>$state,
				    	'vercountry'=>$country,
				    	'verbank1'=>$bank1,
				    	'verbankacc1'=>$bankacc1,
				    	'verbanknation1'=>$banknation1,
				    	'verbankdoc1'=>$bankdoc1,
				    	'verselfie_usr'=>$selfie_usr
				    ]);
			    	$kycdocs->save();
       			}
			    return redirect('/genpdf');
        	}
        }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	public function genpdf(){
		$kyc = KYCDocs::all();
      	return view('user.kycinfo', compact('kyc'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
