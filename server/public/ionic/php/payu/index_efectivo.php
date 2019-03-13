<?php

// DISPLAY ERRORS...
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


// REQUIRE PAYU FILE...
	require_once 'lib/PayU.php';

//GET DATA POST
$BUYER_DNI = $_POST['id'];
$reference = $_POST['referenceCode'];
$VALUE = $_POST['valor'];
$PAYMENT_METHOD = $_POST['tipo'];
$DESCRIPTION = $_POST['description'];
$BUYER_EMAIL = $_POST['email'];


// SOME VARIABLES...
	// Test account credintilas from (http://developers.payulatam.com/en/api/sandbox.html)
		$apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
		$apiLogin = "pRRXKOl8ikMmt9u";
		$merchantId = "508029";
		$accountId = "512321";

	// client's credentials...
		// $apiKey = "NOhf4b6zE9ZET79jx4T595ljE5Api";
		// $apiLogin = "59s2u9v3gIf0B1v";
		// $merchantId = "639781";
		// $accountId = "642153";

	// for testing...
		$testMode = true; // JUST HAVE THIS MODE true OR false, to make it work as you want it.

	// for live...
		// $testMode = false;

		if($testMode === false){
			$paymentUrl = "https://api.payulatam.com/payments-api/4.0/service.cgi";
			$reportUrl = "https://api.payulatam.com/reports-api/4.0/service.cgi";
			$subscriptionUrl = "https://api.payulatam.com/payments-api/rest/v4.3/";
		} else {
			$paymentUrl = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
			$reportUrl = "https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
			$subscriptionUrl = "https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
		}
		

// INITIALIZE PAYU CLASS...
	PayU::$apiKey = $apiKey; //Enter your own apiKey here.
	PayU::$apiLogin = $apiLogin; //Enter your own apiLogin here.
	PayU::$merchantId = $merchantId; //Enter your commerce Id here.
	
	PayU::$language = SupportedLanguages::EN; //Select the language.
	PayU::$isTest = $testMode; // true; //Leave it True when testing.

// INITIALIZE ENVIRONMENT CLASS...
	// Payments URL
	Environment::setPaymentsCustomUrl($paymentUrl);
	// Queries URL
	Environment::setReportsCustomUrl($reportUrl);
	// Subscriptions for recurring payments URL
	Environment::setSubscriptionsCustomUrl($subscriptionUrl);


// SET REFERENCE NUMBER AND AMOUNT...
	$reference = "raindrops_test_".rand(100, 100000);
	//$value = "10000";


$reference = "payment_test_00000001";
$value = "10000";

$parameters = array(
	// Enter the account’s identifier here.
	PayUParameters::ACCOUNT_ID => "512321",
	// Enter the reference code here.
	PayUParameters::REFERENCE_CODE => $reference,
	// Enter the description here.
	PayUParameters::DESCRIPTION => "payment test",
	
	// -- Values --
        // Enter the value here.        
	PayUParameters::VALUE => $value,
	// Enter the currency here.
	PayUParameters::CURRENCY => "COP",
	
	//Enter the buyer's email here.
	PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
	//Enter the payer's name here.
	PayUParameters::PAYER_NAME => "First name and second buyer  name",
	//Enter the payer's contact document here.
	PayUParameters::PAYER_DNI=> "5415668464654",

	//Enter the cash payment method name here.
	PayUParameters::PAYMENT_METHOD => "BALOTO", //EFECTY
   
	// Enter the name of the country here.
	PayUParameters::COUNTRY => PayUCountries::CO,
	
	//Enter the expiration date here.
	PayUParameters::EXPIRATION_DATE => "2014-09-26T00:00:00",
	// Payer IP
	PayUParameters::IP_ADDRESS => "127.0.0.1",   
);
	
try{
	$response = PayUPayments::doAuthorizationAndCapture($parameters);
	if($response){
		$response->transactionResponse->orderId;
		$response->transactionResponse->transactionId;
		$response->transactionResponse->state;
		if($response->transactionResponse->state=="PENDING"){
			$response->transactionResponse->pendingReason;
			$response->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_HTML;
			$response->transactionResponse->extraParameters->REFERENCE;
		}
		$response->transactionResponse->responseCode;		  
	} 
} catch(Exception $e){
		echo "Error: ".$e->getMessage();echo "<br/>";
		echo "<pre>"; print_r($e); exit;
	}


// EXAMPLE RESPONSE...
	// stdClass Object
	// (
	//     [code] => SUCCESS
	//     [transactionResponse] => stdClass Object
	//         (
	//             [orderId] => 840929913
	//             [transactionId] => 37e0ab81-f32c-474d-af45-1a8494bb227a
	//             [state] => DECLINED
	//             [responseCode] => DECLINED_TEST_MODE_NOT_ALLOWED
	//         )

	// )
?>