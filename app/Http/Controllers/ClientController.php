<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //
	public function index(){
		return view('client.client_index');
	}

	public function postConnection(Request $request){

    	$macAddress = "aa-aa-aa-aa-aa";
    	$ipAddress = $request->input('ipAddress');
    	$connectionTime = $request->input('connectionTime');

    	DB::table('connections')->insert(
    		['mac_address' => $macAddress, 'ip_address' => $ipAddress, 'connection_time' => $connectionTime]
		);
	}

	public function checkConnection(Request $request){

    	$macAddress = "aa-aa-aa-aa-aa";
    	$ipAddress = $request->input('ipAddress');
    	$connectionDate = $request->input('connectionDate');

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

}
