<?php
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
    
    
    if($request->tipo=="docente"){
        $imagen = $request->imagen;
        $sql = "DELETE FROM `archivosSoluTarea` WHERE `archivosSoluTarea`.`id_archivo_solucion` = $imagen;";
            mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
        
        return $sql;
    }
    else{
        $imagen = $request->imagen;
        $sql = "DELETE FROM `archivos` WHERE `archivos`.`ida` = $imagen;";
            mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
        
        return $sql;
        
    }
}

  


?>