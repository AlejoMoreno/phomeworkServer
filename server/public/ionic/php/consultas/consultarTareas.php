<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}


$postdata = file_get_contents("php://input");
if (isset($postdata)) {
    $request = json_decode($postdata);
    $encrypt = $request->encrypt;

    if ($encrypt == "453fe2d118fe6ea58f1e54f279d2b4af") {
        $respuesta = ejecutar( $request );
        echo json_encode(array(
            "result" => "true",
            "body" => $respuesta
        ));
    }
    else {
        echo "Empty encrypt parameter!";
    }
}
else {
    echo "Not called properly with encrypt parameter!";
}
/***
Licencia por wakusoft
****/

function ejecutar($request){

	//importar librerias de conexion
	include_once('/home/leizycom/public_html/ionic/php/class/Tareas.php');
	//include_once('c://xampp/htdocs/www/php/class/Tareas.php');

	//echo 'Estamos en reparacion';	
	$tareas = new Tareas();
	$listaTareas = $tareas->Getone($request->sentencia);
	
	return $listaTareas;

}

//1 pendiente

//2 habilitado

//3 inabilitado

?>