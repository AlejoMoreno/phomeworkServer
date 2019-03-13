<?php
/***
Licencia por wakusoft
****/
if(isset($_POST['encrypt'])){
    if($_POST['id']!=''){
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

    $tarea = $_POST['tarea'];

    //envio correo notificacion
    //busqueda de correo estudiante para enviar notificacion que la tarea esta hecha
    $docente = mysqli_query($conexion, "SELECT * FROM `profesores`" ) or die(mysqli_error($conexion)); 
    include_once "notificaciones/onlyMessage.php";
    require_once('class/mailNotify.php');
    $mail = new mailNotify();
    while( $docen = $docente->fetch_assoc() ){
        $hoy = date('Y-m-d');
        $idprofesores = $docen['idprofesores'];
        $mail->params(
        $docen['correo'],
        'Tarea Nueva en Phomework App');
        $mail->send(
            $mail->mensajeTareaNueva(
                $idestudiante,//idestudiante
                $row //post tarea
                ));
        $respuesta = sendMessage('Tarea Nueva en Phomework App', $docen['tipo']);
        $href = "<a href=http://phomework.com.co/www/menuDocente/MostrarTarea.html?id=".$tarea."&estudiante=".$idestudiante."&docente=1><img width=30 src=https://image.flaticon.com/icons/svg/402/402306.svg></a>";
        $sql = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Tarea Nueva', 'la tarea $tarea ha sido posteada, verifica que sea de tu interes. ".$href."', '0', '$idprofesores', '$hoy', '$hoy', '1');";
        mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    }
    echo "<script>alert('Tarea Enviada con éxito');</script>";


}

?>