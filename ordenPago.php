<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">

<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<style>
.camposOrden{
	float:left;
	width:120px;
	margin-top:10px;
	font-weight:bold;
}
.camposOrdenForm{
	float:left;
	padding:5px 0;
	width:150px;
	margin-top:5px;
}
</style>

</head>

<body>

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
  <div style="clear:left; padding-top:10px;" class="contenedor">
    	<!-- Registro -->    
        <div class="recuadroAzul">
        	<h1 style="color:#006564; text-transform:uppercase; font-size:2.1em" align="center"><?php echo planes($_GET['plan'])?></h1>
            <div style="font-size:14px; font-weight:bold; text-transform:uppercase; padding-bottom:20px;" align="center">Informaci&oacute;n para pago</div>
            
            <div style="width:350px; float:left; margin-left:160px;">
            	<div style="color:#346599; font-weight:bold; padding:10px 0;">Esta es su orden de publicación</div>
              	<div class="camposOrden">Orden No.</div>
              	<div class="camposOrdenForm" style=" background:#F4F4F4; border:#989898 1px solid; -moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:5px;"><input name="orden" type="hidden" id="orden" value="<?php echo $_GET['cod']?>" /><?php echo $_GET['cod']?></div>
                <?php
				if($_GET['plan'] != 4)
				{
					$consulta = "SELECT * FROM planes WHERE id = ".$_GET['plan'];	
					$resultado = mysql_query($consulta, $conexion);
					$registro= mysql_fetch_array($resultado);
					$vlrtotal = $registro['valPlan'];
					$Iva = ($registro['valPlan']*16)/100;
					$subtotal = ($registro['valPlan']-$Iva);
					$descripcion = $registro['desPlan'];
				}
				else
				{
					$consulta = "SELECT * FROM planpersonalizado WHERE codinmueble = ".$_GET['cod'];	
					$resultado = mysql_query($consulta, $conexion);
					$registro= mysql_fetch_array($resultado);
					$vlrtotal = $registro['valorPlan'];
					$Iva = ($registro['valorPlan']*16)/100;
					$subtotal = ($registro['valorPlan']-$Iva);
					$descripcion = "Usted a comprado un plan de publicación Personalizado, ".($registro['nMeses'] * 30)." d&iacute;as en internet, ".$registro['nFotos']." fotos.";
				}
				?>
              	<div class="camposOrden">Descripci&oacute;n</div>
              	<div class="camposOrdenForm" style=" background:#F4F4F4; border:#989898 1px solid; -moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:5px;"><input name="descripcion" type="hidden" id="descripcion" value="<?php echo $descripcion ?>" /><?php echo $descripcion?></div>
              	<div class="camposOrden">Valor Bruto</div>
              	<div class="camposOrdenForm" style=" background:#F4F4F4; border:#989898 1px solid; -moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:5px;"><input name="subtotal" type="hidden" id="subtotal" value="<?php echo $subtotal ?>" /><?php echo '$'.number_format($subtotal,0,',','.') ?></div>
              	<div class="camposOrden">Inmpuestos (I.V.A)</div>
              	<div class="camposOrdenForm" style=" background:#F4F4F4; border:#989898 1px solid; -moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:5px;"><input name="iva" type="hidden" id="iva" value="<?php echo $Iva ?>" /><?php echo '$'.number_format($Iva,0,',','.') ?></div>
              	<div class="camposOrden">Total</div>
              	<div class="camposOrdenForm" style=" background:#F4F4F4; border:#989898 1px solid; -moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px; padding:5px;"><input name="valorTotal" type="hidden" id="valorTotal" value="<?php echo $vlrtotal ?>" /><?php echo '$'.number_format($vlrtotal,0,',','.') ?></div>
            </div>
            
          <div style="width:350px; float:left;">
            <div style="color:#346599; font-weight:bold; padding:10px 0px 10px 0;">Instrucciones</div>
                <div style="clear:left; padding-top:5px" align="justify">
                <p>Para que su aviso sea publicado haga clic en pagar y elija una de las siguientes formas de pago.</p>
                <ol>
                	<li>1. Pago con tarjeta de crédito</li>
                    <li>2. Con su cuenta corriente o de ahorros (PSE)</li>
                    <li>3. Con pago en efectivo (puntos baloto)</li>
                    <li>4. Con pago referenciado (consignación bancaria)</li>  
                </ol>
<p>Si tiene alguna duda al respecto por favor comuníquese al 2267212 o al 311 8689032 o envíenos un correo a info@inmueblealaventa.com.</p>
				
</div>
            </div>
            
            <div style="clear:left"></div>
            <div align="center" style="padding-top:20px;">
            <?php
			$llave_encripcion = "13ecd041d9c"; //Llave produccion
			//$llave_encripcion = "852b589c1ad"; //Llave pruebas
			$usuarioId=101741;
			$refVenta= $_GET['cod'];
			$valor= $vlrtotal;
			$baseDevolucionIva= $subtotal;
			$iva= $Iva;
			$moneda=COP;
			$url_respuesta = "http://www.inmueblealaventa.com/respuesta.php";
			$url_confirmacion = "http://www.inmueblealaventa.com/confirmacion.php";
			$descripcion = "Pago plan ".planes($_GET['plan'])." - Inmueble a la Venta";
			$emailComprador = $_SESSION["email_usuario"];
			$firma= "$llave_encripcion~$usuarioId~$refVenta~$valor~$moneda";
			$firma_codificada = md5($firma);
			?>

            <form method="post" action="https://gateway.pagosonline.net/apps/gateway/index.html">
            <input name="usuarioId" type="hidden" value="<?php echo($usuarioId) ?>">
            <input name="descripcion" type="hidden" value="<?php echo $descripcion ?>" >
            <input name="refVenta" type="hidden" value="<?php echo $refVenta ?>">
            <input name="valor" type="hidden" value="<?php echo $valor ?>">
			<input name="iva" type="hidden" value="<?php echo $iva ?>">
            <input name="baseDevolucionIva" type="hidden" value="<?php echo $baseDevolucionIva ?>" >
            <input name="moneda" type="hidden" value="<?php echo $moneda ?>">
            <input name="firma" type="hidden" value="<?php echo $firma_codificada ?>">
            <input name="emailComprador" type="hidden" value="<?php echo $emailComprador?>">
            <input name="prueba" type="hidden" value="0">
            <input name="url_confirmacion" type="hidden" value="<?php echo $url_confirmacion?>">
            <input name="url_respuesta" type="hidden" value="<?php echo $url_respuesta?>">
            
            <input name="Submit" type="submit" value="Pagar" class="boton naranja">
            
            </form>

            </div>
            
        </div>
        <!-- Registro -->
  </div>
</section>

<section>
	
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>