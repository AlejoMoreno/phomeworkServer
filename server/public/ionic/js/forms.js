var host = '../';
//var host = 'http://phomework.com.co/www/';
/* 
	REGISTRODOCENTES
	wakusoft.co
*/

function form_register_docentes(){
	var registerUsernombre = $('#registerUsernombre').val();
	var registerUserapellido = $('#registerUserapellido').val();
	var registerUserurlFoto = $('#registerUserurlFoto').val();
	var registerUsercorreo = $.trim( $('#registerUsercorreo').val() );
	var registerUsertelefono = $('#registerUsertelefono').val();
	var registerUserdireccion = $('#registerUserdireccion').val();
	var registerUserurlCertificado = $('#registerUserurlCertificado').val();
	var registerUserestado = $('#registerUserestado').val();
	var registerUseridadministrador = $('#registerUseridadministrador').val();
	var registerUseridareasEspecialista = $('#registerUseridareasEspecialista').val();
	var registerUserclave = $('#registerUserclave').val();
	var registerUserclaveRepeat = $('#registerUserclaveRepeat').val();
	var registerUsercuenta = $('#registerUsercuenta').val();
	var registerUsercuentaTipo = $('#registerUsercuentaTipo').val();
	var registerUserbanco = $('#registerUserbanco').val();
	var registerUserdescripcion = $('#registerUserdescripcion').val();
	//validar los datos que esten diligenciados
	validate("registerUsernombre","El nombre esta incompleto verifica");
	validate("registerUserapellido","El apellido esta incompleto verifica");
	//validate("registerUserurlCertificado","El certificado esta incompleto verifica");
	//validate("registerUserurlFoto","La foto de perfil esta incompleto verifica");
	validate("registerUsercorreo","El correo esta incompleto verifica");
	validate("registerUsertelefono","El telefono esta incompleto verifica");
	validate("registerUserdireccion","La dirección esta incompleta verifica");
	validate("registerUseridareasEspecialista","Las areas esta incompleta verifica");
	validate("registerUserclave","La clave esta incompleta verifica");
	validate("registerUserclaveRepeat","Repita la clave esta incompleto verifica");
	validate("registerUserdescripcion","La descripción esta incompleta verifica");
	if(registerUserclave != registerUserclaveRepeat){alert('Claves no son iguales');exit();}
	if(registerUserbanco == ''){ registerUserbanco = 'no registra'; }
	if(registerUsercuentaTipo == ''){ registerUsercuentaTipo = 'no registra'; }
	if(registerUsercuenta == ''){ registerUsercuenta = 'no registra'; }
	//enviar datos al servidor
	var parametros = {
		"nombre" : registerUsernombre,
		"apellido" : registerUserapellido,
		"urlFoto" : registerUserurlFoto,
		"correo" : registerUsercorreo,
		"telefono" : registerUsertelefono,
		"direccion" : registerUserdireccion,
		"urlCertificado" : registerUserurlCertificado,
		"estado" : registerUserestado,
		"idadministrador" : registerUseridadministrador,
		"idareasEspecialista" : registerUseridareasEspecialista,
		"clave" : registerUserclave,
		"claveRepeat" : registerUserclaveRepeat,
		"cuenta" : registerUsercuenta,
		"tipocuenta" : registerUsercuentaTipo,
		"banco" : registerUserbanco,
		"descripcion" : registerUserdescripcion,
		"encrypt" : "encrypt"
	};
	sendServerdata(parametros, host+'php/registrodocente.php');
	window.location.assign("../fotosdocentes/imagenes.html?correo="+registerUsercorreo);
}


/* 
	REGISTRO ESTUDIANTES
	wakusoft.co
*/
function form_register_estudiantes(){
	var nickname = $('#registerEstucorreo').val();
	var edad = $('#registerEstuedad').val();
	var telefono = $('#registerEstutelefono').val();
	var correo = $.trim( $('#registerEstucorreo').val() );
	var clave = $('#registerEstuclave').val();
	var claverepeat = $('#registerEstuclaverepeat').val();
	//validar los datos que esten diligenciados
	validate("registerEstuedad","La edad esta incompleto verifica");
	validate("registerEstutelefono","El telefono esta incompleto verifica");
	validate("registerEstucorreo","El correo esta incompleto verifica");
	validate("registerEstuclave","La clave esta incompleta verifica");
	validate("registerEstuclaverepeat","Repita la clave esta incompleto verifica");
	if(clave != claverepeat){alert('Claves no son iguales');exit();}
	if(edad < 10){alert('No tienes la edad suficiente');exit()}
	//enviar datos al servidor
	var parametros = {
		"nickname" : nickname,
		"edad" : edad,
		"telefono" : telefono,
		"correo" : correo,
		"clave" : clave,
		"claverepeat" : claverepeat,
		"encrypt" : "encrypt"
	};
	$.ajax({
            data:  parametros,
            url:   host+'php/registroestudiante.php',
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                if(response.indexOf('1') != -1){ 
                	$('#registerEstunickname').val('');
					$('#registerEstuedad').val('');
					$('#registerEstutelefono').val('');
					$('#registerEstucorreo').val('');
					$('#registerEstuclave').val('');
					$('#registerEstuclaverepeat').val('');
					localStorage.setItem("correo", correo);  
        			localStorage.setItem("password", clave); 
					window.location.assign(host + "info/login.html?user="+nickname+"&clave="+clave);
                }
                else if(response=='NOPERMISOS'){
                	$('#resultado').html('Faltan datos por diligenciar');
                	alert('Faltan datos por diligenciar');
                }
                else if(response=='NO'){
                	$('#resultado').html('Faltan datos por diligenciar');
                	alert('Verifica el formulario, usuario ya registrado');
                }
                else{
                	$('#resultado').html(response);
                	//$('#resultado').html('Vuelve a intentar, tenemos algunas complicaciones');
                	document.getElementById("registerEstunickname").focus();
                	alert(response);
                }
            }
    });
	
}

/* 
	UPDATE form_asignar
	wakusoft.co
*/



/* 
	UPDATE ESTUDIANTES
	wakusoft.co
*/
function form_update_estudiantes(){
	var edad = $('#registerEstuedad').val();
	var telefono = $('#registerEstutelefono').val();
	var correo = $('#registerEstucorreo').val();
	var clave = $('#registerEstuclave').val();
	var claverepeat = $('#registerEstuclaverepeat').val();
	var id = localStorage.getItem("id");
	//validar los datos que esten diligenciados
	validate("registerEstunickname","El nickname esta incompleto verifica");
	validate("registerEstuedad","La edad esta incompleto verifica");
	validate("registerEstutelefono","El telefono esta incompleto verifica");
	validate("registerEstucorreo","El correo esta incompleto verifica");
	validate("registerEstuclave","La clave esta incompleta verifica");
	validate("registerEstuclaverepeat","Repita la clave esta incompleto verifica");
	if(clave != claverepeat){alert('Claves no son iguales');exit();}
	//enviar datos al servidor
	var parametros = {
		"id" : id,
		"edad" : edad,
		"telefono" : telefono,
		"correo" : correo,
		"clave" : clave,
		"claverepeat" : claverepeat,
		"encrypt" : "encrypt"
	};
	sendServerdata(parametros, host+'php/updateestudiante.php');
}




function closeSession(){
	localStorage.setItem("id", "");
	localStorage.setItem("correo", "");
	localStorage.setItem("pushID", ""); 
	localStorage.setItem("clave", ""); 
	localStorage.setItem("tipo", "");
	window.location.assign("../info/login.html");
}

function inicialapp(){
	window.location.assign("screenshot.html");
}


/* 
	OLVIDO
	wakusoft.co
*/
function form_olvido(){
	var correo = $('#olvidocorreo').val();
	//validar los datos que esten diligenciados
	validate("olvidocorreo","El correo esta incompleto verifica");
	//enviar datos al servidor
	var parametros = {
		"correo" : correo,
		"encrypt" : "encrypt"
	};
	$.ajax({
            data:  parametros,
            url:   host+'php/olvido.php',
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                $('#resultado').html(response);
            }
    });
}

/* 
	CHAT
	wakusoft.co
*/
function chat(emisor,receptor,mensaje,tipo){
	//validar los datos que esten diligenciados
	//validate("mensaje","El mensaje esta vacío");
	//enviar datos al servidor
	var parametros = {
		"emisor" : emisor,
	"receptor" : receptor,
	"mensaje" : mensaje,
	"tipo" : tipo, 
		"encrypt" : "encrypt"
	};

$.ajax({
            data:  parametros,
            url:   host+'php/chat.php',
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                $('#resultado').html(response);
            },
            error: function () {
            	$('#resultado').html('No tienes internet');
            }
    });
}

/*
	REGISTRO TAREA
	wakusoft.co
*/
function form_register_tarea(){
	var nombre = $('#nombre').val();
	var valor = '0';
	var descripcion = $('#descripcion').val();
	var fecha_creacion = $('#fecha_creacion').val();
	var fecha_vencimiento = $('#fecha_vencimiento').val();
	var estado = $('#estado').val();
	var calificacion = $('#calificacion').val();
	var id = localStorage.getItem("id");

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
	var urls = host+'php/registrotarea.php';
	$.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
            	var id = response;
            	var href = "imagenesTareas.html?idtarea="+id;
                $('#resultado').html(response);
                window.location.assign(href);
                $('#resultado').append('<a href="'+href+'" class="panel panel-default btestudiante">Tomar Fotos Tareas</a>');
            },
            error: function () {
            	$('#resultado').html('No tienes internet');
            }
    });
}

/*
	REGISTRO SOLUCION A UNA TAREA
	wakusoft.co
*/
function form_register_solucion(){
	var idtarea = $('#idtarea').val();
	var valor = $('#valor').val();
	var solucion = $('#solucion').val();
	var id = localStorage.getItem("id");

	//validar los datos que esten diligenciados
	validate("idtarea","Vuelve a realizar el proceso ya que no registramos una tarea asociada");
	validate("valor","El valor esta incompleto verifica");
	validate("solucion","Brindanos la solución");
	//enviar datos al servidor
	var parametros = {
		"idtarea" : idtarea,
		"valor" : valor,
		"solucion" : solucion,
		"id" : id,
		"encrypt" : "encrypt"
	};
	var urls = host+'php/registrosolucion.php';
	$.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
            	var id = response;
            	var href = "imagenesSolucion.html?idnotificacion="+id;
                $('#resultado').html(response);
                $('#resultado').append('<a href="'+href+'" style="padding:20px;width:200px;background:black;color:white">Tomar Fotos Soluciones</a>');
            }
    });
}

/* 
	forma de pago PHOMEWORK
	wakusoft.co
*/
function form_pasar_forma_pago(){
	var num = $('#referenceCode').val();
	if(isNaN(num)||num==''||num==0){
        alert('Ingrese un valor valido, que sea numérico');
        exit();
    }else{
    	$('#pasar').hide(100);
        $('#resultado').html('<div style="width: 100%;background: white; border: 1px solid black;opacity: 0.7;"><img onclick="form_pago_efecty();" width="250" height="100" src="../image/efecty.png"><br><img onclick="form_pago_baloto();" width="180" height="100" src="../image/baoloto.png"><br><img onclick="form_pago_tarjeta();" width="120" height="100" src="../image/visa.png"></div>');
    }
}




/* 
	TARJETa PHOMEWORK
	wakusoft.co
*/
function form_pago_tarjeta(){
	var referenceCode = $('#referenceCode').val();
	var valor = referenceCode*1000;
	var id = localStorage.getItem("id");
	var tipo = 'VISA';
	var referenceCod = 'efecty';
	var description = 'efecty';
	var email = localStorage.getItem("email");

	//validar los datos que esten diligenciados
	validate("id","Se cerro la sesión");
	//enviar datos al servidor
	var parametros = {
		"id" : id,
		"referenceCode" : referenceCode,
		"valor" : valor,
		"tipo" : tipo,
		"referenceCod" : referenceCod,
		"description" : description,
		"email" : email,
		"encrypt" : "encrypt"
	};
	var urls = host+'php/payu/index.php';
	$.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                $('#resultado').html(response);
            },
            error: function () {
            	$('#resultado').html('No tienes internet');
            }
    });
}

/* 
	EFECTY PHOMEWORK
	wakusoft.co
*/
function form_pago_efecty(){
	var referenceCode = $('#referenceCode').val();
	var valor = referenceCode*1000;
	var id = localStorage.getItem("id");
	var tipo = 'efecty';

	//validar los datos que esten diligenciados
	validate("id","Se cerro la sesión");
	//enviar datos al servidor
	var parametros = {
		"id" : id,
		"encrypt" : "encrypt"
	};
	var urls = host+'php/payu/index_efectivo.php';
	$.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                $('#resultado').html(response);
            },
            error: function () {
            	$('#resultado').html('No tienes internet');
            }
    });
}

/* 
	BALOTO PHOMEWORK
	wakusoft.co
*/
function form_pago_baloto(){
	var referenceCode = $('#referenceCode').val();
	var valor = referenceCode*1000;
	var id = localStorage.getItem("id");
	var tipo = 'efecty';
	var referenceCod = 'efecty';
	var description = 'efecty';
	var email = 'efecty';

	//validar los datos que esten diligenciados
	validate("id","Se cerro la sesión");
	//enviar datos al servidor
	var parametros = {
		"id" : id,
		"referenceCode" : referenceCode,
		"valor" : valor,
		"id" : id,
		"tipo" : tipo,
		"referenceCod" : referenceCod,
		"description" : description,
		"email" : email,
		"encrypt" : "encrypt"
	};
	var urls = host+'php/payu/index_pagoefectivo.php';
	$.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                $('#resultado').html(response);
            },
            error: function () {
            	$('#resultado').html('No tienes internet');
            }
    });
}


/* 
	SOPORTE PHOMEWORK
	wakusoft.co
*/
function form_comentarios(){
	var comentario = $('#registercomentario').val();
	var id = localStorage.getItem("id");
	var correo = localStorage.getItem("correo");
	//validar los datos que esten diligenciados
	validate("comentario","El comentario esta incompleto verifica");		
	//enviar datos al servidor
	var parametros = {
		"comentario" : comentario,
		"correo" : correo,
		"id" : id,
		"encrypt" : "encrypt"
	};
	sendServerdata(parametros, host+'php/comentario.php');
}


function validate(id,text){
	if($('#'+id).val()=='' || $('#'+id).val()==' '){
		alert(text);
		exit();
	}
}
function blanck(id){
	$(id).val('');
}

function sendServerdata(parametros,urls){
	$.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
            	$('#resultado').html("Cargando datos.");
            },
            success:  function (response) {
                if(response=='OK'){
                	$('#resultado').html('Proceso completo');
	               	alert('Proceso completo');
                }
                else if(response=='NOPERMISOS'){
                	$('#resultado').html('Faltan datos por diligenciar');
                	alert('Faltan datos por diligenciar');
                }
                else if(response=='NO'){
                	$('#resultado').html('Faltan datos por diligenciar');
                	alert('Verifica el formulario, usuario ya registrado');
                }
                else{
                	$('#resultado').html(response);
                	//$('#resultado').html('Vuelve a intentar, tenemos algunas complicaciones');
                	alert(response);
                }
            }
    });
}