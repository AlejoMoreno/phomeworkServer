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
	include_once('../class/Chat.php');
	$Chat = new Chat();
	$id = $_POST['id'];
	$tipo = $_POST['tipo'];
	if($_POST['consulta']=='all'){
		echo $Chat->numeroNotificaciones($id,$tipo);
	}

}


?>