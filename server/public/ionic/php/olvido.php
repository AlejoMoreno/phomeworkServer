<?php
/***
Licencia por wakusoft
****/


if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

$postdata = file_get_contents("php://input");
if (isset($postdata)) {
    $request = json_decode($postdata);
    $encrypt = $request->encrypt;

    if ($encrypt == "453fe2d118fe6ea58f1e54f279d2b4af") {
        $respuesta = ejecutar( $request );  
        if($respuesta=='NO'){
            echo 'No existe en la base de datos';
        }
        else{
            echo 'Phomework te ha enviado la solicitud al correo, <a href="http://phomework.com.co/www/cambiatuclave.php?correo='.$request->correo.'" style="color:green;">Si no llego el correo ingresa aqui Cambia tu clave</a>';
            enviar_correo($request->correo);
        }      
        echo json_encode(array(
            "result" => "true",
            "body" => $respuesta
        ));
    }
    else {
        echo "Empty encrypt parameter!";
    }
}
else {
    echo "Not called properly with encrypt parameter!";
}


function ejecutar( $request ){
	//importar librerias de conexion
	include_once "conexion.php"; 
	$conexion = conexion();
	//traer datos POST
	$correo = $request->correo;
	$resultado = '';
	$estudiantes = mysqli_query($conexion,"SELECT * FROM estudiantes WHERE  correo like '$correo'   ") or die(mysqli_error($conexion));
	$profesores = mysqli_query($conexion,"SELECT * FROM profesores WHERE correo like '$correo' ") or die(mysqli_error($conexion));
	//verifiacciones
	if (mysqli_num_rows($estudiantes)>0){
        $row = $estudiantes->fetch_assoc();
		$resultado = $row['clave'];
	}
	elseif(mysqli_num_rows($profesores)>0){
        $row1 = $profesores->fetch_assoc(); 
		$resultado = $row1['clave'];
	}
	else{
		$resultado = 'NO';
	}
	return $resultado;
}

function enviar_correo($correo){
    $mensaje = '<html><head><title>Bienvenido a Phomework</title><meta charset="utf-8"></head><body><div style="background:#dbdbdb;width: 94%;text-align: center;border: 1px solid white;border-radius: 10px 10px 10px 10px;-moz-border-radius: 10px 10px 10px 10px;-webkit-border-radius: 10px 10px 10px 10px;border: 0px solid #000000;padding: 10px;font-family: sans-serif;font-size:12px;color:#666666;">
    <div style="float:left;"><img style="width:60px;" src="http://phomework.com.co/www/image/phome-ico.png"></div>
    <h1 style="color:white"> Hemos encontrado una solicitud para cambio de clave en Phomework al correo '.$correo.'</h1>
    <p>Si no recuerdas tu clave recuerda, nosotros enviamos un correo indicandote la clave del mismo</p>
<script id="chatcolhost12" src="/chatcolhost.php"></script>
    <p style="text-align: justify">Sin embargo nosotros ingresa a este link si deseas cambiar la clave. <a href="http://phomework.com.co/www/cambiatuclave.php?correo='.$correo.'">Cambia tu clave</a></p></body></html>';
    $para = $correo;
    $asunto = "Perdida de clave a Phomework ";
    //Librerías para el envío de mail
    require_once('PHPMailer/class.phpmailer.php');
    require_once('PHPMailer/class.smtp.php');
    //Este bloque es importante
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->IsHTML(true);
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;     
    //Nuestra cuenta
    $mail->Username ='wakusoft@gmail.com';
    $mail->Password = 'wakusoft2016'; //Su password
    $mail->FromName = 'Admin Phomework';
    $mail->From = 'admin@phomework.com.co';

    $mail->AddAddress( $para);
    $mail->Subject =  $asunto;
    $mail->Body = $mensaje;
    $mail->Send();
}



?>