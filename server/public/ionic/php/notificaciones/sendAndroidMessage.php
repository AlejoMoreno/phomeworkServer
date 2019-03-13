<?php 
include_once "../conexion.php"; 
include_once "onlyMessage.php";
$conexion = conexion();

$result = '';
//echo "SI-"."Este usuario no tiene notificaciones-".$_POST['codigoIMEI']." .".date('Y-m-d');exit();

if($_POST['codigoIMEI']=="null"){
	//echo "Este dispositivo no permite notificaciones";
	echo "NO-"."Este usuario no tiene notificaciones-".$_POST['codigoIMEI']." .".date('Y-m-d');
}
else{
	$pushID = $_POST['codigoIMEI'];
	$bill = mysqli_query($conexion,"SELECT * FROM `profesores` WHERE `tipo` like '$pushID' ") or die(mysqli_error($conexion));
	$bill_ = mysqli_query($conexion,"SELECT * FROM `estudiantes` WHERE `tipo` like '$pushID' ") or die(mysqli_error($conexion));
	if(mysqli_num_rows($bill)>0){
		$usuario = $bill->fetch_assoc();
		$id = $usuario['idprofesores'];
		//consultar que notificaciones tiene 
		$consul = mysqli_query($conexion,"SELECT * FROM `notificaciones` WHERE `docente` = $id AND estado = 1") or die(mysqli_error($conexion));
		if(mysqli_num_rows($consul)>0){
			$mensaje = $consul->fetch_assoc();
			$idnotifi = $mensaje['id'];
			//Enviar mensaje
			echo "SI-".$mensaje['titulo']."-".
				 $mensaje['texto']." .".
				 $mensaje['fecha_creado'];
			mysqli_query($conexion,"UPDATE `notificaciones` SET `estado` = '3' WHERE `notificaciones`.`id` = $idnotifi;") or die(mysqli_error($conexion));
				 exit();
		}
		else{
			//Enviar mensaje
			echo "NO-hola-:)";
				 exit();
		}			
	}
	elseif(mysqli_num_rows($bill_)>0){
		$usuario = $bill_->fetch_assoc();
		$id = $usuario['idestudiante'];
		$consul_ = mysqli_query($conexion,"SELECT * FROM `notificaciones` WHERE `estudiante` = $id AND estado = 1") or die(mysqli_error($conexion));
		if(mysqli_num_rows($consul_)>0){
			$mensaje = $consul_->fetch_assoc();
			$idnotifi = $mensaje['id'];
			//Enviar mensaje
			echo "SI-".$mensaje['titulo']."-".
				 $mensaje['texto']." .".
				 $mensaje['fecha_creado'];
			mysqli_query($conexion,"UPDATE `notificaciones` SET `estado` = '3' WHERE `notificaciones`.`id` = $idnotifi;") or die(mysqli_error($conexion));
				 exit();
		}
		else{
			//Enviar mensaje
			echo "NO-hola-:)";
				 exit();
		}
	}
	else{
		echo "NO-"."asunto-".$_POST['codigoIMEI']." .".date('Y-m-d');
		exit();
	}
	//imprimir el resultado
	//print_r($usuario);
	//mensaje expuesto en asunto-texto-email
	//echo "asunto-".$_POST['codigoIMEI']." .".date('Y-m-d');
}
?>