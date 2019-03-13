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
    //incluir librerias de conexion
    include_once "conexion.php"; 
    require_once('notificaciones/onlyMessage.php');
    $conexion = conexion();
    $fecha_creacion = date("Y-m-d");
    //tomar los datos
    $estudiante = $request->receptor;
    $docente = $request->sender;
    $mensaje = $request->message;
    $tipo = $request->tipo;
    $vs = $request->vs;
    if($tipo == 'docente'){
      $estudiante = $request->receptor;
      $docente = $request->sender;
      //$vs = $request->receptor.'-'.$request->sender;
      $receptor = $request->receptor;
      $emisor = $request->sender;
      $hoy  = date('Y-m-d');
      $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Chat de: $emisor', '$mensaje', '$receptor', '0', '$hoy', '$hoy', '1')";
      mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 

      $receptorbill = mysqli_query($conexion,"SELECT * FROM `profesores` WHERE `idprofesores` = $docente") or die(mysqli_error($conexion));
      $row = $receptorbill->fetch_assoc();
      $emisorbill = mysqli_query($conexion,"SELECT * FROM `estudiantes` WHERE `idestudiante` = $estudiante") or die(mysqli_error($conexion));
      $row1 = $emisorbill->fetch_assoc();
      //send push 
      $mensajetotal = "Chat phomework (docente ".$row['idprofesores']."): ".$mensaje;
      sendMessage($mensajetotal,$row1['tipo']); //estudiante

    }
    else{
      $estudiante = $request->sender;
      $docente = $request->receptor;
      //$vs = $request->sender.'-'.$request->receptor;
      $receptor = $request->sender;
      $emisor = $request->receptor;
      $hoy  = date('Y-m-d');
      $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Chat de: $emisor', '$mensaje', '0', '$receptor', '$hoy', '$hoy', '1')";
      mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
      $receptorbill = mysqli_query($conexion,"SELECT * FROM `profesores` WHERE `idprofesores` = $docente") or die(mysqli_error($conexion));
      $row = $receptorbill->fetch_assoc();
      $emisorbill = mysqli_query($conexion,"SELECT * FROM `estudiantes` WHERE `idestudiante` = $estudiante") or die(mysqli_error($conexion));
      $row1 = $emisorbill->fetch_assoc();
      //send push 
      $mensajetotal = "Chat phomework (estudiante ".$row1['idestudiante']."): ".$mensaje;
      sendMessage($mensajetotal,$row['tipo']);
    }
    
    if($mensaje!=''){
      $sql = "INSERT INTO `chat` (`idchat`, `idestudiante`, `idprofesor`, `mensaje`, `fecha`, `estado`, `vs`) VALUES (NULL, $estudiante, $docente, '$mensaje', '$fecha_creacion', 'enviado', '$vs');";
       return mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
    }
         
}

?>