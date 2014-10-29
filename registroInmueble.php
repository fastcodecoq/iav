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
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">

<script type="text/javascript" src="js/funciones.js"></script>
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

	// Formulario y tipo de datos para el validador
	jQuery("#registro").validationEngine();

	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
            });            
        });
   })
   
   
   /*$("#ciudad").change(function () {
           $("#ciudad option:selected").each(function () {
            elegido=$(this).val();
            $.post("comboBarrios.php", { elegido: elegido }, function(data){
            $("#barrio").html(data);
            });            
        });
   })*/
   
   $("#ciudad").change(function () {
           $("#ciudad option:selected").each(function () {
            elegido=$(this).val();
			
          	  $.post("comboZonas.php", { elegido: elegido }, function(data){ 
			  
			  	var rst=data.split(":");
		
			  $("#zona").html(rst[0]);
			  
			  $("#barrio").html(rst[1]);
			  
			  }
			  
			  
			  );            
        });
   })
   
   $("#zona").change(function () {
           $("#zona option:selected").each(function () {
            elegido=$(this).val();
            $.post("comboZonasB.php", { elegido: elegido }, function(data){
			if (data!="no")
				{
         	   $("#barrio").html(data);
				}
            });            
        });
   })
   
   $("#tipoInmueble").change(function(){          
		var value = $("#tipoInmueble option:selected").val();

		if(value == '')
		{
			$("#contenedorFormulario").hide(100);	
		}
		
		if(value == 1)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosApartamento.php');	
		}
		
		if(value == 2)
		{
			$("#contenedorFormulario").show("fast");	
			$("#contenedorFormulario").load('datosCasa.php');	
		}
		
		if(value == 3)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosLocal.php');	
		}
		
		if(value == 4)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosOficina.php');	
		}
		
		if(value == 5)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosBodega.php');	
		}
		
		if(value == 6)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosLote.php');	
		}
		
		if(value == 7)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosFinca.php');	
		}
		
		if(value == 8)
		{
			$("#contenedorFormulario").show(100);	
			$("#contenedorFormulario").load('datosConsultorio.php');	
		}
	});
	
	// This demo is for hidden elements in the form
	$('#negociacion').change(function(){
		
	var value = $(this).val();
	if (value != '' && value != 3 && value != 4) $('#section_' +value).show().siblings().hide();
	else if(value == 3) $('#section_1').show(), $('#section_2').show();
	else if(value == 4) $('#section_1').hide(), $('#section_2').hide(),$('#admon').hide(), $('#alquilerNoche').show();
	else $('#campo_ocultos').children().hide(), $('#alquilerNoche').hide();
	});

});
</script>

<style>

table{
	margin-top:20px;
}
td{
	padding:8px 0;
}
input{
	/*width:160px;*/
}
</style>
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
  <div style="clear:left; padding-top:10px;" class="contenedor">
    	<!-- Registro -->
        <form action="registroInmueblesFotos.php" method="post" id="registro" name="registro">
        <!-- Campos que traigo del plan personalizado-->
        <input name="hdd_tipoCliente" type="hidden" value="<?php echo $_POST['hdd_tipoCliente']?>" /> 
        
        <?php
		if($_POST['hdd_plan'] == 4)
		{
		?>
        <input name="nFotos" type="hidden" value="<?php echo $_POST['fotos']?>" />      
        <input name="nVideo" type="hidden" value="<?php echo $_POST['video']?>" />
        <input name="nDestacados" type="hidden" value="<?php echo $_POST['destacados']?>" />
        <input name="nMeses" type="hidden" value="<?php echo $_POST['meses']?>" />
        <input name="tomaFoto" type="hidden" value="<?php echo $_POST['tomaFoto']?>" />
        <input name="hdd_valor_plan" type="hidden" value="<?php echo $_POST['hdd_valor_plan']?>" />
        <input name="hdd_plan" type="hidden" value="<?php echo $_POST['hdd_plan']?>" />
        <?php
		}
		?>
        
        <div id="formulario" class="recuadroAzul">
        	<h1 style="color:#808080" align="center">REGISTRO DE INMUEBLE</h1>
            <div style="color:#346599" align="center">Por favor llenar todos los campos para publicar su inmueble en inmueblealaventa.com, los datos con asteristo(*) son obligatorios.</div>
            
            <div style="width:325px; float:left; padding-left:10px;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><strong>Plan*:</strong></td>
                <td>
                <?php
                if($_POST['hdd_tipo_neg'] == 1)
				{
					?>
                    <select name="plan" id="plan" class="validate[required] text-input" style="width:150px;">

                      <option value="<?php echo $_POST['hdd_plan']?>"><?php echo planes($_POST['hdd_plan'])?></option>
                    </select>
                    <?php
				}
				else if($_POST['hdd_tipo_neg'] == 2)
					{
					?>
                    <select name="plan" id="plan" class="validate[required] text-input" style="width:150px;">
                    <?php
                    for ($i=1; $i <= 2; $i++)
                    {
                    ?>
                      <option value="<?php if($i != 0) { echo $i;}?>" <?php if($_POST['hdd_plan'] == $i){ echo "selected";}?>><?php echo planes($i)?></option>
                    <?php
                    }
                    ?>
                    </select>
                    <?php	
					}
				?>
              </td>
              </tr>
              <tr>
                <td><strong>Tipo Inmueble*:</strong></td>
                <td>
                <?php
                if($_POST['hdd_tipo_neg'] == 1)
				{
					?>
                    <select name="tipoInmueble" id="tipoInmueble" style="width:150px;" onchange="document.registro.negociacion.value = ''" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
                        $resultado = mysql_query($consulta, $conexion);
                        
                        while ($registro= mysql_fetch_array($resultado))
                        {
                        ?>
                        <option value="<?php echo $registro["tip_inm"]?>"> <?php echo $registro["dest_tip"]?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    <?php
				}
				else if($_POST['hdd_tipo_neg'] == 2)
				{
					?>
                    <select name="tipoInmueble" id="tipoInmueble" style="width:150px;" onchange="document.registro.negociacion.value = ''" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM tipo_in WHERE tip_inm IN(1,2,7) ORDER BY dest_tip ASC";	
                        $resultado = mysql_query($consulta, $conexion);
                        
                        while ($registro= mysql_fetch_array($resultado))
                        {
                        ?>
                        <option value="<?php echo $registro["tip_inm"]?>"> <?php echo $registro["dest_tip"]?> </option>
                        <?php
                        }
                        ?>
                    </select>
					<?php
				}
				?>
                </td>
              </tr>
              <tr>
                <td><strong>Negociaci&oacute;n*:</strong></td>
                <td>
                <?php
                if($_POST['hdd_tipo_neg'] == 1)
				{
					?>
                    <select name="negociacion" id="negociacion" class="validate[required] text-input" style="width:150px;">
                    <?php
                    for ($i=0; $i <= 3; $i++)
                    {
                    ?>
                      <option value="<?php if($i != 0) { echo $i;}?>"><?php echo tipo_negocio($i)?></option>
                    <?php
                    }
                    ?>
                    </select>
                    <?php
				}
				else if($_POST['hdd_tipo_neg'] == 2)
				{
					?>
                    <select name="negociacion" id="negociacion" class="validate[required] text-input" style="width:150px;">
                      <option value=""> Escoja -</option>
                      <option value="4"><?php echo tipo_negocio(4)?></option>
                    </select>
                    <?php
				}
				?>
                </td>
              </tr>
              <tr>
                <td><strong>Departamento*:</strong></td>
                <td>
                <select name="departamento" id="departamento" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                    <option value="" selected="selected">- Escoja -</option>
                    <?php
                    $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                    $resultado_dep = mysql_query($consulta, $conexion);
                    
                    while ($registro_dep= mysql_fetch_array($resultado_dep))
                    {
                    ?>
                    <option value="<?php echo $registro_dep["iddepartamento"]?>"> <?php echo $registro_dep["nombre"]?> </option>
                    <?php
                    }
                    ?>
                </select>
                </td>
              </tr>
              <tr>
                <td><strong>Ciudad*:</strong></td>
                <td>
                <select name="ciudad" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
            		<option value="">- Escoja -</option>
        		</select></td>
              </tr>
              <tr>
                <td><strong>Zona</strong></td>
                <option value="">- Otra -</option>
                <td><select name="zona" style="width:140px;" id="zona" >
                </select></td>
              </tr>
              <tr>
                <td><strong>Barrio</strong></td>
                <td><select name="barrio" id="barrio" >
                  <option value="">- Otro -</option>
                </select></td>
              </tr>
              <tr>
                <td><strong>Direcci&oacute;n (nueva):</strong></td>
                <td><label for="direccion"></label>
                <input type="text" name="direccion" id="direccion" class="text-input" /></td>
              </tr>
             <tr>
                <td colspan="2" style="color:#346599">Nota: Para su tranquilidad la direcci&oacute;n que usted introduzca aqu&iacute; no ser&aacute; publicada. Esto solo se utilizara para tener conocimiento exacto del sector en el que se encuentra su inmueble.</td>
              </tr>
             <tr>
               <td colspan="2" style="color:#346599"><strong>Datos de contacto</strong></td>
             </tr>
             <tr>
               <td><strong>Nombre</strong></td>
               <td><input type="text" name="nomContacto" id="nomContacto" /></td>
             </tr>
             <tr>
               <td><strong>Tel&eacute;fono fijo</strong></td>
               <td><input type="text" name="telContacto" id="telContacto" /></td>
             </tr>
             <tr>
               <td><strong>Tel&eacute;fono celular</strong></td>
               <td><input type="text" name="celContacto" id="celContacto" /></td>
             </tr>
             <tr>
               <td><strong>Email</strong></td>
               <td><input type="text" name="mailContacto" id="mailContacto"  class="validate[required,custom[email]] text-input" /></td>
             </tr>
              </table>       
            </div>
            <div id="contenedorFormulario" style="width:640px; float:left;"></div>
            <div style="clear:left"></div>
            
        </div>
        <input name="cod_temp" type="hidden" value="<?php echo $numero_azar = rand();?>" />
        </form>
        <!-- Registro -->
  </div>
</section>

<section>
	<?php //include('bannerInferior.php')?>
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>