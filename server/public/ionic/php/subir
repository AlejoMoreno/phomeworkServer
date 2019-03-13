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
            $mail->mensajeDocenteRegistro(
                $request->nombre.' '.$request->apellido,
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
    //traer datos POST
    $nombre = $request->nombre;
    $apellido = $request->apellido;
    $correo = $request->correo;
    $telefono = $request->telefono;
    $direccion = $request->direccion;
    $idadministrador = $request->idadministrador;
    $idareasEspecialista = $request->idareasEspecialista;
    $clave = $request->clave;
    $claveRepeat = $request->claveRepeat;
    $descripcion = $request->descripcion;
    $cuenta = $request->cuenta;
    $tipocuenta = $request->tipocuenta;
    $banco = $request->banco;
    $token      = $request->token;
    /*subir foto y certificado*/
        //$imagen_subida1 = subir_certificado();
        //$imagen_subida = subir_foto();
    //insertar en la base de datos
    $encriptada= md5($clave);
    $profesores = mysqli_query($conexion,"SELECT * FROM profesores WHERE correo like '$correo' ") or die(mysqli_error($conexion));
    $estudiantes = mysqli_query($conexion,"SELECT * FROM estudiantes WHERE  correo like '$correo'") or die(mysqli_error($conexion));
    if(mysqli_num_rows($profesores)>0){
        echo 'Correo ya se encuentra registrado profesor';
        exit();
    }
    elseif(mysqli_num_rows($estudiantes)>0){
        echo 'Correo ya se encuentra registrado estudiante';
        exit();
    }
    else{
        $sql = "INSERT INTO `profesores` (`idprofesores`, `nombre`, `apellido`, `urlFoto`, `correo`, `telefono`, `direccion`, `urlCertificado`, `estado`, `idadministrador`, `idareasEspecialista`, `clave`, `descripcion`, `tipo`, `cuenta`, `tipocuenta`, `banco`) VALUES (null, '$nombre', ' $apellido', '$imagen_subida', '$correo', '$telefono', '$direccion', '$imagen_subida1', '2', '2', '$idareasEspecialista', '$encriptada', '$descripcion', '$token', '$cuenta', '$tipocuenta', '$banco');";
        mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 

        $profesores = mysqli_query($conexion,"SELECT * FROM profesores WHERE correo like '$correo' ") or die(mysqli_error($conexion));
        $row = $profesores->fetch_assoc();
        return $row;

    }     
}

function subir_certificado(){
    $dir_destino = '../certificados/';
    $imagen_subida1 = $dir_destino . basename($_FILES['urlCertificado']['name']);
    if(!is_writable($dir_destino)){
        $log = "no tiene permisos";
    }
    else{
        if(is_uploaded_file($_FILES['urlCertificado']['tmp_name'])){
            if (move_uploaded_file($_FILES['urlCertificado']['tmp_name'], $imagen_subida1)) {
                $log =  "El archivo es fue cargado exitosamente.\n";
            } 
            else {
                $log =  "Posible ataque de carga de archivos!\n";
            }
        }
        else{
            $log =  "Posible ataque del archivo subido: ";
            $log =  "nombre del archivo '". $_FILES['archivo_usuario']['tmp_name'] . "'.";
        }
    }
    return $imagen_subida1;
}

function subir_foto(){
    $dir_destino = '../fotosdocentes/';
    $imagen_subida = $dir_destino . basename($_FILES['urlFoto']['name']);
    if(!is_writable($dir_destino)){
        $log =  "no tiene permisos";
    }
    else{
        if(is_uploaded_file($_FILES['urlFoto']['tmp_name'])){
            if (move_uploaded_file($_FILES['urlFoto']['tmp_name'], $imagen_subida)) {
                $log =  "El archivo es fue cargado exitosamente.\n";
            }
            else {
                $log =  "Posible ataque de carga de archivos!\n";
            }
        }
        else{
            $log =  "Posible ataque del archivo subido: ";
            $log =  "nombre del archivo '". $_FILES['archivo_usuario']['tmp_name'] . "'.";
        }
    }
    return $imagen_subida;
}


?>