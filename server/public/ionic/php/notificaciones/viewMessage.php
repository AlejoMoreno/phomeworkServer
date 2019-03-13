<?php 
include_once "../conexion.php"; 
include_once "onlyMessage.php";
$conexion = conexion();

$result = '';

if($_POST['tipo']=='estudiante'){
	$id = $_POST['id'];
	$sql = "SELECT * FROM `notificaciones` WHERE `estudiante` = $id AND `estado` = 3 OR `estado` = 1";
	ejecute($sql,$conexion,$id,$_POST['tipo']);
}
elseif($_POST['tipo']=='docente'){
	$id = $_POST['id'];
	$sql = "SELECT * FROM `notificaciones` WHERE `docente` = $id AND `estado` = 3 OR `estado` = 1";
	ejecute($sql,$conexion,$id,$_POST['tipo']);
}
else{
	echo 'Hay algo mal en este proceso';
}


function ejecute($sql,$conexion,$id,$tipo){
	$bill = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
	if(mysqli_num_rows($bill)>0){
		while($notificacion = $bill->fetch_assoc()){
			if (strpos($notificacion['titulo'], 'Chat') !== false) {
			    $href = "<a href='chat.html?docente=".$notificacion['docente']."&estudiante=".$notificacion['estudiante']."'><img width='30' src='https://image.flaticon.com/icons/svg/402/402306.svg'></a>";
			}
			else{
				$href = "";
			}
			echo $notificacion['titulo']."::".$notificacion['texto']."::".$notificacion['fecha_creado']."::".$notificacion['id']."ENTER";
		}
	}
	else{
		echo 'No existen notificaciones nuevas para ti';
	}
}

?>