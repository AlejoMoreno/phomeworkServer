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

        <!-- FUNCIONES PROPIAS PHOMEWORK -->

        <script src="../js/forms.js"></script>

        <script src="../js/configuration.js"></script>

        <title>Phomework</title>

        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

       <script>

         $(function(){

            $("input[name='file']").on("change", function(){

                var formData = new FormData($("#formulario")[0]);

                var ruta = "../php/Subir/Docentes.php";

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


         function getParameterByName(name) {

            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),

            results = regex.exec(location.search);

            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

        }

         $(document).ready(function(){

            var correo = getParameterByName('correo');
            $('#androidmenor').html("<a style='background: white;' href='http://phomework.com.co/www/fotosdocentes/imagenes.html?correo="+correo+"' target='_blank'> Si no funciona el subir archivo es porque tu version de android no soporta este tratamiento de los archivos por seguridad del mismo. Sin embargo pincha aqui para completar tu proceso. </a>");

            $('#formulario').append('<input type="hidden" name="correo" value="'+correo+'">');

         });





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

            <h3>Toma documentos</h3>

            <img class="imgr" style="width:40px;position:absolute;left:10px;top:8px;" src="../image/phome-ico.png">

        </div>



        <!-- Fondo de imagenes -->

            <div class="fondo">

                <div id="slideshow">

                </div>

            </div>





        <div class="container text-center">     


        <div id="androidmenor"></div>
            <form method="post" id="formulario" enctype="multipart/form-data">

                <input type="file" name="file" id="file" class="inputfile" />

                <label for="file">Adjuntar archivo</label>

            </form><br>

            <a onclick="closeCurrentWindow();" style="background-color:black;padding:20px;color:white">Terminar y enviar</a><br><br>
            <center><div id="load"></center>

            <div id="respuesta"></div><br><br><br><br><br><br><br><br>


            <p>Toma las fotos necesarias para que un especialista de Phomework valide y te habilite el usuario.

                Cuando termines deberas esperar la respuesta por chat de un especialista. <br><br> Si no se ven bien las fotos deben enviar scaners a nuestro correo administrativo. (admin@phomework.com.co) con asunto "certificados"
 <strong>Gracias</strong></p>



        </div>


<script type="text/javascript">
function closeCurrentWindow()
{
  window.close();
}
</script>





        <div id="contact" class="jumbotro text-center">



            <h6>Copyright digit4l@2017</h6>



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