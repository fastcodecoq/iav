<?php
require_once('controlSesion.php');
require_once('bd.php');


?>
<!DOCTYPE html>
<html lang="es-CO">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="es" http-equiv="Content-Language">
<title>Inmueble a la venta</title>
<meta property="fb:admins" content="100005082218469">
<meta property="fb:app_id" content="1435079113381937">
<meta property="og:url" content="">
<meta property="og:title" content="Finca Raiz en <?php echo $ubicacion?> | <?php echo $negocio." de inmuebles en ".$ubicacion?>">
<meta property="og:description" content="Encuentre inmuebles en <?php echo $negocio?> en <?php echo $ubicacion?>. Inmueblealaventa.com le ofrece un amplio listado de propiedades en venta y arriendo en todos los barrios de <?php echo $ubicacion?>. Conozca precios, fotos y contacte hoy mismo al vendedor de las propiedades">
<meta property="og:type" content="other">
<meta property="og:image" content="http://www.inmueblealaventa.com/imagenes/logo.png">
<meta name="description" content="Encuentre inmuebles en <?php echo $negocio?> en <?php echo $ubicacion?>.Inmueblealaventa.com le ofrece un amplio listado de propiedades en venta y arriendo en todos los barrios de <?php echo $ubicacion?>. Conozca precios, fotos y contacte hoy mismo al vendedor de las propiedades">
<meta name="keywords" content="Inmuebles <?php echo $ubicacion ?>, finca raíz, propiedades en <span data-city></span>, bienes raíces,<?php echo $ubicacion?>">
<link href="/css/general.css" rel="stylesheet" type="text/css" />
<link href="/css/paginacion_pagina.css" rel="stylesheet" type="text/css" />
<link href="/css/botones.css" rel="stylesheet" type="text/css" />
<link href="/css/nuevos-estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="/validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<? if(isset($_GET["inm"]))
      echo "<script>
            window.inmobiliaria =  {$_GET['inm']};               
            </script>";
  ?>

<script src="/validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="/validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script type="text/javascript" src="/funciones/script_cajas.js"></script>

<script type="text/javascript" src="/sideFilters.sock.js"></script>
<script type="text/javascript" src="/order.controller.sock.js"></script>


<script type="text/javascript">


jQuery(document).ready(function() {

	// Formulario y tipo de datos para el validador
	jQuery("#filtros").validationEngine();
	jQuery('input').attr('data-prompt-position','topLeft');
	jQuery('select').attr('data-prompt-position','topLeft');
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("/comboCiudades.php", { elegido: elegido }, function(data){
			$("#barrio").empty();
            $("#ciudad").html(data);
            });            
        });
   })
   
   /*$("#ciudad").change(function () {
           $("#ciudad option:selected").each(function () {
            elegido=$(this).val();
            $.post("/comboBarrios.php", { elegido: elegido }, function(data){
            $("#barrio").html(data);
            });            
        });
   })*/
   
   
   $("#ciudad").change(function () {
           $("#ciudad option:selected").each(function () {
            elegido=$(this).val();
			
          	  $.post("/comboZonas.php", { elegido: elegido }, function(data){ 
			  
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
            $.post("/comboZonasB.php", { elegido: elegido }, function(data){
			if (data!="no")
				{
         	   $("#barrio").html(data);
				}
            });            
        });
   })
   
   
   $("#para").change(function(){          
		var value = $("#para option:selected").val();
		
		if(value == '')
		{
			$("#preciosVenta").hide(100);
			$("#preciosArriendo").hide(100);
		}
		
		if(value == 1)
		{
			$("#preciosVenta").show(100);
			$("#preciosArriendo").hide(100);
		}
		
		if(value == 2)
		{
			$("#preciosVenta").hide(100);
			$("#preciosArriendo").show(100);
		}
   });
   
   $("#tipoInmueble").change(function(){          
		var value = $("#tipoInmueble option:selected").val();
		if(value == '')
		{			
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);	
		}
		
		if(value == 1)
		{
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 2)
		{
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 3)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").hide(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 4)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").hide(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 5)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").hide(100);
			$("#antiguedad").show(100);
		}
		
		if(value == 6)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").hide(100);
			$("#garajes").hide(100);
			$("#antiguedad").hide(100);
		}
		
		if(value == 7)
		{
			$("#area").show(100);
			$("#habitaciones").show(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").hide(100);
		}
		
		if(value == 8)
		{
			$("#area").show(100);
			$("#habitaciones").hide(100);
			$("#banos").show(100);
			$("#garajes").show(100);
			$("#antiguedad").show(100);
		}
	
   });

});

</script>

<style>
   *[data-page].active{
   	 color: green;
   	 font-weight: bold;
   }
</style>
    
</head>


<body>

<?php 

include_once("analyticstracking.php");

include('funciones/fechas.php');

?>
<section>
	<?php include('cabezote.php');?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php');?></div>
    </div>
</section>
<section>
	<div class="contenedor">
    	<div class="lineatiempo" data-enouncement><h1 itemprop="headline">Finca Raiz en <span data-city></span> |  <span data-tipo_neg></span> de inmuebles en <span data-city></span></h1></div>
        
        <!-- Inmuebles -->
        <div style=" min-height:700px;">
            <!-- Filtros -->
           
             <div id="filtros" style="float:left; background:#FFF; border: 1px solid #ccc; width:200px; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
                <div style="padding:10px; font-size:18px;">Filtros</div>
                <div style="margin-left:5px; margin-right:5px">
                <form name="filtros" id="filtros" method="get" action="/busca/">
                <table width="100%" border="0">
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Departamento</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="departamento" id="departamento" style="width:140px;" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                    


                        <option value="0" selected="selected">- Escoja -</option>
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
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>	
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Ciudad</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="ciudad" style="width:140px;" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                        
                        <?php
						if ($_GET["ciudad"]!=0 || $_GET["ciudad"]!="")
					{
					?>
                    		
                            <option value="<?php echo $cociudad?>" selected="selected"><?php echo $nomciudad?></option>
                            
                     

<?php
					}
					else
					{
?>
                        <option value="0">- Escoja -</option>
                        
                        <?php 
					}
						?>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Zona</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja"><select name="zona" style="width:140px;" id="zona" >
                      <?php
						if ($_GET["ciudad"]!=0 || $_GET["ciudad"]!="")
					{
					?>
                      <option value="<?php echo $cociudad?>" selected="selected"><?php echo $nomciudad?></option>
                      <?php
					}
					else
					{
?>
                      <option value="0">- Escoja -</option>
                      <?php 
					}
						?>
                    </select></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Barrio</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    
                    <select name="barrio" style="width:140px;" id="barrio" >
                        <option value="0">- Escoja -</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr> 
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de inmueble</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="tipoInmueble" id="tipoInmueble" style="width:140px;" class="validate[required]">
                        <option value="0">- Escoja -</option>
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
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de negociaci&oacute;n </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" >
                    <select name="para" style="width:140px;" id="para" class="validate[required]">
                        <option value="0">- Escoja -</option>
                        <option value="1">Compra</option>
                        <option value="2">Arriendo</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  
                   <tr>
                    <td colspan="2">
                    <div id="preciosVenta" style="display:none">
                    <table width="100%" border="0">
                   	  <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Precio (millones)</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 40 millones</td>
                        <td width="19%"><input type="radio" name="campo_5" id="precio" value="1" /></td>
                      </tr>
                      <tr>
                        <td>40 a 70 millones</td>
                        <td><input type="radio" name="campo_5" id="precio" value="2" /></td>
                      </tr>
                      <tr>
                        <td>70 a 100 millones</td>
                        <td><input type="radio" name="campo_5" id="precio" value="3" /></td>
                      </tr>
                      <tr>
                        <td>100 a 200 millones</td>
                        <td><input type="radio" name="campo_5" id="precio" value="4" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 200 >></td>
                        <td><input type="radio" name="campo_5" id="precio" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="preciosArriendo" style="display:none">
                    <table width="100%" border="0">
                   	  <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Precio (miles)</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 300.000</td>
                        <td width="19%"><input type="radio" name="campo_53" id="precio" value="1" /></td>
                      </tr>
                      <tr>
                        <td>300.000-1.000.000</td>
                        <td><input type="radio" name="campo_53" id="precio" value="2" /></td>
                      </tr>
                      <tr>
                        <td>1.000.000-1.300.000</td>
                        <td><input type="radio" name="campo_53" id="precio" value="3" /></td>
                      </tr>
                      <tr>
                        <td>1.300.000-6.000.000</td>
                        <td><input type="radio" name="campo_53" id="precio" value="4" /></td>
                      </tr>
                      <tr>
                        <td>6.000.000-9.000.000</td>
                        <td><input type="radio" name="campo_53" id="precio" value="5" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 9.000.000</td>
                        <td><input type="radio" name="campo_53" id="precio" value="6" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="area">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">&Aacute;rea m&sup2;</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 60</td>
                        <td width="19%"><input type="radio" name="campo_6" id="radio" value="1" /></td>
                      </tr>
                      <tr>
                        <td>60 a 100</td>
                        <td><input type="radio" name="campo_6" id="radio" value="2" /></td>
                      </tr>
                      <tr>
                        <td>100 a 200</td>
                        <td><input type="radio" name="campo_6" id="radio" value="3" /></td>
                      </tr>
                      <tr>
                        <td>200 a 300</td>
                        <td><input type="radio" name="campo_6" id="radio" value="4" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 300</td>
                        <td><input type="radio" name="campo_6" id="radio" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                                                  
                                 
				  <tr>
                    <td colspan="2">
                    <div id="habitaciones">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Habitaciones</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Habitaci&oacute;n</td>
                        <td width="19%"><input type="radio" name="campo_24" id="habitaciones" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Habitaciones</td>
                        <td><input type="radio" name="campo_24" id="habitaciones" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Habitaciones</td>
                        <td><input type="radio" name="campo_24" id="habitaciones" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Habitaciones</td>
                        <td><input type="radio" name="campo_24" id="habitaciones" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + habitaciones</td>
                        <td><input type="radio" name="campo_24" id="habitaciones" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                  	</td>
                  </tr>

				  
                  <tr>
                    <td colspan="2">
                    <div id="banos">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Ba&ntilde;os</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Ba&ntilde;o</td>
                        <td width="19%"><input type="radio" name="campo_9" id="bano" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Ba&ntilde;os</td>
                        <td><input type="radio" name="campo_9" id="bano" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Ba&ntilde;os</td>
                        <td><input type="radio" name="campo_9" id="bano" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Ba&ntilde;os</td>
                        <td><input type="radio" name="campo_9" id="bano" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + Ba&ntilde;os</td>
                        <td><input type="radio" name="campo_9" id="bano" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="garajes">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Garajes</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Garaje</td>
                        <td width="19%"><input type="radio" name="campo_17" id="garaje" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Garajes</td>
                        <td><input type="radio" name="campo_17" id="garaje" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Garajes</td>
                        <td><input type="radio" name="campo_17" id="garaje" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Garajes</td>
                        <td><input type="radio" name="campo_17" id="garaje" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + Garajes</td>
                        <td><input type="radio" name="campo_17" id="garaje" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
				  
                  <tr>
                    <td colspan="2">
                    <div id="antiguedad">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Antig&uuml;edad</td>
                      </tr>
                      <tr>
                        <td width="81%">Sobre Plano</td>
                        <td width="19%"><input type="radio" name="campo_4" id="antiguedad" value="1" /></td>
                      </tr>
                      <tr>
                        <td>En construcci&oacute;n</td>
                        <td><input type="radio" name="campo_4" id="antiguedad" value="2" /></td>
                      </tr>
                      <tr>
                        <td>de 0 a 5 a&ntilde;os</td>
                        <td><input type="radio" name="campo_4" id="antiguedad" value="3" /></td>
                      </tr>
                      <tr>
                        <td>de 5 a 10 a&ntilde;os</td>
                        <td><input type="radio" name="campo_4" id="antiguedad" value="4" /></td>
                      </tr>
                      <tr>
                        <td>de 10 a 20 a&ntilde;os</td>
                        <td><input type="radio" name="campo_4" id="antiguedad" value="5" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 20 a&ntilde;os</td>
                        <td><input type="radio" name="campo_4" id="antiguedad" value="6" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  	
				  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Filtrar" class="boton bigrounded naranja" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
                </form>
                </div>
                </div>
            
            
            <!-- Inmuebles -->

            <div class="inmobiliaria" data-inmobiliaria style="overflow:hidden; display:none">
                <h2 data-adm-name>SPAZIO INTERNACIONAL S.A.S</h2>
                <div class="contenido">
                  <div class="imagen"> 
                
                  
                  	             		<img style="cursor:pointer" data-imag src="/bannerInmobiliariaConstructora/1376866483_536812458 spazio.png" width="177" height="177" border="0">
                	                 </div> 
                  <div class="direccion">
                    <p><strong>Número de contacto</strong></p>
                    <p data-tel>5305272 • 3183436819</p>
                    <p>&nbsp;</p>
                   <!-- <p><strong>Dirección</strong></p>-->
                    <p><!-- Calle 79 No. 16A 20 Of. 407 Bogotá D.C.--></p>
                  </div>
                  <div class="contacto">
                    <p><strong>Sitio web</strong></p>
                    <p><a href="" target="_blank" data-site>http://spazioin.co/</a></p>                    
                    <p>&nbsp;</p>
                    <a style="margin-left:0px;" class="boton" href="mailto:info@spazioin.co" data-email>Contactar via E-mail</a> </div>
                </div>
              </div>
            
            <div style="float:left; width:530px; margin-left:30px; <?php echo $alto?>"  id="contenedor1">


            
            <form action="" method="get" name="frm_propiedades" id="frm_propiedades">
       

			
			

            <div style="overflow:hidden; display:block">
              <div style="float:left; width:250px; padding-bottom:10px;line-height: 2.5;">Se han encontrado <span data-total></span> inmueble(s)</div>
                <div style="float:left; width:280px; text-align:right">
                
                  <select name="orden" id="orden" >
                  	<option  value="">Ordenar</option>                  	
                  <optgroup label="Publicaci&oacute;n">
                  	<option  value="time<">Desde la m&aacute;s reciente</option>
                    <option  value="time>" >Desde la m&aacute;s antigua</option>
                  </optgroup>
                  <optgroup label="Por precio">
                  	<option  value="price<" >De menor a mayor</option>
                  	<option  value="price>" >De mayor a menor</option>                    
                  </optgroup>
                  <optgroup label="Por &aacute;rea">
                    <option  value="area<" >De menor a mayor</option>                  	
                  	<option  value="area>" >De mayor a menor</option>
                  </optgroup>
                  </select>
                </div>
           </div>
        	  <br>
        	  <br>
				
        <ul class="resultados" data-results>
                            
				</ul>
                
        	  <br>
        	  
       
            	<div data-pages>
                 
                </div>
            </form>
         
            </div>
            <div style="float:left; margin-left:30px;overflow:hidden; background:#FFF; border: 1px solid #ccc; width:180px; min-height:211px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
        	<h1  style="padding-left:15px; font-size:12px"><img src="/imagenes/flecha.png" width="19" height="18" />Enlaces recomendados</h1>

            <hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"></hr>
             <div data-links></div>
           
            </div>
         
            
             
             <div class="recuadro_publicidad">
             <div style="width:180px; height:13px;float:left;text-align:center;font-size:10px;background-color: #f0f0f0;">PUBLICIDAD</div>
             <div style="margin:0 auto; width:160px; height:611px; margin-top:3px; margin-bottom:5px; ">           
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Propiedades de inmuebles -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-4773232013586517"
     data-ad-slot="4991475263"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<div style="margin:0 auto; width:160px; height:130px; margin-top:5px;"> 
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- PropiedadesNUEVO -->
<ins class="adsbygoogle"
     style="display:inline-block;width:125px;height:125px"
     data-ad-client="ca-pub-4773232013586517"
     data-ad-slot="5212258460"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
</div>
    	<?php /*?><?php
		$consulta_banner="SELECT * FROM banner WHERE posicion = 2 AND estado = 1 ORDER BY fecha DESC limit 0,1"; 
		$resultado_banner=mysql_query($consulta_banner,$conexion);
		$num_banner = mysql_num_rows($resultado_banner);
		$registro_banner=mysql_fetch_array($resultado_banner);
		$archivo = $registro_banner['archivo'];
		if($registro_banner['link'] != '')
			$link = $registro_banner['link'];
			else
				$link = '#';
		
		if($num_banner != 0)
		{
		?>
         
           <a href="<?php echo $link?>" <?php if($link != '#') {  }?>> <img  style=" " src="/banner/<?php echo $archivo?>" weight="201px" height="495px" border="0" title="Ver informacion" /></a>
        <?php
		}
		else
		{
		?>
        	<img  style=" " src="/imagenes/paute.jpg" weight="201px" height="495px" />
        <?php
		}
		?><?php */?>
        </div>
      	</div>
        
        
        
	  
        
       
        
        
        <!-- Div en blanco-->
        <div style="clear:left; height:20px;"></div>
        
    </div>    
</section>



<footer>
<?php include('pie.php');?>
</footer>
  

<script src="http://inmueblealaventa.com:9090/socket.io/socket.io.js"></script>
<script src="assets/js/lazy.js"></script>
<script src="assets/js/main.js"></script>

<script type="text/javascript">

 $(function(){ $(window).scroll( function(e){

 /*
       if($(window).scrollTop() >= 705)
         $("#button").removeClass("fijate");
       else
         $("#button").addClass("fijate");
 */

  }) });

</script>

</body>


</html>