<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\PhpProcess;

class ClientController extends Controller
{
    //
	public function index(){
		return view('client.client_index');
	}

	public function postConnection(Request $request){

    	$ipAddress = $request->input('ipAddress');
    	$connectionTime = $request->input('connectionTime');

        chdir('js');
        $macAddress = shell_exec("./findMac.sh ".$ipAddress);

    	DB::table('connections')->insert(
    		['mac_address' => $macAddress, 'ip_address' => $ipAddress, 'connection_time' => $connectionTime]
		);
	}

	public function checkConnection(Request $request){

            $ipAddress = $request->input('ipAddress');
            $connectionDate = $request->input('connectionDate');

            chdir('js');
            $macAddress = shell_exec("./findMac.sh ".$ipAddress);
    	
			$connection_detail = DB::table('connections')
					->select(DB::raw('count(id) as countId'))
                    ->where('ip_address', $ipAddress)
                    ->whereDate('connection_time','=', $connectionDate)
                    ->where('mac_address', $macAddress)
                    ->get();

            $connection_detail = sizeof($connection_detail)==0 ? NULL : $connection_detail;

            return response()->json($connection_detail);
        
	}

	public function insertSurvey(Request $request){

    	$name 			= $request->input('name');
    	$age 			= $request->input('age');
    	$email_mobile 	= $request->input('email_mobile');
    	$answered_date 	= $request->input('answered_date');

    	DB::table('connection_info')->insert(
    		['name' => $name, 'age' => $age, 'email_mobile' => $email_mobile,'created_on' => $answered_date]
		);
	}

    public function adHits(Request $request){

        $dateTimeNow = $request->input('dateTimeNow');
        $dateNow = $request->input('dateNow');
        $ip_address  = $request->input('ipAddress');
    
        chdir('js');
        $macAddress = shell_exec("./findMac.sh ".$ip_address);

        $ad_details = DB::table('ads')
                ->select(DB::raw('id,image_path'))
                ->whereDate('ad_end','>=', $dateNow)
                ->inRandomOrder()
                ->limit(1)
                ->get();

        if(!empty($ad_details[0])){
            DB::table('ad_hits')->insert(
                ['ad_id' => $ad_details[0]->id, 'mac_address' => $macAddress, 'date_hit' => $dateTimeNow]
            );    
        }  
        
        return response()->json($ad_details);
        
    }

    public function adPromoHits(Request $request){

        $dateTimeNow = $request->input('dateTimeNow');
        $dateNow = $request->input('dateNow');
        $ip_address  = $request->input('ipAddress');
        
        chdir('js');
        $macAddress = shell_exec("./findMac.sh ".$ip_address);

        $ad_promo_details = DB::table('advertiser_promo')
                ->select(DB::raw('id,image_path'))
                ->whereDate('promo_end','>=', $dateNow)
                ->inRandomOrder()
                ->limit(1)
                ->get();

        if(!empty($ad_promo_details[0])){
            DB::table('advertiser_promo_hits')->insert(
                ['advertiser_promo_id' => $ad_promo_details[0]->id,'mac_address' => $macAddress, 'date_hit' => $dateTimeNow]
            );    
        }  
        
        return response()->json($ad_promo_details);
        
    }


}
