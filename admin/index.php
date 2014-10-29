<?php
include_once("../bd.php");
if (isset($_GET["error"]))
{
	$_GET["error"]=$_GET["error"];
}
else
{
	$_GET["error"]="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" language="JavaScript1.2" src="../js/ajax.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../js/funciones.js"></script>
</head>

<body style="margin:auto" onload="document.frm_login.txt_usuario.focus();">
<div style="width:100%; margin-bottom: 0 auto -12px">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="imagenes/header.png" height="40px">&nbsp;</td>
  </tr>
  <tr>
    <td id="content" align="center"><br />
	<form action="autenticacion.php" method="post" name="frm_login">
			<table width="400" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2" class="success">&nbsp;<strong>&nbsp;Ingrese su usuario y contrase&ntilde;a</strong></td>
              </tr>
              <tr>
                <td colspan="2" class="rojo_resaltado" style="border-left:1px solid #A5BD71; border-right:1px solid #A5BD71;">&nbsp;</td>
              </tr>			  
              <tr>
                <td width="42%" rowspan="4" align="center" style="border-left:1px solid #A5BD71"><img src="imagenes/candado.png" width="120" height="120" /></td>
                <td align="left" width="58%" class="menu_titulo" style="border-right:1px solid #A5BD71;">Usuario:<br />
                <input name="txt_usuario" type="text" id="txt_usuario" style="margin-bottom:inherit" maxlength="30"  />
                <br /></td>
              </tr>
              <tr>
                <td align="left" class="menu_titulo" style="border-right:1px solid #A5BD71;">Contrase&ntilde;a:
                  <br />
                <input name="txt_clave_ne" type="password" id="txt_clave_ne" onkeypress="pulsar(event,Submit)" maxlength="20" />
                <br /></td>
              </tr>
              <tr>
                <td align="left" style="border-right:1px solid #A5BD71;"><?php 
					if ($_GET["error"] == 1)
					{
					   ?>
                  <span class="error">Error: usuario ó password incorrectos</span>
                  <?php
					} 
					else if ($_GET["error"] == 2)
					{
							?>
                  <span class="error">Error: usuario sin permisos para ver p&aacute;gina</span>
                  <?php
					}
					?>
                  <br /></td>
              </tr>
              <tr>
                <td style="border-right:1px solid #A5BD71;">&nbsp;</td>
              </tr>			  
              <tr>
                <td colspan="2" align="center" style="border-left:1px solid #A5BD71; border-right:1px solid #A5BD71;">
                  <input name="Submit" type="button" class="boton" onclick="ingresar();" value="Ingresar" />                </td>
              </tr>
              <tr>
                <td colspan="2" style="border-left:1px solid #A5BD71; border-right:1px solid #A5BD71; border-bottom:1px solid #A5BD71;">&nbsp;<input name="txt_clave" type="hidden" value=""></td>
              </tr>
        </table>
		<br />
      </form>			</td>
  </tr>
</table></div>
<div id="footer"><?php include ('pie.php')?></div>
</body>
</html>
