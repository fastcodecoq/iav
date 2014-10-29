<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Renovacion de plan</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

</head>

<body>
<?php include_once("analyticstracking.php") ?>

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

<form action="renovarInmuebleFotos.php" method="post" name="plan" id="plan">
	<input name="plan" type="hidden" value="" />
    <input name="cod" type="hidden" value="<?php echo $_GET['cod']?>" />
    <input name="temp" type="hidden" value="<?php echo $_GET['temp']?>" />
</form>

  <div style="clear:left;" class="contenedor">
  <?php
  if($_GET['tipoNeg'] == 1 || $_GET['tipoNeg'] == 2 || $_GET['tipoNeg'] == 3 )
  {
	?>
  	<div><h1>Renovar publicaci&oacute;n - Plan Actual: <?php echo  planes($_GET['plan'])?></h1></div>
  	<div style="float:left"><a href="#" onclick="document.plan.plan.value = 1; document.plan.submit();"><img src="imagenes/planBasic.png" width="333" height="346" border="0" /></a></div>
    <div style="float:left"><a href="#" onclick="document.plan.plan.value = 2; document.plan.submit();"><img src="imagenes/planSilver.png" width="333" height="346" border="0" /></a></div>
    <div style="float:left"><a href="#" onclick="document.plan.plan.value = 3; document.plan.submit();"><img src="imagenes/planGold.png" width="333" height="346" border="0" /></a></div>
    <div style="clear:left; padding-top:20px;">
   	  <div style="float:left; color:#346599; width:250px; padding-right:20px;">Elije el plan que m&aacute;s te convenga o arma tu propio plan de publicaci&oacute;n, si ya est&aacute;s registrado, ingresa tus datos en la parte superior de nuestro sitio.</div>
        <div style="float:left"><a href="planPersonalizado.php?tipo_neg=1"><img src="imagenes/btnArmaPlan.png" width="464" height="76" border="0" /></a></div>
        <div style="float:left; padding:10px 0 0 20px;color:#346599; width:200px;">Para negociaciones especiales
o paquetes diferentes a nuestros planes
llámenos <strong>PBX. 226 7212</strong></div>
    </div>
 	
    
<?php
}
?>

</div>
</div>

<div style="clear:left; height:20px; margin-bottom:25px;"></div>  

</body>
<footer>
<?php include('pie.php')?>
</footer>

</html>