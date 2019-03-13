var docente = new Docente();

function Docente(){
	this.Start = function(){
		var nombre = $('#nombre').val();
		var apellido = $('#apellido').val();
		var urlFoto = $('#urlFoto').val();
		var correo = $('#correo').val();
		var telefono = $('#telefono').val();
		var direccion = $('#direccion').val();
		var urlCertificado = $('#urlCertificado').val();
		var estado = $('#estado').val();
		var idareasEspecialista = $('#idareasEspecialista').val();
		var clave = $('#clave').val();
		var claveRepeat = $('#claveRepeat').val();
		var descripcion = $('#descripcion').val();
		//hacer la validacion de los datos antes de enviarlos
		this.Validar(nombre,'Nombre esta vacío');
		this.Validar(apellido,'Apellido esta vacío');
		this.Validar(correo,'Correo esta vacío');
		this.Validar(telefono,'Teléfono esta vacío');
		this.Validar(direccion,'dirección esta vacío');
		this.Validar(idareasEspecialista,'Areás especialista esta vacío');
		this.Validar(clave,'Clave esta vacío');
		this.Validar(claveRepeat,'Clave Repeat esta vacío');
		this.Validar(descripcion,'Descripcion esta vacío');
		//validar las dos claves
		if(clave!=claveRepeat){alert('Las claves no son iguales');exit();}
		//preparar los datos para enviar
		this.Send(nombre,apellido,urlFoto,correo,telefono,direccion,urlCertificado,estado,idareasEspecialista,clave,claveRepeat,descripcion);

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

	this.Send = function(nombre,apellido,urlFoto,correo,telefono,direccion,urlCertificado,estado,idareasEspecialista,clave,claveRepeat,descripcion){
		var parametros = {
			"nombre" : nombre,
			"apellido" : apellido,
			"urlFoto" : urlFoto,
			"correo" : correo,
			"telefono" : telefono,
			"direccion" : direccion,
			"urlCertificado" : urlCertificado,
			"estado" : estado,
			"idareasEspecialista" : idareasEspecialista,
			"clave" : clave,
			"claveRepeat" : claveRepeat,
			"descripcion" : descripcion
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