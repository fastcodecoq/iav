<?php
include('controlSesion.php');
require('bd.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="REFRESH" content="15; url=http://www.inmueblealaventa.com/index.php">
<title>Pagina No Encontrada - Error 404</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript" src="subir_imagenes_ajax/ajaxupload.js"></script>

<link href="css/general.css" rel="stylesheet" type="text/css" />

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
    	<div style="float:left; margin-top:40px; margin-bottom:30px; width:100%;" align="center">
        <table width="400px" border="0" cellspacing="1" cellpadding="2" style="border:#999 1px solid">
                	  <tr>
                	    <td height="20px" align="center" bgcolor="#0A8CCE"><strong style="color:#FFF">Su pago est&aacute; siendo confirmado para procesar su orden...</strong></td>
   	      </tr>
                	  <tr>
                	    <td>&nbsp;</td>
              	    </tr>
                	  <tr>
                	    <td align="left"><strong>Fecha: </strong><?php echo(date("Y-m-d",strtotime("now"))); ?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>N&ordm; de referencia:</strong> <?php echo $_GET['ref_venta'] ?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Codigo pol:</strong> <?php echo $_GET['ref_pol'] ?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Estado de la Transacci&oacute;n:</strong>
                	      <?php
				switch($_GET['estado_pol'])
				{
				
				case 1: echo "Sin abrir";
				
				break;
				
				case 2: echo "Abierta";
				
				break;
				
				case 3: echo "Pagada";
				
				break;
				
				case 4: echo "Pagada y Abonada";
				
				break;
				
				case 5: echo "Cancelada";
				
				break;
				
				case 6: echo "Rechazada";
				
				break;
				
				case 7: echo "En validacion";
				
				break;
				
				case 8: echo "Reversada";
				
				break;
				
				case 9: echo "Reversada Fraudulenta";
				
				break;
				
				case 10: echo "Enviada Ent. Financiera";
				
				break;
				
				case 11: echo "Capturando datos tarjeta de credito";
				
				break;
				
				case 12: echo "Esperando confirmacion sistema PSE";
				
				break;
				}
				?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Forma de Pago:</strong>
                	      <?php

				switch($_GET['tipo_medio_pago'])
				{
				
				case 1: echo " Tarjeta d&eacute;bito";
				
				break;
				
				case 2: echo " Tarjeta de cr&eacute;dito";
				
				break;
				
				case 3: echo " Tarjeta de cr&eacute;dito Verified by VISA";
				
				break;
				
				case 4: echo " Cuentas corrientes y de ahorros PSE";
				
				break;
				}
				?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Medio de pago:</strong>
                	      <?php
                
                switch($_GET['medio_pago'])
                
                {
                
                case 1: echo "Colpatria";
                
                break;
                
                case 2: echo "Bancolombia";
                
                break;
                
                case 3: echo "Conavi";
                
                break;
                
                case 4: echo "Popular";
                
                break;
                
                case 5: echo "Occidente";
                
                break;
                
                case 6: echo "AvVillas";
                
                break;
                
                case 8: echo "Santander";
                
                break;
                
                case 10: echo "VISA";
                
                break;
                
                case 11: echo "Master Card";
                
                break;
                
                case 12: echo "American Express";
                
                break;
                
                case 14: echo "Davivienda";
                
                break;
                
                case 22: echo "Diners";
                
                break;
                
                case 24: echo "Verified by VISA";
                
                break;
                
                case 25: echo "PSE";
                
                break;
                
                }
                
                ?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Banco:</strong>
                	      <?php
			  switch($_GET['medio_pago'])

				{
				
				case 1: echo "Colpatria";
				
				break;
				
				case 2: echo "Bancolombia";
				
				break;
				
				case 3: echo "Conavi";
				
				break;
				
				case 4: echo "Popular";
				
				break;
				
				case 5: echo "Occidente";
				
				break;
				
				case 6: echo "AvVillas";
				
				break;
				
				case 8: echo "Santander";
				
				break;
				
				case 10: echo "VISA";
				
				break;
				
				case 11: echo "Master Card";
				
				break;
				
				case 12: echo "American Express";
				
				break;
				
				case 14: echo "Davivienda";
				
				break;
				
				case 22: echo "Diners";
				
				break;
				
				case 24: echo "Verified by VISA";
				
				break;
				
				case 25: echo "PSE";
				
				break;
				
				}
				?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Mensaje:</strong> <?php echo $_GET['mensaje']; ?></td>
              	    </tr>
                	  <tr>
                	    <td><strong>Valor:</strong> <? echo $_GET['valor']; ?></td>
              	    </tr>
                	  <tr>
                	    <td>&nbsp;</td>
              	    </tr>
                	  <tr>
                	    <td height="20px" align="center" bgcolor="#0A8CCE"><strong style="color:#FFF">Gracias por confiar en nosotros!</strong><br />
                	      <strong style="color:#FFF">En unos momentos ser&aacute; redireccionado a la p&aacute;gina principal</strong></td>
   	      </tr>
       	  </table>
        </div>
</section>


<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>