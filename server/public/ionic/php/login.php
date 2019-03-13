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
	//importar librerias de conexion
	include_once "conexion.php"; 
	$conexion = conexion();
	//traer datos POST
	$correo = $request->correo;
	$clave = $request->clave;
	$pushID = $request->token;
	$encriptado=md5($clave);
	$estudiantes = mysqli_query($conexion,"SELECT * FROM estudiantes WHERE  correo like '$correo'  AND clave like '$encriptado' ") or die(mysqli_error($conexion));
	$profesores = mysqli_query($conexion,"SELECT * FROM profesores WHERE correo like '$correo' AND clave like '$encriptado' AND estado like '2'  ") or die(mysqli_error($conexion));
	//verifiacciones
	if ($row = $estudiantes->fetch_assoc()){
		$sql = "UPDATE `estudiantes` SET `tipo` = '$pushID' WHERE correo like '$correo' AND clave like '$encriptado' ";
			mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		return array('correo'=> $row['correo'],'tipo'=> 'estudiante','id'=> $row['idestudiante'],'token'=> $row['tipo']);
	}
	elseif($row1 = $profesores->fetch_assoc()){
		if($row1['estado']=='1'){
			$v2="Su cuenta no esta activa";
			return array("error"=>$v2);
			exit();
		}
		else{
			$sql = "UPDATE `profesores` SET `tipo` = '$pushID' WHERE correo like '$correo' AND clave like '$encriptado' AND estado = 2 ";
			mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
			return array('correo'=> $row1['correo'],'tipo'=> 'docente','id'=> $row1['idprofesores'],'token'=> $row1['tipo'], 'cuenta'=>$row1['cuenta'],'tipocuenta'=>$row1['tipocuenta'],'banco'=>$row1['banco']);
		}		
	}
	else{
		$v2="Usuario, Clave o validación, Son erradas .".$row1['estado'];
		return array("error"=>$v2);
	}
}
//1 pendiente
//2 habilitado
//3 inabilitado




?>