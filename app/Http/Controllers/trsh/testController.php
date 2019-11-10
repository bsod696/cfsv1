<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class testController extends Controller
{
	public function getnonce(){
		$address = "0xde0b295669a9fd93d5f28d9ec85e40f4cb697bae"; //pending tx address
		$hash = "0x2ef27ec8b0e5be46e1e49f7dfebc7c653df05acf003dfdd05dbe450bc4a4c4d1"; //pending tx hash
		$json_url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$address."&startblock=0&endblock=99999999&sort=asc&apikey=91V2W6YN95VHHFBPRT18225VYCKI8FMNXB";
		$json = file_get_contents($json_url);
      	$data = json_decode($json);
      	$arrdat = $data->result;
      	//dd($arrdat);
      	foreach ($arrdat  as $a){
      		if($a->hash == $hash){
      			$pendingNonce = $a->nonce;	
      		}
      	}
      	return $pendingNonce; //nonce of pending tx
	}

	public function overwriteTx(){
		$sendrecv = "0xde0b295669a9fd93d5f28d9ec85e40f4cb697bae"; //sender and receiver = dupes pending address 
		$amountSend = "0";
		$gasLimit = "100000"; //100000 wei
		$gasPrice = "100000000000"; //100 gwei [MAX] to be converted to wei
		$pendingNonce = self::getnonce();
		$password = "lalallalala";
		$POST_DATA = [
			'txdata' => [
				'from' => $sendrecv, 
				'to'=> $sendrecv, 
				'gas'=> $gasLimit, 
				'gasPrice'=> $gasPrice, 
				'value'=> $amountSend, 
				'nonce'=> $pendingNonce
			],
			'password' => $password
		];
		return $POST_DATA;
	}


}