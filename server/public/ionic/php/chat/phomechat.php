<?php 

$estudiante = $_POST['estudiante'];
$docente = $_POST['docente'];

include_once "../conexion.php"; 
$conexion = conexion();

//buscar el chat entre 
   	$chat = mysqli_query($conexion,"SELECT * FROM `chat` WHERE `idestudiante` = $estudiante AND `idprofesor` = $docente ORDER BY `chat`.`idchat` ASC ") or die(mysqli_error($conexion));
   	$resultado = '';
   	while ($row = $chat->fetch_assoc()){
   		$arrayVS = explode("-", $row['vs']);
   		if($arrayVS[0]==$row['idestudiante']){
   			echo  '
	    	<div class="msm" style="text-aling: right; background: #ededed; color:#474747; width: 100%;padding: 10px;font-size: 11px;-webkit-box-shadow: 10px 10px 20px -12px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 20px -12px rgba(0,0,0,0.75);
box-shadow: 10px 10px 20px -12px rgba(0,0,0,0.75);border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 0px solid #000000;"><strong>'.$row['idprofesor'].'</strong><p>'.$row['mensaje'].'</p><span style="float: right;font-size: 8px;">'.$row['fecha'].'</span></div><br>'; 
	    }
	    else{
	    	echo '<div class="msm" style="text-aling: left; background: #c1bfea;width: 100%;padding: 10px;font-size: 11px;-webkit-box-shadow: 10px 10px 20px -12px rgba(0,0,0,0.75);
-moz-box-shadow: 10px 10px 20px -12px rgba(0,0,0,0.75);
box-shadow: 10px 10px 20px -12px rgba(0,0,0,0.75);border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 0px solid #000000;"><strong>'.$row['idestudiante'].'</strong><p>'.$row['mensaje'].'</p><span style="float: right;font-size: 8px;">'.$row['fecha'].'</span></div><br>';
	    }

	}

?>