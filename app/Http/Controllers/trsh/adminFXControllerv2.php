<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use NemAPI\TransactionBuilder;
use App\KYCTX;
use Auth;
use Session;

class adminFXControllerv2 extends Controller
{
//-----------------------------------------------------------------------------------------------------------------------------------------------//
	//use AuthenticatesUsers;
//-----------------------------------------------------------------------------------------------------------------------------------------------//
  public function __construct(){$this->middleware('auth');}
  public function index(){return view('admin.admDash');}
//-----------------------------------------------------------------------------------------------------------------------------------------------//
	//NEM Infra
	public function getnodeinfo(){
    if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
      Session::flash('type', 'warning');
      return redirect()->route('home');
    }
    else {
      $json_url = "http://178.128.104.194:7890/node/extended-info";
      //get JSON data
      $json = file_get_contents($json_url);
      $data = json_decode($json);
      print_r ($data);
    }
  }
	public function getblockheight(){
    if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
      Session::flash('type', 'warning');
      return redirect()->route('home');
    }
    else {
    	$json_url = "http://178.128.104.194:7890/chain/height";
      //get JSON data
      $json = file_get_contents($json_url);
      $data = json_decode($json);
      print_r ($data);
    }
  }
//-----------------------------------------------------------------------------------------------------------------------------------------------//
	//Encode user data from database to JSON
	public function encJSON(){
     if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
      Session::flash('type', 'warning');
      return redirect()->route('home');
    }else {return view('admin.formencodeuserdatv2');}
  }
	public function encJSONProc(Request $request){
      $usrname = $request->usrname;
      $idnum = $request->idnum;
      $usr_verify = DB::table('user_verification')->where('idNum', $idnum)->first();
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
   		$accdocs1 = $usr_verify->accdocs_1;
   		$selfie_usr = $usr_verify->selfie_user;
   		$file_name = $usr_verify->upfile_name;
      $usr_jsondat = json_encode($usr_verify); //original data
      $encdat = bin2hex($usr_jsondat);
      KYCTX::create([
          'usrname'=>$usrname,
	        'fname'=>$fullname,
    			'idType'=>$idtype,
    			'idNum'=>$idnum,
    			'usr_payload'=>$encdat    
    		]);
    	echo '<br />user encoded data added<br>';
      return redirect('/home');
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------//
    //Sign data to a block
    public function signBlock() {
      if (!Auth::check()) {
        Session::flash('message', trans('errors.session_label'));
        Session::flash('type', 'warning');
        return redirect()->route('home');
      }else {return view('admin.formsignblockv2');}
    }
    public function signBlockProc(Request $request) {
    	$net = 'testnet';
	    $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $address = 'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $nem = new TransactionBuilder($net);
	    $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	    $nem->ImportAddr($address);
	    $nem->amount = 0.000001; // 1XEM
      $usrname = $request->usrname;
	    $idnum = $request->idnum;
	    $kycblockv1 = DB::table('user_block')->where('idNum', $idnum)->first();
		  $nem->payload = 'fe'.$kycblockv1->usr_payload;
	    $fee = $nem->EstimateFee();
	    $result = $nem->SendNEMver1();
	   	if($result != false){
		    $analysis = $nem->analysis($result);
		    $txhash = $analysis['txid'];
		    echo '<p>RESULTS:<br />Fee is ', $fee,' XEM<br />';
		    if ($analysis['status']) {
		    	echo 'TXID is <a href=http://bob.nem.ninja:8765/#/transfer/',$txhash,'>',$txhash,'</a></p>';
		    	$kycblockv1 = DB::table('user_block')->where('idNum', $idnum)->first();
	            DB::table('user_block')
	                ->where('idNum', $idnum)
	                ->update(['usr_txhash' => $txhash]);
	            echo "<p> Please wait for until deadline has passed before clicking the link to view the transaction above</p>";
		    } else {echo "Fail to send.<br />Status Message: {",$analysis['status'],"}</p>";}
		  }else {echo '<p>RESULTS:<br />You are not authorized to process this function<br />';}
    } 
//-----------------------------------------------------------------------------------------------------------------------------------------------//
}