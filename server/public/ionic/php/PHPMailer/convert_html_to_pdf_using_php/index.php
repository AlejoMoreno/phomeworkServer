<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$DATE_START 			= '27/04/2017';
$DATE_END 				= '29/04/2017';
$DAYS_ON_PERIOD 		= '03';
$DATE_CERTIFICATE_START = '27/04/2017';
$DATE_CERTIFICATE_END 	= '29/04/2017';
$NAME_USER				= 'Hitesh';
$CITY_USER				= 'Surat';
$ID_USER	 			= '0001';
$NAME_TAKER	 			= 'Rajput';
$CITY_TAKER		 		= 'India';
$ID_TAKER				= '10001';
$PRICE			 		= '150';
$TAXES			 		= '10';
$PRICE_AND_TAXES 		= '160';

$SAVE_PDF_PATH = $_SERVER['DOCUMENT_ROOT'].'/programmer/Pdf_Project/downloaded_pdf/';

$html = '<!doctype html>
<html>
<head>
<style>
*{ box-sizing:border-box; font-size:10px;}
h1,h2,h3,h4,h5,h6{ margin:0; padding:0;}
table tr{ float:left; width:100%;}

.lowercase {text-transform: lowercase;}
.uppercase {text-transform: uppercase;}
.capitalize {text-transform: capitalize;}
.main-header h3{font-size:10; margin:0;}
.main-header h4{font-size:8; font-weight:bold;}
.main-header h6{font-size:7; font-weight:bold;}

</style>
<meta charset="utf-8">
<title>PDF</title>
</head>

<body>
<div class="wrapper" style="border:2px solid #000; border-radius:10px; float:left; width:100%; padding:0 10px;">
	<table cellspacing="0" cellpadding="0">
        <tr>
        	<td style="padding-top:0px; float:left; width:15%;">
            	<a href="http://www.segurosmundial.com.co" target="_blank"><img src="images/logo.png" width="120px" alt="logo"></a>	
            </td>
            <td style="text-align:center;  float:left; width:85%; padding:5px 0px 10px 40px;">
            	<h3 style="padding:2px 0 0px; font-size:12px; line-height:14px;">COMPAÑÍA MUNDIAL DE SEGUROS S.A.</h3>
                <h5 style="padding:2px 0 0px; font-size:12px; line-height:14px;">SAMSUNG MOBILECARE</h5>
                <h5 style="padding:2px 0 0px; font-size:11px; line-height:12px;">PÓLIZA DE CORRIENTE DEBIL PROTECCIÓN A EQUIPOS ELECTRICOS Y ELECTRONICOS</h5>
                <h5 style="padding:2px 0 5px; font-size:10px; line-height:12px;">VERSIÓN CLAUSULADO NUMERO 13-03-2017-1317-P-11-PSUS9R0000000002</h5>
                <span style="padding-right:40px; font-weight:normal; font-size:8px; float:right; width:100%; text-align:right;">HOJA No. <b style="font-weight:normal; padding-left:20px; font-size:8px;">1</b></span>	
            </td>
        </tr>

		<tr style="margin-bottom:10px; float:left; width:100%;">
        	<td style="float:left; width:10%; text-align:center;">
            	<span style="font-size:10px; font-weight:bold; padding-bottom:5px; line-height:14px;">NIT 860.037.013-6</span><br/>
                <a href="http://www.segurosmundial.com.co" target="_blank" style="font-size:9px; line-height:14px;">www.segurosmundial.com.co</a>
            </td>
            
            <td style="float:left; width:90%; font-size:8px;">
            	<table style=" width:100%; border:1px solid #000; border-bottom:0; border-radius:6px 6px 0 0;" cellpadding="4" >
                    <tr>
                        <td width="25%" style="padding-left:10px; font-size:8px;">No.POLIZA</td>
                        <td width="25%" style="padding-left:10px; font-size:8px;">No.ANEXO</td>
                        <td width="25%" style="padding-left:10px; font-size:8px;">No.CERTIFICADO</td>
                        <td width="25%" style="padding-left:10px; font-size:8px;">No.RIESGO</td>
                    </tr>
                    <tr>
                    	<td width="30%"  style="font-size:8px; text-align:center;">TIPO DE DOCUMENTO</td>
                        <td colspan="3">
                        	<span style=" font-weight:bold; font-size:8px;">CERTIFICADO INDIVIDUAL DE SEGURO</span>
                        </td>
                    </tr>
				</table>							
				
                <table style="width:100%; border-left:1px solid #000; border-right:1px solid #000;" cellspacing="0" cellpadding="4">                    
                    <tr style="background-color:#00b0f0; color:#fff; ">
                        <th width="20%" style="border:1px solid #000; font-size:8px;">VIGENCIA DESDE</th>
                        <th width="20%" style="border:1px solid #000; font-size:8px; padding:0;">VIGENCIA HASTA</th>
                        <th width="10%" style="border:1px solid #000; font-size:8px;">DIAS</th>
                        <th width="25%" style="border:1px solid #000; font-size:8px;">VIGENCIA DEL CERTIFICADO DESDE</th>
                        <th width="25%" style="border:1px solid #000; font-size:8px;">VIGENCIA DEL CERTIFICADO HASTA</th> 
                    </tr>
                    
                    <tr style="background-color:#dce6f1; color:#000; border:1px solid #000; font-size:8px;">
                    	<td width="20%" style="font-size:8px; border:1px solid #000;">00:00 Horas del &nbsp;'.$DATE_START.'</td>
                        <td width="20%" style="font-size:8px; border:1px solid #000;">24:00 Horas del &nbsp;'.$DATE_END.'</td>
                        <td width="10%" style="font-size:8px; border:1px solid #000;">&nbsp;'.$DAYS_ON_PERIOD.'</td>
                        <td width="25%" style="font-size:8px; border:1px solid #000;">00:00 Horas del &nbsp;'.$DATE_CERTIFICATE_START.'</td>
                        <td width="25%" style="font-size:8px; border:1px solid #000;">24:00 Horas del &nbsp;'.$DATE_CERTIFICATE_END.'</td>
                    </tr>
				</table>
                
                <table style="width:100%; border:1px solid #000; border-radius:0 0 6px 6px;"> 
                    <tr>
                    	<td style="font-size:8px; padding:5px 0 0;" colspan="4">FECHA DE EXPEDICION</td>	
                    </tr>
                    
                    <tr>
                    	<td style="font-size:8px;" width="20%">SUC.EXPEDIDORA</td>
                        <td style="font-size:8px;" width="20%">BOGOTÁ</td>
                        <td style="font-size:8px;" width="30%">DIRECCION: CALLE 33 # 6 B - 24</td>
                        <td style="font-size:8px;" width="30%">TELEFONO: 2855600</td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
        	<td style="padding-top:10px;"></td>
        </tr>
    </table>
    
	<div style="border:1px solid #000; border-radius:6px; margin-bottom:10px;">
    <table style="font-size:5; border-radius:10px; text-align:center; margin-bottom:0px;" cellpadding="2" cellspacing="0" width="100%" align="center">
	  <tr>
	  	  <td width="12%" bgcolor="#DCE6F0" style="border-right:1px solid #000; border-radius:10px; font-size:8px;">TOMADOR</td>
		  <td width="30%"  style=" font-size:8px; font-weight:bolder; text-align:left; padding-left:10px;">SAMSUNG ELECTRONICS COLOMBIA S.A.</td>
		  <td width="8%"></td>
		  <td width="22%"></td>
		  <td width="12%" bgcolor="#DCE6F0" style="border-right:1px solid #000; border-left:1px solid #000; font-size:8px;">NIT / CC</td>
		  <td width="16%" style="font-size:8px;">830.028.931</td>
	  </tr>
	  <tr>
	  	  <td width="12%" bgcolor="#DCE6F0" style="border-right:1px solid #000; font-size:8px;">DIRECCION</td>
		  <td width="30%" style="text-align:left; font-size:7px; padding-left:10px;">CARRERA 7 No 113 - 43 OFC. 607 (Torre Samsung)</td>
		  <td width="8%" bgcolor="#DCE6F0" style=" border:1px solid #000000; font-size:8px;">CIUDAD</td>
		  <td width="22%" style="font-weight:bolder; font-size:8px;">BOGOTÁ</td>
		  <td width="12%" bgcolor="#DCE6F0" style=" font-size:8px; border-right:1px solid #000; border-left:1px solid #000;">TELEFONO</td>
		  <td width="16%" style="font-size:8px;">6001272</td>
	  </tr>
	  <tr>
	  	  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-top:1px solid #000; border-right:1px solid #000; ">ASEGURADO</td>
		  <td width="30%" rowspan="2" style="border-top:1px solid #000; font-size:8px;"> '.$NAME_USER.'</td>
		  <td width="8%" style="border-top:1px solid #000;"></td>
		  <td width="22%" rowspan="2" style="border-top:1px solid #000; font-size:8px;">'.$CITY_USER.'</td>
		  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-top:1px solid #000; border-right:1px solid #000; border-left:1px solid #000;">NIT / CC		</td>
		  <td width="16%" rowspan="2" style="border-top:1px solid #000; font-size:8px;">'.$ID_USER.'</td>
	  </tr>
	  <tr>
	  	  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-right:1px solid #000;">EMAIL</td>
		  <td width="8%" bgcolor="#DCE6F0" style="font-size:8px; border:1px solid #000000;">CIUDAD</td>
		  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-right:1px solid #000; border-left:1px solid #000;">TELEFONO</td>
		</tr>
	  <tr>
	  	  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-top:1px solid #000; border-right:1px solid #000;">BENEFICIARIO</td>
		  <td width="30%" rowspan="2" style="border-top:1px solid #000; font-size:8px;">'.$NAME_TAKER.'</td>
		  <td width="8%"  style="border-top:1px solid #000;"></td>
		  <td width="22%" rowspan="2" style="border-top:1px solid #000; font-size:8px;">'.$CITY_TAKER.'</td>
		  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-top:1px solid #000; border-right:1px solid #000; border-left:1px solid #000;">NIT / CC</td>
		  <td width="16%" rowspan="2" style="border-top:1px solid #000; font-size:8px;">'.$ID_TAKER.'</td>
	  </tr>
	  <tr style=" border-radius:10px;">
	  	  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-radius:10px; border-right:1px solid #000;">EMAIL</td>
		  <td width="8%" bgcolor="#DCE6F0" style="font-size:8px; border:1px solid #000000;">CIUDAD</td>
		  <td width="12%" bgcolor="#DCE6F0" style="font-size:8px; border-right:1px solid #000; border-left:1px solid #000;">TELEFONO</td>
		</tr>
	</table>
  	</div>
    
    <div style="border:1px solid #000; border-radius:6px; margin-bottom:10px;">
        <table style="font-size:5;  text-align:center; " cellpadding="5" cellspacing="0" width="100%" align="center">
          <tr>
              <td width="12%" bgcolor="#DCE6F0" style="border-right:1px solid #000; font-size:8px;">MARCA</td>
              <td width="27%" style="font-weight:bolder; text-align:left; padding-left:20px;">SAMSUNG</td>
              <td width="10%" bgcolor="#DCE6F0" style=" border-left:1px solid #000; font-size:8px; border-right:1px solid #000000;">MODELO</td>
              <td width="24%"></td>
              <td width="12%" bgcolor="#DCE6F0" style="border-left:1px solid #000; border-right:1px solid #000; font-size:8px;">SERIE</td>
              <td width="16%"></td>
          </tr>
          <tr>
              <td width="12%;" bgcolor="#DCE6F0" style="border-right:1px solid #000; font-size:8px;">DIRECCION</td>
              <td width="27%"></td>
              <td width="10%" bgcolor="#DCE6F0" style="border-left:1px solid #000000; font-size:8px; border-right:1px solid #000000;">CIUDAD</td>
              <td width="24%" style="font-weight:bolder;"></td>
              <td width="12%" bgcolor="#DCE6F0" style="border-right:1px solid #000; border-left:1px solid #000; font-size:8px;">No FACTURA</td>
              <td width="16%" style="font-weight:bolder;"></td>
          </tr>
        </table>
	</div>
	
	<table style="font-size:5; border:1px solid black; text-align:center; margin-bottom:10px;" cellpadding="2" cellspacing="0" width="100%" align="center">
	  <tr>
	  	  <td width="100%" colspan="3" bgcolor="#00AFEF" style="border:1px solid #000; color:#fff; font-weight:bolder; font-size:7;">CONDICIONES DE COBERTURA</td>
	  </tr>
	  <tr>
	  	  <td width="44%" bgcolor="#DCE6F0" style="font-size:8px; font-weight:bolder; border-right:1px solid #000; border-left:1px solid #000;">COBERTURA</td>
		  <td width="28%" bgcolor="#DCE6F0" style="font-size:8px; font-weight:bolder;">LIMITE ASEGURADO </td>
		  <td width="28%" bgcolor="#DCE6F0" style="font-size:8px; font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;">DEDUCIBLES</td>
	  </tr>
	  <tr>
	  	  <td width="44%" style=" text-align:left; font-size:8px; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000;">DAÑO ACCIDENTAL DE PANTALLA</td>
		  <td width="28%" style="font-size:8px; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000;">COSTO DE LA REPARACIÓN DE LA PANTALLA</td>
		  <td width="28%" style="font-size:8px; border-left:1px solid #000000; border-right:1px solid #000000; border-top:1px solid #000000;">$99.000</td>
	  </tr>
	  <tr>
	  	<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
		<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
		<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
	  </tr>
	  <tr>
	  	<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
		<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
		<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
	  </tr>
	  <tr>
	  	<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
		<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
		<td style="font-weight:bolder; border-left:1px solid #000000; border-right:1px solid #000000;"></td>
	  </tr>
	</table>
	
	<table style="font-size:5; text-align:center; margin-bottom:10px;"  width="100%" align="center">
		<tr>
        	<td style=" width:40%; float:right;"></td>
            <td style=" width:40%; float:right; text-align:center;">
                <table cellpadding="8" cellspacing="0" width="100%">
                 <tr>
                    <td width="35%" bgcolor="#00AFEF" style="font-size:8px; border:1px solid #000; color:#fff;">PRIMA</td>
                    <td width="30%" bgcolor="#00AFEF" style="font-size:8px; border:1px solid #000; color:#fff;">IVA </td>
                    <td width="35%" bgcolor="#00AFEF" style="font-size:8px; border:1px solid #000; color:#fff;">TOTAL PRIMA + IVA</td>
                </tr>
                <tr>
                    <td width="35%" style="border:1px solid #000; font-size:8px;">'.$PRICE.'</td>
                    <td width="30%" style="border:1px solid #000; font-size:8px;">'.$TAXES.'</td>
                    <td width="35%" style="border:1px solid #000; font-size:8px;">'.$PRICE_AND_TAXES.'</td>
                </tr>	
                </table>
            </td>
        </tr>
	</table>
	 
    <table cellpadding="5" cellspacing="0" style="border:1px solid #000; margin-bottom:10px;">
	 	<tr>
			<td bgcolor="#00AFEF" style="border:1px solid #000; color:#fff; font-weight:bolder; font-size:8px;" align="center">OBSERVACIONES</td>
		</tr>
		<tr>
			<td style="color:#000;font-size:6px;">ESTIMADO CLIENTE TENGA EN CUENTA LAS SIGUIENTES RECOMENDACIONES</td>
		</tr>
		<tr>
			<td style="color:#000;font-size:6px; line-height:10px;">SI REQUIERE DAR AVISO DE SINIESTRO PUEDE HACERLO A TRAVÉS DE LA PLATAFORMA CONSIERGE O COMUNIQUESE CON LAS LINEAS DE ATENCIÓN AL CLIENTE DE SEGUROS MUNDIAL, DIGITANDO OPCIÓN (1): SOLICITUD DE ASISTENCIAS O 
REPORTAR SINIESTROS, LUEGO OPCIÓN (2): SINIESTROS Y FINALMENTE OPCIÓN (3): SINIESTROS DE CELULARES, TABLETS Y COMPUTADORES</td>
		</tr>
		<tr>
			<td style="color:#000;font-size:6px;">SI SU EQUIPO TIENE CAMBIO POR GARANTIA DE FABRICANTE, DEBE REPORTAR ESTA NOVEDAD PARA CONSERVAR LA COBERTURA DE ESTE SEGURO</td>
		</tr>
	 </table>
	 
    <div style=" position:relative; clear:both;">
    	<span style=" position:absolute; left:-11px; top:-10px; "><img src="images/left_vigilado.png" width="11" alt="logo"></span>
    </div> 
    <table cellpadding="5" cellspacing="0" style="border:1px solid #000; margin-bottom:30px;">
    	<tr>
			<td bgcolor="#00AFEF" style="border:1px solid #000; color:#fff; font-weight:bolder; font-size:8px; line-height:14px;" align="center">CONDICIONES GENERALES DE LA POLIZA</td>
		</tr>
		<tr>
			<td style="color:#000;font-size:6px; line-height:10px; word-wrap:break-word; word-break:break-all; hyphen:auto;">ADJUNTO ENCONTRARÁ LAS CONDICIONES PARTICULARES DE ESTE SEGURO, SI REQUIERE CONOCER LAS CONDICIONES GENERALES, ESTÁS SE ENCUENTRAN MENCIONADAS EN EL TEXTO DEL CLAUSULADO NUMERO 13-03-2017-1317-P-11- PSUS9R0000000002, LAS CUALES PUEDEN SER CONSULTADAS EN LA PÁGINA WEB DE SEGUROS MUNDIAL WWW.SEGUROSMUNDIAL.COM.CO</td>
		</tr>
		<tr>
			<td style="color:#000;font-size:6px; line-height:10px; word-wrap:break-word; word-break:break-all; hyphen:auto;">DE ACUERDO CON EL ARTICULO 1068 DEL CÓDIGO DE COMERCIO, MODIFICADO POR EL ARTÍCULO 82 DE LA LEY 45 DE 1990,  LA MORA EN EL PAGO DE LA PRIMA DE LA PRESENTE PÓLIZA  O DE LOS CERTIFICADOS O ANEXOS QUE SE<br> 
             EXPIDAN CON FUNDAMENTO EN ELLA PRODUCIRÁ LA TERMINACIÓN AUTOMÁTICA DEL CONTRATO Y DARÁ DERECHO A LA COMPAÑÍA DE SEGUROS PARA EXIGIR EL PAGO <br>
             DE LA PRIMA DEVENGADA Y DE LOS GASTOS CAUSADOS POR LA EXPEDICIÓN DE LA PÓLIZA</td>
		</tr>
	 </table>
	 
    <table align="center;" cellpadding="5" cellspacing="0" style="table-layout:fixed; width:100%; margin-bottom:10px;">
	 	<tr>
			<td style="border-bottom:2px solid #000; text-align:center;">
				<img src="images/signature.png" style="text-align:center;">				
			</td>
            
            <td style="text-align:right;" align="right">
				<span style="display:inline-block; float:right; border-bottom:2px solid #000; width:200px; margin-right:40px; margin-top:60px;"></span>
			</td>
		</tr>
		
		<tr>
			<td width="50%" style="font-size:5; font-weight:bold" align="center">
				COMPAÑÍA MUNDIAL DE SEGUROS S.A. <br/>
DIRECCION GENERAL CALLE 33 N. 6B - 24 PISOS 2 Y 3 <br/>
TELEFONO: 2855600 FAX 2851220 <br/>
SOMOS GRANDES CONTRIBUYENTES - IVA REGIMEN COMUN - AUTORETENEDORES
			</td>
			<td width="50%" style="font-size:5; font-weight:bold" align="center">
				<span style="font-size:8px; text-align:center; vertical-align:top; margin-top:-20px; display:block; padding-left:40px;">TOMADOR</span>
			</td>
		</tr>		
	</table>
	
    <table style="font-size:8px; font-weight:bold; color:#454F63; table-layout:fixed; width:100%; margin-bottom:20px;">
	 	<tr>
			<td>
				<a href="http://www.segurosmundial.com.co" target="_blank"><img src="images/logo.png" width="140px" alt="footer-logo"></a>
            </td>
			<td>
				<table style="width:100%;">
					<tr>
                    	<td colspan="2">Lineas de Atencion al Cliente: </td>
                    </tr>
                    <tr>
						<td width="20%">
							<img src="images/telephone.png" >
						</td>
						<td width="80%">
							Bogota:327 4712 / 327 4713<br/>
							Nacional:01 8000 111 935
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td width="20%">
							<img src="images/tele.png" >
						</td>
						<td width="70%">
							Portal Web <br/>
							<a href="http://www.segurosmundial.com.co" target="_blank">www.segurosmundial.com.co</a>
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td width="15%">
							<a href="#" target="_blank"><img src="images/facebook.png" ></a>
						</td>
						<td width="15%">
							<a href="#" target="_blank"><img src="images/twitter.png" ></a>
						</td>
						<td width="15%">
							<a href="#" target="_blank"><img src="images/youtube.png" ></a>
						</td>
						<td width="55%" style="white-space:nowrap;">
							Seguros Mundial
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</body>
</html>';

	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();
	
	$output = $dompdf->output();
	$filename = 'Segurosmundial'.time().'.pdf';
	file_put_contents($SAVE_PDF_PATH.$filename, $output);

	//send mail
	$useremail = 'salientcopmputer@gmail.com';
	$content="<html></html>" ;     
	$to = $useremail;
	$from = "Segurosmundial";
	$subject = "Thank you for your Contribution";
	$message = "<p>Well Come</p>";
	
	$separator = md5(time());
	$eol = PHP_EOL;
	$filename = $filename;
	$pdfdoc = $output;
	$attachment = chunk_split(base64_encode($pdfdoc));
	
	$headers = "From: " . $from . $eol;
	$headers .= "MIME-Version: 1.0" . $eol;
	$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
	
	$body = "Content-Transfer-Encoding: 7bit" . $eol;
	$body .= "This is a MIME encoded message." . $eol; 
	$body .= "--" . $separator . $eol;
	$body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
	$body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
	$body .= $message . $eol;
	$body .= "--" . $separator . $eol;
	$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
	$body .= "Content-Transfer-Encoding: base64" . $eol;
	$body .= "Content-Disposition: attachment" . $eol . $eol;
	$body .= $attachment . $eol;
	$body .= "--" . $separator . "--";
	mail($to, $subject, $body, $headers);
?>
