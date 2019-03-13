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
        $respuesta = ejecutar( $request );
        //send mail
        $mail = new mailNotify();
        $mail->params($request->correo,'Bienvenido a Phomework');
        $mail->send(
            $mail->mensajeEstudianteRegistro(
                $request->nickname,
                $request->clave
                ));
        //send push 
        sendMessage("bienvenido a phomework",$request->token);
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
    $id = $request->id;
    $telefono = $request->telefono;
    $correo = $request->correo;
    $clave = $request->clave;
    //encriptar clave con md5
    $encriptada= md5($clave);
    //ejecutar sentencia
    $sql = "UPDATE `estudiantes` SET 
    `telefono` = '$telefono',
    `correo` = '$correo',
    `clave` = '$encriptada'
     WHERE `estudiantes`.`idestudiante` = $id;";
    return mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 

}



?>