<?php
require('bd.php');

$nombres = $_POST["nombres"] ;
$apellidos = $_POST["apellidos"] ;
$identificacion = $_POST["identificacion"] ;
$telefono = $_POST["telefono"] ;
$celular = $_POST["celular"] ;
$ciudad = $_POST["ciudad"] ;
$tipo = $_POST["tipo"] ;
$nomempresa = $_POST["nomempresa"] ;

$usuario = $_POST["email"] ;
$email = $_POST["email"] ;
$contrasena = $_POST["clave"] ;
$password = md5(sha1($_POST["confirmacion"]));
$pregunta = $_POST["pregunta"] ;
$respuesta = $_POST["respuesta"] ;
if($_POST["infoCelular"] == 1)
{
	$infoCelular = $_POST["infoCelular"] ;
}
else
{
	$infoCelular = 0;
}

if($_POST["infoCorreo"] == 1)
{
	$infoCorreo = $_POST["infoCorreo"] ;
}
else
{
	$infoCorreo = 0;
}



//INSERTO DATOS EN LA TABLA USUARIOS
$insercion = "INSERT INTO usuarios (nombres, apellidos, identificacion, telefono, celular, ciudad, tipoUsuario, nombreEmpresa, usuario, email, pass, rol, preguntaClave, respuestaPregunta, fechaCreacion, infoCel, infoMail) VALUES ('$nombres', '$apellidos', $identificacion, '$telefono', '$celular', $ciudad, $tipo, '$nomempresa', '$usuario', '$email', '$password', 1, '$pregunta', '$respuesta', NOW(), $infoCelular, $infoCorreo)";
	
if (mysql_db_query($bd_nombre, $insercion))
{
	//ENVIAMOS E-MAIL CONFIRMADO LA CREACION DE LA CUENTA
	$destinatario = $email;
	
	$UN_SALTO="\r\n";
	$DOS_SALTOS="\r\n\r\n";
	
	$titulo="Registro del Cliente ".$nombres.' '.$apellidos;
	$mensaje =' 
	<html>
	<head>
	<title>Inmueblealaventa.com</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	</head>
	<body bgcolor="#FFFFFF">
	<div style="padding-bottom:20px; font-size:12px">Para asegurar que recibas nuestros correos por favor agrega info@inmueblealaventa.com a tu libreta de direcciones.</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="estilo1"><div align="justify"><strong>Hemos creado una cuenta para usted.</strong></div>
		  <br />
		  <br /></td>
	  </tr>
	  <tr>
		<td bgcolor="#336498">&nbsp;</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td class="estilo1"><strong>Hola '.$nombres.' '.$apellidos.',</strong></td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1">&nbsp;</td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1">Gracias por registrarte en nuestra web. Tu cuenta ha sido creada. </td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1">Podr&aacute; iniciar sesi&oacute;n en <a href="http://www.inmueblealaventa.com">http://www.inmueblealaventa.com</a> usando las siguientes credenciales:</td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1">&nbsp;</td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1"><strong>Usuario:</strong> '.$usuario.'</td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1"><strong>Contrase&ntilde;a:</strong> '.$contrasena.'</td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1">&nbsp;</td>
	  </tr>
	  <tr>
		<td bgcolor="#3364980">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center" class="estilo1" height="40">Visitanos en <a href="http://www.inmueblealaventa.com">Inmueble a la Venta</a></td>
	  </tr>
	</table>
	</body>
	</html>
	';
	//////////////////////


	$separador = "_separador_de_trozos_".md5 (uniqid (rand())); 
	  
	$cabecera = "Date: ".date("l j F Y, G:i").$UN_SALTO; 
	$cabecera .= "MIME-Version: 1.0".$UN_SALTO; 
	$cabecera .= "From: Inmueble a la Venta <info@inmueblealaventa.com >".$UN_SALTO;
	$cabecera .="X-Mailer: PHP/". phpversion().$UN_SALTO;
	$cabecera .= "Content-Type: multipart/mixed;".$UN_SALTO; 
	$cabecera .= " boundary=$separador".$DOS_SALTOS; 
	
	// Parte primera -Mensaje en formato HTML 
		  # Separador inicial
	$texto ="--$separador".$UN_SALTO; 
		  # Encabezado parcial
	$texto .="Content-Type: text/html; charset=\"ISO-8859-1\"".$UN_SALTO; 
	$texto .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS; 
		  # Contenido de esta parte del mensaje
	$texto .= $mensaje;
	
	// envio del mensaje 
	$mensaje=$texto;
	
	// envio del mensaje 

	ini_set("SMTP", "mail.inmueblealaventa.com");
	mail("$destinatario", "$titulo", "$mensaje", "$cabecera");
	
	//ENVIAMOS E-MAIL CONFIRMANDO A LA EMPRESA DE LA CREACION DEL CLIENTE
	$destinatario = 'info@inmueblealaventa.com';
	//$destinatario = 'sauloandres@gmail.com';
	
	$UN_SALTO="\r\n";
	$DOS_SALTOS="\r\n\r\n";
	
	$titulo="Nuevo registro del Cliente ".$nombres.' '.$apellidos;
	$mensaje =' 
	<html>
	<head>
	<title>Inmueblealaventa.com</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	</head>
	<body bgcolor="#FFFFFF">
	<div style="padding-bottom:20px; font-size:12px">Para asegurar que recibas nuestros correos por favor agrega info@inmueblealaventa.com a tu libreta de direcciones.</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="estilo1"></p></td>
	  </tr>
	  <tr>
		<td bgcolor="##336498">&nbsp;</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td class="estilo1"><strong>'.$nombres.' '.$apellidos.' se ha registrado como nuevo cliente en el sitio web.</strong></td>
	  </tr>
	  <tr>
		<td style="border-top:#333" class="estilo1">&nbsp;</td>
	  </tr>
	  <tr>
		<td bgcolor="##336498">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center" class="estilo1" height="40">Visitanos en <a href="http://www.inmueblealaventa.com">Inmueble a la Venta</a></td>
	  </tr>
	</table>
	</body>
	</html>
	';
	//////////////////////


	$separador = "_separador_de_trozos_".md5 (uniqid (rand())); 
	  
	$cabecera = "Date: ".date("l j F Y, G:i").$UN_SALTO; 
	$cabecera .= "MIME-Version: 1.0".$UN_SALTO; 
	$cabecera .= "From: Registro de nuevo usuario   <info@inmueblealaventa.com >".$UN_SALTO;
	$cabecera .="X-Mailer: PHP/". phpversion().$UN_SALTO;
	$cabecera .= "Content-Type: multipart/mixed;".$UN_SALTO; 
	$cabecera .= " boundary=$separador".$DOS_SALTOS; 
	
	// Parte primera -Mensaje en formato HTML 
		  # Separador inicial
	$texto ="--$separador".$UN_SALTO; 
		  # Encabezado parcial
	$texto .="Content-Type: text/html; charset=\"ISO-8859-1\"".$UN_SALTO; 
	$texto .="Content-Transfer-Encoding: 7bit".$DOS_SALTOS; 
		  # Contenido de esta parte del mensaje
	$texto .= $mensaje;
	
	// envio del mensaje 
	$mensaje=$texto;
	
	// envio del mensaje 

	ini_set("SMTP", "mail.inmueblealaventa.com");
	mail("$destinatario", "$titulo", "$mensaje", "$cabecera");
	
?>
<script>
	alert("Usuario registrado con exito!!!!!!");
	document.location.href = "autenticacion.php?usu=<?php echo $usuario?>&pass=<?php echo $password?>";
</script>
<?
}
else
{
?>
	<script language="javascript" type="text/javascript">
	alert("El Usuario no pudo ser registrado.  Intentelo mas tarde y si el problema persiste contacte a su webmaster");
	document.location.href = "registroNuevo.php";
	</script>
<?
}	
?>