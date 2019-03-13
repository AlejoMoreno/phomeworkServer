<?php 

/*idtareas
nombre
urltarea
calificacion
estado
idestudiante
valor
descripcion
fecha_creacion
fecha_vencimiento
idprofesor*/

class Tareas{
	var $idtareas;
	var $nombre;
	var $urltarea;
	var $calificacion;
	var $estado;
	var $idestudiante;
	var $valor;
	var $descripcion;
	var $fecha_creacion;
	var $fecha_vencimiento;
	var $idprofesor;
	var $conn;

	public function __construct(){
		require_once('../conexion.php');
		$this->conn = conexion();
	}

	public function Constructor(
			$idtareas,
			$nombre,
			$urltarea,
			$calificacion,
			$estado,
			$idestudiante,
			$valor,
			$descripcion,
			$fecha_creacion,
			$fecha_vencimiento,
			$idprofesor){

		//constructor del objeto
		$this->idtareas = $idtareas;
		$this->nombre = $nombre;
		$this->urltarea = $urltarea;
		$this->calificacion = $calificacion;
		$this->estado = $estado;
		$this->idestudiante = $idestudiante;
		$this->valor = $valor;
		$this->descripcion = $descripcion;
		$this->fecha_creacion = $fecha_creacion;
		$this->fecha_vencimiento = $fecha_vencimiento;
		$this->idprofesor = $idprofesor;

	}

	public function Insertar(){
		//sentencia para insertar la nueva tarea
		$result = mysqli_query($this->conn,"
			INSERT INTO `tareas` (`idtareas`, `nombre`, `urltarea`, `calificacion`, `estado`, `idestudiante`, `valor`, `descripcion`, `fecha_creacion`, `fecha_vencimiento`, `idprofesor`) VALUES 
				(NULL, 
				'$this->nombre', 
				NULL,  
				'$this->calificacion', 
				'$this->estado', 
				'$this->idestudiante', 
				'$this->valor', 
				'$this->descripcion', 
				'$this->fecha_creacion', 
				'$this->fecha_vencimiento', 
				 1)
			") or die(mysqli_error($this->conn));
		return $result;
	}

	public function Update($tareaObj){
		$result = mysqli_query($this->conn,"
			UPDATE `tareas` SET 
				`nombre` 		= '".$tareaObj['nombre']."',
				`calificacion` 	= '".$tareaObj['calificacion']."',
				`estado` 		= '".$tareaObj['estado']."',
				`valor` 		= '".$tareaObj['valor']."',
				`descripcion` 	= '".$tareaObj['descripcion']."',
				`fecha_creacion`= '".$tareaObj['fecha_creacion']."',
				`fecha_vencimiento` = '".$tareaObj['fecha_vencimiento']."',
				`idprofesor` 	= '".$tareaObj['idprofesor']."'
			WHERE `tareas`.`idtareas` = ".$tareaObj['idtareas'].";				
			") or die(mysqli_error($this->conn));
		return $result;
	}

	public function Getall(){
		$array = array();
		$bill = mysqli_query($this->conn,"SELECT * FROM `tareas`") or die(mysqli_error($this->conn));
		while($row = $bill->fetch_assoc()){
			array_push($array, $row);
		}
		return $array;
	}

	public function Getone($sentencia){
		$array = array();
		$bill = mysqli_query($this->conn,"SELECT * FROM `tareas` ".$sentencia." ") or die(mysqli_error($this->conn));
		while($row = $bill->fetch_assoc()){
			array_push($array, $row);
		}
		return $array;

	}

	public function calificacion($idtarea){
		$bill = mysqli_query($this->conn,"SELECT * FROM `calificaciones` WHERE `idtarea` = $idtarea ") or die(mysqli_error($this->conn));
		return $bill->fetch_assoc();
	}
}

?>