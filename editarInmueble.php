<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
$codigo = $_POST['hdd_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>

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
			
            $.post("comboZonas.php", { elegido: elegido }, function(data){
            	if (data!="")
				{
				$("#zona").empty();
				$("#zona").html(data);
				}
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
   
	// This demo is for hidden elements in the form
	$('#negociacion').change(function(){
	var value = $(this).val();
	if (value != '' && value != 3) $('#section_' +value).show().siblings().hide();
	else if(value == 3) $('#section_1').show(), $('#section_2').show();
	else $('#campo_ocultos').children().hide();
	});

});
</script>
<script>
      jQuery.fn.cargar = function(url) {
            $(document).ready(function(){
                  $("#contenedorFormulario").load(url);
            });
      };
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

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
  <div style="clear:left; padding-top:10px;" class="contenedor">
    	<!-- Registro -->
        <form action="actualizarInmueblenuevo.php" method="post" id="registro" name="registro">

        <?php	
        $consulta = "SELECT tipo_in.dest_tip,tipoUsuario ,inmueble.* 
		FROM inmueble , usuarios, tipo_in
		WHERE codigo = ".$codigo." and inmueble.tipo_inm = tipo_in.tip_inm and usuarios.identificacion=inmueble.usuario";
        $resultado = mysql_query($consulta, $conexion);
        $registro= mysql_fetch_array($resultado);
		?>
        
        <!-- script que me trae el formulario de inmueble adecuado-->
        <script language="javascript">
	
			if(<?php echo $registro['tipo_inm']?> == 1)
			{
				$("#contenedorFormulario").cargar("datosApartamentoEdit.php?cod=<?php echo $codigo ?>");
			}
			
			if(<?php echo $registro['tipo_inm']?> == 2)
			{
				$("#contenedorFormulario").cargar('datosCasaEdit.php?cod=<?php echo $codigo ?>');	
			}
			
			if(<?php echo $registro['tipo_inm']?> == 3)
			{
				$("#contenedorFormulario").cargar('datosLocalEdit.php?cod=<?php echo $codigo ?>');	
			}
			
			if(<?php echo $registro['tipo_inm']?> == 4)
			{	
				$("#contenedorFormulario").cargar('datosOficinaEdit.php?cod=<?php echo $codigo ?>');	
			}
			
			if(<?php echo $registro['tipo_inm']?> == 5)
			{	
				$("#contenedorFormulario").cargar('datosBodegaEdit.php?cod=<?php echo $codigo ?>');	
			}
			
			if(<?php echo $registro['tipo_inm']?> == 6)
			{
				$("#contenedorFormulario").cargar('datosLoteEdit.php?cod=<?php echo $codigo ?>');	
			}
			
			if(<?php echo $registro['tipo_inm']?> == 7)
			{
				$("#contenedorFormulario").cargar('datosFincaEdit.php?cod=<?php echo $codigo ?>');	
			}
			
			if(<?php echo $registro['tipo_inm']?> == 8)
			{	
				$("#contenedorFormulario").cargar('datosConsultorioEdit.php?cod=<?php echo $codigo ?>');	
			}
		</script>
        
        
         <div id="formulario" class="recuadroAzul">
        	<h1 style="color:#808080" align="center">EDITAR INMUEBLE</h1>
            <div style="color:#346599" align="center">Por favor llenar todos los campos para publicar su inmueble en inmueblealaventa.com, los datos con asteristo(*) son obligatorios.</div>
            <div style="color:#346599"></div>
            
            <div style="width:325px; float:left; padding-left:5px;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              
            <tr>
                <td><strong>C&oacute;digo:</strong></td>
                <td>
                  <label><? echo $registro['codigo']; ?></label>
                  <input type="hidden" name="codigo" id="codigo" value="<?php echo $registro['codigo']?>" />                 
                </td>
              </tr>
              <tr>
                <td><strong>Plan:</strong></td>
                <td><?php echo planes($registro['plan'])?><input type="hidden" name="plan" id="plan" value="<?php echo $registro['plan']?>" /></td>
              </tr>
              <tr>
                <td><strong>Tipo inmueble:</strong></td>
                <td><?php echo $registro['dest_tip']?><input type="hidden" name="tipoInmueble" id="tipoInmueble" value="<?php echo $registro['tipo_inm']?>" /></td>
              </tr>
              <tr>
                <td><strong>Negociaci&oacute;n:</strong></td>
                <td><?php echo tipo_negocio($registro['tipo_neg'])?><input type="hidden" name="negociacion" id="negociacion" value="<?php echo $registro['tipo_neg']?>" /></td>
              </tr>
              <tr>
                <td><strong>Departamento*:</strong></td>
                <?php
				//Consultamos el departamento del municipio
				$consulta = "SELECT * FROM municipio WHERE idmunicipio = ".$registro['ciudad'];	
				$resultado_mun = mysql_query($consulta, $conexion);
				$registro_mun= mysql_fetch_array($resultado_mun);
				?>
                <td>
                <select name="departamento" id="departamento" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                    <option value="" selected="selected">- Escoja -</option>
                    <?php
                    $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                    $resultado_dep = mysql_query($consulta, $conexion);
                    
                    while ($registro_dep= mysql_fetch_array($resultado_dep))
                    {
                    ?>
                    <option value="<?php echo $registro_dep["iddepartamento"]?>" <?php if($registro_mun["departamento_iddepartamento"] == $registro_dep["iddepartamento"]) { echo "selected"; } ?>> <?php echo $registro_dep["nombre"]?> </option>
                    <?php
                    }
                    ?>
                </select>
                </td>
              </tr>
              <tr>
                <td><strong>Ciudad*:</strong></td>
                <td>
                <select name="ciudad" style="width:140px;" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                <option value="">- Escoja -</option>
					<?php
                    $consulta = "SELECT * FROM municipio WHERE departamento_iddepartamento = ".$registro_mun["departamento_iddepartamento"]." ORDER BY nombreMunicipio ASC";
                    
                    $resultado_ciu = mysql_query($consulta, $conexion);
                    
                    while ($registro_ciu= mysql_fetch_array($resultado_ciu))
                    {
                    ?>
                        <option value="<?php echo $registro_ciu["idmunicipio"]?>" <?php if($registro['ciudad'] == $registro_ciu["idmunicipio"]) { echo "selected"; } ?> ><?php echo $registro_ciu["nombreMunicipio"]?></option>
                    <?php
                    }
                    ?>
                 	
                 </select>
                </td>
              </tr>
              <tr>
                <td><strong>Zona</strong></td>
                <td><select name="zona" style="width:140px;" id="zona" >
                 
                </select></td>
              </tr>
              <tr>
                <td><strong>Barrio</strong></td>
                <td>
                
                <?php
				if ($registro["barrio"] !=0)
					{
				$consultabarrio = "SELECT nombrebarrio FROM municipio_barrios 
				  WHERE idbarrio = ".$registro["barrio"]." ";
				  $ejecutabarrio=mysql_query($consultabarrio);
				  $muestrabarrio=mysql_fetch_assoc($ejecutabarrio);
					}
				?>
                	<input name="barr" id="barr"  disabled="disabled" value="<?php echo $muestrabarrio['nombrebarrio']?>" /><br />
                  <input name="barrrio" value="<? echo $registro["barrio"]; ?>" type="hidden">
                <select name="barrio" id="barrio" >
                  
				  
				  <?php 
				  	if ($registro["barrio"] !=0)
					{
				  $consultabarrio = "SELECT nombrebarrio,idbarrio FROM municipio_barrios 
				  WHERE idbarrio = ".$registro["barrio"]." ";
				  $ejecutabarrio=mysql_query($consultabarrio);
				 
					}
				 
				  
				  ?>
                  <option value="">- Escoja -</option>
                  
                </select>
                
                </td>
              </tr>
              <tr>
                <td><strong>Direcci&oacute;n (nueva):</strong></td>
                <td><label for="codigo"></label>
                <input type="text" name="direccion" id="direccion" class="text-input" value="<?php echo $registro['dir']?>" /></td>
              </tr>
             <tr>
                <td colspan="2" style="color:#346599">Nota: Para su tranquilidad la direcci&oacute;n que usted introduzca aqu&iacute; no ser&aacute; publicada. Esto solo se utilizara para tener conocimiento exacto del sector en el que se encuentra su inmueble.</td>
              </tr>
             <tr>
               <td colspan="2" style="color:#346599"><strong>Datos de contacto</strong></td>
             </tr>
             <tr>
               <td><strong>Nombre</strong></td>
               <td><input type="text" name="nomContacto" id="nomContacto" value="<?php echo $registro['nomContacto']?>" /></td>
             </tr>
             <tr>
               <td><strong>Tel&eacute;fono fijo</strong></td>
               <td><input type="text" name="telContacto" id="telContacto" value="<?php echo $registro['telContacto']?>" /></td>
             </tr>
             <tr>
               <td><strong>Tel&eacute;fono celular</strong></td>
               <td><input type="text" name="celContacto" id="celContacto" value="<?php echo $registro['celContacto']?>" /></td>
             </tr>
             <tr>
               <td><strong>Email</strong></td>
               <td><input type="text" name="mailContacto" id="mailContacto" value="<?php echo $registro['mailContacto']?>"  class="validate[required,custom[email]] text-input" /></td>
             </tr>
              </table>       
            </div>
            <div id="contenedorFormulario" style="width:650px; float:left;"></div>
            <div style="clear:left"></div>
            <div align="center" ><input type="submit" value="Editar Información" class="boton medium naranja"/>&nbsp;&nbsp;<input type="button" name="cancelar" class="boton medium red" onClick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.registro.action = 'cuenta.php'; document.registro.submit() };" value="Cancelar" /></div>
            
        </div>
        <input name="cod_temp" type="hidden" value="<?php echo $numero_azar = rand();?>" />
        <input name="hdd_accion" type="hidden" value="editar" />
        <input name="hdd_codigo" type="hidden" value="<?php echo $codigo ?>" />
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