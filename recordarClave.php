<?php
include('controlSesion.php');
require('bd.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recordar clave</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="admin/estilos/tabs.css" rel="stylesheet" type="text/css" />
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script language="javascript">
$(document).ready(function() {

	// Formulario a validar
	jQuery("#frm_recordar").validationEngine();


});
</script>  

</head>

<body>

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
	<div class="contenedor">
    </div>    
</section>

<section>
  <div class="contenedor">
		<div>
		  <h1>Olvid&eacute; mi clave</h1></div>
  </div>
</section>

<section>
<div class="contenedor">
    <div class="recuadroAzul">
    <form id="frm_recordar" action="restablacer.php" method="post" name="frm_recordar">
  	<table width="90%" border="0" cellspacing="0" cellpadding="0" style="padding-left:10px">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="left" style="color:#346599; font-weight:bold; padding:5px 0"><strong>Datos b&aacute;sicos</strong></td>
        </tr>
        <tr>
          <td bgcolor="#F7F7F7" style="border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid; border-top:#CCCCCC 1px solid;">
          <table width="100%" border="0" cellspacing="2" cellpadding="0" style="padding:5px">
            <tr>
              <td width="26%" align="left" style="padding:5px"><strong>Correo electr&oacute;nico</strong></td>
              <td width="74%" align="left" style="padding:5px"><input name="mail" type="text" id="mail" size="30" class="validate[required,custom[email]] text-input" /><br />
              	<?php
				if ($_GET["error"] == "err")
				{
				?>
					<span style="color:#F00">El correo ingresado no existe en nuestra base de datos.</span>
				<?
				}
				?>
              </td>
            </tr>
            <tr>
              <td align="left" style="padding:5px"><strong>Ingrese el codigo de la imagen</strong></td>
              <td align="left" style="padding:5px"><label>
                <input type="text" name="captcha" id="captcha" maxlength="6" size="6"/>
              </label></td>
            </tr>
            <tr>
              <td align="left" style="padding:5px">&nbsp;</td>
              <td align="left" style="padding:5px"><img src="captcha.php"/><br />
                <?php
				if ($_GET["error"] == "capcha")
				{
				?>
					<span style="color:#F00">El c&oacute;digo ingresado es incorrecto</span>
				<?
				}
				?>

              </td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="left">
          	<input type="submit" value="Enviar" class="boton medium naranja"/>

          	<input name="hdd_accion" type="hidden" id="hdd_accion" value="editar" />
            
    
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form>
    </div>
</div>
<div style="clear:left;">&nbsp;</div>
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>