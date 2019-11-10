<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NemAPI\TransactionBuilder;
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



class TicketController extends Controller
{
    public function createNamespace(){
    	$net = 'testnet';
	    $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $address = 'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $rootnamespace = "pinkexc";
	    $namespace = "nxgmnfdyjsdhnfds";
	    $nem = new TransactionBuilder($net);
	    $setting = $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	    $nem->ImportAddr($address);
	    $result = $nem->provisionNamespace($rootnamespace, $namespace);
	    dd($result);
	 //   	if($result != false){
		//     $analysis = $nem->analysis($result);
  //       $txstatus = $analysis['status'];
		//     $txhash = $analysis['txid'];
  //       $txcost = floatval($nem->amount + $fee);
		//     if ($analysis['status']) {
		//     	$chainsetv1 = DB::table('identity_transaction')->where('idNum', $idnum)->first();
	 //            DB::table('identity_transaction')
	 //                ->where('idNum', $idnum)
	 //                ->update([
  //                   'usrtxhash' => $txhash,
  //                   'usrtxcost' => $txcost
  //                 ]);
	 //          	$message = "
	 //                        <b>RESULT</b>
	 //                        <br />Transaction Success !
	 //                        <br />FEE : $fee XEM
	 //                        <br />TXID : <a href='http://bob.nem.ninja:8765/#/transfer/$txhash' target='blank'>$txhash</a>
	 //                        <br />Please wait for for a few minutes before clicking the link to view the transaction above
	 //                      ";
	 //          	return view('admin.dashboard', compact('message'));
		//     }
		// }
	}

	public function createTicket(){
    	$net = 'testnet';
	    $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $address = 'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $ticketpath = "pinkexc.pafaticket";
	    $ticketname = "permainan003";
	    $ticketdesc = "game: johor vs perak, venue: stadium melawati (shah slam), date: 10/01/2019, time: 2000-2300h";
	    $ticketcount = "10";
	    $nem = new TransactionBuilder($net);
	    $setting = $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	    $nem->ImportAddr($address);
	    $result = $nem->createMosaic($ticketpath, $ticketname, $ticketdesc, $ticketcount);
	    dd($result);
	 //   	if($result != false){
		//     $analysis = $nem->analysis($result);
  //       $txstatus = $analysis['status'];
		//     $txhash = $analysis['txid'];
  //       $txcost = floatval($nem->amount + $fee);
		//     if ($analysis['status']) {
		//     	$chainsetv1 = DB::table('identity_transaction')->where('idNum', $idnum)->first();
	 //            DB::table('identity_transaction')
	 //                ->where('idNum', $idnum)
	 //                ->update([
  //                   'usrtxhash' => $txhash,
  //                   'usrtxcost' => $txcost
  //                 ]);
	 //          	$message = "
	 //                        <b>RESULT</b>
	 //                        <br />Transaction Success !
	 //                        <br />FEE : $fee XEM
	 //                        <br />TXID : <a href='http://bob.nem.ninja:8765/#/transfer/$txhash' target='blank'>$txhash</a>
	 //                        <br />Please wait for for a few minutes before clicking the link to view the transaction above
	 //                      ";
	 //          	return view('admin.dashboard', compact('message'));
		//     }
		// }
	}

	public function sendTicket(Request $request){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$usraddress = $request->usraddress;
			$blockdat = array('blockdat'=>DB::table('identity_blockdet')->where('id', $id)->first());
      		return view('admin.formsendticket', compact('blockdat'));
      	}
	}
	// public function sendTicketProc(){
	// 	$net = 'testnet';
	//     // $NEMpubkey = $chainsetv->idpub;//'d786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	//     // $NEMprikey = $chainsetv->idpriv;//'300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	//     // $baseurl = 'http://178.128.104.194:7890';
	//     // $address = $chainsetv->idaddress;//'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	//     $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	//     $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	//     $baseurl = 'http://178.128.104.194:7890';
	//     $ticketpath = "pinkexc.pafaticket";
	//     $ticketname = "permainan002";
	//     $ticketquantity = "1";
	//     $address = 'TDDLWFQBQTFZ2D4TY6D5UKPW4JWGHPWQMQLEGVBB'; // 送り先 recipient
	//     $nem = new TransactionBuilder($net);
	//     $nem->setting($NEMpubkey, $NEMprikey, $baseurl);
	//     $nem->ImportAddr($address);
	// 	$nem->payload = 'fe'.$ticketquantity.' units of '.$ticketname.' ticket sold to address: '.$address;
	//     $fee = $nem->EstimateFee();
	//     $result = $nem->SendMosaicver3($ticketpath, $ticketname, $ticketquantity);
	//     dd($result);
	// }
	public function sendTicketProc(){
		$net = 'testnet';
	    // $NEMpubkey = $chainsetv->idpub;//'d786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    // $NEMprikey = $chainsetv->idpriv;//'300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    // $baseurl = 'http://178.128.104.194:7890';
	    // $address = $chainsetv->idaddress;//'TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB'; // 送り先 recipient
	    $NEMpubkey = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	    $NEMprikey = '300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099';
	    $baseurl = 'http://178.128.104.194:7890';
	    $ticketpath = "pinkexc.pafaticket.game1";//"pinkexc.pafaticket";
	    $ticketname = "game09012019_1400-1700";
	    $ticketquantity = "1";
	    $address = 'TDDLWFQBQTFZ2D4TY6D5UKPW4JWGHPWQMQLEGVBB'; // 送り先 recipient

	    $mosaic = new TransactionBuilder($net);
    	$mosaic->setting($NEMpubkey, $NEMprikey, $baseurl);
    	$mosaic->ImportAddr($address);
    	$mosaic->amount = 1;
    	$mosaic->message = $ticketquantity.' units of '.$ticketname.' ticket sold to address: '.$address;

    	$mosaic->InputMosaic($ticketpath, $ticketname, $ticketquantity);
    	// $mosaic->InputMosaic("nem", "xem", "500000");
    
    	$fee = $mosaic->EstimateFee();
    	$levy = $mosaic->EstimateLevy();
    	$result = $mosaic->SendMosaicver4();
    	$anal = $mosaic->analysis($result);
	    dd($levy);
	}

}
