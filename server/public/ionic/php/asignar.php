<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

require_once('class/mailNotify.php');


$postdata = file_get_contents("php://input");
if (isset($postdata)) {
    $request = json_decode($postdata);
    $encrypt = $request->encrypt;

    if ($encrypt == "453fe2d118fe6ea58f1e54f279d2b4af") {
        $respuesta = ejecutar( $request );
        //sendMessage("bienvenido a phomework",$request->token);
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
/***

Licencia por wakusoft

****/


function ejecutar( $request ){

	//importar librerias de conexion

	include_once "conexion.php"; 
  require_once('notificaciones/onlyMessage.php');

	$conexion = conexion();
	//traer datos POST


  $idtarea = $request->tarea;

  $docente = $request->docente;
  $mensaje = 'la tarea '.$idtarea.' Esta disponible para que tu la soluciones' ;
    $docentes = mysqli_query($conexion,"SELECT * FROM `profesores` WHERE `idprofesores` = $docente") or die(mysqli_error($conexion));
  $row1 = $docentes->fetch_assoc;

    //return $docentes;
   sendMessage("Phomework Tarea Nueva ".$mensaje ,$row1['tipo']);

	mysqli_query($conexion,"UPDATE `tareas` SET `idprofesor` = $docente WHERE `tareas`.`idtareas` = ".$idtarea." ;") or die(mysqli_error($conexion));

	mysqli_query($conexion,"UPDATE `solicitudTareas` SET `aceptado` = 1  WHERE `id_docente` = $docente AND `id_tarea` = $idtarea ORDER BY `aceptado` DESC") or die(mysqli_error($conexion));

  $tareas = mysqli_query($conexion,"SELECT * FROM tareas WHERE `tareas`.`idtareas` = ".$idtarea." ;") or die(mysqli_error($conexion));
  $row = $tareas->fetch_assoc();
  $idestudiante = $row['idestudiante'];
  $hoy  = date('Y-m-d');
  $mensaje = 'la tarea '.$idtarea.' Esta disponible para que tu la soluciones' ;
      $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Tarea Nueva', '$mensaje', '0', '$docente', '$hoy', '$hoy', '1')";
      mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 


  //sendMessage('Hola este es desde el servidor','b7cdf994-12e9-4ddb-a4e3-3b686716e290');

	//enviar_correo($row['correo'],$mensaje);
  return 'OK';
}

function enviar_correo($correo,$mensaje){
    $mensaje = '<html><head><title>Bienvenido a Phomework</title><meta charset="utf-8"></head><body><div style="background:#dbdbdb;width: 94%;text-align: center;border: 1px solid white;border-radius: 10px 10px 10px 10px;-moz-border-radius: 10px 10px 10px 10px;-webkit-border-radius: 10px 10px 10px 10px;border: 0px solid #000000;padding: 10px;font-family: sans-serif;font-size:12px;color:#666666;">
    <div style="float:left;"><img style="width:60px;" src="http://phomework.com.co/www/image/phome-ico.png"></div>
    <h1 style="color:white"> '.$mensaje.' </h1></body></html>';
    $para = $correo;
    $asunto = "Habilitado para solucionar tarea ";
    //Librerías para el envío de mail
    include_once('PHPMailer/class.phpmailer.php');
    include_once('PHPMailer/class.smtp.php');
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
    //Agregar destinatario
    $mail->FromName = "Phomework APP";
    $mail->AddAddress($para);
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;
    $mail->Send();
}



?>