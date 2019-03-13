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
  echo '<br><br>';
  //traer datos POST
  $idtarea = $request->idtarea;
  $id = $request->id;
	$tareasId = mysqli_query($conexion,"SELECT * FROM `tareas` where idtareas = $idtarea ") or die(mysqli_error($conexion));
	//verifiacciones
	$row = $tareasId->fetch_assoc();
  $estudiante = $row['idestudiante'];
  if(isset($request->tipo)){ //si es docente
    if($row['idprofesor']==$request->id){ //si la tarea esta asignada a este profesor
      //verificar si el docente quiere editar la tarea
      if($row['estado']=='SOLUCIONADO'){
         echo '<div style="padding:20px;border:1px solid blue;-webkit-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);"><center><a href="imagenesWebEdit.php?idnotificacion='.$idtarea.'" ></a><img width="50" src="../image/soluciones.png"> Proximamente podrás editar adjuntos de esta tarea</center></div>';
      }
      else{
        ?>
        <div style="padding:20px;border:1px solid blue;-webkit-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);"><center>
        <a href="javascript:;" onclick="window.open('imagenesWeb.php?iddocente='+<?php echo $row['idprofesor'];?>+'&tarea='+<?php echo $idtarea;?>, 'Diseño Web', 'width=400, height=300');"><img width="50" src="../image/soluciones.png"> De clic aquí para solucionar esta tarea</a></center></div>
        <?php
      }
    }
    else{
      echo '<div style="padding:20px;border:1px solid blue;-webkit-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);"><center>Espera a que el estudiante habilite la tarea</center></div>';
    }
  }
  else{ //es estudiante
    if($row['estado']!='SOLUCIONADO'){
      echo '<div style="padding:20px;border:1px solid blue;-webkit-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 13px 0px rgba(0,0,0,0.75);"><center><a href="imagenesWebEdit.php?idtarea='.$idtarea.'" ></a><img width="50" src="../image/soluciones.png"> Proximamente podrás editar adjuntos de esta tarea</center></div>';
    }
    else{

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
        
        echo '<style type="text/css">
          #solucion{
            display: none;
          }
          #ver{
          display: inline;
        }
        </style>';
      }
      else{
        echo '<div style="padding:20px;border:1px solid blue; opacity:0.5;"><center><a href="#" ><img width="50" src="../image/soluciones.png"> No puedes editar adjuntos, Tarea ya esta soucionada</a></center></div>';
      }

      
    }
    $boton = '
    <div class="input-group">
        <span ">Ingresa el Id del docente que realizará tu tarea</span>
        <input id="aceptado" type="aceptado" class="form-control" name="aceptado" placeholder="ID docente">
        <input type="hidden" id="idtarea" value="'.$idtarea.'">
    </div>
    <a href="javascript:;" onclick="form_asignar();"><div class="panel panel-default btdocente">
        <div class="panel-body text-center">Asignar Tarea a Docente</div>
    </div></a>';
  }

  echo '    <br><center><h1>'.$row['nombre'].'</h1></center>
      <div>
        <div style="border: 0px; border-bottom: 1px solid #207ce5;padding:15px;"><strong>Estado</strong> ( '.$row['estado'].' )<small>Tarea: '.$idtarea.'</small></div>
        <div style="border: 0px; border-bottom: 1px solid #207ce5;padding:15px;"><strong>Descripción:  </strong>'.$row['descripcion'].'</div>
        <div style="width:60%; border: 0px; border-bottom: 1px solid #207ce5;padding:15px;"> <strong>Creación:</strong> '.$row['fecha_creacion'].'</div>
        <div style="width:60%; border: 0px; border-bottom: 1px solid #207ce5;padding:15px;"><p><strong>Vencimiento:</strong> '.$row['fecha_vencimiento'].'</div>
        <div style="border: 0px; border-bottom: 1px solid #207ce5;padding:15px;">Tarea con un valor de <strong>'.$row['valor'].'</strong> tokens.</div>
      </div><br><br><p>Pincha para agrandar cada una de las imagenes.</p>

      <script>
        function form_asignar(){
  var aceptado = $("#aceptado").val();
  var tarea = $("#idtarea").val();
  //validar los datos que esten diligenciados
  validate("aceptado","La aceptado esta incompleto verifica");
  //enviar datos al servidor
  var parametros = {
    "tarea" : tarea,
    "aceptado" : aceptado,
    "encrypt" : "encrypt"
  };
  sendServerdata(parametros, host+"php/asignar.php");
}
      </script>

  ';


$archivosTarea = mysqli_query($conexion,"SELECT * FROM `archivos` WHERE idtarea = $idtarea ") or die(mysqli_error($conexion));


while($archivos = $archivosTarea->fetch_assoc()){
  $ext = explode('.', $archivos['url'])[1];//verificar la extencion del documento e imprimir una imagen alusiba
  //echo $ext;

  if($ext == 'docx' || $ext == 'doc' || $ext == 'pptx' || $ext == 'xlsx' || $ext == 'xls' || $ext == 'ppt' ){
         echo '<div ><div class="thumbnal">
                    <iframe src="http://docs.google.com/gview?url=http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'&embedded=true" width="275" height="275"></iframe>
                </div></div>';
    }
    elseif($ext == 'pdf'){
        echo '<div ><div class="thumbnal">
                    <iframe src="http://docs.google.com/gview?url=http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'&embedded=true" width="275" height="275"></iframe>
                </div></div>';
    }
    elseif($ext == 'mp4' || $ext == 'mp3' || $ext == 'avg' || $ext == 'wmv' || $ext == 'flv' || $ext == 'mov' || $ext == 'm4a'){
        echo '<video controls width="275" height="275" style="background:black;">
              <source src="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'" type="video/mp4">
              <source src="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'" type="video/ogg">
              Your browser does not support the video tag.
            </video>';
    }
    elseif($ext == 'png' || $ext == 'tif' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp'){
        echo '<img src="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'" width="275" height="275">
              <a href="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'">Descargar</a>';
    }
    else{
        echo '<div ><div class="thumbnil">
                  <iframe src="http://docs.google.com/gview?url=http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'&embedded=true" width="275" height="275"></iframe>
                </div></div>';
    }

  
}

echo '
          </div>';


//solucion de tareas
if($row['estado']=='SOLUCIONADO'){

  //VERIFICAR SI TIENE TOKENS PARA DESCONTAR

  $SoluTarea = mysqli_query($conexion,"SELECT * FROM `soluciones` where idtareas = $idtarea") or die(mysqli_error($conexion));
  $soluciones = $SoluTarea->fetch_assoc();
   echo '<div id="ver" style="padding:20px;border:1px solid blue; opacity:0.5;"><center><a href="mistokens.html" ><img width="50" src="../image/soluciones.png"> No puedes ver la solucion a esta tarea, recarga los tokens necesarios</a></center></div>';
   
  echo '<div id="solucion" style="width:100%;background:#75890c;padding:20px;"><h1 style="color:white;">Solucion de tarea</h1><p>'.$soluciones['notificacion'].'</p> <strong>Fecha de creacion: </strong>'.$soluciones['fecha'];

  $archivosSoluTarea = mysqli_query($conexion,"SELECT * FROM `archivosSoluTarea` WHERE id_tarea = $idtarea ") or die(mysqli_error($conexion));

  while($archivos = $archivosSoluTarea->fetch_assoc()){
    $ext = explode('.', $archivos['url'])[1]; //verificar la extencion del documento e imprimir una imagen alusiba
      if($ext == 'docx' || $ext == 'doc' || $ext == 'pptx' || $ext == 'xlsx' || $ext == 'xls' || $ext == 'ppt' ){
         echo '<div ><div class="thumbnal">
                    <iframe src="http://docs.google.com/gview?url=http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'&embedded=true" width="275" height="275"></iframe>
                </div></div>';
    }
    elseif($ext == 'pdf'){
        echo '<div ><div class="thumbnal">
                    <iframe src="http://docs.google.com/gview?url=http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'&embedded=true" width="275" height="275"></iframe>
                </div></div>';
    }
    elseif($ext == 'mp4' || $ext == 'mp3' || $ext == 'avg' || $ext == 'wmv' || $ext == 'flv' || $ext == 'mov'){
        echo '<video controls width="275" height="275" style="background:black;">
              <source src="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'" type="video/mp4">
              <source src="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'" type="video/ogg">
              Your browser does not support the video tag.
            </video>';
    }
    elseif($ext == 'png' || $ext == 'tif' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp'){
        echo '<img src="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'" width="275" height="275">
              <a href="http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'">Descargar</a>';
    }
    else{
        echo '<div ><div class="thumbnil">
                  <iframe src="http://docs.google.com/gview?url=http://'.$_SERVER['HTTP_HOST'].'/www/php/Subir/'.$archivos['url'].'&embedded=true" width="275" height="275"></iframe>
                </div></div>';
    }

  }
  echo '</div>';

  echo '</div><br>';

}



//verificar si existe la solicitud
if(isset($request->tipo)){ //si es tipo es docente si no es estudiante
  $HistorialTareas = mysqli_query($conexion,"SELECT * FROM `solicitudTareas` WHERE id_tarea = $idtarea AND id_docente = $id ") or die(mysqli_error($conexion));
  if ($HistorialTareas->num_rows == 0) {
    $fecha = date('Y-mm-dd');
    $sql = "INSERT INTO `solicitudTareas` (`id_solicitud`, `id_docente`, `id_tarea`, `fecha`, `aceptado`) VALUES (NULL, '$id', '$idtarea', '$fecha', '0');";
    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    //push notification
  }
  $HistorialTareas1 = mysqli_query($conexion,"SELECT * FROM `solicitudTareas` WHERE id_tarea = $idtarea AND id_docente = $id order by id_solicitud DESC") or die(mysqli_error($conexion));
  while($historial = $HistorialTareas1->fetch_assoc()){
    echo '<a href="chat.html?docente='.$historial['id_docente'].'&estudiante='.$estudiante.'"><div id="historial" style="font-size:15pt;"><h3>Muestra interés por esta solicitud y contacta al estudiante dando clic aquí!.  </div></a>';
  }
}
else{ //como se ve en un estudiatne
  $HistorialTareas1 = mysqli_query($conexion,"SELECT * FROM `solicitudTareas` WHERE id_tarea = $idtarea order by id_solicitud DESC") or die(mysqli_error($conexion));
  echo '<div id="historial" style="font-size:15pt;background:transparent">';
  echo '<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading" style="background:#207ce5;color:white;">
      <h3 class=" text-center" >
        <a data-toggle="collapse" href="#collapse1" style="font-size:15pt;color:white;text-decoration:none;">Descubre quién está interesado en tu solucionar tu tarea</a>
      </h3>
    </div>
    <div id="collapse1" class="panel-collapse collapse" style="font-size:15pt;">
      ';
  while($historial = $HistorialTareas1->fetch_assoc()){
    if($historial['aceptado']=='1'){$color = 'background: #91e842;';}else{$color = '';}
   echo '<ul class="list-group">
          <a href="chat.html?docente='.$historial['id_docente'].'&estudiante='.$estudiante.'">
            <li class="list-group-item" style="'.$color.'" ><img width="20" src="../image/chat.png"> Docente Id. '.$historial['id_docente'].' hablar por chat Aqui! </li>
          </a>

        </ul>';
  }
  echo '<div class="panel-footer" style="color:black"><strong>Fin de solicitudes</strong></div>
    </div>
  </div>
</div>
</div>';
}

echo $boton;


}
//1 pendiente
//2 habilitado
//3 inabilitado

?>
<style type="text/css">
          #ver{
          display: none;
        }
        </style>
