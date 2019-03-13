
<?php

/***

Licencia por wakusoft

****/

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



function ejecutar( $request ){

	//importar librerias de conexion

	include_once "../conexion.php"; 

	$conexion = conexion();

	//traer datos POST

  	$idestudiante = $request->idestudiante;

	$tokensid = mysqli_query($conexion,"SELECT * FROM `pagos` WHERE `idestudiante` = $idestudiante AND  `responseCode` NOT LIKE 'PENDING' ") or die(mysqli_error($conexion));

	//verifiacciones
	if($request->consulta == 'Cantidad'){
		$total = intval(0);
		while($row = $tokensid->fetch_assoc()){
			if($row['signo']=='+'){
				$total += intval($row['valor']);
			}
			elseif($row['signo']=='-'){
				$total -= intval($row['valor']);
			}	
		}
		$total = $total/1000;//mil pesos la unidad de token
		return $total;
	}

	//verifiacciones
	if($request->consulta == 'historico'){
	    $array = array();
	    while($row = $tokensid->fetch_assoc()){
	    	array_push($array, $row);
	    }
	    return $array;
	}
	

}

//1 pendiente

//2 habilitado

//3 inabilitado









?>