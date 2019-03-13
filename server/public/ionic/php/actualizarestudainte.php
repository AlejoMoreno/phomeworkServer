<?php 
//session_start(); 
include_once "conexion.php"; 
$conexion = conexion();

     $nickname = $_POST['nickname'];
     $edadedad = $_POST['edadedad'];
     $telefono = $_POST['telefono'];
     $correo = $_POST['correo'];
     $clave = $_POST['clave'];
     $claverepeat = $_POST['claverepeat'];

    if($clave != $claverepeat){

    	echo'<a href="../info/registroEstudiantes.html" class="olvido">';
  
    }else{

$encriptada= md5($clave);



	 $sql = "UPDATE `estudiantes` SET `nickname` = '$nickname',`edad` = '$edadedad',`telefono` = '$telefono',`correo` = '$correo' ,`clave` = '$encriptada' WHERE `estudiantes`.`idestudiante` = 1;
";

            mysqli_query($conexion, $sql) or die(mysqli_error($conexion));  
    
                echo 'Usted se ha actualizado.'; 
     
                echo "<script type='text/javascript'> function redireccionar(){window.location = '../menu/miperfilestudiante.php';} 
      			setTimeout ('redireccionar()', 1000);</script>";
    }






?>

