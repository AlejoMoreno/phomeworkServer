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
	$tarea = $request->id;
	include_once "../conexion.php"; 
	$conexion = conexion();
	$sql = "SELECT * FROM `solicitudTareas` WHERE `id_tarea` = $tarea";
	$noti = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
	//verifiacciones
	$array = array();
	while($row = $noti->fetch_assoc()){
		$docente = $row['id_docente'];
		$sql = "SELECT * FROM `profesores` WHERE `idprofesores` = $docente";
		$other = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		$row['id_docente'] = $other->fetch_assoc();
		$tarea = $row['id_tarea'];
		$sql = "SELECT * FROM `tareas` WHERE `idtareas` = $tarea";
		$other = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		$row['id_tarea'] = $other->fetch_assoc();
		array_push($array, $row);
	}
	return $array;

}

//1 pendiente

//2 habilitado

//3 inabilitado

?>