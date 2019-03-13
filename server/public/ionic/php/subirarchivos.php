
<?php

  


  $mas = $_POST['mas'];

echo'

    <form  enctype="multipart/form-data" action="../php/upload.php" method="post">
    <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">Selecciona adjuntos</div>
                <div class="panel-body">
                    
                    <span style="color:#207ce5;"><i class="glyphicon glyphicon-open-file"></i><input type="file" class="inputfile" name="archivo"></span>
                </div>
            </div>
        </div>
        <input id="calificacion" type="hidden" name="mas" value="'.$mas.'"><br>
        <center><input type="submit" class="panel-body" name="enviar" value="Postea la Tarea"></center>
        </form>
';

  
    




?>