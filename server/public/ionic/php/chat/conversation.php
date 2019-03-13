<?php 

$usuario = $_POST['usuario'];

include_once "../conexion.php"; 
$conexion = conexion();
$admin = $usuario.'_1';
$sql = "SELECT usuario,mensaje FROM conversation WHERE usuario like '$usuario' OR usuario LIKE '$admin' order by idconversation asc;";
$result = mysqli_query($conexion, $sql);

while ($data = mysqli_fetch_assoc($result)) {
	$bill_estudiante = mysqli_query($conexion,"SELECT * FROM `estudiantes` where idestudiante = $usuario") or die(mysqli_error($conexion));
	$estudiante = $bill_estudiante->fetch_assoc();
	echo "<p><b>".$estudiante['correo']."</b> dice: ".$data['mensaje']."</p>";
}
?>