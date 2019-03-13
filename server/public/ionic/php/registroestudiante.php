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
    $nickname   = $request->correo;
    $edad       = $request->edad;
    $telefono   = $request->telefono;
    $correo     = $request->correo;
    $clave      = $request->clave;
    $claverepeat = $request->claverepeat;
    $token      = $request->token;
    //encriptar clave con md5
    $encriptada= md5($clave);
    //ejecutar sentencia
    $profesores = mysqli_query($conexion,"SELECT * FROM profesores WHERE correo like '$correo' ") or die(mysqli_error($conexion));
    $estudiantes = mysqli_query($conexion,"SELECT * FROM estudiantes WHERE  correo like '$correo'") or die(mysqli_error($conexion));
    if(mysqli_num_rows($profesores)>0){
        echo 'Correo ya se encuentra registrado';
        exit();
    }
    elseif(mysqli_num_rows($estudiantes)>0){
        echo 'Correo ya se encuentra registrado';
        exit();
    }
    else{
        $sql = "INSERT INTO estudiantes (idestudiante, nickname, edad, telefono, correo, clave, PAYER_DNI, tipo, tokens) VALUES 
            (null,'$nickname', '$edad', '$telefono','$correo', '$encriptada', '$correo', '$token', '50');";
        mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
        $respuesta = mysqli_query($conexion,"SELECT * FROM estudiantes WHERE  correo like '$correo'") or die(mysqli_error($conexion));
        $row = $respuesta->fetch_assoc();
        return $row;
        //agregar 50 tokens de regalo
        
    }    

}






?>