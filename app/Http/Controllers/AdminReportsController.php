<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromoHits;
use App\AdHits;


class AdminReportsController extends Controller
{
    public function index(){
        return view('reports.index');
    }
    
    public function getPromosReport(){
        $promoModelInstance = new PromoHits();
        $promoReportData = $promoModelInstance->getPromoHits();
        $macAddress = shell_exec("ifconfig wlan0 | grep HWaddr | awk '{ print $5}'");
        //$macAddress = "a1:b2:c3:d4:e5";
        $reportData = array();
        foreach($promoReportData as $data){
            $dArray['advertiser_promo_id'] = $data['advertiser_promo_id'];
            $dArray['mac_address'] = $data['mac_address'];
            $dArray['date_hit'] = $data['date_hit'];
            array_push($reportData,$dArray);
        }
        $reportHeaders = array('promo_id', 'client mac address', 'date hit');
        $this->generateReportFile('promos',$macAddress,$reportData,$reportHeaders);
    }

    public function getAdsReport(){
        $adHitsModelInstance = new AdHits();
        $adHitsReportData = $adHitsModelInstance->getAdHits();
        $macAddress = shell_exec("ifconfig wlan0 | grep HWaddr | awk '{ print $5}'");
        //$macAddress = "a1:b2:c3:d4:e5";
        $reportData = array();
        foreach($adHitsReportData as $data){
            $dArray['advertiser_promo_id'] = $data['ad_id'];
            $dArray['mac_address'] = $data['mac_address'];
            $dArray['date_hit'] = $data['date_hit'];
            array_push($reportData,$dArray);
        }
        $reportHeaders = array('ad_id', 'client mac address', 'date hit');
        $this->generateReportFile('ads',$macAddress,$reportData,$reportHeaders);
    }

    private function generateReportFile($_reportType,$_macAddress,$_dbData, $_reportHeaders){
        $filename = '';
        $trimMacAddress = str_replace(':','',$_macAddress);
        switch($_reportType){
            case 'promos':
                $filename = $trimMacAddress.'_'.config('app.PROMOHITS_MIDFIX').'_'.date("mdY");
            break;
            case 'ads':
                $filename = $trimMacAddress.'_'.config('app.ADHITS_MIDFIX').'_'.date("mdY");
            break;
        }
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename='.$filename.'.csv');  
        $output = fopen("php://output", "w");  
        fputcsv($output, $_reportHeaders);  
        foreach($_dbData as $row){
             fputcsv($output, $row);
        }
        fclose($output); 
    }

    
}
