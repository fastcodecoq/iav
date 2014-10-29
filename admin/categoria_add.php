<?php
$permisos = array(16);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/upload.php");
include_once("includes/parametros.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<?php
if(isset($_POST["nombre"]) && $_POST["nombre"] != "")
{
	$nombre = $_POST["nombre"] ;

	$insercion = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
		
	if (mysql_db_query($bd_nombre, $insercion))
	{
	?>
	<script>
		alert("Categoria ingresada con exito!!!!!!");
		document.location.href = "categorias.php";
	</script>
	<?
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("La Categoria no pudo ser insertada.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
		document.location.href = "categorias.php";
		</script>
	<?
	}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin:auto">
<form id="frm_categoria" name="frm_categoria" method="post" action="" enctype="multipart/form-data">>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php")?></td>
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>AGREGAR CATEGORIA</strong></h1>
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
            
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">
				<table width="100%" class="form" align="left">
                  <tr>
                    <td width="65" align="left"><span class="required">*</span> <strong>Nombre categor&iacute;a</strong></td>
                    <td align="left"><input name="nombre" type="text" id="nombre" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                      <span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="button" name="Submit" value="Guardar" onclick="agregar_categoria();" />&nbsp;&nbsp;<input type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_categoria.action = 'categorias.php'; document.frm_categoria.submit() };" value="Cancelar"/>
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
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
</form>
</body>
</html>
