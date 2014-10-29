<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');

//Consulto el municipio
$consulta = "SELECT departamento.nombre AS departamento, municipio.nombreMunicipio  FROM municipio 
JOIN departamento ON departamento.iddepartamento = municipio.departamento_iddepartamento
WHERE idmunicipio = ".$_POST["ciudad"];
$resultado= mysql_query($consulta, $conexion);	
$registro = mysql_fetch_array($resultado);
$ciudad = $_POST['direccion'].",".$registro['nombreMunicipio'].",".$registro['departamento'].",Colombia";


// INICIALIZO LAS VARIABLES PARA EL MAPA
$latitud= "4.60971";
$longitud="-74.08175";
$zoom= "14";
$tipo_mapa = "ROADMAP";
$direccion = "";


if (isset($ciudad)) $direccion=  urldecode ($ciudad);
else $direccion="";

// LONGITUD Y LATITUD SI ESTAN COMO PARAMETROS LOS COJO
if (isset($_GET["dir"])) $direccion = $_GET["dir"];
if (strlen ($direccion) <= 8) $direccion =""; // SI LA DIRECCION ES MENOR QUE 8 NO LA PROCESO

// LONGITUD Y LATITUD SI ESTAN COMO PARAMETROS LOS COJO
if (isset($_GET["lon"])) $longitud= $_GET["lon"];
if (isset($_GET["lat"])) $latitud= $_GET["lat"];

// ZOOM ENTRE 0 y 19
if (isset($_GET["zoom"])) $zoom= $_GET["zoom"];
if (($zoom<=0) || ($zoom>=20)){ $zoom= "17";}


// TIPO DE MAPA
if (isset($_GET["tipo"])) $tipo_mapa= strtoupper($_GET["tipo"]);

// COMPRUEBO QUE EL TIPO ES UNO DE LOS QUE ACEPTA GOOGLE
if ($tipo_mapa == "SATELLITE") $error=0;
else
  if ($tipo_mapa == "ROADMAP") $error=0;
  else 	
    if ($tipo_mapa == "TERRAIN")$error=0;
    else $tipo_mapa = "HYBRID";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- mAPA -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">

// VARIABLES GLOBALES JAVASCRIPT
var geocoder;
var marker;
var latLng;
var latLng2;
var map;

// INICiALIZACION DE MAPA
function initialize() {
  geocoder = new google.maps.Geocoder();	
  latLng = new google.maps.LatLng(<?php echo $latitud;?> ,<?php echo $longitud;?>);
  map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom:<?php echo $zoom;?>,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.<?php echo $tipo_mapa;?>
  });


// CREACION DEL MARCADOR  
    marker = new google.maps.Marker({
    position: latLng,
    title: 'Arrastra el marcador si quieres moverlo',
    map: map,
    draggable: true
  });
 
 

 
// Escucho el CLICK sobre el mama y si se produce actualizo la posicion del marcador 
     google.maps.event.addListener(map, 'click', function(event) {
     updateMarker(event.latLng);
   });
  
  // Inicializo los datos del marcador
  //    updateMarkerPosition(latLng);
     
      geocodePosition(latLng);
 
  // Permito los eventos drag/drop sobre el marcador
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Arrastrando...');
  });
 
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Arrastrando...');
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Arrastre finalizado');
    geocodePosition(marker.getPosition());
  });
  

 
}


// Permito la gesti¢n de los eventos DOM
google.maps.event.addDomListener(window, 'load', initialize);

// ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('No puedo encontrar esta direccion.');
    }
  });
}

// OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
function codeLatLon() { 
      str= document.form_mapa.longitud.value+" , "+document.form_mapa.latitud.value;
      latLng2 = new google.maps.LatLng(document.form_mapa.latitud.value ,document.form_mapa.longitud.value);
      marker.setPosition(latLng2);
      map.setCenter(latLng2);
      geocodePosition (latLng2);
      document.form_mapa.direccionMap.value = str+" OK";
}

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress() {
        var address = document.form_mapa.direccionMap.value;
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress2 (address) {
          
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
             document.form_mapa.direccionMap.value = address;
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

function updateMarkerStatus(str) {
  document.form_mapa.direccionMap.value = str;
}

// RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
function updateMarkerPosition (latLng) {
  document.form_mapa.longitud.value =latLng.lng();
  document.form_mapa.latitud.value = latLng.lat();
}

function updateMarkerAddress(str) {
  document.form_mapa.direccionMap.value = str;
}

// ACTUALIZO LA POSICION DEL MARCADOR
function updateMarker(location) {
        marker.setPosition(location);
        updateMarkerPosition(location);
        geocodePosition(location);
      }

</script>

<style type="text/css">
  #mapCanvas { height: 450px;}
</style> 


</head>

<body  <?php if ($direccion != "") { ?> onload=" codeAddress2('<?php echo $direccion; ?>')" <?php } ?> >
<!-- Google Code for http://inmueblealaventa.com/registroInmueblesUbicacion.php Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 994346917;
var google_conversion_language = "es";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "9-w6CJOkqQYQpY-S2gM";
var google_conversion_value = 30000;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/994346917/?value=30000&amp;label=9-w6CJOkqQYQpY-S2gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
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
        <form name="form_mapa" method="post" enctype="multipart/form-data">
        <input name="hdd_tipoCliente" type="hidden" value="<?php echo $_POST['hdd_tipoCliente']?>" /> 
        <input name="codigoinm" type="hidden" value="<?php echo $_POST['codigoinm']?>" /> 
        <input name="cod_temp" type="hidden" value="<?php echo $_POST['cod_temp']?>" />
        <input name="plan" type="hidden" value="<?php echo $_POST['plan']?>" />
		<input name="tipoInmueble" type="hidden" value="<?php echo $_POST['tipoInmueble']?>" />
        <input name="negociacion" type="hidden" value="<?php echo $_POST['negociacion']?>" />
        <input name="ciudad" type="hidden" value="<?php echo $_POST['ciudad']?>" />
        <input name="direccion" type="hidden" value="<?php echo $_POST['direccion']?>" />
        <input name="nomContacto" type="hidden" value="<?php echo $_POST['nomContacto']?>" />
        <input name="telContacto" type="hidden" value="<?php echo $_POST['telContacto']?>" />
        <input name="celContacto" type="hidden" value="<?php echo $_POST['celContacto']?>" />
        <input name="mailContacto" type="hidden" value="<?php echo $_POST['mailContacto']?>" />
        <input name="nomBarrio" type="hidden" value="<?php echo $_POST["nomBarrio"]?>" />
        <input name="tipoBodega" type="hidden" value="<?php echo $_POST["tipoBodega"]?>" />
        <input name="numOficinas" type="hidden" value="<?php echo $_POST["numOficinas"]?>" />
        <input name="tiempo" type="hidden" value="<?php echo $_POST["tiempo"]?>" />
        <input name="vlrventa" type="hidden" value="<?php echo $_POST["vlrventa"]?>" />
        <input name="area" type="hidden" value="<?php echo $_POST["area"]?>" />
        <input name="estrato" type="hidden" value="<?php echo $_POST["estrato"]?>" />
        <input name="tipoPiso" type="hidden" value="<?php echo $_POST["tipoPiso"]?>" />
        <input name="numBanos" type="hidden" value="<?php echo $_POST["numBanos"]?>" />
        <input name="puertaMulas" type="hidden" value="<?php echo $_POST["puertaMulas"]?>" />
        <input name="alarma" type="hidden" value="<?php echo $_POST["alarma"]?>" />
        <input name="humo" type="hidden" value="<?php echo $_POST["humo"]?>" />
        <input name="gabinete" type="hidden" value="<?php echo $_POST["gabinete"]?>" />
        <input name="rociadores" type="hidden" value="<?php echo $_POST["rociadores"]?>" />
        <input name="tanques" type="hidden" value="<?php echo $_POST["tanques"]?>" />
        <input name="planta" type="hidden" value="<?php echo $_POST["planta"]?>" />
        <input name="vigilancia" type="hidden" value="<?php echo $_POST["vigilancia"]?>" />
        <input name="tipoConsultorio" type="hidden" value="<?php echo $_POST["tipoConsultorio"]?>" />
        <input name="vlrAdmon" type="hidden" value="<?php echo $_POST["vlrAdmon"]?>" />
        <input name="parqVisitantes" type="hidden" value="<?php echo $_POST["parqVisitantes"]?>" />
        <input name="numLineas" type="hidden" value="<?php echo $_POST["numLineas"]?>" />
        <input name="tipoFinca" type="hidden" value="<?php echo $_POST["tipoFinca"]?>" />
        <input name="tiempoArriendo" type="hidden" value="<?php echo $_POST["tiempoArriendo"]?>" />
        <input name="numHabitaciones" type="hidden" value="<?php echo $_POST["numHabitaciones"]?>" />
        <input name="numGarajes" type="hidden" value="<?php echo $_POST["numGarajes"]?>" />
        <input name="terrenoConstruido" type="hidden" value="<?php echo $_POST["terrenoConstruido"]?>" />
        <input name="piscina" type="hidden" value="<?php echo $_POST["piscina"]?>" />
        <input name="canchaTenis" type="hidden" value="<?php echo $_POST["canchaTenis"]?>" />
        <input name="canchaFutbol" type="hidden" value="<?php echo $_POST["canchaFutbol"]?>" />
        <input name="otrosDeportes" type="hidden" value="<?php echo $_POST["otrosDeportes"]?>" />
        <input name="tipoLocal" type="hidden" value="<?php echo $_POST["tipoLocal"]?>" />
        <input name="numGarajes" type="hidden" value="<?php echo $_POST["numGarajes"]?>" />
        <input name="numDepositos" type="hidden" value="<?php echo $_POST["numDepositos"]?>" />
        <input name="interior" type="hidden" value="<?php echo $_POST["interior"]?>" />
        <input name="numApartamento" type="hidden" value="<?php echo $_POST["numApartamento"]?>" />
        <input name="numPiso" type="hidden" value="<?php echo $_POST["numPiso"]?>" />
        <input name="gas" type="hidden" value="<?php echo $_POST["gas"]?>" />
        <input name="numCasa" type="hidden" value="<?php echo $_POST["numCasa"]?>" />
        <input name="numPisos" type="hidden" value="<?php echo $_POST["numPisos"]?>" />
        <input name="tipoOficina" type="hidden" value="<?php echo $_POST["tipoOficina"]?>" />
        <input name="numOficina" type="hidden" value="<?php echo $_POST["numOficina"]?>" />
        <input name="tipoTecho" type="hidden" value="<?php echo $_POST["tipoTecho"]?>" />
        <input name="cocineta" type="hidden" value="<?php echo $_POST["cocineta"]?>" />
        <input name="numAscensores" type="hidden" value="<?php echo $_POST["numAscensores"]?>" />
        <input name="escaleras" type="hidden" value="<?php echo $_POST["escaleras"]?>" />
        <input name="tipoLote" type="hidden" value="<?php echo $_POST["tipoLote"]?>" />
        <input name="esquinero" type="hidden" value="<?php echo $_POST["esquinero"]?>" />
        <input name="ubicaLote" type="hidden" value="<?php echo $_POST["ubicaLote"]?>" />
        <input name="todoServicios" type="hidden" value="<?php echo $_POST["todoServicios"]?>" />
        <input name="viaPrincipal" type="hidden" value="<?php echo $_POST["viaPrincipal"]?>" />
        <input name="viaSecundaria" type="hidden" value="<?php echo $_POST["viaSecundaria"]?>" />
        <input name="numBanosInter" type="hidden" value="<?php echo $_POST["numBanosInter"]?>" />
        <input name="canon" type="hidden" value="<?php echo $_POST["canon"]?>" />
        <input name="textoDestacado" type="hidden" value="<?php echo $_POST['textoDestacado']?>" />
        <input name="comentarioUsuario" type="hidden" value="<?php echo $_POST['comentarioUsuario']?>" />
        <input name="video" type="hidden" value="<?php echo $_POST['video']?>" />
         <input name="barrio" type="hidden" value="<?php echo $_POST['barrio']?>" />
        
        <!-- Campos que traigo del plan personalizado-->
        <?php
		// Desactivar toda notificación de error
         error_reporting(0);

		if($_POST['hdd_plan'] == 4)
		{
		?>
        <input name="nFotos" type="hidden" value="<?php echo $_POST['nFotos']?>" />      
        <input name="nVideo" type="hidden" value="<?php echo $_POST['nVideo']?>" />
        <input name="nDestacados" type="hidden" value="<?php echo $_POST['nDestacados']?>" />
        <input name="nMeses" type="hidden" value="<?php echo $_POST['nMeses']?>" />
        <input name="tomaFoto" type="hidden" value="<?php echo $_POST['tomaFoto']?>" />
        <input name="hdd_valor_plan" type="hidden" value="<?php echo $_POST['hdd_valor_plan']?>" />
        <input name="hdd_plan" type="hidden" value="<?php echo $_POST['hdd_plan']?>" />
        <?php
		}
		?>       
        
        <div class="recuadroAzul">
        	<h1 style="color:#808080" align="center">UBIQUE SU INMUEBLE EN EL MAPA</h1>
            <div style="color:#346599" align="center">Por favor mueva el puntero que esta en el mapa a la direcci&oacute;n donde esta ubicado su inmueble "La direcci&oacute;n  no es necesariamente exacta".</div>
            
            <div style="width:960px; float:left;">

                   <table>
                   <tr>
                   		<td><p style="font-size: 10px;font-family: verdana;font-weight: bold;">
                   		Direcci&oacute;n:&nbsp;<input type="text" name="direccionMap" id="direccionMap" value="<?php echo $direccion;?>" style="width: 420px;" />
                   		&nbsp;&nbsp;<input type="button" value="Buscar" onclick="codeAddress()"></p>
                		</td>
                		<td><p style="font-size: 10px;font-family: verdana;font-weight: bold;"><input type="hidden" name="latitud" value="<?php echo $latitud;?>" style="width: 100px;font-size: 10px;font-family: verdana;font-weight: bold;" /></p>
                		</td>
                        <td> <p style="font-size: 10px;font-family: verdana;font-weight: bold;"><input type="hidden" name="longitud" value="<?php echo $longitud;?>" style="width: 100px;font-size: 10px;font-family: verdana;font-weight: bold;" />
                        </p>
                        </td>
                 </tr>
                 </table> 
				
                <div id="mapCanvas"></div>
                
              	<!-- Boton siguiente-->
                <div style="clear; padding-left:10px; padding-top:20px;" align="right">
                <input type="submit" name="button" id="button"  onclick = "this.form.action = 'crearInmueble.php'" value="" style="background:url(imagenes/btnSiguiente.png) no-repeat; width:222px; height:25px; border:none; cursor:pointer" title="Enviar" /></div>
                <!-- Boton siguiente-->
                
            </div>
            
            <div style="clear:left"></div>
            
        </div>
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