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

function ejecutar( $request ){
  $boton = '';
  //importar librerias de conexion
  include_once "../conexion.php"; 
  $conexion = conexion();
  //traer datos POST
  $idtarea = $request->idtarea;
  $id = $request->id;
  $array = array(); // arreglo para return
  $tareasId = mysqli_query($conexion,"SELECT * FROM `tareas` where idtareas = $idtarea ") or die(mysqli_error($conexion));
  $tareasId1 = mysqli_query($conexion,"SELECT * FROM `tareas` where idtareas = $idtarea ") or die(mysqli_error($conexion));
  $row = $tareasId1->fetch_assoc();
  array_push($array, array(
    'tarea' => $tareasId->fetch_assoc()
  ));

  if($request->tipo == 'docente'){
    array_push($array, array(
      'tipo' => 'docente'
    ));
    if($row['idprofesor']==$request->id){
      if($row['estado']=='SOLUCIONADO'){
        array_push($array, array(
          'url' => '',
          'texto' => 'Proximamente podrás editar adjuntos de esta tarea',
          'img' => 'https://www.flaticon.com/premium-icon/icons/svg/536/536921.svg'
        ));
      }
      else{
        array_push($array, array(
          'url' => 'solucionartarea',
          'texto' => 'De clic aquí para solucionar esta tarea',
          'img' => 'https://www.flaticon.com/premium-icon/icons/svg/536/536923.svg'
        ));
      }
    }
    else{ //estudiante aun no ha habilitado esta tarea a este docente
      array_push($array, array(
        'url' => '',
        'texto' => 'Espera a que el estudiante habilite la tarea',
        'img' => 'https://image.flaticon.com/icons/svg/497/497839.svg'
      ));
    }
  }
  else{
    array_push($array, array(
      'tipo' => 'estudiante'
    ));
    if($row['estado']!='SOLUCIONADO'){
      array_push($array, array(
        'url' => '',
        'texto' => 'Proximamente podrás editar adjuntos de esta tarea',
        'img' => 'https://www.flaticon.com/premium-icon/icons/svg/536/536921.svg'
      ));
    }
    else{
      $estudiante = $row['idestudiante'];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://phomework.com.co/www/php/consultas/consultarTokens.php");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,
                  "idestudiante=".$estudiante."&consulta=Cantidad&encrypt=algo");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
      // receive server response ...
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $cantidadTokens = curl_exec ($ch);
      curl_close ($ch);

      if(intval($cantidadTokens) < intval($row['valor'])/2){
        //no tiene tokens suficientes
        array_push($array, array(
          'url' => '',
          'texto' => 'No tienes tokens suficientes',
          'img' => 'https://image.flaticon.com/icons/svg/497/497839.svg'
        ));
      }
      else{
        array_push($array, array(
          'url' => '',
          'texto' => 'No puedes editar adjuntos, Tarea ya esta soucionada',
          'img' => 'https://www.flaticon.com/premium-icon/icons/svg/536/536921.svg'
        ));
      }
    }
  }


  $archivosTarea = mysqli_query($conexion,"SELECT * FROM `archivos` WHERE idtarea = $idtarea ") or die(mysqli_error($conexion));
  $array2 = array();

  while($archivos = $archivosTarea->fetch_assoc()){
    array_push($array2, $archivos);  
  }
  array_push($array, array(
    'archivosestudiante' => $array2
  ));


  //solucion de tareas
  if($row['estado']=='SOLUCIONADO'){

    //VERIFICAR SI TIENE TOKENS PARA DESCONTAR
    if(intval($cantidadTokens) < intval($row['valor'])/2){ //no tiene toekens
      //
    }
    else{
        $SoluTarea = mysqli_query($conexion,"SELECT * FROM `soluciones` where idtareas = $idtarea") or die(mysqli_error($conexion));
        $soluciones = $SoluTarea->fetch_assoc();
        array_push($array, array(
          'solucion' => $soluciones
        ));

        $archivosSoluTarea = mysqli_query($conexion,"SELECT * FROM `archivosSoluTarea` WHERE id_tarea = $idtarea ") or die(mysqli_error($conexion));
        $array3 = array();
        while($archivos = $archivosSoluTarea->fetch_assoc()){
          array_push($array3, $archivos);
        }
        array_push($array, array(
          'archivosdocente' => $array3
        ));
    }
  }

  if($request->tipo == 'docente'){
    $HistorialTareas = mysqli_query($conexion,"SELECT * FROM `solicitudTareas` WHERE id_tarea = $idtarea AND id_docente = $id ") or die(mysqli_error($conexion));
    if ($HistorialTareas->num_rows == 0) {
        $fecha = date('Y-mm-dd');
        $sql = "INSERT INTO `solicitudTareas` (`id_solicitud`, `id_docente`, `id_tarea`, `fecha`, `aceptado`) VALUES (NULL, '$id', '$idtarea', '$fecha', '0');";
        mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
        //push notification
    }

  }
  return $array;
}
