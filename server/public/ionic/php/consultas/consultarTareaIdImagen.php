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
  $boton = '';
	//importar librerias de conexion
	include_once "../conexion.php"; 
	$conexion = conexion();
  echo '<br><br>';
  //traer datos POST
  $idtarea = $_POST['idtarea'];

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

}
//1 pendiente
//2 habilitado
//3 inabilitado

?>