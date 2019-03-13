<?php
include_once "conexion.php"; 
$conexion = conexion();
session_start();




     $correo = $_POST['correo'];
    


$bill = mysqli_query($conexion,"SELECT * FROM estudiantes wHERE  correo ='$correo'    ") or die(mysqli_error($conexion));



if ($row = $bill->fetch_assoc()){

$_SESSION['id'] = $row["idestudiante"];

header('Location: cambioclave.php');
}else{


$_SESSION['id'] = ["N"];

header('Location: ../info/olvido.html');
}

}




     ?>
