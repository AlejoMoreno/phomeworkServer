var estudiante = new Estudiante();

function Estudiante(){
	this.Start = function(){
		var nickname = $('#nickname').val();
		var edad = $('#edad').val();
		var telefono = $('#telefono').val();
		var correo = $('#correo').val();
		var clave = $('#clave').val();
		var claverepeat = $('#claverepeat').val();
		//validar las dos claves
		if(clave!=claverepeat){alert('Las claves no son iguales');exit();}
		//preparar los datos para enviar
		this.Send();

	}

	this.Validar = function(id,texto){
		if(id == ''){
			alert(texto);
			$('#'+id).addClass('error');
		}
		else{
			$('#'+id).removeClass('error');
		}
	}

	this.Send = function(){
		var parametros = {
			
		}
		$.ajax({
                data:  parametros,
                url:   'ejemplo_ajax_proceso.php',
                type:  'post',
                beforeSend: function () {
                    $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    $("#resultado").html(response);
                }
                error: function(){
                	$("#resultado").html('No tienes Internet.');
                }
        });

	}
}

nickname
edad
telefono
correo
clave
claverepeat