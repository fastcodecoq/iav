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

<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Slider de precios -->
<link rel="stylesheet" href="css/sliderPrecios/jslider.css" type="text/css">

<link rel="stylesheet" href="css/sliderPrecios/jslider.plastic.css" type="text/css">

<!-- Slider de precios -->
<script type="text/javascript" src="js/slider/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="js/slider/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="js/slider/tmpl.js"></script>
<script type="text/javascript" src="js/slider/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="js/slider/draggable-0.1.js"></script>
<script type="text/javascript" src="js/slider/jquery.slider.js"></script>
<!-- end -->

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>

<script language="javascript">
window.onload = function() {
	valor();
}

$(document).ready(function() {	

	// Formulario y tipo de datos para el validador
	jQuery("#registro").validationEngine();
	//$("#registro").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
            });            
        });
   })

});
</script>

<style>

table{
	margin-top:20px;
}
td{
	padding:5px 0;
}
input{
	width:160px;
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
        <form action="registroInmueble.php" method="post" id="armaPlan" name="armaPlan">
        <div class="recuadroNaranja">
        	<h1 style="color:#CD6732; font-weight:bold; font-size:2.2em" align="center">ARMA TU PLAN</h1>
            <div style="color:#346599" align="center">Dise&ntilde;alo como quieras y haz negocios f&aacute;cilmente.</div>
            
            <div style="float:left; width:296px; margin-left:40px; margin-top:30px;">
            	<div class="titulosFiltros">No. de Fotos</div>
                <div class="layout-slider" style="width: 100%; margin-bottom:30px;">
                  <span style="display: inline-block; width: 260px; padding: 0 0px;">			
                  <input id="fotos" type="slider" name="fotos" value="6"  /></span>
                </div>
                <script type="text/javascript" charset="utf-8">
                  jQuery("#fotos").slider({ from: 6, to: 26, step: 1, round: 1, format: {format: '#0,##0.', locale: 'es' }, dimension: '&nbsp;', scale: ['6','8','10','12','14','16','18','22','24','26'], limits: false, skin: "round", 
				  calculate: function( value )
				  { 
				 	var fotos = value;
					if(fotos == 6)
					{
						var valFotos = '$4.800';
					}
					else if(fotos == 8)
					{
						var valFotos = '$6.000';
					}
					else if(fotos == 10)
					{
						var valFotos = '$7.000';
					}
					else if(fotos == 12)
					{
						var valFotos = '$7.800';
					}
					else if(fotos == 14)
					{
						var valFotos = '$8.400';
					}
					else if(fotos == 16)
					{
						var valFotos = '$8.800';
					}
					else if(fotos == 18)
					{
						var valFotos = '$9.000';
					}
					else if(fotos == 22)
					{
						var valFotos = '$9.900';
					}
					else if(fotos == 24)
					{
						var valFotos = '$10.200';
					}
					else if(fotos == 26)
					{
						var valFotos = '$10.400';
					}					
				  					
					return (valFotos);
				  },
				  onstatechange: function( value ){
    			  valor( this );
				  }});
                </script>

          </div>
            
            
            <div style="float:left; width:296px; margin-left:20px; margin-top:30px;">
            	<div class="titulosFiltros">No. meses en destacados</div>
                <div class="layout-slider" style="width: 100%; margin-bottom:30px;">
                  <span style="display: inline-block; width: 260px; padding: 0 0px;">
                  <input id="destacados" type="slider" name="destacados" value="0" onkeyup="valor()" /></span>
                </div>
                <script type="text/javascript" charset="utf-8">
                  jQuery("#destacados").slider({ from: 0, to: 9, step: 1, round: 1, format: {format: '#0,##0.', locale: 'es' }, dimension: '&nbsp;', scale: ['0','1','2','3','4','5','6','7','8','9'], limits: false, skin: "round", 
				  calculate: function( value )
				  { 
				  	var destacados = value;
					if(destacados == 0 || destacados == "")
					{
						var valDestacados = '$0';
					}
					else if(destacados == 1)
					{
						var valDestacados = '$4.000';
					}
					else if(destacados == 2)
					{
						var valDestacados = '$7.000';
					}
					else if(destacados == 3)
					{
						var valDestacados = '$10.000';
					}
					else if(destacados == 4)
					{
						var valDestacados = '$13.000';
					}
					else if(destacados == 5)
					{
						var valDestacados = '$16.000';
					}
					else if(destacados == 6)
					{
						var valDestacados = '$19.000';
					}
					else if(destacados == 7)
					{
						var valDestacados = '$22.000';
					}
					else if(destacados == 8)
					{
						var valDestacados = '$26.000';
					}
					else if(destacados == 9)
					{
						var valDestacados = '$28.000';
					}
					
					return (valDestacados);
				  },
				  onstatechange: function( value ){
    			  valor( this );
				  }});
                </script>
                
            </div>
            
            
            <div style="float:left; width:296px; margin-left:20px; margin-top:30px;">
            	<div class="titulosFiltros">Meses de publicaci&oacute;n</div>
                <div class="layout-slider" style="width: 100%; margin-bottom:30px;">
                  <span style="display: inline-block; width: 260px; padding: 0 0px;">
                  <input id="meses" type="slider" name="meses" value="1" /></span>
                </div>
                <script type="text/javascript" charset="utf-8">
                  jQuery("#meses").slider({ from: 1, to: 10, step: 1, round: 1, format: {format: '#0,##0.', locale: 'es' }, dimension: '&nbsp;', scale: ['1','2','3','4','5','6','7','8','9','&infin;'], limits: false, skin: "round", 
				  calculate: function( value )
				  { 
				  	var meses = value;
					if(meses == 1 || meses == '')
					{
						var valMes = '$16.000';
					}
					else if(meses == 2)
					{
						var valMes = '$22.100';
					}
					else if(meses == 3)
					{
						var valMes = '$24.000';
					}
					else if(meses == 4)
					{
						var valMes = '$26.000';
					}
					else if(meses == 5)
					{
						var valMes = '$28.000';
					}
					else if(meses == 6)
					{
						var valMes = '$30.000';
					}
					else if(meses == 7)
					{
						var valMes = '$32.000';
					}
					else if(meses == 8)
					{
						var valMes = '$36.000';
					}
					else if(meses == 9)
					{
						var valMes = '$40.000';
					}
					else if(meses == 10)
					{
						var valMes = '$46.000';
					}
					
					return (valMes);
				  },
				  onstatechange: function( value ){
    			  valor( this );
				  }});
                </script> 
                
            </div>
            <div style="clear:left; padding-top:20px;"></div>
            <div style="padding:30px 0;">
              <div style="float:left; padding-left:100px;"><img src="imagenes/imgTarjetas.png" width="187" height="39" /></div>
              <div style="float:left; padding-left:100px;"><span id="ganancia" style="font-weight:bold; font-size:2em;">Valor Total: $0</span></div>
              
              <div style="float:right; padding-right:50px; margin-top:5px;"><a href="#" onclick="document.armaPlan.hdd_plan.value = 4;  document.armaPlan.hdd_tipo_neg.value = 1;document.armaPlan.submit();"><img src="imagenes/btnOrdenarAhora.png" width="223" height="25" border="0" /></a></div>
            </div>
            
            <div style="clear:left; padding-top:40px;"></div>
            
        </div>
        <script  type="text/javascript">	
		function numero_moneda(numero)
		{	
			negativo = false;
			
			if (numero < 0)
			{
				negativo = true;
				numero *= -1;
			}
			
			numero = numero.toString();
			
			punto_pos = numero.length;
			if (numero.indexOf('.') != -1)
			{	
				punto_pos = numero.indexOf('.');
			}
			
			int_numero = numero.substring(0, punto_pos);
			dec_numero = numero.substring(punto_pos+1, numero.length);
			strnumero = int_numero;
			moneda = "";
			
			while (strnumero.length > 2)
			{
				moneda = "." + strnumero.substring(strnumero.length-3, strnumero.length) + moneda;
				strnumero = strnumero.substr(0, strnumero.length-3);
			}
			
			if (strnumero.length > 0)
			{
				moneda = strnumero + moneda;
			}
			else
			{
				moneda = moneda.substr(1, moneda.length);
			}
			
			if (dec_numero != '')
			{
				moneda += ","+dec_numero;
			}
			
			if (negativo)
			{
				return "-"+moneda;
			}
			else
			{
				return moneda;
			}
		}	
		
		function valor()
		{
		
			var nfotos = document.getElementById("fotos").value;
			var ndestacados = document.getElementById("destacados").value;
			var nmeses = document.getElementById("meses").value;

			//var val2= document.getElementById("val2").value;
			
			//sacamos el valor de las fotos

			if(nfotos == 6 || nfotos == 7)
			{
				var valFotoSum = 4800;
			}
			else if(nfotos == 8 || nfotos == 9)
			{
				var valFotoSum = 6000;
			}
			else if(nfotos == 10 || nfotos == 11)
			{
				var valFotoSum = 7000;
			}
			else if(nfotos == 12 || nfotos == 13)
			{
				var valFotoSum = 7800;
			}
			else if(nfotos == 14 || nfotos == 15)
			{
				var valFotoSum = 8400;
			}
			else if(nfotos == 16 || nfotos == 17)
			{
				var valFotoSum = 8800;
			}
			else if(nfotos == 18 || nfotos == 19  || nfotos == 20  || nfotos == 21)
			{
				var valFotoSum = 9000;
			}
			else if(nfotos == 22 || nfotos == 23)
			{
				var valFotoSum = 9900;
			}
			else if(nfotos == 24 || nfotos == 25)
			{
				var valFotoSum = 10200;
			}
			else if(nfotos == 26)
			{
				var valFotoSum = 10400;
			}
			
			
					
			//Valor destacados
			if(ndestacados == 0 || ndestacados == "")
			{
				var valDestacadosSum = 0;
			}
			else if(ndestacados == 1)
			{
				var valDestacadosSum = 4000;
			}
			else if(ndestacados == 2)
			{
				var valDestacadosSum = 7000;
			}
			else if(ndestacados == 3)
			{
				var valDestacadosSum = 10000;
			}
			else if(ndestacados == 4)
			{
				var valDestacadosSum = 13000;
			}
			else if(ndestacados == 5)
			{
				var valDestacadosSum = 16000;
			}
			else if(ndestacados == 6)
			{
				var valDestacadosSum = 19000;
			}
			else if(ndestacados == 7)
			{
				var valDestacadosSum = 22000;
			}
			else if(ndestacados == 8)
			{
				var valDestacadosSum = 26000;
			}
			else if(ndestacados == 9)
			{
				var valDestacadosSum = 28000;
			}
			
			//Valor de meses
			if(nmeses == 1 || nmeses == '')
			{
				var valMeSum = 16000;
			}
			else if(nmeses == 2)
			{
				var valMeSum = 22100;
			}
			else if(nmeses == 3)
			{
				var valMeSum = 24000;
			}
			else if(nmeses == 4)
			{
				var valMeSum = 26000;
			}
			else if(nmeses == 5)
			{
				var valMeSum = 28000;
			}
			else if(nmeses == 6)
			{
				var valMeSum = 30000;
			}
			else if(nmeses == 7)
			{
				var valMeSum = 32000;
			}
			else if(nmeses == 8)
			{
				var valMeSum = 36000;
			}
			else if(nmeses == 9)
			{
				var valMeSum = 40000;
			}
			else if(nmeses == 10)
			{
				var valMeSum = 46000;
			}

			
			//Hallamos el valor del plan
			var costo= (parseInt(valFotoSum)+parseInt(valDestacadosSum)+parseInt(valMeSum));
			   
			var total =  document.getElementById("ganancia");    
			document.getElementById("hdd_valor_plan").value = costo;
			total.innerHTML = 'Valor Total: $'+numero_moneda(costo);           
		
		}
		
		</script>
        <input name="hdd_valor_plan" id="hdd_valor_plan" type="hidden" value="" />
        <input name="hdd_plan" type="hidden" value="" />
        <input name="hdd_tipo_neg" type="hidden" value="" />
        </form>
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