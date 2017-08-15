<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromoHits;
use App\AdHits;


class AdminReportsController extends Controller
{
    public function index(){

    }
    
    public function getPromosReport(){
        $promoModelInstance = new PromoHits();
        $promoReportData = $promoModelInstance->getPromoHits();
        //$macAddress = shell_exec("ifconfig wlan0 | grep HWaddr | awk '{ print $5}'");
        $macAddress = "a1:b2:c3:d4:e5";
        $reportHeaders = array('ID', 'Advertiser Promo ID', 'Mac Address', 'Hit Date');
        $this->generateReportFile('promos',$macAddress,$promoReportData,$reportHeaders);
    }

    public function getAdsReport(){
        $adHitsModelInstance = new AdHits();
        $adHitsReportData = $adHitsModelInstance->getAdHits();
        $macAddress = shell_exec("ifconfig wlan0 | grep HWaddr | awk '{ print $5}'");
        //$macAddress = "a1:b2:c3:d4:e5";
        $reportHeaders = array('ID', 'Advertisement ID', 'Mac Address', 'Hit Date');
        $this->generateReportFile('ads',$macAddress,$adHitsReportData,$reportHeaders);
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
