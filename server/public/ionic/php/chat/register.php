<?php 

include_once "../conexion.php"; 
$conexion = conexion();

$user = $_POST['user'];
$message = $_POST['message'];

$sql = "INSERT INTO conversation (usuario, mensaje) VALUES ('$user','$message')";
$result = mysqli_query($conexion, $sql);
if($result){
	echo "Mensaje Registrado";
}

?>