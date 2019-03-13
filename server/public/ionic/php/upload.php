<?php
include_once "conexion.php"; 
$conexion = conexion();

$mas = $_POST['mas'];

error_reporting(0);

$dir_destino = '../archivos';

$imagen_subida = $dir_destino . basename($_FILES['archivo']['name']);
//Variables del metodo POST
//$codigo=$_POST['codigo'];
//$descripcion=$_POST['descripcion'];
if(!is_writable($dir_destino)){
    echo "no tiene permisos";
}else{
    if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
        /*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
        echo "Mostrar contenido\n";
        echo $imagen_subida;*/
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $imagen_subida)) {
           

            //Creamos nuestra consulta sql
            $sql = "INSERT INTO `archivos` (`ida`, `url`, `idtarea`) VALUES (null,'$imagen_subida', '$mas');";

            mysqli_query($conexion, $sql) or die(mysqli_error($conexion));  
    

           echo "El archivo es fue cargado exitosamente.\n";
            echo "<p>$codigo</p>";
            echo "<p>$descripcion</p>";
            //echo "<img src='http://localhost/miweb/uploads/". basename($imagen_subida) ."' />";
        } else {
            echo "Posible ataque de carga de archivos!\n";
        }
    }else{
        echo "Posible ataque del archivo subido: ";
        echo "nombre del archivo '". $_FILES['archivo_usuario']['tmp_name'] . "'.";
    }
}


echo'
 Desea adjuntar mas archivos?
<form  enctype="multipart/form-data" action="../php/subirarchivos.php" method="post">
    
       
   <input id="calificacion" type="hidden" name="mas" value="'.$mas.'"><br>
        <center><input type="submit" class="panel-body" name="enviar" value="SI"></center>
</form>
<form  enctype="multipart/form-data" action="../menu/index.php" method="post">
    
      
        <center><input type="submit" class="panel-body" name="enviar" value="NO"></center>
</form>
';
	


	?>