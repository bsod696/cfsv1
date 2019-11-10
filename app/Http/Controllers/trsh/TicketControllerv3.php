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
use NEM\Models\MosaicAttachments;
use NEM\Models\MosaicAttachment;
use NEM\Models\Mosaic;
use NEM\Models\Transaction\MosaicTransfer;
use NEM\Infrastructure\Transaction as TransactionService;



class TicketControllerv3 extends Controller
{
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