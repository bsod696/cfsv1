<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;
use Carbon\Carbon;
use NemAPI\Apostille;

class guestFXControllerv2 extends Controller
{
//---------------------------------------------------------------------------------------------------------------------------------------------//
    //Verify user data in block
    public function verifydocs(){return view('formverifydocsv4');}
    public function authpasskey(Request $request){
    	$passkey = $request->pass;
    	$txhash = $request->txhash;
    	return view('formverifydocsv4');
    }
    public function viewDocs(Request $request){
      	$txhash = $request->txhash; // This hash will only exist only after it past deadline based on explorer.
   		$json_url = "http://178.128.104.194:7890/transaction/get?hash=".$txhash;
   		//get JSON data
        $json = file_get_contents($json_url);
        $data = json_decode($json);
        $payload = $data->transaction->message->payload;
        $strpayload = str_replace('fe', '',strval($payload));
        $conv_hex = hexdec($strpayload);
        $hashinstalogo = "3c80265b55fbfca4fb6cbd554ff128fff3cf110300459ee973ef5c7552442886d2dce58dc0d219b570f8d0f6e2252b23cadae7cbdc803477a45d6c27b78a07604";
        $var = hash('adler32', 'instalogo.png');
        dd($var, $hashinstalogo);

   //      $block = $data->meta->height;
   //      $nemaddr = $data->transaction->recipient;
   //      $timestampUNIXuncalib = intval($data->transaction->deadline)+1427630785; //recalibrated from NEM to Current Timestamp + 12 hours correction
   //      $timestamp = gmdate("Y-m-d H:i:s", strval($timestampUNIXuncalib));
   //      $signature = $data->transaction->signer;
   //      DB::table('user_block')
			// ->where('usr_txhash', $txhash)
		 //    ->update([
		 //    	'usr_block'=>$block,
			// 	'usr_nemaddr'=>$nemaddr,
			// 	'usr_deadline'=>$timestamp,
			// 	'usr_signature'=>$signature
		 //    ]);
   //      $verifydat = array('verifydat'=>DB::table('user_block')->where('usr_txhash', $txhash)->first());
   //      return view('verifyblock', compact('verifydat'));
     }
  //  	public function viewDocsProc(Request $request){
  //  		$txhash = $request->txhash; // This hash will only exist only after it past deadline based on explorer.
  //  		$json_url = "http://178.128.104.194:7890/transaction/get?hash=".$txhash;
  //  		//get JSON data
  //       $json = file_get_contents($json_url);
  //       $data = json_decode($json);

  //       $payload = $data->transaction->message->payload;
  //       $strpayload = str_replace('fe', '',strval($payload));
  //      	$conv_hex = hex2bin($strpayload);
		// $json_hex = json_decode($conv_hex);
		// $json_dat = $json_hex;
		// $name = $json_dat->fname;
		// $gender = $json_dat->gender;
		// $dob = $json_dat->dob;
		// $idtype = $json_dat->idType;
		// $idnum = $json_dat->idNum;
		// $iddoc1 = $json_dat->iddocs_front;
		// $iddoc2 = $json_dat->iddocs_back;
		// $addrline1 = $json_dat->addrline1;
		// $addrline2 = $json_dat->addrline2;
		// $postcode = $json_dat->postcode;
		// $city = $json_dat->city;
		// $state = $json_dat->state;
		// $country = $json_dat->country;
		// $bank1 = $json_dat->bankname1;
		// $bankacc1 = $json_dat->bankaccnum1;
		// $banknation1 = $json_dat->banknation1;
		// $bankdoc1 = $json_dat->accdocs_1;
		// $selfie_usr = $json_dat->selfie_user;
     	
  //    	$verifiedblocks = DB::table('verified_blocks')->where('veridnum', $idnum)->first();
  //    	if($verifiedblocks != ''){
  //    		DB::table('verified_blocks')
	 //   			->where('veridnum', $idnum)
	 //            ->update([
	 //             'vername'=>$name,
		// 		 'vergender'=>$gender,
		// 		 'verdob'=>$dob,
		// 		 'veridtype'=>$idtype,
		// 		 'veridnum'=>$idnum,
		// 		 'veriddoc1'=>$iddoc1,
		// 		 'veriddoc2'=>$iddoc2,
		// 		 'veraddrline1'=>$addrline1,
		// 		 'veraddrline2'=>$addrline2,
		// 		 'verpostcode'=>$postcode,
		// 		 'vercity'=>$city,
		// 		 'verstate'=>$state,
		// 		 'vercountry'=>$country,
		// 		 'verbank1'=>$bank1,
		// 		 'verbankacc1'=>$bankacc1,
		// 		 'verbanknation1'=>$banknation1,
		// 		 'verbankdoc1'=>$bankdoc1,
		// 		 'verselfie_usr'=>$selfie_usr,
		// 		 'vertxhash'=>$txhash
	 //        	]);
	 //        $kyc = array('kyc'=>DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
  //       	return view('kycinfov3', compact('kyc'));
	 //    }
	 //    else {
  //      		$kycdocs = new KYCDocs ([
		// 		'vername'=>$name,
		// 		'vergender'=>$gender,
		// 		'verdob'=>$dob,
		// 		'veridtype'=>$idtype,
		// 		'veridnum'=>$idnum,
		// 		'veriddoc1'=>$iddoc1,
		// 		'veriddoc2'=>$iddoc2,
		// 		'veraddrline1'=>$addrline1,
		// 		'veraddrline2'=>$addrline2,
		// 		'verpostcode'=>$postcode,
		// 		'vercity'=>$city,
		// 		'verstate'=>$state,
		// 		'vercountry'=>$country,
		// 		'verbank1'=>$bank1,
		// 		'verbankacc1'=>$bankacc1,
		// 		'verbanknation1'=>$banknation1,
		// 		'verbankdoc1'=>$bankdoc1,
		// 		'verselfie_usr'=>$selfie_usr,
		// 		'vertxhash'=>$txhash
		// 	]);
		// 	$kycdocs->save();
	 //        $kyc = array('kyc'=>DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
  //       	return view('kycinfov3', compact('kyc'));
  //      	}
  //   }
     public function apostilleCreate(){
     	$net = 'testnet';
     	$filename = "instagram.png";
     	$type = "private";
     	$algo = "sha256";
	    // $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    // $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    // $baseurl = 'http://178.128.104.194:7890';
	    // $address = 'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $nemApos = new Apostille();
	   	$nemApos->setting($filename, $type, $algo, $net);
	   	$nemApos->Run();
	   	dd($nemApos);
	   //  $nem->ImportAddr($address);
	   //  $nem->amount = 0.000001; // 1XEM
		  // $nem->payload = 'fe'.$kycblockv1->usr_payload;
	   //  $fee = $nem->EstimateFee();
	   //  $result = $nem->SendNEMver1();
	}
	public function storedocs(){return view('user.formupload');}
   	public function store(Request $request){
   		\Tinify\setKey("yZBnhDl4dwYH5wfg2q7LPWkTfs29pPJd");
   		$usrname = $request->usrname;
   		$prodid = $request->prodid;
   		$manufacdate = $request->manufacdate;
   		$manufacorigin = $request->manufacorigin;
   		$color = $request->color;
   		$mercsize = $request->mercsize;
   		$merctype = $request->merctype;
   		$mercphoto1 = $request->mercphoto1;
   		$mercphoto2 = $request->mercphoto2;
   		$mercphoto3 = $request->mercphoto3;
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
			    	MercAdd::create([
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
		            $message = "New data added";
		            return view('user.home', compact('message'));
	        	}
	    		else{
			    	$message = "
			    					<br />Invalid file for Selfie
			    					<br />Selfie File Name: $selfie_usr->getClientOriginalName()
			    					<br />Expected: image/pdf
			    				";
			    	return view('user.home', compact('message'));
	    		} 
	    	}
	    	else{
		    	$message = "
		    					<br />Invalid file for Account Statement
		    					<br />Account Statement File Name: $accdocs->getClientOriginalName()
		    					<br />Expected: image/pdf
		    				";
		    	return view('user.home', compact('message'));
	    	} 
	    } 
	    else{
		    $message = "
		    				<br />Invalid file for ID Front and Back Photo
		    				<br />ID Back Photo File Name: $iddocs2->getClientOriginalName()
		    				<br />ID Back File Name: '.$iddocs2->getClientOriginalName()
		    				<br />Expected: image/pdf
		    			";
		    return view('user.home', compact('message'));
	    }
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
