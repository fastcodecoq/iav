<?php
session_start();
?>
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
<?php

require('../bd.php');
include('../includes/parametros.php');
include('fechas.php');
if(!isset($_GET['action'])) 
{
	$action="nnn";
}
else 
{
	$action = $_GET['action'];
}


if(strcmp("search2", $action) == 0) 
{
	echo '<ul class="tabs">
                    
                    <li><a href="#tab1"><strong>Mis Inmuebles</strong></a></li>
                    <li><a href="#tab2"><strong>Datos b&aacute;sicos</strong></a></li>
                    <!--<li><a href="#tab3"><strong>Sus transacciones</strong></a></li>-->
    </ul>
    	<div class="tab_container">
        <div id="tab1" class="tab_content" style="min-height:400px;">
          <form action="#" method="post" id="frm_cuenta" name="frm_cuenta">';
         
          //Consulta de los inmuebles de cada cliente
          $consulta = "SELECT municipio.nombreMunicipio, tipo_in.dest_tip, inmueble.* FROM inmueble 
    JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm
    JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
    WHERE usuario = ".$_SESSION['idusuario']." ORDER BY codigo DESC";
          $resultado = mysql_query($consulta, $conexion);
          $num_inm = mysql_num_rows($resultado);	


		  //Consulta de los datos del usuario
          $consultaUsu = "SELECT usuarios.*, municipio.nombreMunicipio
FROM usuarios 
JOIN municipio ON usuarios.ciudad = municipio.idmunicipio WHERE identificacion = ".$_SESSION['idusuario'];
          $resultadoUsu = mysql_query($consultaUsu, $conexion);
          $registroUsu= mysql_fetch_array($resultadoUsu);
          
          echo '  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4" height="30" align="right">';
                
                if($_SESSION["rol"] == 3 || $_SESSION["rol"] == 4 )
                {
					$cantidadInm = $registroUsu['nInmuebles'] - $num_inm;
                    if($cantidadInm > 0){
                        echo "<div style='float:right; padding-left:20px;'><a href='#' onclick='registrarinmueble()' class='boton azul small'>Agregar Inmueble</a></div>";
                        
                    }
					
					 echo '<div style="float:right">Inmuebles del plan <strong>'.$registroUsu['nInmuebles'].'</strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Registrados <strong>'. $num_inm.'</strong> <strong>(Disp: '. $cantidadInm.')</strong></div>';
					
    
                }
                
                echo '</td>
              </tr>
              <tr>
                <td width="48%" style="padding:5px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Foto principal</strong></td>
                <td width="15%" style="padding:5px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Estado de la publicación</strong></td>
                <td width="6%" style="padding:5px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Plan</strong></td>
                <td width="14%" style="padding:5px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF"><strong>Ubicacion</strong></td>
                <td width="17%" style="padding:5px; border-bottom:#CCC 1px solid; border-top:#F66 1px solid; background:#F60; color:#FFF">Caracteristicas</td>
              </tr>';
                    
              while($registro= mysql_fetch_array($resultado))
              {
              
             echo ' <tr>
                <td  align="left" style="padding:5px; border-bottom:#CCC 1px solid">';
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."'  LIMIT 0,1";
				
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$nFotos = mysql_num_rows($resultadoFoto);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				
				if (file_exists("inmuebles/".$registroFoto["foto"]))
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
				
                  
                  
                  
                  
                  echo '<div class="imagen">';
                   
					if($nFotos > 0)
					{
					
                    echo '<img src="inmuebles/'.$foto.'" width="150px" height="120px" border="0" title="Ver informacion" />';
                   
					}
					else
					{
					echo '<img src="imagenes/sinImagen150.jpg" width="150px" height="120px" title="Ver informacion" border="0" />';

					}
					
                echo '</div></td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid">';
				  
                if($registro["estado"] == 1)
				{
				
                  echo '<img src="admin/imagenes/activo.png" alt="activopx" width="22" height="22px" title="Activo" border="0" />';
                 
				}
				else
				{
				echo '               <img src="admin/imagenes/inactivo.png" alt="inactivo" width="22" height="22" title="Inactivo" border="0" />';
                
				}
				
					echo "Visitas:".$registro['numvisitas']."<br />";
					echo "Codigo inmobiliaria:".$registro['codigoinm']."<br />";
					echo "Codigo pagina:".$registro['codigo']."<br />";
                    echo "Fecha publicación:".$registro['fecha_inscripcion']."<br />";

    
                if($registro['fecha_activacion'] != '0000-00-00')
                {
                    //Consultamos los dias de los planes
                    $consulta = "SELECT * FROM planes WHERE id = ".$registro['plan'];
                    $resultado_plan = mysql_query($consulta, $conexion);
                    $registro_plan= mysql_fetch_array($resultado_plan);
                    
                    if($registro['plan'] == 1 || $registro['plan'] == 2)
                    {
                        echo suma_dia_fecha($registro['fecha_activacion'],$registro_plan['dias']);
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
                        echo suma_dia_fecha($registro['fecha_activacion'],$dias);
                    }
                }
				
                echo '</td>';
                echo '<td align="left" style="padding:5px; border-bottom:#CCC 1px solid">'. planes($registro['plan']).'</td>';
                echo '<td align="left" style="padding:5px; border-bottom:#CCC 1px solid">'. $registro['campo_1'].'<br />'.$registro['nombreMunicipio'].'<br />'.$registro['dir'].'</td>';
              
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."' LIMIT 0,1";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$nFotos = mysql_num_rows($resultadoFoto);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				
				if (file_exists("inmuebles/".$registroFoto["foto"]))
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
				echo '<td align="center" style="padding:5px; border-bottom:#CCC 1px solid">';
                
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
					echo '<br />
               • Area: '. $registro['campo_6'].' m&sup2  <br />• '. $registro['campo_24'].' Habitaciones • '. $registro['campo_9'].' Baños  <br />• '.$registro['campo_17'].' Garaje<br />
                </td>
              </tr>
              <tr>
                <td  align="left" style="padding:5px; border-bottom:#CCC 1px solid"><a href="#" onclick="editarfoto('.$registro['codigo'].','. $registro['plan'].');" class="boton">Editar Fotos del inmueble</a></td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid"><a href="#" onclick="editarInmueble('. $registro['codigo'].');" class="boton">Editar Detalles del inmueble</a></td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid">&nbsp;</td>
                <td align="left" style="padding:5px; border-bottom:#CCC 1px solid"><a href="/inmueble/'.$registro['codigo'].'" class="boton">Ver inmueble</a></td>
                <td align="center" style="padding:5px; border-bottom:#CCC 1px solid">';
                if($_SESSION["rol"] != 3 && $_SESSION["rol"] != 4 )
				{
					$str = "1234567890";
					$cad = "";
					for($i=0;$i<5;$i++) {
						$cad .= substr($str,rand(0,10),1);
					}
				
               echo '<a href="#" onclick="renovarInmueble('.$registro['plan'].','.$registro['codigo'].', '. $cad .','.$registro['tipo_neg'].')">Renovar</a>';
                
				}
				echo  '<a href="#" onclick="if(confirm("Desea continuar \nEliminara el inmueble")) { eliminarInmueble('.$registro['codigo'].'); };" class="boton">Borrar</a></td>
              </tr>';
              
              }
              
           echo ' </table>';
            
            
        
				
          echo '  <input name="hdd_id" type="hidden" value="" />
            <input name="hdd_plan" type="hidden" value="" />
            <input name="hdd_tipo_neg" type="hidden" value="" />
            <input name="hdd_tipoCliente" type="hidden" value="" />
            
             <input name="cod_temp" type="hidden" value="'. $numero_azar = rand().'" />
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
                <td width="70%" style="padding:5px;">'. $registroUsu['nombres'].'</td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>Apellidos:</strong></td>
                <td style="padding:5px;">'. $registroUsu['apellidos'].'</td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>Telefono:</strong></td>
                <td style="padding:5px;">'. $registroUsu['telefono'].'</td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>Celular:</strong></td>
                <td style="padding:5px;">'. $registroUsu['celular'].'</td>
            </tr>
            </table></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30%" style="padding:5px;"><strong>Ciudad:</strong></td>
                <td width="70%" style="padding:5px;">'.$registroUsu['nombreMunicipio'].'</td>
            </tr>
              <tr>
                <td style="padding:5px;"><strong>E-mail:</strong></td>
                <td style="padding:5px;">'.$registroUsu['email'].'</td> 
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
    </div>';
}

?>