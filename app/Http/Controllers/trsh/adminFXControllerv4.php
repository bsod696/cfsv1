<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use NemAPI\TransactionBuilder;
use App\KYCTX;
use App\KYCDat;
use Auth;
use Session;

class adminFXControllerv4 extends Controller
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
  //Update User Submission Status
  public function viewUsersubmit(){
    if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
        Session::flash('type', 'warning');
        return redirect()->route('');
    }
    else {
      $submiss = DB::table('user_verification')->get();
      return view('admin.admin-subView', compact('submiss'));
    }
  }
  public function updatestatus(Request $request){
    $id = $request->id;
    $submissbyid = array('submissbyid'=>DB::table('user_verification')->where('id', $id)->first());
    return view('admin.formupdatesubstat', compact('submissbyid'));
  }
   public function updatestatusProc(Request $request){
    $id = $request->id;
    $status = $request->status;
    DB::table('user_verification')->where('id', $id)->update(['status'=>$status]);
    $message = "User Submission Status Updated";
    return view('admin.dashboard', compact('message'));
  }
//---------------------------------------------------------------------------------------------------------------------------------------------//
  //Encode user data from database to JSON
  public function viewUsertoencode(){
    if (!Auth::check()) {
      Session::flash('message', trans('errors.session_label'));
      Session::flash('type', 'warning');
      return redirect()->route('');
    }
    else {
      $submissenc = DB::table('user_verification')->where('status', 'CHECKED')->get();
      return view('admin.admin-subViewenc', compact('submissenc'));
    }
  }
	public function encJSON(Request $request){
    $id = $request->id;
    $submissencbyid = array('submissencbyid'=>DB::table('user_verification')->where('id', $id)->first());
    return view('admin.formencodeuserdatv3', compact('submissencbyid'));
  }
	public function encJSONProc(Request $request){
      $id = $request->id;
      $usrname = $request->usrname;
      DB::table('user_verification')->where('id', $id)->update(['status'=>'READY']);
      $usr_verify = DB::table('user_verification')->where('id', $id)->first();
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
      $userblock = DB::table('user_block')->where('idNum', $idnum)->first();
      if($userblock != ''){
        DB::table('user_block')->where('idNum', $idnum)
          ->update([
            'usrname'=>$usrname,
            'fname'=>$fullname,
            'idType'=>$idtype,
            'idNum'=>$idnum,
            'usr_payload'=>$encdat
        ]);
        $message = "User Submission Successfully Encoded";
        return view('admin.dashboard', compact('message'));
      }
      else{
        KYCTX::create([
          'usrname'=>$usrname,
          'fname'=>$fullname,
          'idType'=>$idtype,
          'idNum'=>$idnum,
          'usr_payload'=>$encdat    
        ]);
        $message = "User Submission Successfully Encoded";
        return view('admin.dashboard', compact('message'));
      }
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------//
    //Sign data to a block
    public function viewUsertosign(){
      if (!Auth::check()) {
        Session::flash('message', trans('errors.session_label'));
        Session::flash('type', 'warning');
        return redirect()->route('');
      }
      else {
        $submisssign = DB::table('user_verification')->where('status', 'READY')->get();
        return view('admin.admin-subViewsign', compact('submisssign'));
      }
    }
    public function signBlock(Request $request) {
      $idnum = $request->idNum;
      $submisssignbyid = array('submisssignbyid'=>DB::table('user_verification')->where('idNum', $idnum)->first());
      return view('admin.formsignblockv3', compact('submisssignbyid'));
    }
    public function signBlockProc(Request $request) {
      $idnum = $request->idNum;
      DB::table('user_verification')->where('idNum', $idnum)->update(['status'=>'SIGNED']);
      $kycblockv1 = DB::table('user_block')->where('idNum', $idnum)->first();
      
    	$net = 'testnet';
	    $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $address = 'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $nem = new TransactionBuilder($net);
	    $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	    $nem->ImportAddr($address);
	    $nem->amount = 0.000001; // 1XEM
		  $nem->payload = 'fe'.$kycblockv1->usr_payload;
	    $fee = $nem->EstimateFee();
	    $result = $nem->SendNEMver1();
	   	if($result != false){
		    $analysis = $nem->analysis($result);
        $txstatus = $analysis['status'];
		    $txhash = $analysis['txid'];
        $txcost = floatval($nem->amount + $fee);
		    if ($analysis['status']) {
		    	$kycblockv1 = DB::table('user_block')->where('idNum', $idnum)->first();
	            DB::table('user_block')
	                ->where('idNum', $idnum)
	                ->update([
                    'usr_txhash' => $txhash,
                    'usr_txcost' => $txcost
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
}