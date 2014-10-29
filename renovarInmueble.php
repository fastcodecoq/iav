<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');

$plan = $_GET['plan'];
$codigo = $_GET['cod'];
$codigoTemp = $_GET['temp'];

//Consultamos las fotos del inmueble
$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = ".$codigo;	
$resultado = mysql_query($consulta, $conexion);
while($registroFotos= mysql_fetch_array($resultado))
{
	$insercion = "INSERT INTO fotostemp (nombre_foto, cod_temp) VALUES ('".$registroFotos['foto']."', '$codigoTemp')";
	mysql_db_query($bd_nombre, $insercion);
}


//Consultamos el numero de fotos por plan
$consulta = "SELECT * FROM planes WHERE id = ".$plan;	
$resultado = mysql_query($consulta, $conexion);
$registro= mysql_fetch_array($resultado);

if($plan == 1 || $plan == 2 || $plan == 3)
{	
	$nfotos = $registro['nfotos'];
}
else
{
	$nfotos = $_POST['nFotos'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">

<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript" src="subir_imagenes_ajax/ajaxupload.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		var button = $('#upload'), interval;
		new AjaxUpload(button,{
			action: 'subir_imagenes_ajax/procesa.php', 
			name: 'image[]',
			onSubmit : function(file, ext){
				// cambiar el texto del boton cuando se selecicione la imagen	
				if (! (ext && /^(jpg|png|jpeg|gif|JPG|JPGE|PNG)$/.test(ext))){
            	// extensiones permitidas
            	alert('Solo se permiten imagenes');
            	// cancela upload
            	return false;
        		} 
				else {	
					this.setData({
					codTemp: '<?php echo $codigoTemp?>',
					numFotos: '<?php echo $nfotos?>'
					});	
					button.text('Subiendo');
					// desabilitar el boton
					this.disable();
					
					interval = window.setInterval(function(){
						var text = button.text();
						if (text.length < 11){
							button.text(text + '.');					
						} else {
							button.text('Subiendo');				
						}
					}, 200);
				};
			},
			onComplete: function(file, response){
				button.text('Subir Foto');
							
				window.clearInterval(interval);
							
				// Habilitar boton otra vez
				this.enable();
				if(response == 0){
					alert('El plan escojido solo permite subir <?php echo $nfotos?>');
					return false;
				}
				
				// Añadiendo las imagenes a mi lista
				
				if($('#gallery li').length == 0){
					$('#gallery').html(response).fadeIn("fast");
					$('#gallery li').eq(0).hide().show("slow");
				}else{
					$('#gallery').prepend(response);
					$('#gallery li').eq(0).hide().show("slow");
				}
			}
		});
		
		// Listar  fotos que hay en mi tabla
		$("#gallery").load("subir_imagenes_ajax/procesa.php?action=listFotos&codTemp=<?php echo $codigoTemp?>");
		
		// Eliminar
		
		$("#gallery li a").live("click",function(){
			var a = $(this)
			$.get("subir_imagenes_ajax/procesa.php?action=eliminar",{id:a.attr("id")},function(){
				a.parent().fadeOut("slow")
			})
		})
	});

</script>

<style type="text/css">
	#content{
		width:970px;
		margin:10px auto;
		/*height:550px;
		border:6px solid #F3F3F3;*/
		padding-top:10px;
		overflow-y:auto;
		border:0;
	}
	#upload{  
		padding:12px;  
		font:bold 12px Arial, Helvetica, sans-serif;
        text-align:center;  
        background:#f2f2f2;  
        color:#3366cc;  
        border:1px solid #ccc;  
        width:150px;
		display:block;  
        -moz-border-radius:5px;
		-webkit-border-radius:5px; 
		margin:0 auto; 
		text-decoration:none
    }
	#gallery{
		list-style:none;
		margin:10px 0 0 0;
		padding:0
	}
	#gallery li{
		display:block;
		float:left;
		width:100px;
		height:100px;
		background:#CCC;
		border:1px solid #999;
		text-align:center;
		padding:6px 0;
		margin:5px 0 5px 20px;
		position:relative
	}
	#gallery li img{
		width:95px;
		height:95px
	}
	#gallery li a{
		position:absolute;
		right:10px;
		top:10px
	}
	#gallery li a img{ width:auto; height:auto}
	
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
        <form action="registroInmueblesUbicacion.php" method="post" enctype="multipart/form-data" id="registro">
        <input name="hdd_tipoCliente" type="hidden" value="<?php echo $_POST['hdd_tipoCliente']?>" /> 
        <input name="cod_temp" type="hidden" value="<?php echo $_POST['cod_temp']?>" />
        <input name="plan" type="hidden" value="<?php echo $_POST['plan']?>" />
		<input name="tipoInmueble" type="hidden" value="<?php echo $_POST['tipoInmueble']?>" />
        <input name="negociacion" type="hidden" value="<?php echo $_POST['negociacion']?>" />
        <input name="ciudad" type="hidden" value="<?php echo $_POST['ciudad']?>" />
        <input name="direccion" type="hidden" value="<?php echo $_POST['direccion']?>" />
        <input name="nomContacto" type="hidden" value="<?php echo $_POST['nomContacto']?>" />
        <input name="telContacto" type="hidden" value="<?php echo $_POST['telContacto']?>" />
        <input name="celContacto" type="hidden" value="<?php echo $_POST['celContacto']?>" />
        <input name="nomBarrio" type="hidden" value="<?php echo $_POST["nomBarrio"]?>" />
        <input name="tipoBodega" type="hidden" value="<?php echo $_POST["tipoBodega"]?>" />
        <input name="numOficinas" type="hidden" value="<?php echo $_POST["numOficinas"]?>" />
        <input name="tiempo" type="hidden" value="<?php echo $_POST["tiempo"]?>" />
        <input name="vlrventa" type="hidden" value="<?php echo str_replace(".","",$_POST["vlrventa"])?>" />
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
        <input name="vlrAdmon" type="hidden" value="<?php echo str_replace(".","",$_POST["vlrAdmon"])?>" />
        <input name="parqVisitantes" type="hidden" value="<?php echo $_POST["parqVisitantes"]?>" />
        <input name="numLineas" type="hidden" value="<?php echo $_POST["numLineas"]?>" />
        <input name="tipoFinca" type="hidden" value="<?php echo $_POST["tipoFinca"]?>" />
        <input name="tiempoArriendo" type="hidden" value="<?php echo str_replace(".","",$_POST["tiempoArriendo"])?>" />
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
        <input name="canon" type="hidden" value="<?php echo str_replace(".","",$_POST["canon"])?>" />
        <input name="textoDestacado" type="hidden" value="<?php echo $_POST['textoDestacado']?>" />
        <input name="comentarioUsuario" type="hidden" value="<?php echo $_POST['comentarioUsuario']?>" />
        
        
        <!-- Campos que traigo del plan personalizado-->
        <?php
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
        	<h1 style="color:#808080" align="center">RENOVAR INMUEBLE</h1>
            <div style="padding:10px; 15px;">Plan:
            	<select name="plan" id="plan" class="validate[required] text-input" style="width:150px;">
				<?php
                for ($i=1; $i <= 4; $i++)
                {
                ?>
                  <option value="<?php echo $i;?>" <?php if($plan == $i){ echo "selected";}?>><?php echo planes($i)?></option>
                <?
                }
                ?>
                </select></div>
            <div style="color:#346599; padding:5px 15px;">Por favor revise que sus fotograf&iacute;as pesen como m&aacute;ximo 300Kb y no contengan caractes especiales (&ntilde;, espacios ni tildes). Se aceptan solo im&aacute;genes con formato (JPG, JPGE Y PNG)</div>
            
            <div style="width:960px; float:left;">
           	  <div id="content" align="center">
                    <a href="javascript:('2');" id="upload">Subir Foto</a>
                    <ul id="gallery">
                        <!-- Cargar Fotos -->
                    </ul>
              </div>


                <div style="clear; padding-left:10px;" align="right"><input type="button" name="button" id="button" value="" style="background:url(imagenes/btnSiguiente.png) no-repeat; width:222px; height:25px; border:none; cursor:pointer" title="Siguiente" /></div>
            </div>
            
            <div style="clear:left"></div>
            
        </div>
        </form>
        <!-- Registro -->
  </div>
</section>

<section>
	<?php include('bannerInferior.php')?>
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>