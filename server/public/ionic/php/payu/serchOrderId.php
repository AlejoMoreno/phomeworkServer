<?php 


include_once "../conexion.php"; 
$conexion = conexion();
$payu = mysqli_query($conexion,"SELECT * FROM `pagos` WHERE `responseCode` LIKE 'PENDING'") or die(mysqli_error($conexion));
while ($row = $payu->fetch_assoc()){
	$orderid=$row['reference_pol'];
	$transactionId=$row['transactionId'];
	                   
	$data_string = array(
		'test' 		=> false,
		'language' 	=> "es",
		'command' 	=> "ORDER_DETAIL",
		'merchant' 	=> array(
			'apiLogin' 	=> "22l56TfbD9Qz8K4",
			'apiKey' 	=> "VayBPsJpvSssy4PeJbSWmuJiFV"),
		'details' 	=> array(
			'orderId' 	=> intval($orderid))
		);                                                                          

	//Pruebas: https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi
	//Producción: https://api.payulatam.com/reports-api/4.0/service.cgi
 	//"apiLogin": "22l56TfbD9Qz8K4",
    //"apiKey": "VayBPsJpvSssy4PeJbSWmuJiFV"

	$url='https://api.payulatam.com/reports-api/4.0/service.cgi';
	$datos=json_encode($data_string);
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
}


/*

TIPO envio
/*$data_string = '{
   "test": false,
   "language": "es",
   "command": "ORDER_DETAIL",
   "merchant": {
      "apiLogin": "22l56TfbD9Qz8K4",
      "apiKey": "VayBPsJpvSssy4PeJbSWmuJiFV"
   },
   "details": {
      "orderId": '.$orderid.'
   }
}';   



Respuesta payu

<reportingResponse>
    <code>SUCCESS</code>
    <result>
        <payload class="order">
            <id>947179095</id>
            <accountId>634315</accountId>
            <status>IN_PROGRESS</status>
            <referenceCode>01 - 2017-06-02 15:36:59 872</referenceCode>
            <description>Recarga de 10000 pesos</description>
            <language>es</language>
            <shippingAddress>
                <street1>cl 8</street1>
                <city>bogota</city>
                <country>CO</country>
            </shippingAddress>
            <buyer>
                <fullName>alejandro</fullName>
                <emailAddress>fredymoreno@uan.edu.co</emailAddress>
                <contactPhone>57 3219045297</contactPhone>
            </buyer>
            <transactions>
                <transaction>
                    <id>0b962266-cd35-4825-b629-41c666ed46c7</id>
                    <type>AUTHORIZATION_AND_CAPTURE</type>
                    <paymentMethod>BALOTO</paymentMethod>
                    <source>PAYMENT_BUTTON</source>
                    <paymentCountry>CO</paymentCountry>
                    <transactionResponse>
                        <state>PENDING</state>
                        <pendingReason>AWAITING_NOTIFICATION</pendingReason>
                        <responseCode>PENDING_TRANSACTION_CONFIRMATION</responseCode>
                    </transactionResponse>
                    <deviceSessionId>704a2a94988834e0fce4ac657909db53</deviceSessionId>
                    <ipAddress>186.145.86.24</ipAddress>
                    <cookie>pol_186_145_86_24_1496435816456</cookie>
                    <userAgent>Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36</userAgent>
                    <expirationDate>2017-06-07T23:59:59</expirationDate>
                    <payer>
                        <billingAddress>
                            <country>CO</country>
                        </billingAddress>
                        <emailAddress>fredymoreno@uan.edu.co</emailAddress>
                    </payer>
                    <additionalValues>
                        <entry>
                            <string>TX_ADDITIONAL_VALUE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_PAYER_TOTAL_AMOUNT</string>
                            <additionalValue>
                                <value>10000.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>TX_VALUE</string>
                            <additionalValue>
                                <value>10000.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_TAX_RETURN_BASE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_VALUE</string>
                            <additionalValue>
                                <value>10000.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>COMMISSION_VALUE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_NETWORK_VALUE</string>
                            <additionalValue>
                                <value>10000.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>DP_MERCHANT_COMMISSION_VALUE</string>
                            <additionalValue>
                                <value>3451.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_ADDITIONAL_VALUE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_PAYER_PRICING_VALUES</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_TAX</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_PAYER_COMMISSION_VALUE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>TX_TAX_RETURN_BASE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_PAYER_INTEREST_VALUE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>DP_MERCHANT_INTEREST_VALUE</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>DP_MERCHANT_TOTAL_INCOME_VALUE</string>
                            <additionalValue>
                                <value>6549.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_PURCHASE_VALUE</string>
                            <additionalValue>
                                <value>10000.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>TX_TAX</string>
                            <additionalValue>
                                <value>0.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                    </additionalValues>
                    <extraParameters>
                        <entry>
                            <string>MERCHANT_PROFILE_ID</string>
                            <string>6804927f-38bb-4325-9e7e-c6907556278f</string>
                        </entry>
                        <entry>
                            <string>MAX_SHIPPING_MERCHANT</string>
                            <string>0</string>
                        </entry>
                        <entry>
                            <string>MIN_SHIPPING_PAYER</string>
                            <string>0</string>
                        </entry>
                        <entry>
                            <string>CHECKOUT_VERSION</string>
                            <string>V2</string>
                        </entry>
                        <entry>
                            <string>MAX_SHIPPING_PAYER</string>
                            <string>0</string>
                        </entry>
                        <entry>
                            <string>MIN_SHIPPING_MERCHANT</string>
                            <string>0</string>
                        </entry>
                        <entry>
                            <string>URL_PAYMENT_RECEIPT_HTML</string>
                            <string>https://checkout.payulatam.com/ppp-web-gateway-payu/app?vid=947179095Y0b962266cd35482Yc02b54daa7415b4</string>
                        </entry>
                        <entry>
                            <string>INSTALLMENTS_NUMBER</string>
                            <string>1</string>
                        </entry>
                        <entry>
                            <string>PRICING_PROFILE_GROUP_ID</string>
                            <string>f65720ab-5bed-4667-bcf9-83e51388a25f</string>
                        </entry>
                        <entry>
                            <string>EMAIL_REMINDER_DAYS_MODEL</string>
                            <string>0,1,3,6</string>
                        </entry>
                        <entry>
                            <string>URL_PAYMENT_RECEIPT_PDF</string>
                            <string>https://checkout.payulatam.com/ppp-web-gateway-payu/receipt?vid=947179095Y0b962266cd35482Yc02b54daa7415b4</string>
                        </entry>
                        <entry>
                            <string>REFERENCE</string>
                            <string>947179095</string>
                        </entry>
                        <entry>
                            <string>NEXT_EMAIL_REMINDER_DATE</string>
                            <string>2017/06/03</string>
                        </entry>
                        <entry>
                            <string>PERCENT_SHIPPING_MERCHANT</string>
                            <string>0</string>
                        </entry>
                    </extraParameters>
                </transaction>
            </transactions>
            <additionalValues>
                <entry>
                    <string>TX_ADDITIONAL_VALUE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>TX_VALUE</string>
                    <additionalValue>
                        <value>10000.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_TAX_RETURN_BASE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_VALUE</string>
                    <additionalValue>
                        <value>10000.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>COMMISSION_VALUE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_NETWORK_VALUE</string>
                    <additionalValue>
                        <value>10000.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>DP_MERCHANT_COMMISSION_VALUE</string>
                    <additionalValue>
                        <value>3451.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_ADDITIONAL_VALUE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_PAYER_PRICING_VALUES</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>TX_TAX_RETURN_BASE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_PAYER_COMMISSION_VALUE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_TAX</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_PAYER_INTEREST_VALUE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>DP_MERCHANT_INTEREST_VALUE</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_PURCHASE_VALUE</string>
                    <additionalValue>
                        <value>10000.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>TX_TAX</string>
                    <additionalValue>
                        <value>0.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
            </additionalValues>
        </payload>
    </result>
</reportingResponse>



*/
?>