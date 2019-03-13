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

        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

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
                        $('#load').html('<img src="https://cdn.dribbble.com/users/69182/screenshots/2179253/animated_loading__by__amiri.gif"></div>');

                    },

                    success: function(datos)

                    {
                        $('#load').html('');
                        $("#respuesta").append(datos);

                    }

                });

            });

         });



         $(document).ready(function(){

            var idtarea = getParameterByName('idtarea');
            $('#idtarea').val(idtarea);

             $('#androidmenor').html("<a style='background: white;' href='http://phomework.com.co/www/menu/imagenesTareas.html?idtarea="+idtarea+"' target='_blank'> Si no funciona ingresa por web contus credenciales a www.phomework.com.co/www. </a>");

            var parametrer = {
                "encrypt":"husi",
                "consulta":"consulta",
                "idtarea": idtarea
            };
            var ruta = "http://phomework.com.co/www/php/consultas/consultarTareaIdImagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: parametrer,
                beforeSend: function () {
                    $('#load').html('Cargando...');
                },
                success: function(datos)
                {
                    $('#load').html('');
                    $("#respuesta").append(datos);
                }
            });

         });


          function getParameterByName(name) {

            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),

            results = regex.exec(location.search);

            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

        }





        </script>



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



    </head>

    <body>



        <div class="jumbotro text-center inicio">

            <h3>Imagenes Tareas</h3>
<div style="background:black;text-align: left;opacity:0.3;" id="tokens">
                <script>
                    $(document).ready(function(){
                        tokens();
                    });
                </script>
            </div>
            <div style="background:black;text-align: right;opacity:0.3;">

                <a href="miperfilestudiante.html" style="color:white"><span class="glyphicon glyphicon-user" style="padding:5px;"></span></a>

                <a href="soporte.html" style="color:white"><span class="glyphicon glyphicon-exclamation-sign" style="padding:5px;"></span></a>

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


        <div id="androidmenor"></div>
            <form method="post" id="formulario" enctype="multipart/form-data">

                <input type="file"  name="file" id="file" class="inputfile"  />

                <label for="file">Subir archivo adjunto</label>
                <input type="hidden" name="idtarea" id="idtarea" value="">

            </form><br>

            <a onclick="closeCurrentWindow();" style="background-color:black;padding:20px;color:white">Terminar</a><br><br>
            <center><div id="load"></center>
            <div id="respuesta"></div><br><br><br><br><br><br><br><br>

        

            <p>Toma las fotos necesarias para que un especialista de Phomework valide y te resuelva tu tarea.

                Cuando termines deberas esperar la respuesta por chat de un especialista. <strong>Gracias</strong></p>
                
                


        </div>



<script type="text/javascript">
function closeCurrentWindow()
{
  window.close();
}
</script>







        <div id="contact" class="jumbotro text-center">



            <h6>Copyright wakusoft@2017</h6>



        </div>



</html>



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

