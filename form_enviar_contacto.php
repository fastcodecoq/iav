<?php
$nombre = $_POST["nombre"];
$email = $_POST["mail"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];
$asunto = $_POST["asunto"];
$mensaje = $_POST["mensaje"];

//ENVIAMOS E-MAIL CONFIRMADO LA CREACION DE LA CUENTA
			
// El correo a quien va dirigido
//$destinatario = 'sauloandres@gmail.com'; 
$destinatario = 'info@inmueblealaventa.com'; 
$asunto = "Datos del contacto ".$nombre; 
$cuerpo = ' 
<html>
<head>
<title>Inmueblealaventa.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body bgcolor="#FFFFFF">
<div style="padding-bottom:20px; font-size:12px">Para asegurar que recibas nuestros correos por favor agrega info@inmueblealaventa.com a tu libreta de direcciones.</div>
<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td style="padding:0px 20px 20px 20px">
	  <table width="100%" border="0">
		<tr>
		  <td bgcolor="#FFFFFF"><table width="100%" border="0">
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="estilo1"><div align="justify"><strong>'.$nombre.' desea contactarse con nosotros </strong></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" class="estilo1">
                      <tr>
                        <td width="173" bgcolor="#F7F7F7"><strong>Nombre:</strong></td>
                        <td width="235" bgcolor="#F7F7F7">'.$nombre.'</td>
                      </tr>
                      <tr>
                        <td><strong>E-mail:</strong></td>
                        <td colspan="2">'.$email.'</td>
                      </tr>
                      <tr>
                        <td bgcolor="#F7F7F7"><strong>Ciudad:</strong></td>
                        <td colspan="2" bgcolor="#F7F7F7">'.$ciudad.'</td>
                      </tr>
                      <tr>
                        <td><strong>Telefono:</strong></td>
                        <td colspan="2">'.$telefono.'</td>
                      </tr>
                      <tr>
                        <td bgcolor="#F7F7F7"><strong>Asunto:</strong></td>
                        <td colspan="2" bgcolor="#F7F7F7">'.$asunto.'</td>
                      </tr>
                      <tr>
                        <td><strong>Mensaje:</strong></td>
                        <td colspan="2">'.$mensaje.'</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table> 
              </td>
			</tr>
		  </table></td>
		</tr>
	</table></td>
  </tr>
  <tr>
	<td align="center" style="padding:10px 0 10px 0">Visitanos en <a href="http://www.inmueblealaventa.com">Inmuble a la Venta.com</a></td>
  </tr>
</table>
</body>
</html>
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Inmueble a la venta <info@inmueblealaventa.com>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: sauloandres@gmail.com\r\n"; 

//ruta del mensaje desde origen a destino 
//$headers .= "Return-path: desarrollo@sacompsystem.com\r\n"; 

//direcciones que recibián copia 

//$headers .= "Cc: ".$_SESSION["email_usuario"]."\r\n"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
			
			
  
if($nombre != "" && $mensaje != "")
{

	mail($destinatario,$asunto,$cuerpo,$headers) ;
		
	?>
	<script>
	alert("El correo fue enviado correctamente");
	parent.$.fancybox.close({'transitionOut'	: 'elastic'});
	</script>
	<?
}
else
{
	?>
	<script>
	alert("El correo no pudo ser enviado");
	parent.$.fancybox.close({'transitionOut'	: 'elastic'});
	</script>
	<?
}
?>