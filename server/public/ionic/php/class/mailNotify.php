<?php 

Class mailNotify{
	var $mail;
	var $to;
	var $asunto;
	
	function __construct(){
		//Librerías para el envío de mail
	    require_once('PHPMailer/class.phpmailer.php');
	    require_once('PHPMailer/class.smtp.php');
	    //Este bloque es importante
	    $this->mail = new PHPMailer();
	    $this->mail->IsSMTP();
	    $this->mail->SMTPAuth = true;
	    $this->mail->IsHTML(true);
	    $this->mail->SMTPSecure = "tls";
	    $this->mail->Host = "smtp.gmail.com";
	    $this->mail->Port = 587;     
	    //Nuestra cuenta
	    $this->mail->Username ='wakusoft@gmail.com';
	    $this->mail->Password = 'wakusoft2016'; //Su password
	    $this->mail->FromName = 'Admin Phomework';
	    $this->mail->From = 'admin@phomework.com.co';
	}
	//parametros para y asunto
	function params($to,$asunto){
		$this->to = $to;
		$this->asunto = $asunto;
	}
	//enviar el mensaje
	function send($mensaje){
		 //Agregar destinatario
	    $this->mail->AddAddress($this->to);
	    $this->mail->Subject = $this->asunto;
	    $this->mail->Body = $mensaje;
	    return $this->mail->Send();
	}
	//tomar el mail
	function getMail(){
		return $this->mail;
	}
	//tomar el para
	function getTo(){
		return $this->to;
	}
	/**********Configuracion de mensajes en html********************* */
	function mensajeEstudianteRegistro($nickname,$clave){
		return '<!DOCTYPE html>
			<html lang="en">
			<head>
			  <title>REgistro</title>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>

			<div class="jumbotron text-center" style="">
			  <h1><img src="http://phomework.com.co/www/image/phome-ico.png"></h1>
			  <p>Bienvenido a Phomework '.$nickname.'</p> 
			</div>
			  
			<div class="container">
			  <div class="row">
			    <div class="col-sm-12">
			      <h3>Datos de usuario</h3>
			      <p>Tu clave es: '.$clave.'<br><strong>Gracias por registrarte, ingresa tienes 50 tokens para gastar gratuitamente</strong></p>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <h3>ESTUDIANTE¡</h3>
			      <p>Ahorra tiempo desde tu dispositivo móvil !<br>
			    Si cuentas con poco tiempo para realizar tu trabajos, PhomeWork se encargará de tu proceso académico
			     para la comprensión de un tema o la solución de una tarea en específico. ¡ Descárgala ya !</p>
			    </div>
			    <div class="col-sm-6">
			      <h3>PROFESOR</h3>
			      <p>Gana dinero desde tu dispositivo móvil !
			    Si tu eres especialista en cualquier área del conocimiento y quieres tener ingresos extras, te conviene
			     nuestra App. ¡ Descárgala ya !.</p>
			    </div>
			  </div>
			</div>

			</body>
			</html>
			';
	}

	function mensajeDocenteRegistro($nombrecompleto,$clave){
		return '<!DOCTYPE html>
			<html lang="en">
			<head>
			  <title>REgistro</title>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>

			<div class="jumbotron text-center" style="">
			  <h1><img src="http://phomework.com.co/www/image/phome-ico.png"></h1>
			  <p>Bienvenido a Phomework '.$nombrecompleto.'</p> 
			</div>
			  
			<div class="container">
			  <div class="row">
			    <div class="col-sm-12">
			      <h3>Datos de usuario</h3>
			      <p>Tu clave es: '.$clave.'<br><strong>Espera a que un asesor de phomework te de alta en la aplicación </strong></p>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <h3>ESTUDIANTE¡</h3>
			      <p>Ahorra tiempo desde tu dispositivo móvil !<br>
			    Si cuentas con poco tiempo para realizar tu trabajos, PhomeWork se encargará de tu proceso académico
			     para la comprensión de un tema o la solución de una tarea en específico. ¡ Descárgala ya !</p>
			    </div>
			    <div class="col-sm-6">
			      <h3>PROFESOR</h3>
			      <p>Gana dinero desde tu dispositivo móvil !
			    Si tu eres especialista en cualquier área del conocimiento y quieres tener ingresos extras, te conviene
			     nuestra App. ¡ Descárgala ya !.</p>
			    </div>
			  </div>
			</div>
			</body>
			</html>
			';
	}

	function mensajeSolucionTarea($iddocente,$tarea){
		return '<!DOCTYPE html>
			<html lang="en">
			<head>
			  <title>REgistro</title>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>

			<div class="jumbotron text-center" style="">
			  <h1><img src="http://phomework.com.co/www/image/phome-ico.png"></h1>
			  <p>El docente '.$iddocente.' <strong style="color:green">solucionó</strong> tu tarea</p> 
			</div>
			  
			<div class="container">
			  <div class="row">
			    <div class="col-sm-12">
			      <h3>Datos de la tarea</h3>
			      <p> <strong>Título tarea:</strong> '.$tarea['nombre'].'</p>
			      <p> <strong>Descripción tarea:</strong> '.$tarea['descripcion'].'</p>
			      <p> <strong>Creación tarea:</strong> '.$tarea['fecha_creacion'].'</p>
			      <p> <strong>Vencimiento tarea:</strong> '.$tarea['fecha_vencimiento'].'</p>
			      <p> <strong>Valor tarea:</strong> '.$tarea['valor'].'</p>
			      <p> <strong style="color:red">Si quieres ver la solución a esta tarea ingresa a la APP phomework</strong></p>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <h3>ESTUDIANTE¡</h3>
			      <p>Ahorra tiempo desde tu dispositivo móvil !<br>
			    Si cuentas con poco tiempo para realizar tu trabajos, PhomeWork se encargará de tu proceso académico
			     para la comprensión de un tema o la solución de una tarea en específico. ¡ Descárgala ya !</p>
			    </div>
			    <div class="col-sm-6">
			      <h3>PROFESOR</h3>
			      <p>Gana dinero desde tu dispositivo móvil !
			    Si tu eres especialista en cualquier área del conocimiento y quieres tener ingresos extras, te conviene
			     nuestra App. ¡ Descárgala ya !.</p>
			    </div>
			  </div>
			</div>

			</body>
			</html>
			';
	}

	function mensajeTareaNueva($idestudiante,$tarea){
		return '<!DOCTYPE html>
			<html lang="en">
			<head>
			  <title>REgistro</title>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>

			<div class="jumbotron text-center" style="">
			  <h1><img src="http://phomework.com.co/www/image/phome-ico.png"></h1>
			  <p>El Estudiante '.$idestudiante.' <strong style="color:green">publicó </strong>una tarea</p> 
			</div>
			  
			<div class="container">
			  <div class="row">
			    <div class="col-sm-12">
			      <h3>Datos de la tarea</h3>
			      <p> <strong>Título tarea:</strong> '.$tarea['nombre'].'</p>
			      <p> <strong>Descripción tarea:</strong> '.$tarea['descripcion'].'</p>
			      <p> <strong>Creación tarea:</strong> '.$tarea['fecha_creacion'].'</p>
			      <p> <strong>Vencimiento tarea:</strong> '.$tarea['fecha_vencimiento'].'</p>
			      <p> <strong>Valor tarea:</strong> '.$tarea['valor'].'</p>
			      <p> <strong style="color:red">Si quieres dar solución a esta tarea ingresa a la APP phomework</strong></p>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <h3>ESTUDIANTE¡</h3>
			      <p>Ahorra tiempo desde tu dispositivo móvil !<br>
			    Si cuentas con poco tiempo para realizar tu trabajos, PhomeWork se encargará de tu proceso académico
			     para la comprensión de un tema o la solución de una tarea en específico. ¡ Descárgala ya !</p>
			    </div>
			    <div class="col-sm-6">
			      <h3>PROFESOR</h3>
			      <p>Gana dinero desde tu dispositivo móvil !
			    Si tu eres especialista en cualquier área del conocimiento y quieres tener ingresos extras, te conviene
			     nuestra App. ¡ Descárgala ya !.</p>
			    </div>
			  </div>
			</div>

			</body>
			</html>
			';
	}

	function mensajeInteresado($iddocente,$tarea){
		return '<!DOCTYPE html>
			<html lang="en">
			<head>
			  <title>REgistro</title>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>

			<div class="jumbotron text-center" style="">
			  <h1><img src="http://phomework.com.co/www/image/phome-ico.png"></h1>
			  <p>El Docente '.$iddocente.' <strong style="color:blue">esta interesado en tu </strong> tarea</p> 
			</div>
			  
			<div class="container">
			  <div class="row">
			    <div class="col-sm-12">
			      <h3>Datos de la tarea</h3>
			     <p> <strong>Título tarea:</strong> '.$tarea['nombre'].'</p>
			      <p> <strong>Descripción tarea:</strong> '.$tarea['descripcion'].'</p>
			      <p> <strong>Creación tarea:</strong> '.$tarea['fecha_creacion'].'</p>
			      <p> <strong>Vencimiento tarea:</strong> '.$tarea['fecha_vencimiento'].'</p>
			      <p> <strong>Valor tarea:</strong> '.$tarea['valor'].'</p>
			      <p> <strong style="color:red">Contacta a este docente lo más pronto posible ingresando a la App phomework</strong></p>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <h3>ESTUDIANTE¡</h3>
			      <p>Ahorra tiempo desde tu dispositivo móvil !<br>
			    Si cuentas con poco tiempo para realizar tu trabajos, PhomeWork se encargará de tu proceso académico
			     para la comprensión de un tema o la solución de una tarea en específico. ¡ Descárgala ya !</p>
			    </div>
			    <div class="col-sm-6">
			      <h3>PROFESOR</h3>
			      <p>Gana dinero desde tu dispositivo móvil !
			    Si tu eres especialista en cualquier área del conocimiento y quieres tener ingresos extras, te conviene
			     nuestra App. ¡ Descárgala ya !.</p>
			    </div>
			  </div>
			</div>

			</body>
			</html>
			';
	}

	function mensajeElegidoDocente($idestudiante,$tarea){
		return '<!DOCTYPE html>
			<html lang="en">
			<head>
			  <title>REgistro</title>
			  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>
			<body>

			<div class="jumbotron text-center" style="">
			  <h1><img src="http://phomework.com.co/www/image/phome-ico.png"></h1>
			  <p>El Estudiante '.$idestudiante.' <strong style="color:blue">te selecciono para hacer su tarea</strong> </p> 
			</div>
			  
			<div class="container">
			  <div class="row">
			    <div class="col-sm-12">
			      <h3>Datos de la tarea</h3>
			      <p> <strong>Título tarea:</strong> '.$tarea['nombre'].'</p>
			      <p> <strong>Descripción tarea:</strong> '.$tarea['descripcion'].'</p>
			      <p> <strong>Creación tarea:</strong> '.$tarea['fecha_creacion'].'</p>
			      <p> <strong>Vencimiento tarea:</strong> '.$tarea['fecha_vencimiento'].'</p>
			      <p> <strong>Valor tarea:</strong> '.$tarea['valor'].'</p>
			      <p> <strong style="color:red">Realiza la tarea de este estudiante por medio de la App phomework</strong></p>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
			      <h3>ESTUDIANTE¡</h3>
			      <p>Ahorra tiempo desde tu dispositivo móvil !<br>
			    Si cuentas con poco tiempo para realizar tu trabajos, PhomeWork se encargará de tu proceso académico
			     para la comprensión de un tema o la solución de una tarea en específico. ¡ Descárgala ya !</p>
			    </div>
			    <div class="col-sm-6">
			      <h3>PROFESOR</h3>
			      <p>Gana dinero desde tu dispositivo móvil !
			    Si tu eres especialista en cualquier área del conocimiento y quieres tener ingresos extras, te conviene
			     nuestra App. ¡ Descárgala ya !.</p>
			    </div>
			  </div>
			</div>

			</body>
			</html>
			';
	}

}

/*$mail = new mailNotify();
$mail->params('fredymoreno@uan.edu.co','Asunto nuevo');
echo "Respuesta mail: ".$mail->send($mail->mensajeDocenteRegistro('41','tarea'));
echo $mail->mensajeDocenteRegistro('41','tarea');*/

/*require_once('PHPMailer/class.phpmailer.php');
require_once('PHPMailer/class.smtp.php');
	    //Este bloque es importante
$mail = new PHPMailer();

//$mail->SMTPDebug = 4;                               // Habilitar el debug

$mail->isSMTP();                                      // Usar SMTP
$mail->Host = 'servidor';  // Especificar el servidor SMTP reemplazando por el nombre del servidor donde esta alojada su cuenta
$mail->SMTPAuth = true;                               // Habilitar autenticacion SMTP
$mail->Username = 'info@phomework.com.co';                 // Nombre de usuario SMTP donde debe ir la cuenta de correo a utilizar para el envio
$mail->Password = 'phomework2017';                           // Clave SMTP donde debe ir la clave de la cuenta de correo a utilizar para el envio
$mail->SMTPSecure = 'ssl';                            // Habilitar encriptacion
$mail->Port = 465;                                    // Puerto SMTP

$mail->setFrom('info@phomework.com.co');     //Direccion de correo remitente
$mail->addAddress('fredymoreno@uan.edu.co');     // Agregar el destinatario
$mail->addReplyTo('info@phomework.com.co');     //Direccion de correo para respuestas

$mail->isHTML(true);                                  // Habilitar contenido HTML

$mail->Subject = 'Mensaje de ejemplo';
$mail->Body    = 'Este es solo un mensaje de ejemplo <b>en HTML!</b>';

if(!$mail->send()) {
    echo 'El mensaje no pudo ser enviado';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'El mensaje ha sido enviado';
}*/

?>

