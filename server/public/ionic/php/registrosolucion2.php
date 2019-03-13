<?php
/***
Licencia por wakusoft
****/
if(isset($_POST['encrypt'])){
    if($_POST['idtarea']!=''){
        ejecutar();
    }
    else{
        echo 'NOPERMISOS';
    }
}
else{
    echo 'NO';
}

function ejecutar(){
    include_once "conexion.php"; 
    $conexion = conexion();

    $idtarea = $_POST['idtarea'];
    $idestudiante = $_POST['idestudiante'];

    $hoy = date('Y-m-d');
    $href = "<a href=http://phomework.com.co/www/menu/MostrarTarea.html?id=".$idtarea."&estudiante=".$idestudiante."&docente=1><img width=30 src=https://image.flaticon.com/icons/svg/402/402306.svg></a>";
    $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Tarea Solucionada', 'tarea solucionada $idtarea <br> $href' , '$idestudiante', '0', '$hoy', '$hoy', '1')";

    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));    

}




?>