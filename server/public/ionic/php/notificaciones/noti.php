<!DOCTYPE html>
<html>
<head>
	<title>Servicio de notificaciones</title>
</head>
<body>
<div id="respuesta"></div>
<!-- ENVIO DE DATOS PARA VERIFICAR SI EXISTE UNA NOTIFICACION -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$.ajaxSetup({'cache':false});
setInterval("loadNotifi()",500);    
});
function loadNotifi(){
var parametros = {
    "correo" : ""
};
$.ajax({
    type: 'GET',
    url: 'http://phomework.com.co/www/php/notificaciones/cronNotification.php',
    data: parametros
}).done(function(info){
    $('#respuesta').html(info);
});
}
</script>
</body>
</html>

