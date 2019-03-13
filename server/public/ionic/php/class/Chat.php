<?php 

/*
idchat
idestudiante
idprofesor
mensaje
fecha
estado
vs
*/
class Chat{
	var $idchat;
	var $idestudiante;
	var $idprofesor;
	var $mensaje;
	var $fecha;
	var $estado;
	var $vs;
	var $conn;

	public function __construct(){
		require_once('../conexion.php');
		$this->conn = conexion();
	}

	public function numeroNotificaciones($id,$tipo){
		if($tipo=='docente'){
			$sql = "SELECT COUNT(*)as total, `idprofesor` FROM `chat` WHERE `vs` LIKE '%67' AND `estado` LIKE 'enviado' GROUP BY `idprofesor`";
			$bill = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
			$row = $bill->fetch_assoc();
			return $row['total'];
		}
		elseif($tipo=='estudiante'){
			$sql = "SELECT COUNT(*)as total, idestudiante FROM `chat` WHERE `vs` LIKE '%$id' AND `estado` LIKE 'enviado' GROUP BY `idestudiante`";
			$bill = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
			$row = $bill->fetch_assoc();
			return $row['total'];
		}
	}

	public function actualizarNotificaciones($vs){
		mysqli_query($this->conn,"UPDATE `chat` SET `estado` = 'recibido'  WHERE `vs` LIKE '$vs' ") or die(mysqli_error($this->conn));
	}

	public function notificacionTareaNueva($idtarea){
		$sql = "SELECT COUNT(*)as total, estado FROM `tareas` WHERE `estado` LIKE 'EN ESPERA' GROUP BY `estado`";
			$bill = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
			$row = $bill->fetch_assoc();
			return $row['total'];
	}
}

?>