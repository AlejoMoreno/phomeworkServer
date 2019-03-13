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

    $respuesta = ejecutar( $request );
        echo json_encode(array(
            "result" => "true",
            "body" => $respuesta
        ));
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
    $fecha_creacion = date("Y-m-d");
    //tomar los datos
    $estudiante = $request->receptor;
    $docente = $request->sender;
    $tipo = $request->tipo;
    if($tipo == 'docente'){
        $estudiante = $request->receptor;
        $docente = $request->sender;
    }
    else{
        $estudiante = $request->sender;
        $docente = $request->receptor;
    }
    //buscar el chat entre 
    $chat = mysqli_query($conexion,"SELECT * FROM `chat` WHERE `idestudiante` = $estudiante AND `idprofesor` = $docente ORDER BY `chat`.`idchat` ASC") or die(mysqli_error($conexion));
    $array = array();
    while ($row = $chat->fetch_assoc()){
        $row['vs'] = explode('-', $row['vs']);
      array_push($array, $row);
    }
    return $array;
}

?>