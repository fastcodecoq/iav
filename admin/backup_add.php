<?php
$permisos = array(20);
require_once("../bd.php");
include_once("control_admin.php");

//Defino la zona horaria exacta del pais. 
date_default_timezone_set('America/Bogota'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<?php
if(isset($_POST["txt_nombre"]) && $_POST["txt_nombre"] != "")
{
	$nombre = $_POST["txt_nombre"] ;
	
	$insercion = "INSERT INTO permiso (idpermiso, nompermiso) VALUES (NULL, '$nombre')";
		
	if (mysql_db_query($bd_nombre, $insercion))
	{
		//ACTUALIZO LA BITACORA
		$des_bitacora = 'Creo permiso '.$nombre;
		$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
		mysql_db_query($bd_nombre, $insertar);
	?>
	<script>
		alert("Permiso ingresado con exito!!!!!!");
		document.location.href = "permisos.php";
	</script>
	<?
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("El Permiso no pudo ser insertado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
		document.location.href = "permisos.php";
		</script>
	<?
	}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin:auto">
<form id="frm_backup" name="frm_backup" method="post" action="hacerbak.php">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php")?></td>
  </tr>
  <tr>
    <td id="content" align="center"><br />
      <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="box">
		  	<div class="left"></div>
  			<div class="right"></div>
  			<div class="heading">
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>NUEVA COPIA DE SEGURIDAD</strong></h1>
				<div align="right"></div>
		  	</div>
		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>

            <?php
			$hoy=date("d/m/Y");
			$hora=date("H:i:s");
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">
				<table width="100%" class="form">
                  <tr>
                    <td align="left"> Fecha</td>
                    <td align="left"><input name="fecha" type="text" id="fecha" value="<?php echo $hoy?>" /></td>
                  </tr>
                  <tr>
                    <td align="left">Hora</td>
                    <td align="left"><input name="hora" type="text" id="hora" value="<?php echo $hora?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><br />
                      <br />
                      <input type="submit" name="Submit" value="Crear"/>&nbsp;&nbsp;<input type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_backup.action = 'contenido.php'; document.frm_backup.submit() };" value="Cancelar"/>
                      <br />
                      </td>
                  </tr>
                  
                </table></td>
                </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer">Yamile Style © 2011 Todos los Derechos Reservados</td>
  </tr>
</table>
</form>
</body>
</html>
