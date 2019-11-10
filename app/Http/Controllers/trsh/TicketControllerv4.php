<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

class TicketControllerv4 extends Controller
{
	public function createNamespaceProc(){
	    $rootnamespace = "pinkexc";
	    $namespace = "fhgsdhdhs";
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
		$keypair = new KeyPair("300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099");
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
		//dd($response);
		// interpret result
		$result = json_decode($response, true);
		dd($result);
		var_export($result, true);
		exit;
	}

	public function createTicketProc(){
		$creatorid = 'd786e99db1f1bb36a2d2a621ad4a2d67ae9868e1b9ad4ff72b8f9606d41ff956';
	   	$mosaicpath = "pinkexc";
	   	$mosaicname = "percubaantiket2";
	   	$mosaicdesc = "game: sabah vs sarawak, venue: stadium rixton (kuala lipis), date: 21/01/2019, time: 2100-0000h";
	   	$mosaicsupply = 150;
	   	$mosaicfeerecv  = "TD4HOYCHQ23H3TUDTAJ7TFKJDQDKMDN7HBOHG5PB";
	   	$mosaicfeeamt = 500000; // in microxem
	   	$divisibility = 0;
	   	$mutable = "false";
	   	$transferable = "false";

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
                        "fee"=> $mosaicfeeamt // 0.5 XEM fee
                    ],
                ],
        ];
        $transaction = new MosaicDefinition($txData);
        //dd($transaction->toDTO());

        // now prepare the keypair used for signing
		$keypair = new KeyPair("300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099");
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
		//dd($response);
		// interpret result
		$result = json_decode($response, true);
		dd($result);
		var_export($result, true);
		exit;
	}

	public function sendTicketProc(){
		$recipientAddr  = 'TDDLWFQBQTFZ2D4TY6D5UKPW4JWGHPWQMQLEGVBB'; // 送り先 recipient
		$ticketpath = "pinkexc.pafaticket.game1";//"pinkexc.pafaticket";
	    $ticketname = "game09012019_1400-1700";
	    $ticketquantity = 1;

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
		            	"mosaicId" => (new Mosaic(["namespaceId" => $ticketpath, "name" => $ticketname]))->toDTO(),
		            	"quantity" => $ticketquantity,
		        ])
		    ]))->toDTO(),
		    "message"   => (new Message(["plain" => $ticketquantity." units of ".$ticketname." ticket sold to address: ".$recipientAddr]))->toDTO(),
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
		$keypair = new KeyPair("300c111bef83d395acae760ca50eeb83f12322a8b86256e092da0a0c85a7d099");
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
		dd($result);
		var_export($result, true);
		exit;
	}
}