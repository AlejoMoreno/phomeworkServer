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


// SET PARAMETERS...
	$parameters = array(
		// Enter the account’s identifier here.
		PayUParameters::ACCOUNT_ID => $accountId,
		// Enter the reference code here.
		PayUParameters::REFERENCE_CODE => $reference,
		// Enter the description here.
		PayUParameters::DESCRIPTION => $DESCRIPTION,
		
		// -- Values --
	        // Enter the value here.       
			PayUParameters::VALUE => $VALUE,
			// Enter the currency here.
			PayUParameters::CURRENCY => "COP",
		
	 	// -- Buyer --
	        //Enter the buyer Id here.
			PayUParameters::BUYER_NAME => "First name and second buyer name",
			//Enter the buyer's email here.
			PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
			//Enter the buyer's contact phone here.
			PayUParameters::BUYER_CONTACT_PHONE => "7563126",
			//Enter the buyer's contact document here.
			PayUParameters::BUYER_DNI => "5415668464654",
			//Enter the buyer's address here.
			PayUParameters::BUYER_STREET => "calle 100",
			PayUParameters::BUYER_STREET_2 => "5555487",
			PayUParameters::BUYER_CITY => "Medellin",
			PayUParameters::BUYER_STATE => "Antioquia",
			PayUParameters::BUYER_COUNTRY => "CO",
			PayUParameters::BUYER_POSTAL_CODE => "000000",
			PayUParameters::BUYER_PHONE => "7563126",
		
		// -- Payer --
			//Enter the payer's name here.
			PayUParameters::PAYER_NAME => "First name and second payer name",
			//Enter the payer's email here.
			PayUParameters::PAYER_EMAIL => $BUYER_EMAIL,
			//Enter the payer's contact phone here.
			PayUParameters::PAYER_CONTACT_PHONE => "7563126",
			//Enter the payer's contact document here.
			PayUParameters::PAYER_DNI => "5415668464654",
			//Enter the payer's address here.
			PayUParameters::PAYER_STREET => "calle 93",
			PayUParameters::PAYER_STREET_2 => "125544",
			PayUParameters::PAYER_CITY => "Bogota",
			PayUParameters::PAYER_STATE => "Bogota",
			PayUParameters::PAYER_COUNTRY => "CO",
			PayUParameters::PAYER_POSTAL_CODE => "000000",
			PayUParameters::PAYER_PHONE => "7563126",
		
		// -- Credit card data -- 
			// Enter the number of the credit card here
			PayUParameters::CREDIT_CARD_NUMBER => "4097440000000004",
			// Enter expiration date of the credit card here
			PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "2017/12",
			//Enter the security code of the credit card here
			PayUParameters::CREDIT_CARD_SECURITY_CODE=> "321",
			//Enter the name of the credit card here
			//VISA||MASTERCARD||AMEX||DINERS
			PayUParameters::PAYMENT_METHOD => $PAYMENT_METHOD,
			
			// Enter the number of installments here.
			PayUParameters::INSTALLMENTS_NUMBER => "1",
			// Enter the name of the country here.
			PayUParameters::COUNTRY => PayUCountries::CO,
			
			//Session id del device.
			PayUParameters::DEVICE_SESSION_ID => session_id(),
			// Payer IP
			PayUParameters::IP_ADDRESS => $_SERVER['REMOTE_ADDR'],
			// Cookie of the current session.
			PayUParameters::PAYER_COOKIE => @$_COOKIE['private_content_version'],
			// User agent of the current session.      
			PayUParameters::USER_AGENT => $_SERVER['HTTP_USER_AGENT'],
	);


// CAPTURE PAYMENT...
	try{		
		$response = PayUPayments::doAuthorizationAndCapture($parameters);
		echo "<pre>"; print_r($response); exit;

		// if ($response) {
		// 	$response->transactionResponse->orderId;
		// 	$response->transactionResponse->transactionId;
		// 	$response->transactionResponse->state;
		// 	if ($response->transactionResponse->state=="PENDING") {
		// 		$response->transactionResponse->pendingReason;	
		// 	}
		// 	$response->transactionResponse->paymentNetworkResponseCode;
		// 	$response->transactionResponse->paymentNetworkResponseErrorMessage;
		// 	$response->transactionResponse->trazabilityCode;
		// 	$response->transactionResponse->responseCode;
		// 	$response->transactionResponse->responseMessage;   	
		// }
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