<?php
include('bd.php');
include('includes/parametros.php');

$codigo = $_POST['hdd_codigo'];
$nombre = $_POST["nombre"];
$email = $_POST["mail"];
$aquien = $_POST["destinatario"];
if($_POST["mensaje"] != '')
{
	$mensaje = $_POST["mensaje"];
}
else
{
	$mensaje = "Te recomiendo el siguiente inmueble, visitalo en Inmueble a la Venta.com";
}

$consulta = "SELECT tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
WHERE inmueble.codigo = ".$codigo;
$resultado = mysql_query($consulta, $conexion);
$registro = mysql_fetch_array($resultado);

//Consultamos la primera imagen del inmueble
$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$codigo."' LIMIT 0,1";
$resultadoFoto = mysql_query($consulta, $conexion);
$registroFoto = mysql_fetch_array($resultadoFoto);


//ENVIAMOS E-MAIL CONFIRMADO LA CREACION DE LA CUENTA
			
// El correo a quien va dirigido
$destinatario = $aquien; 
$asunto = $nombre." te a sugerido un inmueble en Inmueble a la Venta‏"; 
$cuerpo = ' 
<html>
<head>
<title>Inmueblealaventa.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/botones.css" rel="stylesheet" type="text/css" />
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
                    <td class="estilo1"><div align="justify"><strong>'.$nombre.' te a sugerido un inmueble.‏ </strong></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" class="estilo1">
                      <tr>
                        <td width="173" rowspan="6" bgcolor="#F7F7F7"><img src="www.inmueblealaventa.com/redimencionar.php?src=fotoinmueble/'.$registroFoto['foto'].'&amp;w=150&h=120" border="0" title="Ver informacion" /></td>
                        <td width="235" bgcolor="#F7F7F7">'.tipo_negocio_imprimir($registro['tipo_neg']).' '.$registro['dest_tip'].'</td>
                      </tr>
                      <tr>
                        <td colspan="2">'.$registro['nombreMunicipio'].'</td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#F7F7F7">'.$registro['campo_1'].'</td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#F7F7F7">Area '.$registro['campo_6'].' m&sup2;, No. Ba&ntilde;os '.$registro['campo_9'].'</td>
                      </tr>
                      <tr>
                        <td colspan="2">'.$mensaje.'</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="center"><a href="www.inmueblealaventa.com/inmueble.php?cod='.$registro['codigo'].'" class="boton medium  naranja">Ver inmueble</a></td>
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
</html>'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 

//dirección del remitente 
$headers .= "From: Inmueble a la venta <info@inmublealaventa.com>\r\n"; 

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