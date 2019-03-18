<?php
//Comprobamos que se haya presionado el boton enviar
if(isset($_POST['enviar'])){
//Guardamos en variables los datos enviados
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$recaptcha= $_POST['g-recaptcha-response'];

if($recaptcha!=''){
	$secret="6LdTaZgUAAAAAOJHPMSjqxkeICZN0TQEmBC77yp2";
	$ip=$_SERVER['REMOTE_ADDR'];
	$var=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
	$array=json_decode($var, true);
	if($array['success']){
		///Validamos del lado del servidor que el nombre y el email no estén vacios
			if($nombre == ''){
			echo "Debe ingresar su nombre";
			}
			else if($email == ''){
			echo "Debe ingresar su email";
			}else{
			$para = "gersonsamayoa@gmail.com";//Email al que se enviará
			$asunto = "Mensaje de sitio cts.edu.gt";//Puedes cambiar el asunto del mensaje desde aqui
			//Este sería el cuerpo del mensaje
			$mensaje = "
			<table border='0' cellspacing='3' cellpadding='2'>
			<tr>
			<td width='30%' align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
			<td width='80%' align='left'>$nombre</td>
			</tr>
			<tr>
			<td align='left' bgcolor='#f0efef'><strong>E-mail:</strong></td>
			<td align='left'>$email</td>
			</tr>
			<tr>
			<td width='30%' align='left' bgcolor='#f0efef'><strong>Teléfono:</strong></td>
			<td width='70%' align='left'>$telefono</td>
			</tr>
			<tr>
			<td align='left' bgcolor='#f0efef'><strong>Comentario:</strong></td>
			<td align='left'>$mensaje</td>
			</tr>
			</table>
			";
			 
			//Cabeceras del correo
			$headers = "From: $nombre <$email>\r\n"; //Quien envia?
			$headers .= "X-Mailer: PHP5\n";
			$headers .= 'MIME-Version: 1.0' . "\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //
			 
			//Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
			if(mail($para, $asunto, $mensaje, $headers)){
			echo '<script type="text/javascript">
			alert("Gracias por tu mensaje");
			window.location.assign("../contacto.html");
			</script>';


			}else{
			echo '<script type="text/javascript">
			alert("Hubo un error en el envio de los datos");
			window.location.assign("../contacto.html");</script>';
			}
			}
			}
	}
	else{
		echo '<script type="text/javascript">
			alert("Hubo un error con tu captcha intentalo de nuevo");
			window.location.assign("../contacto.html");</script>';
	}
} else{
	echo"rellene todos los campos";
}

 

?>