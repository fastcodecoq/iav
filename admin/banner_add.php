<?php
session_start();
require_once("../bd.php");
include_once("../funciones/upload.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $GLOBAL_nombre_pagina?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/funciones.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="../validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="../validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="../validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>

<script language="javascript">
$(document).ready(function() {	

	// Formulario y tipo de datos para el validador
	jQuery("#frm_banner").validationEngine();
	//$("#registro").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
	   
});
</script>

<?php
if(isset($_POST["hdd_tipo"]) && $_POST["hdd_tipo"] == "guardar")
{
	$nombre = $_POST["nombre"] ;
	$posicion = $_POST["posicion"] ;
	$link = $_POST["link"] ;
	$estado = $_POST["estado"] ;					   
	$fecha = $_POST["fecha"] ;

	$archivo = subir_archivo($_FILES["archivo"]["name"], $_FILES["archivo"]["size"], 2000000, $_FILES["archivo"]["tmp_name"], "../banner/");
	
	if($archivo != '')
	{
		$insercion = "INSERT INTO banner (posicion, estado, link, fecha, archivo, nombre, fecha_modif, tipo_modif, persona_modif) VALUES ($posicion, $estado, '$link', '$fecha', '$archivo', '$nombre', CURDATE(), 'N', '".$_SESSION["cedula_usuario"]."')";
			
		if (mysql_db_query($bd_nombre, $insercion))
		{
		?>
		<script>
			alert("Banner subido con exito!!!!!!");
			document.location.href = "banner.php";
		</script>
		<?
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
			alert("El Banner no pudo ser subido.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
			document.location.href = "banner.php";
			</script>
		<?
		}	
	}
}
?>

</head>

<body style="margin:auto" onload="document.frm_banner.nombre.focus()">
<form id="frm_banner" name="frm_banner" method="post" action="" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php");?></td>
  </tr>
  <tr>
    <td bgcolor="#056C46"><?php include_once("menu.php");?></td>
  </tr>
  <tr>
    <td id="content" align="center"><br />
      <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="box">
		  	<div class="left"></div>
  			<div class="right"></div>
  			<div class="heading">
				<h1 style="background-image:url(imagenes/computer.png)">&nbsp;<strong>AGREGAR BANNER </strong></h1>
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

            <label></label>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="20%" align="left">Nombre</td>
                    <td width="80%" align="left"><label>
                      <input name="nombre" type="text" id="nombre" size="30" class="validate[required] text-input" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left">Posicion</td>
                    <td align="left">
                      <select name="posicion" id="posicion" class="validate[required] text-input">
                        <option value="">[ Escoja ]</option>
                        <option value="1">Pagina Principal (Tam. 319 x 233 pixeles)</option>
                        <option value="2">Pagina Interna - Lateral (Tam. 265 x 495 pixeles)</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td width="20%" align="left">Estado </td>
                    <td align="left">
                      <select name="estado" size="1" id="estado" class="validate[required] text-input">
                        <option value="">[ Escoja ]</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        </select>
                      </td>
                  </tr>
                  <tr>
                    <td width="20%" align="left">Link </td>
                    <td align="left">
                    <input name="link" type="text" id="link" />
                     </td>
                  </tr>
                  <tr>
                    <td width="20%" align="left">Fecha </td>
                    <td align="left">
                    <input name="fecha" type="text" id="fecha" size="15" value="<?php echo date(Y.'-'.m.'-'.d);?>" readonly />
                     </td>
                  </tr>
                    <tr>
                      <td align="left">Archivo </td>
                      <td align="left"><label>
                        <input type="file" name="archivo" id="archivo" class="validate[required] text-input" />
                      </label></td>
                    </tr>
                    <tr>
                     <td colspan="2" align="left"><br />
                        <br />
                        <input type="submit" name="Submit" value="Guardar" />
                      &nbsp;&nbsp;
                      <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_banner.action = 'banner.php'; document.frm_banner.submit() };" value="Cancelar"/>
                        <br />
                        <input name="hdd_tipo" type="hidden" id="hdd_tipo" value="guardar" />
                    </td>
                  </tr>
                </table></td>
                </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
</table>
<div id="footer"><?php include ('pie.php')?></div>
</form>
</body>
</html>
