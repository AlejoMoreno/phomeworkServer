<?php

$data = array(
   "test"=> false,
   "language"=> "en",
   "command"=> "PING",
   "merchant"=> array(
      "apiLogin"=> "22l56TfbD9Qz8K4",
      "apiKey"=> "VayBPsJpvSssy4PeJbSWmuJiFV"
   )
);

$url='https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi';
$datos=json_encode($data);
$ch = curl_init($url); 

$curlConfig = array(
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_BINARYTRANSFER => true,
    CURLOPT_POSTFIELDS => $datos
);

curl_setopt_array($ch, $curlConfig);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('POST/payments-api/4.0/service.cgi HTTP/1.1'
,'Host:api.payulatam.com'
,'Content-Type:application/json; charset=utf-8'
,'Accept:application/json'
,'Accept-language:es'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_URL, $url);

$output = curl_exec($ch); 
curl_close($ch);
echo $output;

?>