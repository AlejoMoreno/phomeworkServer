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
    //incluir librerias de conexion
    include_once "conexion.php"; 
    $conexion = conexion();
    $id_docente   = $request->id_docente;
    $id_tarea       = $request->id_tarea;
    $fecha = date('Y-m-d');
    $aceptado = '0';

    require_once('notificaciones/onlyMessage.php');

    $respuesta = mysqli_query($conexion,"SELECT * FROM `tareas` WHERE `idtareas` = $id_tarea") or die(mysqli_error($conexion));
    $tareas = $respuesta->fetch_assoc();
    $estudiante = $tareas['idestudiante'];
    $respuestas = mysqli_query($conexion,"SELECT * FROM `leizycom_phomework`.`estudiantes` WHERE `idestudiante` = $estudiante") or die(mysqli_error($conexion));
    $estudiantes = $respuestas->fetch_assoc();

    sendMessage("El docente ".$id_docente." esta interesado en solucionar tu tarea ".$id_tarea ,$estudiantes['tipo']);

    $respuestas = mysqli_query($conexion,"SELECT * FROM `leizycom_phomework`.`profesores` WHERE `idprofesores` = $id_docente") or die(mysqli_error($conexion));
    $docentes = $respuestas->fetch_assoc();
    sendMessage("Se habilito el chat con estudiante  ".$estudiantes['correo'].' con la tarea: '.$id_tarea ,$docentes['tipo']);
    
    $respuestas = mysqli_query($conexion,"SELECT * FROM `leizycom_phomework`.`solicitudTareas` WHERE `id_docente` = $id_docente AND `id_tarea` = $id_tarea") or die(mysqli_error($conexion));
    if(mysqli_num_rows($respuestas)==0){
        $sql = "INSERT INTO `solicitudTareas` (`id_solicitud`, `id_docente`, `id_tarea`, `fecha`, `aceptado`) VALUES (NULL, '$id_docente', '$id_tarea', '$fecha', '$aceptado');";
        return mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
    }
    else{
        return "ya se encuentra habilitado";
    }
   


}






?>