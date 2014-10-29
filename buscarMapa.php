<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');

// INICIALIZO LAS VARIABLES PARA EL MAPA
$latitud= "4.60971";
$longitud="-74.08175";
$zoom= "6";
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
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyCqBOtWjy5lxnrIg4PZXpYDPfFuvXQ8-h4" type="text/javascript"></script>

<link href="selectEstilos/css/core.css" media="screen" rel="stylesheet" type="text/css">
<link href="selectEstilos/css/core-ui-select.css" media="screen" rel="stylesheet" type="text/css">
<link href="selectEstilos/css/jquery.scrollpane.css" media="screen" rel="stylesheet" type="text/css">

<script src="selectEstilos/js/lib/jquery/plugins/jquery.mousewheel.js"></script>
<script src="selectEstilos/js/lib/jquery/plugins/jquery.scrollpane.js"></script>
<script src="selectEstilos/js/jquery.core-ui-select.js"></script>
<script type="text/javascript" src="funciones/script_cajas.js"></script>
<script language="javascript">
$(document).ready(function() {	
	
	$('#tipoInmueble').coreUISelect();
	$('#departamento').coreUISelect();
	$('#ciudad').coreUISelect();
	$('#para').coreUISelect();
	
	// Formulario y tipo de datos para el validador
	jQuery("#form_mapa").validationEngine();
	jQuery('input').attr('data-prompt-position','topLeft');
	jQuery('select').attr('data-prompt-position','topLeft');
	jQuery('textarea').attr('data-prompt-position','topLeft');
	
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
				$('#ciudad').coreUISelect();
            });            
        });
   })

});
</script>
<!-- mAPA -->

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
    //<![CDATA[

    window.customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
	  generico: {
		  icon:'/imagenes/apuntador.png'
	  },
	  
    };

      var geocoder;
    var map;
      var infoWindow = new google.maps.InfoWindow;
      window.map;

    function load() {

  
      map = new google.maps.Map(document.getElementById("mapCanvas"), {
        center: new google.maps.LatLng(<?php echo $latitud?>, <?php echo $longitud?>),
        zoom: <?php echo $zoom?>,
        mapTypeId: 'roadmap'
      });

      load_rs();

    }

	  // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
	function codeAddress() {
        var address = document.form_mapa.ciudad.value;
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
	  
    function load_rs(){

      // Change this depending on the name of your PHP file
      downloadUrl("phpsqlajax_genxml.php?tipo=<?php echo $_POST['tipoInmueble']?>&para=<?php echo $_POST['para']?>&ciudad=<?php echo $_POST['ciudad']?>", function(data) {
        var xml = data.responseXML;        
        var markers = xml.documentElement.getElementsByTagName("marker");        
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var short = markers[i].getAttribute("short");
          var precio = markers[i].getAttribute("precio");
          var type = markers[i].getAttribute("type");
		  var foto = markers[i].getAttribute("foto");
		  var tipoIn = markers[i].getAttribute("tipoIn");
		  var barrio = markers[i].getAttribute("barrio");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<div style='float:left; width:350px; height:110px;overflow-x:hidden; overflow-y:hidden;'><div style='float:left; padding-right:10px;'><img src='redimencionar.php?src=fotoinmueble/"+foto+"&w=100' /> </div> <div style='float:left; font-size:14px; padding-bottom:8px; font-weight:bold; width:200px'>"+tipoIn+"</div><br/> <div style='float:left; font-size:14px; font-weight:bold; padding-bottom:8px; width:200px'>$ "+precio+"</div><br/> <div style='float:left; font-size:12px; font-weight:bold; padding-bottom:8px; width:200px'>"+barrio+"</div><br/> <div style='float:left; padding-top:15px' align='center'><a href='"+short+"' target='_blank' class='boton medium naranja'>Ver Inmueble</a></div></div>";

          var icon = customIcons['generico'] || { icon : "http://inmueblealaventa.com.co/imagenes/apuntador.png"};
          var marker = new google.maps.Marker({
            map: map,
            position: point,            
            shadow: icon.shadow,
            icon : icon.icon            
          });
          
          map.setCenter(point)
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });

      }
    
  

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
		map.setZoom(12);
		map.setCenter(marker.getPosition());
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
 

<style type="text/css">
  #mapCanvas { height: 600px; background:#FFF;}
</style> 
</head>

<body onload="load()">

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
	<div class="contenedor">
    <div><h1>Por Mapa</h1></div>
    <!-- Espacio para el buscador-->
    <div style="padding-top:15px; padding-left:20px; background:url(imagenes/fondoBuscadorMapa.png); height:64px;">
    <form action="" method="post" name="form_mapa" id="form_mapa">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="250px">
        	<div style="color:#FFF; font-weight:bold;">En qu&eacute; Departamento?</div>
        	<div style="padding-top:5px; width:190px;"><select name="departamento" id="departamento" style="width:190px; height:25px;" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
            <option value="" selected="selected">- Escoja -</option>
            <?php
            $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
            $resultado_dep = mysql_query($consulta, $conexion);
            
            while ($registro_dep= mysql_fetch_array($resultado_dep))
            {
            ?>
            <option value="<?php echo $registro_dep["iddepartamento"]?>" <?php if($_POST["departamento"] == $registro_dep["iddepartamento"]) { echo "selected"; } ?>> <?php echo $registro_dep["nombre"]?> </option>
            <?php
            }
            ?>
        </select></div>
        </td>
        <td width="250px">
        	<div style="color:#FFF; font-weight:bold">En qu&eacute; Ciudad</div>
        	<div style="padding-top:5px; width:190px;">
            <select name="ciudad" style="width:190px; height:25px" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
            	<?php
				$consulta = "SELECT * FROM municipio WHERE departamento_iddepartamento = '".$_POST["departamento"]."' ORDER BY nombreMunicipio ASC";
				
				$resultado_ciu = mysql_query($consulta, $conexion);
				
				while ($registro_ciu= mysql_fetch_array($resultado_ciu))
				{
				?>
					<option value="<?php echo $registro_ciu["idmunicipio"]?>" <?php if($_POST['ciudad'] == $registro_ciu["idmunicipio"]) { echo "selected"; } ?> ><?php echo $registro_ciu["nombreMunicipio"]?></option>
				<?php
                }
                ?>
                <option value="">- Escoja -</option>
        	</select></div>
        </td>
        <td>
        	<div style="color:#FFF; font-weight:bold;">Qu&eacute; inmueble busca?</div>
        	<div style="padding-top:5px; width:150px"><select name="tipoInmueble" id="tipoInmueble" style="width:150px; height:25px" class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
            <option value="">- Escoja -</option>
            <option value="0" <?php if($_POST['tipoInmueble'] == 0){ echo 'selected'; }?>>Cualquiera</option>
            <?php
            $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
            $resultado = mysql_query($consulta, $conexion);
            
            while ($registro= mysql_fetch_array($resultado))
            {
            ?>
            <option value="<?php echo $registro["tip_inm"]?>" <?php if($_POST['tipoInmueble'] == $registro["tip_inm"]){ echo 'selected';}?>> <?php echo $registro["dest_tip"]?> </option>
            <?php
            }
            ?>
        </select></div>
        </td>
        <td>
        	<div style="color:#FFF; font-weight:bold; ">Para qu&eacute;?</div>
            <div style="padding-top:5px;width:150px;">
            <select name="para" style="width:150px; height:25px" id="para" class="validate[required]">
                <option value="">- Escoja -</option>
                <option value="1" <?php if($_POST['para'] == 1){ echo 'selected'; }?>>Compra</option>
                <option value="2" <?php if($_POST['para'] == 2){ echo 'selected'; }?>>Arriendo</option>
                <option value="3" <?php if($_POST['para'] == 3){ echo 'selected'; }?>>Alquiler</option>
            </select>
            
            <input type="hidden" name="latitud" value="<?php echo $latitud;?>" />
            <input type="hidden" name="longitud" value="<?php echo $longitud;?>" />
            </div>
        </td>
        <td style="padding-top:15px"><a href="#" onclick="if(jQuery('#form_mapa').validationEngine('validate') == true) { jQuery('#form_mapa').submit();}"><img src="imagenes/btIr.png" width="81" height="25" border="0" style="cursor:pointer" /></a></td>
      </tr>
    </table>
    </form>
    </div>
   <div style="height:20px"></div> 
    <!-- Mapa -->
    <div>
    	<div id="mapCanvas"></div>
    </div>
  </div>    
  <div style="clear:left">&nbsp;</div>
</section>

<section>
	<?php //include('bannerInferior.php')?>
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>