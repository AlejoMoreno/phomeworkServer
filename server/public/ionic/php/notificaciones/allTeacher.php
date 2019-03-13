<?php 

/**
* 
*/
class AllTeacher 
{
	var $conexion1;
	
	function __construct()
	{
		include_once "../conexion.php"; 
		$this->conexion1 = conexion1();
	}

	function enviarDocente($text){
		$sql = 'SELECT * FROM `profesores` WHERE LENGTH(`tipo`) = (20)';
		$bill= mysqli_query($this->conexion1,$sql) or die(mysqli_error($this->conexion1));
		while($usuario = $bill->fetch_assoc()){
			$id = $usuario['idprofesores'];
			$hoy = date('Y-m-d');
			$insert = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Admin', '$text', '0', '$id', '$hoy', '$hoy', '1');";
			mysqli_query($this->conexion1,$insert) or die(mysqli_error($this->conexion1));
		}
	}

	function enviarEstudiante($text){
		$sql = 'SELECT * FROM `estudiantes` WHERE LENGTH(`tipo`) = (20)';
		$bill= mysqli_query($this->conexion1,$sql) or die(mysqli_error($this->conexion1));
		while($usuario = $bill->fetch_assoc()){
			$id = $usuario['idestudiante'];
			$hoy = date('Y-m-d');
			$insert = "INSERT INTO `notificaciones` (`id`, `titulo`, `texto`, `estudiante`, `docente`, `fecha_creado`, `fecha_actualizado`, `estado`) VALUES (NULL, 'Phomework Admin', '$text', '$id', '0', '$hoy', '$hoy', '1');";
			mysqli_query($this->conexion1,$insert) or die(mysqli_error($this->conexion1));
		}
	}

}


?>