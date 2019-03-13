<?php 

require_once('class/mailNotify.php');
$mail = new mailNotify();
        $mail->params($_GET['correo'],'Bienvenido a Phomework');
        /*$mail->send(
            $mail->mensajeDocenteRegistro(
                $_GET['nombre'].' '.$_GET['apellido'],
                $_GET['clave']
                ));*/
echo $mail->mensajeSolucionTarea(
                $_GET['nombre'].' '.$_GET['apellido'],
                $_GET['clave']
                );
?>