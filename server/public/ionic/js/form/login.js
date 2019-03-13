var login = new Login();

function Login()
{
	this.Start = function(){
		var correo = $('#correo').val();
		var clave = $('#clave').val();
		this.Validar(correo,clave);
	}

	this.Validar = function(correo, clave){
		alert(correo);
	}

	this.Enviar = function(){

	}

	this.Session = function(){
		/*Guardando los datos en el LocalStorage*/
		localStorage.setItem("correo", $('#correo').val());
		/*Obtener datos almacenados*/
		var correo = localStorage.getItem("correo");
		alert('Bienvenido '+correo);
	}

	this.Cerrar = function(){
		/*Guardando los datos en el LocalStorage*/
		localStorage.setItem("correo", '');
	}
}