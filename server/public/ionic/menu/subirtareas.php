<!DOCTYPE html>

<!--

    Licensed to the 

-->
<html>

    <head>

        <meta charset="utf-8">

        <meta name="format-detection" content="telephone=no">

        <meta name="msapplication-tap-highlight" content="no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">

        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="../css/phomeworks.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script src="../js/jquery.min.js"></script>

        <script src="../js/bootstrap.min.js"></script>
        <meta name="theme-color" content="#207ce5">
        <link rel="icon" sizes="192x192" href="../image/phome-ico.png">

        <!-- FUNCIONES PROPIAS PHOMEWORK -->

        <script src="../js/forms.js"></script>

        <script src="../js/configuration.js"></script>

        <title>Phomework</title>
<!-- ENVIO DE DATOS PARA VERIFICAR SI EXISTE UNA NOTIFICACION -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$.ajaxSetup({'cache':false});
setInterval("loadNotifi()",500);    

$('#subirarchivos').hide();


$('select').on('change', function() {
    if(this.value=='SI'){
        register_other();
    }
    if(this.value=='NO'){
        register_other();
        alert('Tarea Guardada, espere porfavor, estamos enviando su solicitud');
        enviar_docentes();
    }
    if(this.value==''){
        alert("Asegurate de tener todos los campos diligenciados");
    }
});


});


function getParameterByName(name) {

    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),

    results = regex.exec(location.search);

    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

}

function loadNotifi(){
var parametros = {
    "correo" : localStorage.getItem("correo"),
    "tipo" : "estudiantes"
};
$.ajax({
    type: 'POST',
    url: 'http://phomework.com.co/www/php/notificaciones/sendWebMessage.php',
    data: parametros
}).done(function(info){
    //var altura = $('#resultado').prop('scrollHeight');
    //$('#resultado').scrollTop(altura);
});
}
</script>
    </head>

    <body>



        <div class="jumbotro text-center inicio">

            <h3>Subir Tarea</h3>
            <div style="background:black;text-align: left;opacity:0.3;" id="tokens">
                <script>
                    $(document).ready(function(){
                        document.getElementById("fecha_vencimiento").value = "2017-06-01";
                    });
                </script>
            </div>
            <div style="background:black;text-align: right;opacity:0.3;">

                <a href="miperfilestudiante.html" style="color:white"><span class="glyphicon glyphicon-user" style="padding:5px;"></span></a>
                <a href="notificaciones.html" style="color:white"><span class="glyphicon glyphicon-info-sign" style="padding:5px;"></span></a>

                <a href="soporte.html" style="color:white"><span class="" style="padding:5px;">FAQs</span></a>

                <a href="cerrar.html" style="color:white"><span class="glyphicon glyphicon-off" style="padding:5px;"></span></a>

            </div>

            <a href="index.html"><img class="imgr" style="width:40px;position:absolute;left:10px;top:8px;" src="../image/phome-ico.png"></a>

        </div>



        <!-- Fondo de imagenes -->

            <div class="fondo">

                <div id="slideshow">

                </div>

            </div>



    	<div class="container text-center">  
         	<p style="text-align: left;">Sube tus tareas de forma dinamica y rápidamente: <br>
            </p> 

            <form id="form_registerTareas">


				<div class="input-group">

					<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

					<input id="nombre" type="text" class="form-control" name="nombre" placeholder="Escribe el título de la tarea">

				</div>

					<input id="valor" type="hidden" class="form-control" name="valor" placeholder="Escribe cuantos tokens consideras en esta tarea">

				<div class="input-group">

					<span class="input-group-addon"><i class="glyphicon glyphicon-text-size"></i></span>

					<textarea name="descripcion" id="descripcion" class="form-control" placeholder="Escribe una breve descripción de tu tarea"></textarea> 

				</div>

                <i class="glyphicon glyphicon-calendar" for="fecha_vencimiento1"></i>Escribe la fecha de vencimiento de tu tarea (para cuando la necesitas)

                <div class="input-group">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                    <input id="fecha_vencimiento1" type="date" class="form-control" name="fecha_vencimiento1"  placeholder="Escribe la fecha de vencimiento">

                </div>

					<input id="fecha_creacion" type="hidden" class="form-control" name="fecha_creacion" placeholder="Escribe la fecha de creación" value="1">


                    <span class="input-group-addon" >¿Que desea hacer?</span>

                <div class="input-group">

                    <span class="input-group-addon"></span>
                    <select name="correcta" id="correcta" class="form-control">
                        <option value="">SELECCIONA UNA OPCION</option>
                        <option value="SI">Adjuntar archivo</option>
                        <option value="NO">Enviar solicitud</option>
                    </select>

                </div>
				

				<input type="hidden" name="estado" id="estado" value="ACTIVO">

				<input id="calificacion" type="hidden" name="calificacion" value="0"><br>



			</form>





<script>

         $(function(){

            $("input[name='file']").on("change", function(){

                var formData = new FormData($("#formulario")[0]);


                var ruta = "../php/Subir/Estudiantes.php";

                $.ajax({

                    url: ruta,

                    type: "POST",

                    data: formData,

                    contentType: false,

                    processData: false,

                    beforeSend: function () {

                        $('#respuesta').append(".");
                        $('#load').html('<img style="width:100%;position:absolute;top:0px;left:0px;" src="https://cdn.dribbble.com/users/69182/screenshots/2179253/animated_loading__by__amiri.gif"></div>');

                    },

                    success: function(datos)

                    {
                        $('#load').html('');
                        $("#respuesta").append(datos);

                    }

                });

            });

         });





        </script>
<div class="container text-center" id="subirarchivos">     


        <div id="androidmenor"></div>
            <form method="post" id="formulario" enctype="multipart/form-data">

                <input type="file"  name="file" id="file" class="inputfile"  />

                <label for="file">Adjuntar archivo</label>
                <input type="hidden" name="idtarea" id="idtarea" value="">

            </form><br>

            <a href="#" onclick="enviar_docentes();" id="boton222" ><div  class="panel panel-default btestudiante">

                <div class="panel-body">Enviar solicitud</div>

            </div></a>
            <div id="resultado"></div>
            <center><div id="load"></center>
            <div id="respuesta"></div><br><br><br><br><br><br><br><br>

        

            <p>Adjunta los archivos necesarios para hacer tu solicitud y envíala para recibir ayuda. <strong>Gracias</strong></p>
                
                


        </div>

<style type="text/css">

#respuesta{float: left;}

.inputfile {

    width: 0.1px;

    height: 0.1px;

    opacity: 0;

    overflow: hidden;

    position: absolute;


    z-index: -1;

}



.inputfile + label {

    font-size: 1.25em;

    font-weight: 700;
    width: 100%;

    color: white;

    background-color: #207ce5;

    padding: 30px;

    margin-bottom: 20px;

    display: inline-block;

}



.inputfile:focus + label,

.inputfile + label:hover {

    background-color: red;

}



.inputfile + label {

    cursor: pointer; /* "hand" cursor */

}



.inputfile:focus + label {

    outline: 1px dotted #000;

    outline: -webkit-focus-ring-color auto 5px;

}





</style>













        <style type="text/css">

    .zoom{

        transition: 1.5s ease;

        -moz-transition: 1.5s ease; /* Firefox */

        -webkit-transition: 1.5s ease; /* Chrome - Safari */

        -o-transition: 1.5s ease; /* Opera */

    }

    .zoom:hover,.zoom:focus{

        transform : scale(3);

        -moz-transform : scale(3); /* Firefox */

        -webkit-transform : scale(3); /* Chrome - Safari */

        -o-transform : scale(3); /* Opera */

        -ms-transform : scale(3); /* IE9 */

    }

</style>







            

        </div>



        <div id="contact" class="jumbotro text-center">

            <h6>Copyright wakusoft@2017</h6>

        </div>

<script type="text/javascript">
    function enviar_docentes(){
    var id = localStorage.getItem("id");
    //alert('djsadh');

    var parametros = {
        "id" : id,
        "encrypt" : "encrypt"
    };
    var urls = 'http://phomework.com.co/www/php/registrotarea2.php';
    $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                var id = response;
                $('#resultado').html(response);
                window.location.replace("index.html");
            }
    });
}


function register_other(){
        var nombre = $('#nombre').val();
    var valor = '0';
    var descripcion = $('#descripcion').val();
    var fecha_creacion = $('#fecha_creacion').val();
    var fecha_vencimiento = $('#fecha_vencimiento1').val();
    var estado = $('#estado').val();
    var calificacion = $('#calificacion').val();
    var id = getParameterByName('idestudiante');

    //validar los datos que esten diligenciados
    validate("nombre","El nombre esta incompleto verifica");
    validate("descripcion","La descripcion esta incompleto verifica");
    validate("fecha_vencimiento","La fecha_vencimiento esta incompleta verifica");
    //enviar datos al servidor
    var parametros = {
        "nombre" : nombre,
        "valor" : valor,
        "descripcion" : descripcion,
        "fecha_creacion" : fecha_creacion,
        "fecha_vencimiento" : fecha_vencimiento,
        "estado" : estado,
        "calificacion" : calificacion,
        "id" : id,
        "encrypt" : "encrypt"
    };
    var urls = 'http://phomework.com.co/www/php/registrotarea.php';
    $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                var id = response;
                $('#idtarea').val(id);
                alert('Estamos Preparando la Información que se enviará a nuestros especialistas. Tu tarea es: '+id);
                $('#resultado').html(response);
                $('#form_registerTareas').hide();
                $('#subirarchivos').show();
            },
            error: function () {
                $('#resultado').html('No tienes internet');
            }
    });
}
</script>

<script id="chatcolhost12" src="/chatcolhost.php"></script>

    </body>

</html>

