

function selectAreas(){

	var parametros = {

		"consulta" : 'areas',

		"encrypt" : ''

	}

	$.ajax({

        data:  parametros,

        url:   host+'php/consultas/consultaareasespecialista.php',

        type:  'post',

        beforeSend: function () {

        	$('#areas').html("Cargando datos.");

        },

        success:  function (response) {

            $('#areas').html(response);

        }

    });

}



function selectidEstudiante(){

    var id = localStorage.getItem("id");

    var parametros = {

        "id" : id,

        "consulta" : 'estudiantes',

        "encrypt" : ''

    }

    $.ajax({

        data:  parametros,

        url:   host+'php/consultas/idstudiante.php',

        type:  'post',

        beforeSend: function () {

            $('#estudiante').html("Cargando datos.");

        },

        success:  function (response) {

            $('#estudiante').html(response);

        }

    });

}

function selectTareasId(){

    var id = localStorage.getItem("id");

    var idtarea = $('#idtarea').val();

    var tipo = $('#tipo').val();

    if(tipo=='docente'){
        var parametros = {

            "idtarea" : idtarea,

            "id" : id,

            "tipo" : tipo,

            "consulta" : 'estudiantes',

            "encrypt" : ''

        }
    }
    else{
        var parametros = {

            "idtarea" : idtarea,

            "id" : id,

            "consulta" : 'estudiantes',

            "encrypt" : ''

        }
    }

    
    $.ajax({

        data:  parametros,

        url:   host+'php/consultas/consultarTareaId.php',

        type:  'post',

        beforeSend: function () {

            $('#tarea').html("Cargando datos.");

        },

        success:  function (response) {

            $('#tarea').html(response);

        }

    });

}



function buscarTareas(){

    var sentencia = 'WHERE `idestudiante` = '+localStorage.getItem("id")+' ORDER BY `tareas`.`fecha_creacion` DESC ';

    var parametros = {

        "sentencia" : sentencia,

        "consulta" : 'tareas',

        "encrypt" : ''

    }

    $.ajax({

        data:  parametros,

        url:   host+'php/consultas/consultarTareas.php',

        type:  'post',

        beforeSend: function () {

            $('#tareas').html("Cargando datos...");

        },

        success:  function (response) {

            $('#tareas').html(response);

        }

    });

}




function buscarTareasDocentes(){

    var sentencia = 'WHERE `idprofesor` = '+localStorage.getItem("id")+' ORDER BY `tareas`.`fecha_creacion` DESC ';

    var parametros = {

        "sentencia" : sentencia,

        "consulta" : 'tareas',

        "encrypt" : ''

    }

    $.ajax({

        data:  parametros,

        url:   host+'php/consultas/consultarTareas.php',

        type:  'post',

        beforeSend: function () {

            $('#tareas').html("Cargando datos...");

        },

        success:  function (response) {

            $('#tareas').html(response);

        }

    });

}



function buscarTareasAll(){

    var sentencia = ' WHERE `estado` LIKE "EN ESPERA" ORDER BY `tareas`.`fecha_creacion` DESC ';

    var parametros = {

        "sentencia" : sentencia,

        "consulta" : 'tareas',

        "encrypt" : ''

    }

    $.ajax({

        data:  parametros,

        url:   host+'php/consultas/consultarTareas.php',

        type:  'post',

        beforeSend: function () {

            $('#tareas').html("Cargando datos...");

        },

        success:  function (response) {

            $('#tareas').html(response);

        }

    });

}

function selectTokensId(){

    var id = localStorage.getItem("id");

    var parametros = {

        "idestudiante" : id,

        "consulta" : 'Cantidad',

        "encrypt" : ''

    }

    $.ajax({

        data:  parametros,

        url:   host+'php/consultas/consultarTokens.php',

        type:  'post',

        beforeSend: function () {

            $('#cantidad').html("Cargando datos.");

        },

        success:  function (response) {

            $('#cantidad').html(response);

        }

    });

}

