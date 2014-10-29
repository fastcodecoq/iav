<?php
include('controlSesion.php');
require('bd.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingresar</title>
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
		  <h1 style="text-align:center; display:block">Ingresar</h1>
      </div>
  </div>
</section>

<section>
<div class="contenedor">
    <div class="recuadroAzul" style="display: table;
margin: 0 auto;
padding: 30px 50px;">
    <form id="frm_recordar" action="/autenticacion.php" method="post" name="frm_recordar">
      <table>
         <tr>
            <td> Usuario <br> <input name="username" type="text"> <br></td>            
         <tr>
         <tr>
            <td> Clave <br> <input name="password" type="password"> </td>            
         <tr>
         <tr>
            <td> <input  type="submit" value="Iniciar Sesión"> </td>            
         <tr>
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