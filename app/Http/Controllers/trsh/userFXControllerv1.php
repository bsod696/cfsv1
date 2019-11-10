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
class userFXControllerv1 extends Controller
{
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	// public function countrylist(){
	//     $countrylist = array('countrylist' =>  DB::table('currency')->get());
	//     //$countrylist = KYCReg::all(['country', 'ccode']);
	//     //dd($countrylist);
	//     //return view('user.formuserreg', compact('countrylist',$countrylist));
	//     return view('user.formuserreg', $countrylist);
	// }
	// //User Registration
	// public function userreg(){return view('user.formuserreg');}
 //   	public function userregProc(Request $request){
 //   		$usr_name = $request->username;
 //   		$usr_email = $request->useremail;
 //   		$pass = $request->pass;
 //   		$country = $request->country;
 //   		//Generate neww address for user
 //   		$json_url1 = "http://178.128.104.194:7890/account/generate";
 //        //get JSON data
 //        $json1 = file_get_contents($json_url1);
 //        $addrdata = json_decode($json1);
 //        $nemaddress = $addrdata->address;
 //        $priv_kunci = $addrdata->privateKey;
 //        $pub_kunci = $addrdata->publicKey;
 //        //Get user balance
 //        $json_url2 = "http://178.128.104.194:7890/account/get?address=$nemaddress";
 //        //get JSON data
 //        $json2 = file_get_contents($json_url2);
 //        $baldata = json_decode($json2);
 //        $usr_balance = $baldata->account->balance;
 //   		//Insert user data to database
	// 	KYCReg::create([
	// 	        'usrname'=>$usr_name,
	// 			'usrmail'=>$usr_email,
	// 			'usrpass'=>"pass",
	// 			'usrcountry'=>$country,
	// 			'usraddress'=>$nemaddress,
	// 			'usrbalance'=>$usr_balance
	// 	]);
	// 	echo '<br />Successfully registered<br>';
	// 	return $this->hashstr($request);
	// }

	// //Hash user pass
	// public function hashstr(Request $request){
	// 	$usr_name = $request->username;
	// 	$hash_recv = $request->pass;
	// 	$options = ['cost' => 11];
	// 	$hashed = password_hash($hash_recv, PASSWORD_BCRYPT, $options);
	// 	//dd($hashed);
	// 	$kycblockv1 = DB::table('users')->where('usrname', $usr_name)->first();
	//             DB::table('users')
	//                 ->where('usrname', $usr_name)
	//                 ->update(['usrpass' => $hashed]);
	// }

	use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/home';

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

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


	//Update user data in database
	public function updatedata(){
		if (!Auth::check()) {
			Session::flash('message', trans('errors.session_label'));
		  	Session::flash('type', 'warning');
		  	return redirect()->route('home');
		}
		else {
			$countrylist = array('countrylist' =>  DB::table('currency')->get());
			$updata = array('updata'=>DB::table('user_verification')->where('usrname', Auth::user()->usrname)->first());
			//$dataMerge = array_merge($updata,$countrylist);
			//dd(compact('dataMerge'));
      		// return view('user.formsubsupdate', compact('updata','countrylist'));
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
   		$iddocs1 = $request->iddocs1;
   		$iddocs2 = $request->iddocs2;
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
		            //echo '<img src="data:image/'.$extensionid1.';base64,'.$encid1.'" />'; //display image
		            // $kycblockv1 = DB::table('user_verification')->where('veridnum', $idnum)->first();
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
        //dd($arrdat[0]);
        // //dd($arrdat);
        // $key = -1;
        // $intkey = intval($key);
        //dd($arrdat[$intkey]);
        //dd("sdgsdg");
  //       $i = 0;
  //       $collection = collect($arrdat); //->meta->hash->data);
  //       foreach ($collection as $c)
  //       {
  //       	 dd($collection[$i+1]);
  //       }
  //       //dd($collection);
		// $filteredItems = $collection->where('name', 'first');
        // dd($arrdat);
        //echo '<img src="data:image/'.$extensionid1.';base64,'.$encid1.'" />'; //display image
        // $arrdat[$x];
        // $x++;
        //dd($arrdat[$x]);
        //dd(sizeof($arrdat));
        for($x = 0; $x < sizeof($arrdat); $x++){
        	//dd(strpos($r->data,$txhash));
        	//++$intkey;
        	//print_r ($r->meta->hash->data);
        	//$r[$intkey];
        	//print_r($arrdat[$x]);

        	//print_r($key);
        	$data = $arrdat[$x];
        	$hashfound = strval($data->meta->hash->data);
        	//echo $hashfound;
        	if($hashfound == $txhash){
        		$payload = $data->transaction->message->payload;
        		//echo $payload;

        		$strpayload = str_replace('fe', '',strval($payload));
       			$conv_hex = hex2bin($strpayload);
		        $json_hex = json_decode($conv_hex);
		        $json_dat = $json_hex;
		        //dd($json_dat);
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


    //     	//return strval(strpos($hashfound,$txhash));
    //     	//print_r($r->meta);
  //       	if($hashfound == $txhash) {
  //      			$payload = $r->transaction->message->payload;
  //      			print_r($payload);
  //   //    			 //"fe7b226964223a32312c227573726e616d65223a22486172697a222c22666e616d65223a224d7568616d6d656420486172697a2042696e205a75626972222c22696454797065223a224e524943222c2269644e756d223a22313233353637383930222c2267656e646572223a224d616c65222c22646f62223a22313939332d30322d3135222c22616464726c696e6531223a2239302c204a616c616e204a617469204131325c2f36222c22616464726c696e6532223a2243616e6e7a61205265736964656e6365222c22706f7374636f6465223a223735333935222c2263697479223a224a656e676b61222c227374617465223a2253656c616e676f7220446172756c20456873616e222c22636f756e747279223a224d616c6179736961222c226964646f63735f66726f6e74223a22757049445c2f49445f3146524f4e54313162373330616538333337333239616438323630336535663666333165646133373163643665362e6a7067222c226964646f63735f6261636b223a22757049445c2f49445f324241434b313162373330616538333337333239616438323630336535663666333165646133373163643665362e6a7067222c2262616e6b6e616d6531223a224f4442432042616e6b222c2262616e6b6163636e756d31223a22523334353636363435363334363335363432333448222c2262616e6b6e6174696f6e31223a22527573736961222c22616363646f63735f31223a2275704163635c2f4143435f315354415445313162373330616538333337333239616438323630336535663666333165646133373163643665362e6a7067222c2273656c6669655f75736572223a22757053656c6669655c2f53454c464945313162373330616538333337333239616438323630336535663666333165646133373163643665362e6a7067222c22757066696c655f6e616d65223a2231316237333061653833333733323961643832363033653566366633316564613337316364366536222c22637265617465645f6174223a22323031382d31322d31312031363a35393a3035222c22757064617465645f6174223a22323031382d31322d31322030313a31363a3535227d";//
  //      			$strpayload = str_replace('fe', '',strval($payload));
  //      			$conv_hex = hex2bin($strpayload);
		//         $json_hex = json_decode($conv_hex);
		//         $json_dat = $json_hex;
		//         //dd($json_dat);
		//         $name = $json_dat->fname;
		//    		$gender = $json_dat->gender;
		//    		$dob = $json_dat->dob;
		//    		$idtype = $json_dat->idType;
		//    		$idnum = $json_dat->idNum;
		//    		$iddoc1 = $json_dat->iddocs_front;
		//    		$iddoc2 = $json_dat->iddocs_back;
		//    		$addrline1 = $json_dat->addrline1;
		//    		$addrline2 = $json_dat->addrline2;
		//    		$postcode = $json_dat->postcode;
		//    		$city = $json_dat->city;
		//    		$state = $json_dat->state;
		//    		$country = $json_dat->country;
		//    		$bank1 = $json_dat->bankname1;
		//    		$bankacc1 = $json_dat->bankaccnum1;
		//    		$banknation1 = $json_dat->banknation1;
		//    		$bankdoc1 = $json_dat->accdocs_1;
		//    		$selfie_usr = $json_dat->selfie_user;
  //      			$kycblockv1 = DB::table('verified_blocks')->where('veridnum', $idnum)->first();

  //      			if($kycblockv1->veridnum == $idnum){
  //      				DB::table('verified_blocks')
	 //    			->where('veridnum', $idnum)
	 //                ->update([
	 //                	'vername'=>$name,
		// 		    	'vergender'=>$gender,
		// 		    	'verdob'=>$dob,
		// 		    	'veridtype'=>$idtype,
		// 		    	'veridnum'=>$idnum,
		// 		    	'veriddoc1'=>$iddoc1,
		// 		    	'veriddoc2'=>$iddoc2,
		// 		    	'veraddrline1'=>$addrline1,
		// 		    	'veraddrline2'=>$addrline2,
		// 		    	'verpostcode'=>$postcode,
		// 		    	'vercity'=>$city,
		// 		    	'verstate'=>$state,
		// 		    	'vercountry'=>$country,
		// 		    	'verbank1'=>$bank1,
		// 		    	'verbankacc1'=>$bankacc1,
		// 		    	'verbanknation1'=>$banknation1,
		// 		    	'verbankdoc1'=>$bankdoc1,
		// 		    	'verselfie_usr'=>$selfie_usr
	 //                ]);
  //      			}
  //      			else {
  //      				 $kycdocs = new KYCDocs ([
		// 		    	'vername'=>$name,
		// 		    	'vergender'=>$gender,
		// 		    	'verdob'=>$dob,
		// 		    	'veridtype'=>$idtype,
		// 		    	'veridnum'=>$idnum,
		// 		    	'veriddoc1'=>$iddoc1,
		// 		    	'veriddoc2'=>$iddoc2,
		// 		    	'veraddrline1'=>$addrline1,
		// 		    	'veraddrline2'=>$addrline2,
		// 		    	'verpostcode'=>$postcode,
		// 		    	'vercity'=>$city,
		// 		    	'verstate'=>$state,
		// 		    	'vercountry'=>$country,
		// 		    	'verbank1'=>$bank1,
		// 		    	'verbankacc1'=>$bankacc1,
		// 		    	'verbanknation1'=>$banknation1,
		// 		    	'verbankdoc1'=>$bankdoc1,
		// 		    	'verselfie_usr'=>$selfie_usr
		// 		    ]);
		// 	    	$kycdocs->save();
  //      			}
		// 	    return redirect('/genpdf');
		// 	 //    //dd($kycdocs);
		// 	 // //    $pdf = PDF::loadView('user.kycinfo', $kycdocs);
		// 		// // return $pdf->download('invoice.pdf');
		// 	 // //    $pdf = App::make('dompdf.wrapper');
		// 		// // $pdf->loadHTML('user.kycinfo');
		// 		// // return $pdf->stream();
  //   //    			//return view('user.kycinfo', compact($kycdocs));
  //   //    			// $urlimage = "http://localhost/kycblockv1/public/storage/upSelfie/SELFIEbfe54caa6d483cc3887dce9d1b8eb91408f1ea7a.jpg";
  //   //     		// echo '<center><img src="'.$urlimage.'"height="300" width="400" /></center>'; //display image
  //      		}
  //      		else{
  //      			echo "Not Found<br/>";
  //      			break;
  //      		}
		// }
	}

	public function genpdf(){
		$kyc = KYCDocs::all();
      	return view('user.kycinfo', compact('kyc'));
	}

	// public function genpdf(){
	// 	$kyc = KYCDocs::all();
 //      	return view('user.kycinfo', compact('kyc'));
	// }
}
