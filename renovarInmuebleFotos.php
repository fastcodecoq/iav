<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');

$plan = $_POST['plan'];
$codigo = $_POST['cod'];
$codigoTemp = $_POST['temp'];

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

 if($_SESSION["rol"] === "3")
 	$nfotos = 35;

//Consultamos las fotos del inmueble
$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = ".$codigo;	
$resultado = mysql_query($consulta, $conexion);
$i=1;
while($registroFotos= mysql_fetch_array($resultado))
{
	if($i<=$nfotos)
	{
	$insercion = "INSERT INTO fotostemp (nombre_foto, cod_temp) VALUES ('".$registroFotos['foto']."', '$codigoTemp')";
	mysql_db_query($bd_nombre, $insercion);
	}
	$i++;
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
		list-style: none;
margin: 10px auto;
padding: 0;
overflow: hidden;
width: 732px !important;
display: table;
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

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
  <div style="clear:left; padding-top:10px;" class="contenedor">
    	<!-- Registro -->
        <form action="actualizarInmuebleRenovacion.php" method="post" enctype="multipart/form-data" id="registro">
        <input name="codigo" type="hidden" value="<?php echo $_POST['cod']?>" /> 
        <input name="cod_temp" type="hidden" value="<?php echo $_POST['temp']?>" />
        <input name="plan" type="hidden" value="<?php echo $_POST['plan']?>" />
        <input name="hdd_accion" type="hidden" value="renovar" />
     
        
        
        <!-- Campos que traigo del plan personalizado-->
        <?php
		if($_POST['plan'] == 4)
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
        	<h1 style="color:#808080" align="center">RENOVAR INMUEBLE - Plan <?php echo planes($plan)?></h1>
            <div style="color:#346599; padding:5px 15px;">Por favor revise que sus fotograf&iacute;as pesen como m&aacute;ximo 300Kb y no contengan caractes especiales (&ntilde;, espacios ni tildes). Se aceptan solo im&aacute;genes con formato (JPG, JPGE Y PNG)</div>
            
            <div style="width:960px; float:left;">
           	  <div id="content" align="center">
                    <a href="javascript:('2');" id="upload">Subir Foto</a>
                    <ul id="gallery">
                        <!-- Cargar Fotos -->
                    </ul>
              </div>


                <div style="clear; padding-left:10px;" align="right"><input type="submit" name="button" id="button" value="" style="background:url(imagenes/btnSiguiente.png) no-repeat; width:222px; height:25px; border:none; cursor:pointer" title="Siguiente" /></div>
            </div>
            
            <div style="clear:left"></div>
            
        </div>
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