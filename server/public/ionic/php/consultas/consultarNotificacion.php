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


function ejecutar($request){
	$id = $request->id;
	$tipo = $request->tipo;
	include_once "../conexion.php"; 
	$conexion = conexion();
	if($tipo=='docente'){
		$sql = "SELECT * FROM `notificaciones` WHERE `docente` = $id ORDER BY `notificaciones`.`id` DESC ";
	}
	else{
		$sql = "SELECT * FROM `notificaciones` WHERE `estudiante` = $id ORDER BY `notificaciones`.`id` DESC ";
	}
	$noti = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
	//verifiacciones
	$array = array();
	while($row = $noti->fetch_assoc()){
		array_push($array, $row);
	}
	return $array;

}

//1 pendiente

//2 habilitado

//3 inabilitado

?>