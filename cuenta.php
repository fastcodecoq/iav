<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
include('funciones/fechas.php');

$idciu=(int)($_GET["ciudad"]);
$idciu = htmlspecialchars(trim($idciu)); 
$idciu = stripslashes($idciu);
$idciu = mysql_real_escape_string($idciu);
if ((int)$_GET["ciudad"]!=0 || (int)$_GET["ciudad"]!="")
{
$traerciudad="select m.nombreMunicipio as ciudad, d.nombre as departamento, d.iddepartamento, m.idmunicipio
			from municipio m, departamento as d
			where d.iddepartamento=m.departamento_iddepartamento
			and idmunicipio=".$_GET["ciudad"]."";
$ejecutaciudad=mysql_query($traerciudad);
$muestraciudad=mysql_fetch_assoc($ejecutaciudad);
$nomciudad=$muestraciudad['ciudad'];
$cociudad=$muestraciudad['idmunicipio'];
$nomdepto=$muestraciudad['departamento'];
$coddpto=$muestraciudad['iddepartamento'];
}

			
			$tipoInmueble = 0;
			$ciudad = 0;
			$area = 0;
			$tipoBusqueda=0;
			$precio=0;
			
			if (isset($_POST['tipoInmueble']))
			{
				$tipoInmueble = $_POST['tipoInmueble'];
			}
			
			
			if (isset($_POST['ciudad']))
			{
				$ciudad = $_POST['ciudad'];
			}
			
			
			if (isset($_POST['area']))
			{
				$area = $_POST['area'];
			}
			
			if (isset($_POST['precio']))
			{
				$precio = $_POST['precio'];
			}
			
			if (isset($_POST['para']))
			{
				$tipoBusqueda = $_POST['para'];
			}
			
			/*
			echo "232".$tipoInmueble;

			$tipoInmueble = $_GET['tipoInmueble']; //1 venta 2 Arriendo 3 Alquiler
			$ciudad = $_GET['ciudad'];
			$area = $_GET['area'];
			$tipoBusqueda=$_GET['para'];
			*/
			
			 if($tipoInmueble == 0)
			{
				$condTipInm = "";
			}
			else
			{
				$condTipInm = " AND inmueble.tipo_inm = $tipoInmueble";
			}
			
			
			if($tipoBusqueda == 1)
			{
				
									
									$tipo_negociacion = " AND inmueble.tipo_neg IN ($tipoBusqueda,3) ";
			}
			
			// Para Arriendo
			if($tipoBusqueda == 2)
			{
				
									$tipo_negociacion = " AND inmueble.tipo_neg IN ($tipoBusqueda,3) ";
			}
			
			if($area == 0)
			{
				$condarea = "";
			}
			else
			{
				
				$traevalor="select * from area where idarea='".$area."'";
				$muestra=mysql_query($traevalor);
				$ejecutaarea=mysql_fetch_assoc($muestra);
				$areaini=$ejecutaarea['areaini'];
				$areafin=$ejecutaarea['areafin'];
				
				$condarea = " AND $areaini <= inmueble.campo_6 and $areafin >= inmueble.campo_6";
			}
			
			
			if($tipoBusqueda != 0)
					{
					
							 $tipo_negociacion = " AND inmueble.tipo_neg = $tipoBusqueda ";
					}
					
							
			if($precio == 0)
			{
				$condprecio = "";
			}
			else
			{
				
				$traevalor="select * from precio where idpre='".$precio."'";
				$muestra=mysql_query($traevalor);
				$ejecutaarea=mysql_fetch_assoc($muestra);
				$preini=$ejecutaarea['preini'];
				$prefin=$ejecutaarea['prefin'];
				
				if($tipoBusqueda == 1)
					{
					
							 $condprecio = " AND $preini <= inmueble.campo_5 and $prefin >= inmueble.campo_5";
					}
					else if($tipoBusqueda == 2)
							{
								
									$condprecio = " AND $preini <= inmueble.campo_53 and $prefin >= inmueble.campo_53";
								
							}
							
							
				//$condprecio = " AND $areaini <= inmueble.campo_6 and $areafin >= inmueble.campo_6";
			}
			
			if($ciudad != 0)
			{
				$condCiudad = " AND inmueble.ciudad = $ciudad";
			}
			else
			{
				$condCiudad = "";
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cuenta de edición de inmuebles</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="admin/estilos/tabs.css" rel="stylesheet" type="text/css" />
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript" src="funciones/script.js"></script>
<script>

</script>

<!-- cargar login -->
<!--<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$("a#inmueble").fancybox({
		'padding'		: 0,
		'autoDimensions': false,
		'centerOnScroll' : true,
		'overlayOpacity' : 0.1,
		'hideOnOverlayClick' : false,
        'height': 460,
       	'width': 350,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'type' : 'iframe'
	});
});
</script> -->

<script type="text/javascript">

jQuery(document).ready(function() {


	// Formulario y tipo de datos para el validador
	//jQuery("#filtros").validationEngine();
	jQuery('input').attr('data-prompt-position','topLeft');
	jQuery('select').attr('data-prompt-position','topLeft');
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
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
	<div class="contenedor">
    </div>    
</section>

<section>
  <div class="contenedor">
		<div><h1>Mi Cuenta</h1></div>
        <div style=" min-height:700px;">

<div style="float:left; background:#FFF; border:#989898 1px solid; width:200px; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
                <div style="padding:10px; font-size:18px;">Filtros</div>
                <div style="margin-left:5px; margin-right:5px">
                <form name="filtros" id="filtros" method="post"  action="cuenta.php">
                <table width="100%" border="0">
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>	
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Ciudad</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                           <script type="text/javascript" src="funciones/jquery.js"></script>

          <script type="text/javascript" src="funciones/script.js"></script>
		<span> <input type="text"  name="ciudad" id="ciudad" placeholder="Ciudad"></span>
		<input type="hidden"  name="idciudad" id="idciudad" >
		 <div id="ajax_response"></div>
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
                    <select name="tipoInmueble" id="tipoInmueble" style="width:140px;" >
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
                    <select name="para" style="width:140px;" id="para"  >
                        <option value="">- Escoja -</option>
                        <option value="1">Compra</option>
                        <option value="2">Arriendo</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>   
                            
                           
                               
                  <tr>
                    <td colspan="2" class="titulosFiltroNaranja">Precio</td>
                  </tr>                                                  
                        
				 		  
                                 	
				  <tr>
				    <td colspan="2"><select name="precio" id="precio"   >
                  
                <option value="0">- Precio -</option>
                <?php
                $consulta = "SELECT idpre , preini,  preini , predesc  FROM precio ORDER BY preini ASC";	
                $resultado = mysql_query($consulta, $conexion);
               
                while ($registro= mysql_fetch_array($resultado))
                {
                ?>
                <option value="<?php echo $registro["idpre"]?>"> <?php echo $registro["predesc"]?> </option>
                <?php
                }
                ?>
              </select>
              </td>
			      </tr>
                  <tr>
				    <td colspan="2" class="titulosFiltroNaranja">Area</td>
			      </tr>
				  <tr>
				    <td colspan="2">
                    
                    <select name="area" id="area"  >
                  
                <option value="0">- Area -</option>
                <?php
                $consulta = "SELECT idarea , areaini,  areafin , areadesc  FROM area ORDER BY areaini ASC";	
                $resultado = mysql_query($consulta, $conexion);
               
                while ($registro= mysql_fetch_array($resultado))
                {
                ?>
                <option value="<?php echo $registro["idarea"]?>"> <?php echo $registro["areadesc"]?> </option>
                <?php
                }
                ?>
              </select>
                    </td>
			      </tr>
				  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Filtrar" class="boton bigrounded naranja"  /></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
                </form>
                </div>
                </div>
	<div style="float:left; width:690px; margin-left:30px;"  id="contenedor1">
    	
    
    	<ul class="tabs">
                    
                    <li><a href="#tab1"><strong>Mis Inmuebles</strong></a></li>
                    <li><a href="#tab2"><strong>Datos b&aacute;sicos</strong></a></li>
                    <!--<li><a href="#tab3"><strong>Sus transacciones</strong></a></li>-->
    </ul>
    	<div class="tab_container">
        <div id="tab1" class="tab_content" style="min-height:400px;">
          <form action="#" method="post" id="frm_cuenta" name="frm_cuenta">
         <?php 
          //Consulta de los inmuebles de cada cliente
          $consulta = "SELECT municipio.nombreMunicipio, tipo_in.dest_tip, inmueble.* FROM inmueble 
    JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm
    JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
    WHERE usuario = ".$_SESSION['idusuario']."  $condTipInm   $condarea $condprecio  $condCiudad $tipo_negociacion ORDER BY codigo DESC";
	
          $resultado = mysql_query($consulta, $conexion);
          $num_inm = mysql_num_rows($resultado);	


		  //Consulta de los datos del usuario
          $consultaUsu = "SELECT usuarios.*, municipio.nombreMunicipio, inmueble.*
FROM usuarios , inmueble, municipio
where usuarios.ciudad = municipio.idmunicipio and identificacion = ".$_SESSION['idusuario']." $condTipInm $condarea   $condprecio $condCiudad $tipo_negociacion"; 


          $resultadoUsu = mysql_query($consultaUsu, $conexion);
          $registroUsu= mysql_fetch_array($resultadoUsu);
		 // echo $consultaUsu;
          ?>
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4" height="30" align="right">
                <?php
                if($_SESSION["rol"] == 3 || $_SESSION["rol"] == 4 )
                {
					if ($registroUsu['nInmuebles']<= 0)
					{
						$cantidadInm = $num_inm;
					}
					else
					{
						$cantidadInm = $registroUsu['nInmuebles'] - $num_inm;
					}
                    if($cantidadInm > 0){
                        ?>
                        <div style="overflow:hidden; padding: 10px 0 18px 0;; line-height:2">						
                        <?php
                    }
					?>
				
					 <div style=" float:right;">Inmuebles del plan <strong><?php echo $cantidadInm?></strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Registrados <strong><?php echo $num_inm ?></strong> <strong>(Disp: <?php echo $cantidadInm - $num_inm; ?>)</strong></div>
					</div>
				
				<?php	
    
                }
                
                ?>
				</td>
              </tr>
              <tr>
                <td width="10%" style="padding:5px;padding-left: 40px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Foto principal</strong></td>
                <td width="15%" style="padding:5px;padding-left: 10px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Estado de la publicación</strong></td>
                <td width="6%" style="padding:5px; padding-left: 40px;border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Plan</strong></td>
                <td width="14%" style="padding:5px;padding-left: 40px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Ubicacion</strong></td>
                <td width="17%" style="padding:5px;padding-left: 40px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Caracteristicas</strong></td>
              </tr>
                <?php    
              while($registro= mysql_fetch_array($resultado))
              {
              
             	?><tr>
                <td  align="left" style="padding:5px; border-bottom:#CCC 1px solid">
                <?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."'  LIMIT 0,1";
				
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$nFotos = mysql_num_rows($resultadoFoto);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				//echo $consulta;
				if (file_exists("fotoinmueble/".$registroFoto["foto"]))
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
                  
                  
                  <div class="imagen">
                   <?php
					if($nFotos > 0)
					{
					?>
                  		<img src="fotoinmueble/<?php echo $foto?>" width="150px" height="120px" border="0" title="Ver informacion" />
                   <?php
					}
					else
					{
						?>
				<img src="imagenes/sinImagen150.jpg" width="150px" height="120px" title="Ver informacion" border="0" />
					<?php
					}
					
                ?></div></td>
                <td align="left" style="padding:px; border-bottom:#CCC 1px solid">
				  <?php
                if($registro["estado"] == 1)
				{
				
                  ?>
                  <img src="admin/imagenes/activo.png" alt="activopx" width="22" height="22px" title="Activo" border="0" />
                 <?php
				}
				else
				{
				?>               
                <img src="admin/imagenes/inactivo.png" alt="inactivo" width="22" height="22" title="Inactivo" border="0" />
                <?php
				}
				?>
					<strong>Visitas:</strong><?php echo $registro['numvisitas']."<br />";?>
					<strong>Codigo inmobiliaria:</strong><?php echo $registro['codigoinm']."<br />"?>
					<strong>Codigo pagina:</strong><?php echo $registro['codigo']."<br />"?>
                    <strong>Fecha:</strong><?php echo $registro['fecha_inscripcion']."<br />"?>

    			<?php
                if($registro['fecha_activacion'] != '0000-00-00')
                {
                    //Consultamos los dias de los planes
                    $consulta = "SELECT * FROM planes WHERE id = ".$registro['plan'];
                    $resultado_plan = mysql_query($consulta, $conexion);
                    $registro_plan= mysql_fetch_array($resultado_plan);
                    
                    if($registro['plan'] == 1 || $registro['plan'] == 2)
                    {
                       // echo suma_dia_fecha($registro['fecha_activacion'],$registro_plan['dias']);
                    }
                    
                    if($registro['plan'] == 3)
                    {
                        echo "Hasta que se venda";
                    }
                    
                    if($registro['plan'] == 4)
                    {
                        $consulta = "SELECT * FROM planpersonalizado WHERE codinmueble = ".$registro['codigo'];
                        $resultado_planper = mysql_query($consulta, $conexion);
                        $registro_planper = mysql_fetch_array($resultado_planper);
                        
                        $dias = ($registro_planper['nMeses'] * 30);
                        //echo suma_dia_fecha($registro['fecha_activacion'],$dias);
                    }
                }
				?>
                </td>
                <td align="left" style="padding-left:40px; border-bottom:#CCC 1px solid"><?php echo  planes($registro['plan'])?></td>
                <td align="left" style="padding-left:40px; border-bottom:#CCC 1px solid"><?php echo  $registro['campo_1'].'<br />'.$registro['nombreMunicipio'].'<br />'.$registro['dir']?></td>
              <?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."' LIMIT 0,1";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$nFotos = mysql_num_rows($resultadoFoto);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				
				if (file_exists("fotosinmuebles/".$registroFoto["foto"]))
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
                
                <td align="center" style="padding-left:15px; border-bottom:#CCC 1px solid">
                <?php /*?><?php
					echo $registro['dest_tip'].'<br />';
					echo tipo_negocio($registro['tipo_neg']).'<br />';

					if($registro['tipo_inm'] == 1)
					{
						if ($registro['campo_5']!="")
						{
							echo "$".number_format($registro['campo_5'],0,',','.');
						}
					}
					else if($tipoBusqueda == 2)
							{
								if ($registro['campo_53']!="")
								{
									echo "$".number_format($registro['campo_53'],0,',','.');
								}
							}
					?><?php */?>
                   
                    •<?php echo $registro['dest_tip'] ?><br/>
                    •<?php echo tipo_negocio_imprimir_inm ($registro['tipo_neg'])?>
                     <?php   if ($registro["tipo_neg"]==1)
					
					{
					
						if ($registro['campo_5']!="")
						{
							echo ""."$".number_format($registro['campo_5'],0,',','.');
						}
					}
					
					else if ($registro["tipo_neg"]==2)
					
					{
					
						if ($registro['campo_53']!="")
						{
							echo ""."$".number_format($registro['campo_53'],0,',','.');
						}
					}
										
					?><br />
               • Area:<?php echo $registro['campo_6']?> m&sup2 <br/>• <?php echo  $registro['campo_24']?> Habitaciones <br/>• <?php echo  $registro['campo_9']?> Baños  <br/>• <?php echo $registro['campo_25']?> Garaje<br/>
                </td>
              </tr>
              <tr>
                <td  align="left" style="padding:px; border-bottom:#CCC 1px solid"><a href="#" onclick="editarfoto('<?php echo $registro['codigo']?>','<?php echo $registro['plan']?>')" class="boton">Editar Fotos del inmueble</a></td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid"><a href="#" onclick="editarInmueble('<?php echo $registro['codigo']?>');" class="boton">Editar Detalles del inmueble</a></td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid">&nbsp;</td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid">
                	<a href="<?php echo str_replace("nio", "ño", file_get_contents("http://inmueblealaventa.com/short/direct/" . $registro['codigo'])); ?>" class="boton">Ver inmueble</a>
                </td>
                <td align="center" style="padding:5px; border-bottom:#CCC 1px solid">
                <?php
                if($_SESSION["rol"] != 3 && $_SESSION["rol"] != 4 )
				{
					$str = "1234567890";
					$cad = "";
					for($i=0;$i<5;$i++) {
						$cad .= substr($str,rand(0,10),1);
					}
				?>
               <a href="#" class='boton' onclick="renovarInmueble('<?php echo $registro['plan']?>','<?php echo $registro['codigo']?>', '<?php echo  $cad ?>','<?php echo $registro['tipo_neg']?>')">Renovar</a>
                <?php
				}
				?>
				<a href='#'  onclick="if(confirm('Desea continuar \nEliminara el inmueble')) { eliminarInmueble('<?php echo $registro['codigo']?>'); };"
				class='boton'>Borrar</a></td>
              </tr>
              <?php
              }
              ?>
            </table>
            
            
        
				
          <input name="hdd_id" type="hidden" value="" />
            <input name="hdd_plan" type="hidden" value="" />
            <input name="hdd_tipo_neg" type="hidden" value="" />
            <input name="hdd_tipoCliente" type="hidden" value="" />
            
             <input name="cod_temp" type="hidden" value="<?php echo  $numero_azar = rand()?>" />
        <input name="hdd_accion" type="hidden" value="editar" />
        <input name="codigo" type="hidden" id="codigo" value="" />
        <input name="plan" type="hidden" id="plan" value="" />
            
			
          </form>
          </div>
        <div id="tab2" class="tab_content">
        <table width="100%" border="0" cellspacing="3" cellpadding="2" bgcolor="#F7F7F7" style="border:#CCCCCC 1px solid;">
          <tr>
            <td width="51%" align="left"><strong>Datos personales</strong></td>
            <td width="49%" align="left">&nbsp;</td>
          </tr>                    
          <tr>
            <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30%" align="left" style="padding:5px;"><strong>Nombre:</strong></td>
                <td width="70%" style="padding:5px;"><?php echo $registroUsu['nombres']?></td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>Apellidos:</strong></td>
                <td style="padding:5px;"><?php echo $registroUsu['apellidos']?></td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>Telefono:</strong></td>
                <td style="padding:5px;"><?php echo $registroUsu['telefono']?></td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>Celular:</strong></td>
                <td style="padding:5px;"><?php echo  $registroUsu['celular']?></td>
            </tr>
            </table></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30%" style="padding:5px;"><strong>Ciudad:</strong></td>
                <td width="70%" style="padding:5px;"><?php echo  $registroUsu['nombreMunicipio']?></td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>E-mail:</strong></td>
                <td style="padding:5px;"><?php echo $registroUsu['email']?></td> 
            </tr>
              <tr>
                <td>:</td>
                <td>&nbsp;</td>
            </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </table></td>
         </tr>
          <tr>
            <td colspan="2" valign="top" style="padding:10px 0"><a href="cuenta_edit.php" class="boton medium azul">Modificar cuenta</a></td>
          </tr>
          <tr>
            <td colspan="2" valign="top" style="padding:10px 0"><a href="contrasena_edit.php" class="boton medium naranja">Cambiar contrase&ntilde;a</a></td>
          </tr>
        </table>
      </div>      
    </div>
	</div>

</div>
  </div>

<div style="clear:left">&nbsp;</div>


</section>

<footer>
<?php 
include('pie.php');
mysql_close();  
?>
</footer>
</body>

<script type="text/javascript">
	/*$(document).ready(function() {
							   
			
		var ajax_load = "<img class='loading' src='bigLoader.gif' alt='loading...' />";
		var loadUrl2 = "funciones/resultados_cuenta.php?action=search2";  
		
		function getResultsAlphabet(letter){	
		$("#resultsContainer").html(ajax_load);
		$.post(
			  loadUrl2,
			  {query: letter}, 
			  function(data2){
				$("#resultsContainer").html(data2);
				$("#resultsContainer").show("blind");
			});
		}
		
		getResultsAlphabet('all');
});*/
</script>


<script language="javascript">
$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	

});

function editarInmueble(id)
{
	document.frm_cuenta.hdd_id.value = id;
	document.frm_cuenta.action = "editarInmueble.php";
	document.frm_cuenta.submit();
}

function eliminarInmueble(id)
{
	
	document.frm_cuenta.hdd_id.value = id;
	document.frm_cuenta.action = "inmuebledelete.php";
	document.frm_cuenta.submit();
}

function renovarInmueble(plan,codigo,temp,tipo)
{
	document.frm_cuenta.action = "planesRenovacion.php?plan="+plan+"&cod="+codigo+"&temp="+temp+"&tipoNeg="+tipo;
	document.frm_cuenta.submit();
}

function editarfoto(id,plan)
{
	document.frm_cuenta.codigo.value = id;
	document.frm_cuenta.plan.value = plan;
	document.frm_cuenta.action = "editarInmuebleFotos.php";
	document.frm_cuenta.submit();
}


function registrarinmueble()
{
	document.frm_cuenta.hdd_plan.value = 2;
	document.frm_cuenta.hdd_tipo_neg.value = 1;
	document.frm_cuenta.hdd_tipoCliente.value = 3;
	document.frm_cuenta.action = "registroInmueble.php";
	document.frm_cuenta.submit();
}





</script> 
</html>