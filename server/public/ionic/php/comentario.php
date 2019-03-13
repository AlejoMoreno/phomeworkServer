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

/***
Licencia por wakusoft
****/

function ejecutar( $request ){
    //incluir librerias de conexion
    include_once "conexion.php"; 
    $conexion = conexion();
    //tomar los datos
    $comentario = $request->comentario;
    $correo = $request->correo;
    $id = $request->id;
    $sql = "INSERT INTO `testimonios_blog` (`idtestimoniosBlog`, `testimonio`, `idestudiante`, `correo`) VALUES (NULL, '$comentario', '$id', '$correo');";
    return mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 

}


?>