<!DOCTYPE html>
<!--
    Licensed to the 
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/phomeworks.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- FUNCIONES PROPIAS PHOMEWORK -->
        <script src="js/forms.js"></script>
        <script src="js/configuration.js"></script>
        <title>Phomework</title>

    </head>
    <body>

    <div class="jumbotro text-center inicio">
            <h3>Respuesta </h3>
            <img class="imgr" style="width:40px;position:absolute;left:10px;top:8px;" src="image/phome-ico.png">
        </div>

<div style="width: 100%;height: 100px;">.</div>

<div class="container center"> 

<?php
if(isset($_REQUEST['merchantId'])){

	$ApiKey = "VayBPsJpvSssy4PeJbSWmuJiFV";
	$merchant_id = $_REQUEST['merchantId'];
	$referenceCode = $_REQUEST['referenceCode'];
	$TX_VALUE = $_REQUEST['TX_VALUE'];
	$New_value = number_format($TX_VALUE, 1, '.', '');
	$currency = $_REQUEST['currency'];
	$transactionState = $_REQUEST['transactionState'];
	$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
	$firmacreada = md5($firma_cadena);
	$firma = $_REQUEST['signature'];
	$reference_pol = $_REQUEST['reference_pol'];
	$cus = $_REQUEST['cus'];
	$extra1 = $_REQUEST['description'];
	$pseBank = $_REQUEST['pseBank'];
	$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
	$transactionId = $_REQUEST['transactionId'];
	$lapTransactionState = $_REQUEST['lapTransactionState'];

	if ($_REQUEST['transactionState'] == 4 ) {
		$signo = '+';
		$estadoTx = "Transacción aprobada";
	}

	else if ($_REQUEST['transactionState'] == 6 ) {
		$signo = '=';
		$estadoTx = "Transacción rechazada";
	}

	else if ($_REQUEST['transactionState'] == 104 ) {
		$signo = '=';
		$estadoTx = "Error";
	}

	else if ($_REQUEST['transactionState'] == 7 ) {
		$signo = '=';
		$message = "Transacción pendiente";
		$estadoTx = '';
	}

	else {
		$signo = '=';
		$message=$_REQUEST['mensaje'];
		$estadoTx = '';
	}
	/*http://www.phomework.com.co/www/regresopayu.php?merchantId=631982&merchant_name=Julio+Cesar++Diaz+Cano&merchant_address=cr+51+38+16+sur+&telephone=3227593073&merchant_url=http%3A%2F%2Fwww.phomework.com.co%2F&transactionState=7&lapTransactionState=PENDING&message=PENDING&referenceCode=01+-+2017-05-31+13%3A28%3A06+330&reference_pol=946650574&transactionId=26c6e152-bc7c-4a91-b486-ec3bf8c616f3&description=Recarga+de+10000+pesos&trazabilityCode=&cus=&orderLanguage=es&extra1=&extra2=&extra3=&polTransactionState=14&signature=c1e9e63f059a1b3f1c15f1e5451059f3&polResponseCode=25&lapResponseCode=PENDING_TRANSACTION_CONFIRMATION&risk=&polPaymentMethod=35&lapPaymentMethod=BALOTO&polPaymentMethodType=7&lapPaymentMethodType=CASH&installmentsNumber=1&TX_VALUE=10000.00&TX_TAX=.00&currency=COP&lng=es&pseCycle=&buyerEmail=fredymoreno%40uan.edu.co&pseBank=&pseReference1=&pseReference2=&pseReference3=&authorizationCode=*/


	if (strtoupper($firma) == strtoupper($firmacreada)) {

		$conexion =  mysqli_connect("phomework.com.co", "leizycom_admin", "david1234"); //cambiar usuario por osmed
		
	        	if (!$conexion) {
				echo 'conexion';
			    die('No pudo conectarse: ' . mysqli_error($conexion));
			}
			//--------------------------------------------------------------
			mysqli_select_db($conexion,"leizycom_phomework") or die(mysqli_error($conexion));

		$buyerEmail = $_REQUEST['buyerEmail'];
		$estudiante = mysqli_query($conexion,"SELECT * FROM `estudiantes` WHERE `correo` LIKE '$buyerEmail'") or die(mysqli_error($conexion));
		$row = $estudiante->fetch_assoc();
		$idestudiante = $row['idestudiante'];
		//guardar proceso
		
		echo $buyerEmail;
		$hoy = date('Y-m-d');

		include("php/conexion.php"); 
		$conexion = conexion();
		$sql = "INSERT INTO `pagos` (`idpago`, `idestudiante`, `valor`, `signo`, `saldo`, `reference_pol`, `transactionId`, `responseCode`, `FIRMA`, `EMAILPAYER`, `DESCRIPTION`, `REFERENCE_CODE`, `fecha_creation`, `lapTransactionState`) VALUES (
			NULL, 
			$idestudiante, 
			'$TX_VALUE', 
			'$signo', 
			'1',  
			'$reference_pol', 
			'$transactionId', 
			'$message', 
			'$firma', 
			'$buyerEmail', 
			'".$lapPaymentMethod." Ref:".$referenceCode."', 
			'$transactionState', 
			'$hoy',
			'$lapTransactionState');";
		    mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
	?>
		<h2>Resumen Transacción</h2>
		<table>
		<tr>
		<td>Estado de la transaccion</td>
		<td><?php echo $estadoTx; ?></td>
		</tr>
		<tr>
		<tr>
		<td>ID de la transaccion</td>
		<td><?php echo $transactionId; ?></td>
		</tr>
		<tr>
		<td>Transacción Estado</td>
		<td style="color:red;font-size: 30px;"><?php echo $message; ?></td>
		</tr>
		<tr>
		<td>Referencia de la venta</td>
		<td><?php echo $reference_pol; ?></td> 
		</tr>
		<tr>
		<td>Referencia de la transaccion</td>
		<td><?php echo $referenceCode; ?></td>
		</tr>
		<tr>
		<?php
		if($pseBank != null) {
		?>
			<tr>
			<td>cus </td>
			<td><?php echo $cus; ?> </td>
			</tr>
			<tr>
			<td>Banco </td>
			<td><?php echo $pseBank; ?> </td>
			</tr>
		<?php
		}
		?>
		<tr>
		<td>Valor total</td>
		<td>$<?php echo number_format($TX_VALUE); ?></td>
		</tr>
		<tr>
		<td>Moneda</td>
		<td><?php echo $currency; ?></td>
		</tr>
		<tr>
		<td>Descripción</td>
		<td><?php echo ($extra1); ?></td>
		</tr>
		<tr>
		<td>Entidad:</td>
		<td><?php echo ($lapPaymentMethod); ?></td>
		</tr>
		</table>
	<?php
	}
	else
	{
	?>
		<h1>Error validando firma digital.</h1>
	<?php
	}
}
?>
<a href="http://www.phomework.com.co/www/menu/index.html" class="btn btn-success" style="width: 100%;">Volver a Phomework app</a>
</div>


        	

        <div id="contact" class="jumbotro text-center">

            <h6>Copyright wakusoft@2017</h6>

        </div>
    </body>
</html>

