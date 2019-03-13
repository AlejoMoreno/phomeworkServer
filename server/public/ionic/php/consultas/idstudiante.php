<?php
/***
Licencia por wakusoft
****/

if(isset($_POST['encrypt'])){
    if($_POST['consulta']!=''){
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
	//importar librerias de conexion
	include_once "../conexion.php"; 
	$conexion = conexion();
	$id = $_POST['id'];
	//traer datos POST
	$bill_estudiante = mysqli_query($conexion,"SELECT * FROM `estudiantes` where idestudiante = $id") or die(mysqli_error($conexion));
	//verifiacciones
	$estudiante = $bill_estudiante->fetch_assoc();
	$resultado = '
    <img style="width:200px;" src="https://www.flaticon.com/premium-icon/icons/svg/145/145857.svg">
    <h1>'.$estudiante['correo'].'</h1>
	<div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i>Edad:</span>
                    <input id="registerEstuedad" type="text" class="form-control" name="edadedad" value="'.$estudiante['edad'].'" placeholder="edad">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i>Teléfono:</span>
                    <input id="registerEstutelefono" type="text" class="form-control" name="telefono" value="'.$estudiante['telefono'].'" placeholder="telefono">
                </div>
                    <input id="registerEstucorreo" type="hidden" class="form-control" name="correo" value="'.$estudiante['correo'].'" placeholder="correo">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i>Clave:</span>
                    <input id="registerEstuclave" type="password" class="form-control" name="clave" value="'.$estudiante['clave'].'" placeholder="clave">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i>Clave rep:</span>
                    <input id="registerEstuclaverepeat" type="password" class="form-control" name="claverepeat" value="'.$estudiante['clave'].'" placeholder="repita clave">
                </div>
                <a href="javascript:;" onclick="form_update_estudiantes();"><div class="panel panel-default btestudiante">
                    <div class="panel-body">Actualizate en Phomework</div>
                </div></a>
	';
	echo $resultado;
}
//1 pendiente
//2 habilitado
//3 inabilitado




?>