<?php
session_start();
require_once("../bd.php");
$permisos = array(1,2,3,21);
require_once("../bd.php");
include_once("control_admin.php");
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
            <h1>&nbsp;<strong>EMail</strong></h1>
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
						<div style="position:relative;width:600px;height:60px;background-image:url(http://domains.live.com/OpenSignupImages/OpenMembership600x60.jpg);overflow:hidden;">
  <div style="height:100%;width:100%;overflow:hidden">
    <table align="left" border="0px" cellpadding="5px" cellspacing="0px" style="table-layout:fixed;word-wrap:break-word;">
      <tr>
        <td width="260px" height="60px" align="center" valign="middle" style="color:#ffffff;font:16px Arial">Obtén una cuenta de @inmueblealaventa.com gratuita</td>
      </tr>
    </table>
  </div>
  <div style="position:absolute;border:1px solid #ffffff;width:90px;left:270px;bottom:18px;">
    <div style="border:1px solid #1F59A5;">
      <div style="border:1px solid #ffffff;background-image:url(http://domains.live.com/OpenSignupImages/OpenButtonBackground.gif);padding:1px 0px 1px 0px;margin:0px;text-align:center;">
        <a href="https://domains.live.com/members/signup.aspx?domain=inmueblealaventa.com"  style="font:bold 12px Arial,Helvetica,sans-serif;color:#092076;text-decoration:none;">Registrarse</a>
      </div>
    </div>
  </div>
  <div style="position:absolute;border:1px solid #ffffff;width:90px;right:135px;bottom:18px;">
    <div style="border:1px solid #1F59A5;">
      <div style="border:1px solid #ffffff;background-image:url(http://domains.live.com/OpenSignupImages/OpenButtonBackground.gif);padding:1px 0px 1px 0px;margin:0px;text-align:center;">
        <a href="http://mail.live.com"  style="font:bold 12px Arial,Helvetica,sans-serif;color:#092076;text-decoration:none;">Ver correo</a>
      </div>
    </div>
  </div>
</div>
                  </td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="9" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="9" align="right">&nbsp;</td>
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