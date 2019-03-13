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
	$bill_estudiante = mysqli_query($conexion,"SELECT * FROM `profesores` where idprofesores = $id") or die(mysqli_error($conexion));
	//verifiacciones
	$estudiante = $bill_estudiante->fetch_assoc();
	$resultado = '
    <img style="width:200px;" src="https://image.flaticon.com/icons/svg/149/149071.svg">
    <h1>'.$estudiante['correo'].'</h1>
    <p>'.$estudiante['descripcion'].'</p>
    <p>'.$estudiante['edad'].'</p>
	<div class="input-group">
                    <input id="registerEstuedad" type="hidden" class="form-control" name="edadedad" value="'.$estudiante['edad'].'" placeholder="edad">
                </div>
                <div class="input-group">
                    <input id="registerEstutelefono" type="hidden" class="form-control" name="telefono" value="'.$estudiante['telefono'].'" placeholder="telefono">
                </div>                
                    <input id="registerEstucorreo" type="hidden" class="form-control" name="correo" value="'.$estudiante['correo'].'" placeholder="correo">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i>Clave</span>
                    <input id="registerEstuclave" type="password" class="form-control" name="clave" value="'.$estudiante['clave'].'" placeholder="clave">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i>Clave Rep</span>
                    <input id="registerEstuclaverepeat" type="password" class="form-control" name="claverepeat" value="'.$estudiante['clave'].'" placeholder="repita clave">
                </div>
                <div style="border:1px solid black;padding:20px;">
                    <p>Info. Cuenta Bancaria</p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i>Cuenta:</span>
                        <input type="text" class="form-control" name="cuenta" value="'.$estudiante['cuenta'].'" placeholder="Cuenta" disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i>Banco:</span>
                        <input type="text" class="form-control" name="banco" value="'.$estudiante['banco'].'" placeholder="banco" disabled>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i>Tipo Cuenta:</span>
                        <input type="text" class="form-control" name="tipocuenta" value="'.$estudiante['tipocuenta'].'" placeholder="tipocuenta" disabled>
                    </div>
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