<?php
session_start();
require_once("../bd.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="../js/administrador.js"></script>

</head>

<body style="margin:auto">
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
        <td class="box"><div class="left"></div>
          <div class="right"></div>
          <div class="heading">
            <h1>&nbsp;<strong>MENU</strong></h1>
            <div align="right"></div>
          </div></td>
      </tr>
      <tr>
        <td class="box" valign="top"><div class="content">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="9" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td align="center">

                  <a href="inmuebles.php"><img src="imagenes/bt_inmuebles.png" width="80" height="80" alt="Inmuebles" title="Inmuebles" border="0" /></a>
                  
                  </td>
                  <td>&nbsp;</td>
                  <td align="center"><a href="guiaTurismo.php"><img src="imagenes/bt_turismo.png" alt="Turismo" title="Turismo" width="80" height="80" border="0" /></a></td>
                  <td>&nbsp;</td>
                  <td align="center"><a href="noticias.php"><img src="imagenes/btn_noticias.jpg" alt="Productos" title="Noticias" width="80" height="80" border="0" /></a></td>
                  <td>&nbsp;</td>
                  <td align="center"><a href="noticiasDecoracion.php"><img src="imagenes/bt_decoracion.png" alt="Productos" title="Decoracion" width="80" height="80" border="0" /></a></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="center"><a href="hoteles.php"><img src="imagenes/bt_hoteles.png" width="80" height="80" alt="Hoteles" title="Hoteles" border="0" /></a></td>
              <td>&nbsp;</td>
              <td align="center"><a href="banner.php"><img src="imagenes/bt_banners.png" width="80" height="80" alt="Banners" title="Banners" border="0" /></a></td>
              <td>&nbsp;</td>
              <td align="center">
                <a href="usuarios.php"><img src="imagenes/bt_usuarios.png" width="80" height="80" border="0" title="Usuarios" /></a></td>
              <td >&nbsp;</td>
              <td align="center"><a href="suscripciones.php"><img src="imagenes/bt_suscripciones.png" width="90" height="80" border="0" /></a></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="center"><a href="salir.php"><img src="imagenes/bt_salir.png" width="80" height="80" border="0" /></a></td>
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td >&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="9" align="right">&nbsp;</td>
            </tr>
          </table>
          <label></label>
        </div></td>
      </tr>
    </table>      
    </td>
  </tr>
</table>
<div id="footer"><?php include ('pie.php')?></div>
</body>
</html>
