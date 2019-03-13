<?php 
include_once "../conexion.php"; 
$conexion = conexion();


$id = $_POST['id'];
$sql = "UPDATE `notificaciones` SET `estado` = '2' WHERE `notificaciones`.`id` = $id;";
echo mysqli_query($conexion,$sql) or die(mysqli_error($conexion));


?>