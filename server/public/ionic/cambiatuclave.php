<?php 

if(isset($_POST['pass1'])){
	if($_POST['pass1']==$_POST['pwd']){
		//soniguales
		$password = md5($_POST['pwd']);
		//ejecutar(base64_decode($_GET['correo']),$password);
		ejecutar($_POST['correo'],$password);
	}
	else{
		echo '<H1>LAS CLAVES NO SON IGUALES</H1>';
	}
}




function ejecutar($correo,$password){
	//importar librerias de conexion
	include_once "php/conexion.php"; 
	$conexion = conexion();
	//traer datos POST
	$estudiantes = mysqli_query($conexion,"SELECT * FROM estudiantes WHERE  correo like '$correo' ") or die(mysqli_error($conexion));
	$profesores = mysqli_query($conexion,"SELECT * FROM profesores WHERE correo like '$correo' ") or die(mysqli_error($conexion));
	//verifiacciones
	if (mysqli_num_rows($estudiantes)>0){
		$row = $estudiantes->fetch_assoc();
		$id=$row['idestudiante'];
		//print_r($row);
		mysqli_query($conexion,"UPDATE `estudiantes` SET `clave` = '$password' WHERE `estudiantes`.`idestudiante` = ".$id." ") or die(mysqli_error($conexion));
		echo 'Actualizado correctamente
		<script>window.location.assign("http://phomework.com.co/www/info/login.html");</script>';
	}
	elseif(mysqli_num_rows($profesores)>0){
		$row1 = $profesores->fetch_assoc();
		$id=$row1['idprofesores'];
		//print_r($row1);
		mysqli_query($conexion,"UPDATE `profesores` SET `clave` = '$password' WHERE `profesores`.`idprofesores` = ".$id." ") or die(mysqli_error($conexion));
		echo 'Actualizado correctamente
		<script>window.location.assign("http://phomework.com.co/www/info/login.html");</script>';
	}
	else{
		echo "No se encontro el usuario, contactanos por nuestra fanpage <a href='www.phomework.com.co'>www.phomework.com.co</a>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background:url(image/base_image.jpg);background-repeat: no-repeat;background-size:cover;">
<div style="float:left;"><img style="width:60px;" src="image/phome-ico.png"></div>
<div class="container" style=" margin-top:20px;padding:10px">
  <h2>Cambio de Contraseña</h2>
  <p>Escribe la nueva contraseña y sigue los pasos para cambiar tu contraseña.</p>
  <form action="" method="POST">
  <div class="form-group">
      <label for="telefono">Teléfono:</label>
      <input type="text" class="form-control" name="telefono" placeholder="Ingresa El Teléfono registrado">
    </div>
    <div class="form-group">
      <label for="pass1">Clave:</label>
      <input type="password" class="form-control" name="pass1" placeholder="Ingresa la clave">
    </div>
    <div class="form-group">
      <label for="pwd">Repite Clave:</label>
      <input type="password" class="form-control" name="pwd" placeholder="Repite la clave">
    </div><br>
    <?php echo '<input type="hidden" name="correo" value="'.$_GET['correo'].'">';?>
    <button type="submit" class="btn btn-default">Cambiar</button>
  </form>
</div>


</body>
</html>
