<?php 
include_once "../conexion.php"; 
include_once "onlyMessage.php";
$conexion = conexion();

$result = '';

if($_POST['correo']=="NO"){
	//echo "Este dispositivo no permite notificaciones";
	echo "NO-"."Este usuario no tiene notificaciones-".$_POST['correo']." .".date('Y-m-d');
}
else{
	if($_POST['tipo']=='profesores'){
		$correo = $_POST['correo'];
		$bill = mysqli_query($conexion,"SELECT * FROM `profesores` WHERE `correo` LIKE '$correo' ") or die(mysqli_error($conexion));
		if(mysqli_num_rows($bill)>0){
			$usuario = $bill->fetch_assoc();
			$id = $usuario['idprofesores'];
			//consultar que notificaciones tiene 
			$consul = mysqli_query($conexion,"SELECT * FROM `notificaciones` WHERE `docente` = $id AND estado = 1") or die(mysqli_error($conexion));
			if(mysqli_num_rows($consul)>0){
				$mensaje = $consul->fetch_assoc();
				$idnotifi = $mensaje['id'];
				//Enviar mensaje
				$response = sendMessage($mensaje['texto'],$usuario['tipo']);
				echo $response;
				mysqli_query($conexion,"UPDATE `notificaciones` SET `estado` = '3' WHERE `notificaciones`.`id` = $idnotifi;") or die(mysqli_error($conexion));
			}
			exit();
		}
	}
	
	elseif($_POST['tipo']=='estudiantes'){
		$correo = $_POST['correo'];
		$bill_ = mysqli_query($conexion,"SELECT * FROM `estudiantes` WHERE `correo` LIKE '$correo' ") or die(mysqli_error($conexion));
		if(mysqli_num_rows($bill_)>0){
			$usuario = $bill_->fetch_assoc();
			$id = $usuario['idestudiante'];
			$consul_ = mysqli_query($conexion,"SELECT * FROM `notificaciones` WHERE `estudiante` = $id AND estado = 1") or die(mysqli_error($conexion));
			$mensaje_ = $consul_->fetch_assoc();
			if(mysqli_num_rows($consul_)>0){
				$mensaje = $consul_->fetch_assoc();
				$idnotifi = $mensaje['id'];
				//Enviar mensaje
				$response = sendMessage1($mensaje['texto'],$usuario['tipo']);
				echo $response;
				mysqli_query($conexion,"UPDATE `notificaciones` SET `estado` = '3' WHERE `notificaciones`.`id` = $idnotifi;") or die(mysqli_error($conexion));
			}
			exit();
		}
	}

}

function sendMessage1($message,$idpush){
	$content = array(
		"en" => $message
		);
	
	$fields = array(
		'app_id' => "d83f7a35-792a-4254-b6c5-1a7c3b0a1d9b",
		'include_player_ids' => array($idpush),
  'data' => array("foo" => "bar"),
		'contents' => $content
	);
	
	$fields = json_encode($fields);
/*print("\nJSON sent:\n");
print($fields);*/
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
											   'Authorization: Basic NTE1ZDZhYmMtYzIxNi00NWRhLWE2MzQtODI5Y2IwMDg1MDUz'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	$response = curl_exec($ch);
	curl_close($ch);
	
	return $response;
}
?>