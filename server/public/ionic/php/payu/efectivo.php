<?php
$signature = md5('VayBPsJpvSssy4PeJbSWmuJiFV~631982~'.$_POST['referenceCode'].'~'.$_POST['valor'].'~CO');
$data = array(
   "language"=> "es",
   "command"=> "SUBMIT_TRANSACTION",
   "merchant"=> array(
      "apiKey"=> "VayBPsJpvSssy4PeJbSWmuJiFV",
      "apiLogin"=> "22l56TfbD9Qz8K4"
   ),
   "transaction"=> array(
      "order"=> array(
         "accountId"=> "634315",
         "referenceCode"=> $_POST['referenceCode'],
         "description"=> $_POST['description'],
         "language"=> "es",
         "signature"=> $signature,
         "notifyUrl"=> "http://www.phomework.com.co/www/confirmacionpayu.php",
         "additionalValues"=> array(
            "TX_VALUE"=> array(
               "value"=> $_POST['valor'],
               "currency"=> "COP"
            ),
            "TX_TAX"=> array(
               "value"=> 0,
               "currency"=> "COP"
            ),
            "TX_TAX_RETURN_BASE"=> array(
               "value"=> 0,
               "currency"=> "COP"
            )
         ),
         "buyer"=> array(
            "fullName"=> $_POST['id'],
            "emailAddress"=> $_POST['email']
         )
      ),
      "type"=> "AUTHORIZATION_AND_CAPTURE",
      "paymentMethod"=> $_POST['paymentMethod'],
      "expirationDate"=> "2018-05-10T00:00:00",
      "paymentCountry"=> "CO",
      "ipAddress"=> "127.0.0.1"
   ),
   "test"=> false
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
