<?php 

// SOME VARIABLES...
	// Test account credintilas from (http://developers.payulatam.com/en/api/sandbox.html)
		//$apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
		//$apiLogin = "pRRXKOl8ikMmt9u";
		//$merchantId = "508029";
		//$accountId = "512321";

	// client's credentials...
		$apiKey = "VayBPsJpvSssy4PeJbSWmuJiFV";
		$apiLogin = "22l56TfbD9Qz8K4";

	// for testing...
		$testMode = false; // JUST HAVE THIS MODE true OR false, to make it work as you want it.

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

		// verificar si esta disponible el servicio
		/*$data = array(
   			"test" => false,
		   "language" => "en",
		   "command" => "PING",
		   "merchant" => array(
		      "apiLogin" => "pRRXKOl8ikMmt9u",
		      "apiKey" => "4Vj8eK4rloUd272L48hsrarnUA"
		   )
		);*/

		$conn =  mysqli_connect("phomework.com.co", "leizycom_admin", "david1234"); //cambiar usuario por osmed
		
        	if (!$conn) {
			echo 'conexion';
		    die('No pudo conectarse: ' . mysqli_error($conn));
		}
		//--------------------------------------------------------------
		mysqli_select_db($conn,"leizycom_phomework") or die(mysqli_error($conn));

		//buscar ordenes pendientes
		$sql = "SELECT * FROM `pagos` WHERE `lapTransactionState` LIKE 'PENDING' ";
		$bill = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($bill)){
			$orden = $row['reference_pol'];

			$data = array(
			   "test" => false,
			   "language" => "es",
			   "command" => "ORDER_DETAIL",
			   "merchant" => array(
			      "apiLogin" => $apiLogin,
			      "apiKey" => $apiKey
			   ),
			   "details" => array(
			      "orderId" => intval($orden)
			   )
			);
			//echo '<pre>'.json_encode($data).'</pre>';
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL,$reportUrl);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);
			curl_close ($ch);

			$server_output = new SimpleXMLElement($server_output);

			//echo '<pre>'.print_r($server_output).'</pre>';


			$estado = $server_output->result->payload->transactions->transaction->transactionResponse->state;
			$responseCode = $server_output->result->payload->transactions->transaction->transactionResponse->responseCode;
			$operationDate = $server_output->result->payload->transactions->transaction->transactionResponse->operationDate;

			if($estado == 'APPROVED'){
				$estado_producto = '+';
			}
			elseif($estado == 'DECLINED'){
				$estado_producto = '=';
			}
			elseif($estado == 'PENDING'){
				$estado_producto = '=';
			}
			elseif($estado = 'EXPIRED'){
				$estado_producto = '=';
			}
			$id = $row['idpago'];
			$sql1 = "UPDATE `pagos` SET `lapTransactionState` = '$estado', `responseCode` = '$responseCode', `signo` = '$estado_producto' WHERE `pagos`.`idpago` = $id ;";
			mysqli_query($conn, $sql1);
			echo $sql1;
			//echo $estado.' '.$responseCode.' '.$operationDate.' ';
			

		}

/* EXAMPLE RESPONSE...
	// <reportingResponse>
    <code>SUCCESS</code>
    <result>
        <payload class="order">
            <id>950350893</id>
            <accountId>644720</accountId>
            <status>CAPTURED</status>
            <referenceCode>Product_48617</referenceCode>
            <description>6 MESES PROTECCI�N&lt;br&gt; DE PANTALLA Y DA�O &lt;br&gt;TOTAL ACCIDENTAL&lt;br&gt; MOBILE CARE CON DEDUCIBLE</description>
            <language>en</language>
            <buyer>
                <fullName>Hussein El Rada</fullName>
                <emailAddress>husseinrada@hotmail.com</emailAddress>
                <contactPhone>3007474224</contactPhone>
            </buyer>
            <transactions>
                <transaction>
                    <id>f848bf79-1372-4d7f-8aeb-5eb35f20eb1c</id>
                    <creditCard>
                        <maskedNumber>459918******9877</maskedNumber>
                        <name>HusseinEl Reda</name>
                        <issuerBank>BANCO DE BOGOTA</issuerBank>
                    </creditCard>
                    <type>AUTHORIZATION_AND_CAPTURE</type>
                    <paymentMethod>VISA</paymentMethod>
                    <source>PAYU_SDK</source>
                    <paymentCountry>CO</paymentCountry>
                    <transactionResponse>
                        <state>APPROVED</state>
                        <paymentNetworkResponseCode>00</paymentNetworkResponseCode>
                        <trazabilityCode>910091866</trazabilityCode>
                        <authorizationCode>451394</authorizationCode>
                        <responseCode>APPROVED</responseCode>
                        <operationDate>2017-06-16T16:58:42</operationDate>
                    </transactionResponse>
                    <deviceSessionId>5fd519b97c7edf14d2ae84994e54372b</deviceSessionId>
                    <ipAddress>190.182.106.113</ipAddress>
                    <cookie>cookie_0.79728700 1497650319</cookie>
                    <userAgent>Mozilla/5.0 (Linux; Android 7.0; SAMSUNG SM-G955F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/5.4 Chrome/51.0.2704.106 Mobile Safari/537.36</userAgent>
                    <payer>
                        <fullName>HusseinEl Reda</fullName>
                        <billingAddress>
                            <street1>Cra 48 #70-212</street1>
                            <street2>125544</street2>
                            <city>Bogota</city>
                            <state>Bogota</state>
                            <country>CO</country>
                            <postalCode>000000</postalCode>
                            <phone>7563126</phone>
                        </billingAddress>
                        <emailAddress>husseinrada@hotmail.com</emailAddress>
                        <contactPhone>3007474224</contactPhone>
                        <dniNumber>15208879</dniNumber>
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
                                <value>176715.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>TX_VALUE</string>
                            <additionalValue>
                                <value>176715.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_TAX_RETURN_BASE</string>
                            <additionalValue>
                                <value>148500.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_VALUE</string>
                            <additionalValue>
                                <value>176715.00</value>
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
                                <value>176715.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>DP_MERCHANT_COMMISSION_VALUE</string>
                            <additionalValue>
                                <value>7238.35</value>
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
                                <value>28215.00</value>
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
                                <value>148500.00</value>
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
                                <value>162402.11</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>PM_PURCHASE_VALUE</string>
                            <additionalValue>
                                <value>148500.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                        <entry>
                            <string>TX_TAX</string>
                            <additionalValue>
                                <value>28215.00</value>
                                <currency>COP</currency>
                            </additionalValue>
                        </entry>
                    </additionalValues>
                    <extraParameters>
                        <entry>
                            <string>CREDIBANCO_CERTIFICATE_MERCHANT_NAME</string>
                            <string>PAYU PAGOSONLINE 30911 011213402</string>
                        </entry>
                        <entry>
                            <string>MERCHANT_PROFILE_ID</string>
                            <string>6804927f-38bb-4325-9e7e-c6907556278f</string>
                        </entry>
                        <entry>
                            <string>CREDIBANCO_RESPONSE_ANSWER_MESSAGE</string>
                            <string>00</string>
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
                            <string>CREDIBANCO_REFERENCE_CODE</string>
                            <string>19431941</string>
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
                            <string>INSTALLMENTS_NUMBER</string>
                            <string>1</string>
                        </entry>
                        <entry>
                            <string>PRICING_PROFILE_GROUP_ID</string>
                            <string>f65720ab-5bed-4667-bcf9-83e51388a25f</string>
                        </entry>
                        <entry>
                            <string>CREDIBANCO_CERTIFICATE_AGENCY_CODE</string>
                            <string>011213402</string>
                        </entry>
                        <entry>
                            <string>CREDIBANCO_CERTIFICATE_TERMINAL_NUMBER</string>
                            <string>00030911</string>
                        </entry>
                        <entry>
                            <string>PERCENT_SHIPPING_MERCHANT</string>
                            <string>0</string>
                        </entry>
                        <entry>
                            <string>CREDIBANCO_RESPONSE_AUTHORIZATION_CODE</string>
                            <string>451394</string>
                        </entry>
                        <entry>
                            <string>CREDIBANCO_RESPONSE_RECEIPT_NUMBER</string>
                            <string>910091866</string>
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
                        <value>176715.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_TAX_RETURN_BASE</string>
                    <additionalValue>
                        <value>148500.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>PM_VALUE</string>
                    <additionalValue>
                        <value>176715.00</value>
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
                        <value>176715.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>DP_MERCHANT_COMMISSION_VALUE</string>
                    <additionalValue>
                        <value>7238.35</value>
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
                        <value>148500.00</value>
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
                        <value>28215.00</value>
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
                        <value>148500.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
                <entry>
                    <string>TX_TAX</string>
                    <additionalValue>
                        <value>28215.00</value>
                        <currency>COP</currency>
                    </additionalValue>
                </entry>
            </additionalValues>
        </payload>
    </result>
</reportingResponse>

	// )*/
?>