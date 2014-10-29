<?php
include('controlSesion.php');
require('bd.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pagina No Encontrada - Error 404</title>
<link href="/css/general.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/css/nuevos-estilos.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

</head>

<body>

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>


<section>
  <div style="clear:left; padding-top:0px;" class="contenedor">
    	<!-- Div 1 -->
        <div style="float:left; margin-right:20px; width:256px; padding:30px;">
        <img src="/imagenes/alerta.png" width="256" height="256" /> </div>
        <div style="float:left; font-size:45px; width:600px; margin-top:50px;" align="center">ERROR <span style="color:#900; font-size:56px;">404</span></div>
        <div style="float:left; font-size:36px; margin-top:40px; width:600px;" align="center">Pagina no encontra</div>
  </div>
</section>


<div style="clear:left; margin-bottom:230px;">&nbsp;</div>


</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>