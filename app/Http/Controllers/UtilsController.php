<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller{

    public function __construct(){
        $this->from_currency ="USD";
        $this->to_currency ="MXN";
        $this->apikey ="8e934db21f24dfa008ad";
    }
    
    public function convertCurrency($amount){
        $apikey = $this->apikey;
      
        $from_Currency = urlencode($this->from_currency);
        $to_Currency = urlencode($this->to_currency);
        $query =  "{$from_Currency}_{$to_Currency}";
      
        // URL para solicitar los datos
        /*$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);
      
        $val = floatval($obj["$query"]);
        $total = $val * $amount;
        return number_format($total, 2, '.', '');*/
        return $amount;
    }
}
