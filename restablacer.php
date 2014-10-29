<?php
//Llamamos la base de datos
include('controlSesion.php');
include_once('bd.php');

$cap = 'notEq';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
// Verificamos si el captcha es correcto
	if ($_POST['captcha'] == $_SESSION['cap_code']) {
		
		$consulta = "SELECT * FROM usuarios WHERE email ='".$_POST["mail"]."'";
		$resultado = mysql_query($consulta, $conexion);
		$num_registros = mysql_num_rows($resultado);
		$registro = mysql_fetch_array($resultado);
		
		if ($num_registros > 0) 
		{
			// Generamos una clave aleatoria
		 
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$cad = "";
			for($i=0;$i<8;$i++) {
				$cad .= substr($str,rand(0,62),1);
			}
			$contrasena_nueva = md5(sha1($cad)) ;
			/////////////////////////////////////////
			
			$actualizar = "UPDATE usuarios SET pass = '$contrasena_nueva' WHERE identificacion = ".$registro["identificacion"];
			mysql_db_query($bd_nombre, $actualizar);
							
			$email = $_POST["mail"];
			$destinatario = $email;
			
			$UN_SALTO="\r\n";
			$DOS_SALTOS="\r\n\r\n";
			
			$titulo="Recordatorio de su cuenta";
			$mensaje =' 
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td class="estilo1" style="padding-top:10px"><div align="justify"><strong>Hemos emitido una nueva contraseña, favor cambiarla.</strong></div>
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
				<td class="estilo1"><strong>Hola '.$registro["nombres"].':</strong></td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1">&nbsp;</td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1">Hemos restablecido   su contraseña use la siguiente para ingresar nuevamente. </td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1">&nbsp;</td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1"><strong>Usuario:</strong> '.$registro["usuario"].'</td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1"><strong>Contrase&ntilde;a:</strong> '.$cad.'</td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1">&nbsp;</td>
			  </tr>
			  <tr>
				<td style="border-top:#333" class="estilo1">No olvide cambiarla luego de ingresar. Para realizar el cambio debe ingresar a la opci&oacute;n (Mi cuenta), esta se encuentra en la parte superior de la pantalla, alli encontrara el enlace donde puede realizar el cambio.</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td bgcolor="#336498">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="center" class="estilo1" height="40">Visitanos en <a href="http://www.inmueblealaventa.com">Inmueble a la venta</a></td>
			  </tr>
			</table>
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
			
			if($destinatario != "" )
			{
			
				ini_set("SMTP", "mail.inmueblealaventa.com");
				mail("$destinatario", "$titulo", "$mensaje", "$cabecera");
					
				?>
				<script>
				alert("Se ha enviado un correo a su cuenta. Favor reviselo para ingresar de nuevo");
				document.location.href = "index.php";
				</script>
				<?
			}
			else
			{
				?>
				<script>
				alert("No se ha podido enviar el recordatorio de la cuenta.");
				document.location.href = "recordarClave.php";
				</script>
				<?
			}
		}
		else 
		{ 
			//si no existe le mando otra vez a la portada 
			header("Location: recordarClave.php?error=err");
		}  
	
	} else {
		header("Location: recordarClave.php?error=capcha");
	}
}
?>