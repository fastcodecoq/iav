<?php
include('controlSesion.php');
require('bd.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es">
<title>Inmobiliarias en colombia, finca raiz en venta y arriendo Bogota</title>
<meta property="og:url" content="http://www.inmueblealaventa.com/buscarInmobiliaria/">
<meta property="og:title" content="Inmobiliarias en colombia inmueble a la venta">
<meta property="og:description" content="inmobiliarias en colombia, encuentre un listado completo de inmobiliarias en colombia, busque y encuentre su inmueble en arriendo y venta aqui en inmueble a la venta">
<meta property="og:type" content="other">
<meta property="og:image" content="http://www.inmueblealaventa.com/imagenes/logo.png">
<meta name="description" content="inmobiliarias en colombia, encuentre un listado completo de inmobiliarias en colombia, busque y encuentre su inmueble en arriendo y venta aquí en inmueble a la venta.com">
<meta name="keywords" content="inmobiliarias en colombia, inmobiliarias en bogota, inmobiliarias en cali, inmobiliarias en medellin, apartamentos en bogota, venta y arriendo de inmubles">
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="funciones/jsinmovi.js"></script>
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
	<div class="contenedor" id="contenedor1">
    	<div>
    	  <h1>Inmobiliarias en colombia, venta y arriendo de inmuebles</h1></div>
        
        <!-- Logos Inmobiliarias -->
        <form action="" method="post">
        <div style="background:#FFF; float:left; width:760px; min-height:970px;">
        	<!-- Banner -->
        	<div style="padding:20px;">
        	<table style="width:100%">
        	 <tbody>
           		<?php
				$consulta = "SELECT * FROM usuarios WHERE tipoUsuario = 3 AND banner1 != '' ORDER BY id DESC";	
				$resultado = mysql_query($consulta, $conexion);	
				$num_banners = mysql_num_rows($resultado);		

				echo "<tr> <td colspan='2'> <h2> {$num_banners}  Inmobiliarias encontradas.</h2> <br/><br/></td></tr>";

				while ($registro = mysql_fetch_array($resultado))
				{

					if(empty($registro['banner1']))
						continue;

					$img = $registro['banner1'] ;
					$dir = empty($registro['direccion']) ? '' : "<b>Dirección:</b> {$registro['direccion']}";
					$url = empty($registro['url']) || $registro['url'] === '#' ? '' : "<a href='{$registro['url']}' target='_blank'>Sitio web</a>";

					
					?><tr style="padding:15px 0; border-top:1px solid #ccc">
					<td style="width:70%">
					 			<h3 style="color:#0089CE; padding:0; font-weight:bold; height:auto; margin:0"><a href="/propiedades_.php?inm=<?php echo $registro['identificacion']?>" ><?php echo $registro["nombreEmpresa"] ?></a></h3>
					 			<br/>
					 			<p style="font-size:14px; padding:0; margin:0">
					 			 <?php 



					 			       echo "{$dir}<br /> 
					 			 			 <b>Teléfono:</b> {$registro['telefono']} <br /> 
					 			             <b>Celular:</b> {$registro['celular']} <br />
					 			             {$url}
					 			             " 
					 			          ?>
					 			</p>
			
					</td>
					<td>
					 <table style="width:100%">
					 	<tbody>					 	
					 		<tr>
					 			<td>
					 					<a  style="float:right; display:block" href="/propiedades_.php?inm=<?php echo $registro['identificacion']?>" >
					<img src="/pic.php?i=/bannerInmobiliariaConstructora/<?php echo "{$img}&width=100&make=show";?> " width="100"  title="Visitar Inmobiliaria" />
					</a>					 			
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>
					 				<a class="boton-cool" style="float:right; display:block; font-size:12px" href="/propiedades_.php?inm=<?php echo $registro['identificacion']?>" >Ver Inmuebles</a>
					 			</td>
					 		</tr>
					 	</tbody>
					 </table>
					<td>
					
					</tr>
					<tr><td colspan="2">
						<div style="border-top:1px dotted #ccc; display:block"></div>
						<br>
					</td></tr>
                    <?php

				}
				
				for($i=$num_banners; $i<3; $i++)
				{
				?>
				<div class="recuadroAzul" style="margin-bottom:20px" align="center"><img src="imagenes/constructora4.png" width="550" height="100" title="" /></div>	
              <?php
				}
				?>
				 </tbody>
				</table>
            </div>
            
            <div style="clear:left"></div>
        </div>
        </form>
        
        <!-- Buscador -->
        <?php //include('buscador.php')?>
        
    	<!-- Noticias -->
    	<?php /*?><div style="float:left; width:295px; margin:0px 0px; background:#F1F1F1; padding:10px; height:215px; margin-left:30px; margin-top:20px; ">
            <div class="titulosFiltroNaranja" style="padding:10px 0; clear:lef; font-size:16px; border-bottom:#999 1PX solid;"><strong>Noticias</strong></div>
            <?php
			$consulta = "SELECT * FROM noticias ORDER BY id DESC LIMIT 0,1 ";
            $resultado = mysql_query($consulta, $conexion);
            $num_registros = mysql_num_rows($resultado);

            $registro = mysql_fetch_array($resultado);
			
			if($num_registros > 0)
			{

			
				if (file_exists("imgNoticias/".$registro["imagen"]))
				{ 
				   $foto=$registro["imagen"];
				}else{ 
				$extension = explode(".", $registro["imagen"]);
				$nombre = $extension[0];
				$extension = $extension[sizeof($extension)-1];
				$foto = "";

					switch ($extension)
					{
						case 'JPG':		$foto = $nombre.".jpg";
										break;
						case 'JPGE':	$foto = $nombre.".jpg";
										break;
						default:		$foto = $nombre.".jpg";
										break;
					}
				}
				?>
            <div style="float:left; width:150px; padding-top:10px;"><a href="noticia.php?not=<?php echo $registro['id']?>"><img src="redimencionar.php?src=imgNoticias/<?php echo $foto."&amp;w=126&h=152"?>" border="0" title="Ver informacion"  style="border:#CCC 5px solid"/></a></div>
            <div style="float:left; width:120px; padding-top:10px;">
			
			  <div style="padding-bottom:10px; padding-top:20px; font-size:1.2em"><strong><?php echo $registro['titulo']?></strong></div>
    </div>
	<?php
			}
			else
			{
			?>
            <div style="padding-top:40px">No existen noticias</div>
            <?php
			}
			?>
            <a href="noticia.php?not=<?php echo $registro['id']?>"><div style="background: url(imagenes/btn_mas.png) no-repeat; width: 40px; height: 40px; position:relative; z-index: 99; left: 265px; top: 145px;"></div></a>
  </div><?php */?>
        <div style="float:left; margin-left:30px;overflow:hidden; background:#FFF; border:#989898 1px solid; width:200px; min-height:211px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
        	<h1  style="padding-left:15px; font-size:12px"><img src="/imagenes/flecha.png" width="19" height="18" />Enlaces recomendados</h1>

            <hr style="border: 0; border-bottom: 1px dashed #F90;" size="1">
			<?php /*?><?php
            $consulta = "SELECT * FROM noticias ORDER BY n_visitas DESC LIMIT 0,5";	
            $resultado = mysql_query($consulta, $conexion); 
			$numRegistros = mysql_num_rows($resultado);
            while($registro= mysql_fetch_array($resultado))
			{
			?>
            	<li style="padding-left: 12px; padding-bottom:4px; background: url(/imagenes/bullet_black.png) 0em 0.5em no-repeat;    margin-bottom: 1em; margin-left:-25px; border-bottom:#CCC 1px dotted; margin-right:15px;"><a href="noticia.php?not=<?php echo $registro["id"]?>" class="lomasleido"><?php echo $registro['titulo']?></a></li>
            <?php
            }
			?><?php */?>
           
			<?php
			
			
			
			
             $sql="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
				FROM inmueble, municipio, departamento, tipo_in
				WHERE inmueble.estado =1
				AND municipio.idmunicipio = inmueble.ciudad 
				AND municipio.departamento_iddepartamento = departamento.iddepartamento 
				ORDER BY RAND( )
				LIMIT 11 "; 
			
			
			
$ejecuta=mysql_query($sql);
while ($muestra=mysql_fetch_assoc($ejecuta))
{
	$tipoin="";
	if($muestra['tipo_neg']==1){		$tipoin="Venta";	}
	else if ($muestra['tipo_neg']==2){ 	$tipoin="Arriendo";	}
	
 echo '<a href="/lo-mas-leido/'.$muestra['tipo_neg'].'/'.$muestra['tip_inm'].'/'.$muestra['ciudad'].'" style="color:#000;"" ><div  style="font-size:10px; margin-left:5px">'.$tipoin." ".$muestra['dest_tip']." ".$muestra['nombreMunicipio']."  &nbsp;".'</div></a><br />';

}
?>
           
           
           
            </div>
        <!-- Turismo-->
        <?php /*?><div style="float:left; width:290px; margin:0px 0px; background:#F1F1F1; padding:10px; height:215px; margin-top:20px; margin-left:30px; ">
            <div class="titulosFiltroNaranja" style="padding:10px 0; clear:lef; font-size:16px; border-bottom:#999 1PX solid;"><strong>TURISMO - Hoteles</strong></div>
            <?php
			$consulta = "SELECT *, left(descripcion, 300) AS text FROM hoteles WHERE estado = 1 LIMIT 0,1";
            $resultado = mysql_query($consulta, $conexion);
            $num_registros = mysql_num_rows($resultado);

            $registro = mysql_fetch_array($resultado);
			
			if($num_registros > 0)
			{

				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_hotel WHERE cod_hot = '".$registro['id']."' LIMIT 0,1";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				
				if (file_exists("fotosHoteles/".$registroFoto["foto"]))
				{ 
				   $foto=$registroFoto["foto"];
				}else{ 
				$extension = explode(".", $registroFoto["foto"]);
				$nombre = $extension[0];
				$extension = $extension[sizeof($extension)-1];
				$foto = "";

					switch ($extension)
					{
						case 'JPG':		$foto = $nombre.".jpg";
										break;
						case 'JPGE':	$foto = $nombre.".jpg";
										break;
						default:		$foto = $nombre.".jpg";
										break;
					}
				}
				?>
            <div style="float:left; width:150px; padding-top:10px;"><a href="hotel.php?cod=<?php echo $registro['id']?>"><img src="redimencionar.php?src=fotosHoteles/<?php echo $foto."&amp;w=126&h=152"?>" border="0" title="Ver informacion"  style="border:#CCC 5px solid"/></a></div>
            <div style="float:left; width:120px; padding-top:10px;">
			
			  <div style="padding-bottom:10px; padding-top:20px"><strong><?php echo $registro['nombre']?></strong></div>
              <div style="padding-bottom:10px">Habitación x Noche desde</div>
              <div style="padding-bottom:10px"><span style="color:#336498; font-size:1.7em; font-weight:bold;"><?php echo "$".number_format($registro['precioNoche'],0,',','.')?></span></div>
    </div>
	<?php
			}
			else
			{
			?>
            <div style="padding-top:40px">No existen hoteles</div>
            <?php
			}
			?>
           	<a href="hotel.php?cod=<?php echo $registro['id']?>"><div style="background: url(imagenes/btn_mas.png) no-repeat; width: 40px; height: 40px; position:relative; z-index: 99; left: 265px; top: 145px;"></div></a>
        </div><?php */?>
        
        <!-- Div en blanco-->
        <div style="clear:left; height:20px;"></div>
        
    </div>    
</section>


<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>