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

function ejecutar($request){
    include_once "conexion.php"; 
    require_once('notificaciones/onlyMessage.php');
    $conexion = conexion();

    $iddocente = $request->id;
    $idtarea = $request->idtarea;
    $valor = $request->valor;
    $solucion = $request->solucion;
    $fecha_creacion = date("Y-m-d");

    //buscar estudiante de la tarea
    $bill = mysqli_query($conexion,"SELECT * FROM tareas where `idtareas` = '$idtarea' ") or die(mysqli_error($conexion));
    $row = $bill->fetch_assoc();
    $idestudiante = $row['idestudiante'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://phomework.com.co/www/php/consultas/consultarTokens.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
              "idestudiante=".$idestudiante."&consulta=Cantidad&encrypt=algo");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $cantidadTokens = curl_exec ($ch);
    curl_close ($ch);


    if(intval($cantidadTokens) > intval($valor)){
        //insertar solucion 
        $sql = "INSERT INTO `soluciones` (`idnotificacion`, `notificacion`, `idtareas`, `idestudiante`, `idprofesores`, `fecha`) VALUES (NULL, '$solucion', '$idtarea', '$idestudiante', '$iddocente', '$fecha_creacion');";

        mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

        $hoy = date('Y-m-d');
        $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Tarea Solucionada', 'tarea solucionada $idtarea ' , '$idestudiante', '0', '$hoy', '$hoy', '1')";

        mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

        //actualizar tarea que quede al docente 
        mysqli_query($conexion, "UPDATE `tareas` SET `idprofesor` = '$iddocente', `estado` = 'SOLUCIONADO',  `valor` = '$valor' WHERE `tareas`.`idtareas` = $idtarea AND `tareas`.`idestudiante` = $idestudiante;") or die(mysqli_error($conexion));

        //quitar la mitad de los tokens de los estudiantes
        $valortoken = (intval($valor)*1000);
        $date = date('Y-m-d h:m:s');
        mysqli_query($conexion, " INSERT INTO `pagos` (`idpago`, `idestudiante`, `valor`, `signo`, `saldo`, `reference_pol`, `transactionId`, `responseCode`, `FIRMA`, `EMAILPAYER`, `DESCRIPTION`, `REFERENCE_CODE`, `fecha_creation`, `lapTransactionState`) VALUES 
            (NULL, 
            $idestudiante, 
            '$valortoken', 
            '-', 
            '$valortoken', 
            'Disminucion', 
            'Disminucion', 
            'Disminucion', 
            'Disminucion', 
            'Disminucion', 
            'Disminucion', 
            'Disminucion', 
            '2017-06-02', 
            '$date');") or die(mysqli_error($conexion));
       

        //buscar estudiante apartir de la tarea 
        $tareaid = mysqli_query($conexion, "SELECT * FROM `tareas` WHERE `idtareas` = $idtarea ") or die(mysqli_error($conexion)); 
        $row = $tareaid->fetch_assoc();


        //envio correo notificacion
        //busqueda de correo estudiante para enviar notificacion que la tarea esta hecha
        $estudiante = mysqli_query($conexion, "SELECT * FROM `estudiantes` WHERE `idestudiante` = $idestudiante " ) or die(mysqli_error($conexion)); 
        $estudiante = $estudiante->fetch_assoc();


        require_once('class/mailNotify.php');
        $mail = new mailNotify();
        $mail->params(
            $estudiante['correo'],
            'Solucion tarea Phomework App');
        $mail->send(
            $mail->mensajeSolucionTarea(
                $iddocente,//iddocente
                $row //post tarea
                ));
        sendMessage("Docente soluciono la tarea",$estudiante['tipo']);
    }
    else{
        sendMessage("Estudiante no tiene tokens suficientes",$request->token);
        $hoy = date('Y-m-d');
        $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'No tienes tokens suficientes', 'No tienes tokens suficientes para que resolvamos la tarea ', '$idestudiante', '0', '$hoy', '$hoy', '1')";
        sendMessage("No tienes tokens suficientes para que resolvamos la tarea",$estudiante['tipo']);

        mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
        require_once('class/mailNotify.php');
        $mail = new mailNotify();
        $mail->params(
            $estudiante['correo'],
            'No tienes tokens suficientes para que resolvamos la tarea');
        $mail->send(
            $mail->mensajeSolucionTarea(
                $iddocente,//iddocente
                $row //post tarea
                ));
    }
    

    

}




?>