<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\KYCDat;
use App\KYCReg;
use App\KYCDocs;
use PDF;

use Carbon\Carbon;

class guestFXControllerv1 extends Controller
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

        $block = $data->meta->height;
        $nemaddr = $data->transaction->recipient;
        $timestampUNIXuncalib = intval($data->transaction->deadline)+1427630785; //recalibrated from NEM to Current Timestamp + 12 hours correction
        $timestamp = gmdate("Y-m-d H:i:s", strval($timestampUNIXuncalib));
        $signature = $data->transaction->signer;
        DB::table('user_block')
			->where('usr_txhash', $txhash)
		    ->update([
		    	'usr_block'=>$block,
				'usr_nemaddr'=>$nemaddr,
				'usr_deadline'=>$timestamp,
				'usr_signature'=>$signature
		    ]);
        $verifydat = array('verifydat'=>DB::table('user_block')->where('usr_txhash', $txhash)->first());
        return view('verifyblock', compact('verifydat'));
     }
   	public function viewDocsProc(Request $request){
   		$txhash = $request->txhash; // This hash will only exist only after it past deadline based on explorer.
   		$json_url = "http://178.128.104.194:7890/transaction/get?hash=".$txhash;
   		//get JSON data
        $json = file_get_contents($json_url);
        $data = json_decode($json);

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
     	
     	$verifiedblocks = DB::table('verified_blocks')->where('veridnum', $idnum)->first();
     	if($verifiedblocks != ''){
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
				 'verselfie_usr'=>$selfie_usr,
				 'vertxhash'=>$txhash
	        	]);
	        $kyc = array('kyc'=>DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
        	return view('kycinfov3', compact('kyc'));
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
				'verselfie_usr'=>$selfie_usr,
				'vertxhash'=>$txhash
			]);
			$kycdocs->save();
	        $kyc = array('kyc'=>DB::table('verified_blocks')->where('vertxhash', $txhash)->first());
        	return view('kycinfov3', compact('kyc'));
       	}
    }
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
