<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Admin;
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
use NEM\API;
use NEM\SDK;
use NEM\Models\Message;
use NEM\Core\KeyPair;
use NEM\Core\Buffer;
use NEM\Models\Transaction\NamespaceProvision;
use NEM\Models\Transaction\MosaicDefinition;
use NEM\Models\MosaicAttachments;
use NEM\Models\MosaicAttachment;
use NEM\Models\Mosaic;
use NEM\Models\Transaction\MosaicTransfer;
use NEM\Infrastructure\Transaction as TransactionService;

//MAIN NETWORK
//remove version parameter in $txData in controller
//change Model/Address.php $networkid from 104 to -104

class TicketControllerv5 extends Controller
{
use AuthenticatesUsers;
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//CREATE NAMESPACE
	public function createNamespace(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$admblock = DB::table('admins')->where('usrname', Auth::guard('admin')->user()->usrname)->first();
			$admaddr = $admblock->admaddress;
			$avains_url = "http://178.128.104.194:7890/account/namespace/page?address=".$admaddr;
			$avains_json = file_get_contents($avains_url);
	        $avainsdata = json_decode($avains_json);
	        $x = 0;
	        foreach ($avainsdata->data as $nsdat) {
	        	$nsfound[$x] = $nsdat->fqn;
	        	$x++;
	        }
			return view('admin.formcreatenamespace', compact('nsfound'));
		}
	}
	public function createNamespaceProc(Request $request){
		$usrname = $request->usrname;
		$admblock = DB::table('admins')->where('usrname', $usrname)->first();
		$admpri = hex2bin($admblock->admpriv);
	    $rootnamespace = strtolower($request->rootnamespace); //"pinkexc";
	    $namespace = strtolower($request->namespace); //"ryyher46uj";
	    $timestampCarbon = Carbon::now()->subDays(16524); //minus 45years NEM NTP
        $timestamp = strtotime($timestampCarbon);
        $deadlineCarbon = $timestampCarbon->addHour(24);
        $deadline = strtotime($deadlineCarbon);

	    $txData = [
                'timeStamp' => $timestamp, // NEMは1427587585つまり2015/3/29 0:6:25 UTCスタート
                'deadline' => $deadline, // 送金の期限
                'version' => "-1744830463",  // mainnetは-1744830465、testnetは-1744830463
                'rentalFeeSink' => "TAMESPACEWH4MKFMBCVFERDPOOP4FK7MTDJEYP35", // for test net only
                "newPart" => $namespace,
                "parent" => $rootnamespace,
        ];
        $transaction = new NamespaceProvision($txData);
        //dd($transaction->toDTO());

        // now prepare the keypair used for signing
		$keypair = new KeyPair($admpri);
		//dd($keypair->getAddress());

	   	// prepare the connection (for broadcast)
		$api = new API([
			"protocol" => "http",
		    "use_ssl"  => false,
		    "host" => "178.128.104.194",
		    "port" => 7890,
		    "endpoint" => "/",
		]);

		// use transaction SDK service to sign + broadcast transaction
		$service = new TransactionService($api);

		// sign transaction
		$signature = $service->signTransaction($transaction, $keypair);
		$broadcast = [
		    "data" => Buffer::fromUInt8($transaction->serialize())->getHex(),
		    "signature" => $signature->getHex(),
		];
		// broadcast transaction
		$endpoint = $service->getAnnouncePath($transaction, $keypair);
		$apiUrl   = $service->getPath($endpoint, []);
		$response = $api->postJSON($apiUrl, $broadcast);

		// interpret result
		$result = json_decode($response, true);
		$resmessage = $result["message"];
		$restxhash = $result["transactionHash"]["data"];
		$message = "Result ".$resmessage." with Transaction hash : ".$restxhash;
		return view('admin.formcreatenamespace', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//CREATE MOSAIC
	public function createTicket(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$admblock = DB::table('admins')->where('usrname', Auth::guard('admin')->user()->usrname)->first();
			$admaddr = $admblock->admaddress;
			$avains_url = "http://178.128.104.194:7890/account/namespace/page?address=".$admaddr;
			$avains_json = file_get_contents($avains_url);
	        $avainsdata = json_decode($avains_json);
	        $x = 0;
	        foreach ($avainsdata->data as $nsdat) {
	        	$nsfound[$x] = $nsdat->fqn;
	        	$x++;
	        }
			return view('admin.formcreateticket', compact('nsfound'));
		}
	}
	public function createTicketProc(Request $request){
		$usrname = $request->usrname;
		$admblock = DB::table('admins')->where('usrname', $usrname)->first();
		$admpri = hex2bin($admblock->admpriv);
		$creatorid = hex2bin($admblock->admpub);
	   	$mosaicpath = strtolower($request->ticketpath); //"pinkexc";
	   	$mosaicname = strtolower($request->ticketname); //"percubaantiket2";
	   	$mosaicdetevent = strtolower($request->eventname);
	   	$mosaicdetvenue = strtolower($request->eventvenue);
	   	$mosaicdetdate = $request->eventdate;
	   	$mosaicdetstarttime = $request->eventstarttime;
	   	$mosaicdetendtime = $request->eventendtime;
	   	$mosaicdescRAW = array(
	   		"EventName" => $mosaicdetevent,//"game: sabah vs sarawak, venue: stadium rixton (kuala lipis), date: 21/01/2019, time: 2100-0000h";
	   		"EventVenue" => $mosaicdetvenue,
	   		"EventDate" => $mosaicdetdate,
	   		"EventStartTime" => $mosaicdetstarttime,
	   		"EventEndTime" => $mosaicdetendtime
	   	);
	   	$mosaicdesc = json_encode($mosaicdescRAW);
	   	//dd($mosaicdesc);
	   	$mosaicsupply = $request->ticketcount; //150;
	   	$mosaicfeerecv  = $request->ticketroyaltyrecv; //"TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB";
	   	$mosaicfeeamt = $request->ticketroyaltyamt; //500000; // in microxem
	   	$divisibility = "0";
	   	$mutable = "false";
	   	$transferable = $request->tickettxbehav; //"false";

	    $timestampCarbon = Carbon::now()->subDays(16524); //minus 45years NEM NTP
        $timestamp = strtotime($timestampCarbon);
        $deadlineCarbon = $timestampCarbon->addHour(24);
        $deadline = strtotime($deadlineCarbon);

		$txData = [
                'timeStamp' => $timestamp,
                'deadline' => $deadline, 
                'creationFeeSink' => "TBMOSAICOD4F54EE5CDMR23CCBGOAM2XSJBR5OLC",
                'version' => "-1744830463",
                "mosaicDefinition" => [
                	"creator" => $creatorid,
                    "description" => $mosaicdesc,
                    "id" => [
                        "namespaceId" => $mosaicpath,
                        "name" => $mosaicname,
                    ],
                    "properties" => [
                        [
                            "name" => "divisibility",
                            "value" => (string)$divisibility,
                        ],
                        [
                            "name" => "initialSupply",
                            "value" => (string)$mosaicsupply,
                        ],
                        [
                            "name" => "supplyMutable",
                            "value" => $mutable,
                        ],
                        [
                            "name" => "transferable",
                            "value" => $transferable,
                        ],
                    ],
                    "levy" => [
                        "type" => 1,
                        "recipient" => $mosaicfeerecv,
                        "mosaicId" => [
                            "namespaceId" => "nem",
                            "name" => "xem"
                        ],
                        "fee"=> $mosaicfeeamt * 1000000 // 0.5 XEM fee
                    ],
                ],
        ];
        $transaction = new MosaicDefinition($txData);
        //dd($transaction->toDTO());

        // now prepare the keypair used for signing
		$keypair = new KeyPair($admpri);
		//dd($keypair)

	   	// prepare the connection (for broadcast)
		$api = new API([
			"protocol" => "http",
		    "use_ssl"  => false,
		    "host" => "178.128.104.194",
		    "port" => 7890,
		    "endpoint" => "/",
		]);

		// use transaction SDK service to sign + broadcast transaction
		$service = new TransactionService($api);

		// sign transaction
		$signature = $service->signTransaction($transaction, $keypair);
		$broadcast = [
		    "data" => Buffer::fromUInt8($transaction->serialize())->getHex(),
		    "signature" => $signature->getHex(),
		];
		// broadcast transaction
		$endpoint = $service->getAnnouncePath($transaction, $keypair);
		$apiUrl   = $service->getPath($endpoint, []);
		$response = $api->postJSON($apiUrl, $broadcast);
		// interpret result
		$result = json_decode($response, true);
		$resmessage = $result["message"];
		$restxhash = $result["transactionHash"]["data"];
		$message = "Result ".$resmessage." with Transaction hash : ".$restxhash;
		return view('admin.formcreateticket', compact('message'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//SEND TICKET
	public function sendTicket(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {
			$admblock = DB::table('admins')->where('usrname', Auth::guard('admin')->user()->usrname)->first();
			$admaddr = $admblock->admaddress;
			$mosaichold_url = "http://178.128.104.194:7890/account/mosaic/owned?address=".$admaddr; //TCS4D2GUIXTEA25ZHLPNBORNWEZ2LIJUN45OXG6K"
			$jsonMSChold = file_get_contents($mosaichold_url);
	        $dataM = json_decode($jsonMSChold);
	        //dd($dataM);
	        $x = 0;
	        foreach ($dataM->data as $blockdat) {
	        	$mscqty[$x] = $blockdat->quantity;
			    $mscnamespfound[$x] = $blockdat->mosaicId->namespaceId;
				$mscnamefound[$x] =  $blockdat->mosaicId->name;
				$mscdetname[$x] = array(
				    "TicketDomain" => $mscnamespfound[$x],
				    "TicketName" => $mscnamefound[$x],
				    "TicketBalance" => $mscqty[$x]
				);
				$x++;
	        }

	        $usrblock = DB::table('users')->get();
	        //  $submissbyid = array('submissbyid'=>DB::table('identity_listing')->where('id', $id)->first());
	        // foreach ($usrblock as $usr) {
	        // 	$usraddrarray[$x] =  array("usrAddr" => $usr->usraddress);
	        // 	$x++; 
	        // }
	        //dd($usrblock);
			return view('admin.formsendticket', compact('mscdetname','usrblock'));
		}
	}
	public function getTicketName($dataTicketDomain){
		$admblock = DB::table('admins')->where('usrname', Auth::guard('admin')->user()->usrname)->first();
		$admaddr = $admblock->admaddress;
		$mosaichold_url = "http://178.128.104.194:7890/account/mosaic/owned?address=".$admaddr; //TCS4D2GUIXTEA25ZHLPNBORNWEZ2LIJUN45OXG6K"
		$jsonMSChold = file_get_contents($mosaichold_url);
	    $dataM = json_decode($jsonMSChold);
	    $x = 0;
	    foreach ($dataM->data as $blockdat) {
			$mscnamespfound[$x] = $blockdat->mosaicId->namespaceId;
			if($dataTicketDomain == $mscnamespfound[$x]){
				$mscnamefound[$x] =  $blockdat->mosaicId->name;
				$mscqty[$x] = $blockdat->quantity;
				$mscdetname[$x] = array(
				   	"TicketDomain" => $mscnamespfound[$x],
				   	"TicketName" => $mscnamefound[$x],
				   	"TicketBalance" => $mscqty[$x]
					);
			}
			$x++;
	    }
	    $tabletest = '<select id="ticketname" class="form-control" name="ticketname" required autofocus>';
	    foreach ($mscdetname as $msc) {
	       $tabletest .= '<option value="'.$msc['TicketName'].'">'.$msc['TicketName'].'</option>';
	    }
	    $tabletest .= '</select>'; 
	    return $tabletest;                 
	}
	public function getTicketBalance($dataTicketName){
		$admblock = DB::table('admins')->where('usrname', Auth::guard('admin')->user()->usrname)->first();
		$admaddr = $admblock->admaddress;
		$mosaichold_url = "http://178.128.104.194:7890/account/mosaic/owned?address=".$admaddr; //TCS4D2GUIXTEA25ZHLPNBORNWEZ2LIJUN45OXG6K"
		$jsonMSChold = file_get_contents($mosaichold_url);
	    $dataM = json_decode($jsonMSChold);
	    $x = 0;
	    foreach ($dataM->data as $blockdat) {
			$mscnamefound[$x] = $blockdat->mosaicId->name;
			if($dataTicketName == $mscnamefound[$x]){
				$mscqty= $blockdat->quantity;
				$mscdetname = array(
				   	"TicketBalance" => $mscqty
				);
				$tabletest = '<p>Balance: '.$mscdetname['TicketBalance'].' units left</p>';
				return $tabletest; 
				//dd($mscdetname);
			}
			$x++;
	    }
	    //foreach ($mscdetname as $msc) {$tabletest = 'Balance: '.$msc['TicketBalance'].' units left';}
	    //return $tabletest;                 
	}
	public function sendTicketProc(Request $request){
		$admblock = DB::table('admins')->where('usrname', Auth::guard('admin')->user()->usrname)->first();
		$admaddr = $admblock->admaddress;
		$mosaichold_url = "http://178.128.104.194:7890/account/mosaic/owned?address=".$admaddr; //TCS4D2GUIXTEA25ZHLPNBORNWEZ2LIJUN45OXG6K"
		$jsonMSChold = file_get_contents($mosaichold_url);
	    $dataM = json_decode($jsonMSChold);
	        //dd($dataM);
	    $x = 0;
	    foreach ($dataM->data as $blockdat) {
	        $mscqty[$x] = $blockdat->quantity;
			$mscnamespfound[$x] = $blockdat->mosaicId->namespaceId;
			$mscnamefound[$x] =  $blockdat->mosaicId->name;
			$mscdetname[$x] = array(
				"TicketDomain" => $mscnamespfound[$x],
				"TicketName" => $mscnamefound[$x],
				"TicketBalance" => $mscqty[$x]
			);
			$x++;
	    }
		$usrblock = DB::table('users')->get();
		$usrname = $request->usrname;
		$admblock = DB::table('admins')->where('usrname', $usrname)->first();
		$admpri = hex2bin($admblock->admpriv);

		$recipientAddr  = $request->ticketrecv; //'TDDLWFQBQTFZ2D4TY6D5UKPW4JWGHPWQMQLEGVBB'; // 送り先 recipient
		//dd($recipientAddr);
		$mosaicpath =  strtolower($request->ticketpath); //"pinkexc.pafaticket.game1";//"pinkexc.pafaticket";
	    $mosaicname =  strtolower($request->ticketname); //"game09012019_1400-1700";
	    $mosaicqty =  $request->ticketquantity;

	    $timestampCarbon = Carbon::now()->subDays(16524); //minus 45years NEM NTP
        $timestamp = strtotime($timestampCarbon);
        $deadlineCarbon = $timestampCarbon->addHour(24);
        $deadline = strtotime($deadlineCarbon);

		$txData = [
			"timeStamp"	=> $timestamp,
			"fee" => 500000,
		    "amount" => 0,
		    "recipient" => $recipientAddr,
		    "deadline"	=> $deadline,
		    "mosaics" => (new MosaicAttachments([
		        new MosaicAttachment([
		            	"mosaicId" => (new Mosaic(["namespaceId" => $mosaicpath, "name" => $mosaicname]))->toDTO(),
		            	"quantity" => $mosaicqty,
		        ])
		    ]))->toDTO(),
		    "message"   => (new Message(["plain" => $mosaicqty." units of ".$mosaicname." ticket sold to address: ".$recipientAddr]))->toDTO(),
		];
		$transaction = new MosaicTransfer($txData);
		//dd($transaction->toDTO());
		
		// prepare the connection (for broadcast)
		$api = new API([
			"protocol" => "http",
		    "use_ssl"  => false,
		    "host" => "178.128.104.194",
		    "port" => 7890,
		    "endpoint" => "/",
		]);

		// now prepare the keypair used for signing
		$keypair = new KeyPair($admpri);
		//dd($keypair)

		// use transaction SDK service to sign + broadcast transaction
		$service = new TransactionService($api);

		// sign transaction
		$signature = $service->signTransaction($transaction, $keypair);
		$broadcast = [
		    "data" => Buffer::fromUInt8($transaction->serialize())->getHex(),
		    "signature" => $signature->getHex(),
		];
		// broadcast transaction
		$endpoint = $service->getAnnouncePath($transaction, $keypair);
		$apiUrl   = $service->getPath($endpoint, []);
		$response = $api->postJSON($apiUrl, $broadcast);
		//dd($response);
		// interpret result
		$result = json_decode($response, true);
		$resmessage = $result["message"];
		$restxhash = $result["transactionHash"]["data"];
		$message = "Result ".$resmessage." with Transaction hash : ".$restxhash;
		return view('admin.formsendticket', compact('message','usrblock','mscdetname'));
	}
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//VIEW TICKET
	public function viewTicket(){
		if (!Auth::guard('admin')) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('');
		}
		else {return view('admin.formviewticket');}
	}
	public function viewTicketProc(Request $request){
		$usraddress = $request->useraddress;
		$x = 0;
		$mosaichold_url = "http://178.128.104.194:7890/account/transfers/incoming?address=".$usraddress; //TCS4D2GUIXTEA25ZHLPNBORNWEZ2LIJUN45OXG6K"
		$jsonMSChold = file_get_contents($mosaichold_url);
        $dataM = json_decode($jsonMSChold);

        foreach ($dataM->data as $blockdat) {
        		$msctxhash[$x] = $blockdat->meta->hash->data;
        		$mscblock[$x] = $blockdat->meta->height;
        		$msctimestamp[$x] = $blockdat->transaction->timeStamp;
        		$mscmessage[$x] = $blockdat->transaction->message->payload;
        		$mscsignerPub[$x] = $blockdat->transaction->signer;
        		$admblock = DB::table('admins')->where('admpub', bin2hex($mscsignerPub[$x]))->first();
        		$mscsigner[$x] = $admblock->admaddress;
		       	foreach ($blockdat->transaction->mosaics as $mscdat) {
		        	$mscnamespfound[$x] = $mscdat->mosaicId->namespaceId;
			        $mscnamefound[$x] =  $mscdat->mosaicId->name;
			        $mscfullname[$x] = $mscnamespfound[$x].":".$mscnamefound[$x];
			        $mscqty[$x] =  $mscdat->quantity;
			        $mscdetbalance[$x] = array(
			        		"TicketHolder" => $usraddress,
			        		"TicketFullName" => $mscfullname[$x],
			        		"TicketQuantity" => $mscqty[$x],
			        		"TicketHash" => $msctxhash[$x],
			        		"TicketBlock" => $mscblock[$x],
			        		"TicketTimestamp" => date('m/d/Y H:i:s', strval(intval($msctimestamp[$x])+1427630785)),
			        		"TicketMessage" => hex2bin($mscmessage[$x]),
			        		"TicketIssuer" => $mscsigner[$x]
			        );
			        $x++;
		        }
        }
	    return view('admin.ticketDetails', compact("mscdetbalance"));
    }
//---------------------------------------------------------------------------------------------------------------------------------------------//
	//VIEW EVENT
    public function eventDetailsProc(Request $request){
    	$mscfullnameusr = $request->ticketfullname;
    	$x = 0;
    	$mosaicDEF_url = "http://178.128.104.194:7890/namespace/mosaic/definition/page?namespace=pinkexc";
		$jsonMSCdef = file_get_contents($mosaicDEF_url);
        $dataMdef = json_decode($jsonMSCdef);
        foreach ($dataMdef->data as $blockdat) {
        	$mscnamespfound[$x] = $blockdat->mosaic->id->namespaceId;
        	$mscnamefound[$x] = $blockdat->mosaic->id->name;
        	$mscfullname[$x] = $mscnamespfound[$x].":".$mscnamefound[$x];
        	if($mscfullname[$x] == $mscfullnameusr){
        		$eventdetfullRAW = $blockdat->mosaic->description;
        		$eventdetfull = json_decode($eventdetfullRAW);
        		//dd($eventdetfull->EventVenue);
        		return view('admin.eventDetails', compact('eventdetfull'));
        	}
        	$x++;
        }
    }

}