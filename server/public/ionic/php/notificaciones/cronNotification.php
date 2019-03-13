<?php 
include_once "../conexion.php"; 
include_once "onlyMessage.php";
$conexion = conexion();


$consul = mysqli_query($conexion,"SELECT * FROM `notificaciones` WHERE `estado` = 3  ORDER BY `notificaciones`.`fecha_creado` DESC ") or die(mysqli_error($conexion));

while ($row = $consul->fetch_assoc()){
	$id = $row['id'];
	$titulo = $row['titulo'];
	$message = $row['texto'];
	$estudiante = $row['estudiante'];
	$docente = $row['docente'];
	if($row['estudiante']==0){
		//es docente
		$bill = mysqli_query($conexion,"SELECT * FROM `profesores` WHERE `idprofesores` = $docente") or die(mysqli_error($conexion));
		$row_1 = $bill->fetch_assoc();
	}
	else{
		//es estudiante
		$bill = mysqli_query($conexion,"SELECT * FROM `estudiantes` WHERE `idestudiante` = $estudiante") or die(mysqli_error($conexion));
		$row_1 = $bill->fetch_assoc();
	}

	if($row_1['tipo']!=''){
		$payerId = $row_1['tipo'];
		$response = sendMessage($titulo.' '.$message, $payerId);
		$return["allresponses"] = $response;
		$return = json_encode( $return);
		
		  print("\n\nJSON received:\n");
			print($return);
		  print("\n");

		//actualizacion estados
		  if($payerId!=''){
		  	$sql = "UPDATE `notificaciones` SET `estado` = '2' WHERE `notificaciones`.`id` = $id ;";
			mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		  }
	}
	
	
}


?>