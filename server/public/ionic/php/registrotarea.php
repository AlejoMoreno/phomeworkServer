<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

require_once('class/mailNotify.php');
require_once('notificaciones/onlyMessage.php');

$postdata = file_get_contents("php://input");
if (isset($postdata)) {
    $request = json_decode($postdata);
    $encrypt = $request->encrypt;

    if ($encrypt == "453fe2d118fe6ea58f1e54f279d2b4af") {

        include_once "conexion.php"; 
        $conexion = conexion();

        //envio a todos los docentes
        $hoy = date("Y-m-d");
        $bill = mysqli_query($conexion,"SELECT * FROM `profesores`") or die(mysqli_error($conexion));
        while($row = $bill->fetch_assoc()){
            //envio de mensaje al docente
            $id = $row['idprofesores'];
            sendMessage("Nueva Tarea, verifica tu panel de tareas por resolver y resuelvelas pronto. ",$row['tipo']);
            $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Tarea Nueva', 'verifica tu panel de tareas por resolver y resuelvelas pronto.' , '0', '$id', '$hoy', '$hoy', '1')";
            mysqli_query($conexion, $sql) or die(mysqli_error($conexion));    
        }  

        $respuesta = ejecutar( $request );
        sendMessage("Tarea Guardada ",$request->token);

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
    include_once "conexion.php"; 
    $conexion = conexion();

    $idestudiante = $request->id;
    $nombre = $request->titulo;
    $valor = $request->valor;
    $descripcion = $request->descripcion;
    $fecha_creacion = date("Y-m-d");
    $fecha_vencimiento = $request->fecha_vencimiento;
    $estado = 'EN ESPERA';
    $calificacion = '5';
    $sql = "INSERT INTO `tareas` (`idtareas`, `nombre`, `urltarea`, `calificacion`, `estado`, `idestudiante`, `valor`, `descripcion`, `fecha_creacion`, `fecha_vencimiento`, `idprofesor`) VALUES (NULL, '$nombre', null, '$calificacion', '$estado', $idestudiante, '$valor', '$descripcion', '$fecha_creacion', '$fecha_vencimiento', '1');";

    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    $bill = mysqli_query($conexion,"SELECT * FROM tareas where `idestudiante` = '$idestudiante' ORDER BY `tareas`.`idtareas` DESC") or die(mysqli_error($conexion));
    return $bill->fetch_assoc();   


}

?>