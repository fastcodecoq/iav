 <?php
			
			$pagina = "propiedades.php"; 	//your file name  (the name of this file)
			$TAMANO_PAGINA = 12; 								//how many items to show per page
			$page = $_GET['page'];
			
			
			if($page) 
				$inicio = ($page - 1) * $TAMANO_PAGINA; 			//first item to display on this page
			else
				$inicio = 0;	
            
			$condarea="";
			$condprecio="";
			$condTipInm="";
			$tipoInmueble = $_GET['tipoInmueble']; //1 venta 2 Arriendo 3 Alquiler
			$ciudad = $_GET['ciudad'];
			$area = $_GET['area'];
			$precio = $_GET['precio'];
			$tipoBusqueda=$_GET['para'];
			$tipoporye=$_GET['tipoporye'];
			 //1 venta 2 Arriendo 3 Alquiler
			 
			 if($tipoInmueble == 0)
			{
				$condTipInm = "";
			}
			else
			{
				$condTipInm = " AND inmueble.tipo_inm = $tipoInmueble";
			}
			
			
			if($tipoporye == "")
			{
				$tipoporye = "";
			}
			else
			{
				$tipoporye = " AND inmueble.campo_4 = $tipoporye";
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
			
			
			
			
			if($codigo == "")
			{
				$condCodigo = "";
			}
			else
			{
				$condCodigo = " AND inmueble.codigo = $codigo";
			}
			
			if($ciudad != 0)
			{
				$condCiudad = " AND inmueble.ciudad = $ciudad";
			}
			else
			{
				$condCiudad = "";
			}
			
			$condicionOrdenar = "ORDER BY inmueble.plan = 3 DESC";
			$orden = $_POST['orden'];
			if($_POST['orden'] != 0)
			{
				$orden =$_POST['orden'];
			}
			
			
			
			

			
			// Para venta
			
			
			if($tipoBusqueda == 4)
			{
				$tipo_negociacion = " AND inmueble.tipo_neg='".$_GET['para']."' ";
			}
			
			if($tipoBusqueda == 1)
			{
				if($orden == 1)
				{
					$condicionOrdenar = " ORDER BY fecha_activacion DESC";
				}
				else if($orden == 2)
					{
						$condicionOrdenar = " ORDER BY fecha_activacion ASC";
					}
					else if($orden == 3)
						{
						$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_5)), campo_5) DESC ";
						}		
						else if($orden == 4)
							{
							$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_5)), campo_5) ASC ";
							}
							else if($orden == 5)
								{
								$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) DESC ";
								}
								else if($orden == 6)
									{
									$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) ASC ";
									}
									
									$tipo_negociacion = " AND inmueble.tipo_neg IN ($tipoBusqueda,3) ";
			}
			
			// Para Arriendo
			if($tipoBusqueda == 2)
			{
				if($orden == 1)
				{
					$condicionOrdenar = " ORDER BY fecha_activacion DESC";
				}
				else if($orden == 2)
					{
						$condicionOrdenar = " ORDER BY fecha_activacion ASC";
					}
					else if($orden == 3)
						{
						$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_53)), campo_53) DESC ";
						}		
						else if($orden == 4)
							{
							$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_53)), campo_53) ASC ";
							}
							else if($orden == 5)
								{
								$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) DESC ";
								}
								else if($orden == 6)
									{
									$condicionOrdenar = " ORDER BY CONCAT(REPEAT('0', 40 - LENGTH(campo_6)), campo_6) ASC ";
									}
									
									$tipo_negociacion = " AND inmueble.tipo_neg IN ($tipoBusqueda,3) ";
			}
			
				$consulta = "SELECT usuarios.banner1, usuarios.rol, 
			CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre, tipo_in.dest_tip, 
			municipio.nombreMunicipio, inmueble.* FROM inmueble,tipo_in,municipio, usuarios,rol where
			inmueble.tipo_inm = tipo_in.tip_inm 
			and inmueble.ciudad = municipio.idmunicipio
			and inmueble.usuario = usuarios.identificacion
			and usuarios.rol = rol.idrol
			and inmueble.estado = 1 $condTipInm $tipoporye  $condarea $condCiudad $condprecio $tipo_negociacion $condicionOrdenar "; // $condCodigo $tipo_negociacion $condCiudad $condPalabraClave $condicionOrdenar";
			//echo $consulta;
			
            $resultado = mysql_query($consulta, $conexion);
            $num_registros = mysql_num_rows($resultado);
            $total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
            $registro = mysql_fetch_assoc($resultado);
			
			if ($num_registros >=3)
			{
				$alto="";
			}
			else
			{
				$alto="height:400px";
			}
			?>     
            <div style="float:left; width:530px; margin-left:30px; <?php echo $alto?>"   id="contenedor1">
            
            <form action="" method="get" name="frm_propiedades" id="frm_propiedades">
            <?php	
			
			
			
			   $orderes = array(
         null,
         "ORDER BY `fecha_activacion` DESC",
         "ORDER BY `fecha_activacion` ASC",
         "ORDER BY `campo_5` DESC",
         "ORDER BY `campo_5` ASC",
         "ORDER BY `campo_6` DESC",         
         "ORDER BY `campo_6` ASC",         
        );



      $order = (isset($_GET["orden"])) ? $_GET["orden"] : null;
      $order = ($order) ? $orderes[$order] : "";

			
			
			
			
			
			
            $consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre,  
			tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble ,tipo_in,municipio, usuarios,rol
			WHERE inmueble.estado = 1 
			and inmueble.tipo_inm = tipo_in.tip_inm 
			and inmueble.ciudad = municipio.idmunicipio
			and inmueble.usuario = usuarios.identificacion
			and  usuarios.rol = rol.idrol
			$tipoporye $condTipInm  $condarea $condCiudad $condprecio $tipo_negociacion {$order} ";// $tipo_negociacion $condCiudad $condPalabraClave  LIMIT $inicio , $TAMANO_PAGINA  ";
			//require 'funciones/paginador_header.php';
			
			
			//Consultar inmuebles
			//$consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre, tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
//JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
//JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
//JOIN usuarios ON inmueble.usuario = usuarios.identificacion
//JOIN rol ON usuarios.rol = rol.idrol
//WHERE inmueble.estado = 1 $condTipInm $condCodigo $tipo_negociacion $condCiudad $condPalabraClave $condicionOrdenar";
//            $resultado = mysql_query($consulta, $conexion);
//            $num_registros = mysql_num_rows($resultado);
//            $total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
//            $registro = mysql_fetch_array($resultado);
//            
//            $consulta = "SELECT usuarios.banner1, usuarios.rol, CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nombre,  tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* FROM inmueble 
//JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm 
//JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
//JOIN usuarios ON inmueble.usuario = usuarios.identificacion
//JOIN rol ON usuarios.rol = rol.idrol
//WHERE inmueble.estado = 1 $condTipInm $condCodigo $tipo_negociacion $condCiudad $condPalabraClave $condicionOrdenar LIMIT $inicio , $TAMANO_PAGINA  ";
            $resultado = mysql_query($consulta, $conexion);
			//."&tipoInmueble=".$_GET["tipoInmueble"]."&ciudad=".$_GET["ciudad"]."&codigo=".$_GET["codigo"]."&orden=$orden";
			$varia="";
			
			
			
				
			$ruta_busqueda="cmb_ciudad_a=".$_GET["ciudad"]."&Submit=Consultar";
			
			
			
			?>
            <div style="overflow:hidden" >
              <div style="float:left; width:250px; padding-bottom:10px">Se han encontrado <?php echo $num_registros?> inmueble(s)</div>
                <div style="float:left; width:280px; text-align:right">
                
                  <select name="orden" id="orden" onchange="<?php echo $anexo?>;document.frm_propiedades.submit();">
                  <optgroup label="Publicaci&oacute;n">
                  	<option  value="1" <?php if($orden == 1) { echo 'selected';}?>>Desde la m&aacute;s reciente</option>
                    <option  value="2" <?php if($orden == 2) { echo 'selected';}?>>Desde la m&aacute;s antigua</option>
                  </optgroup>
                  <optgroup label="Por precio">
                  	<option  value="3" <?php if($orden == 3) { echo 'selected';}?>>De mayor a menor</option>
                    <option  value="4" <?php if($orden == 4) { echo 'selected';}?>>De menor a mayor</option>
                  </optgroup>
                  <optgroup label="Por &aacute;rea">
                  	<option  value="5" <?php if($orden == 5) { echo 'selected';}?>>De mayor a menor</option>
                    <option  value="6" <?php if($orden == 6) { echo 'selected';}?>>De menor a mayor</option>
                  </optgroup>
                  </select>
                </div>
           </div>
            <?php
			
			//include_once("funciones/paginacion_pagina.php");
			
			 
            if(mysql_num_rows($resultado) > 0)
            {?>
				
                <ul class="resultados">
                
                <?php
                while($registro = mysql_fetch_array($resultado))
                {
					
					$fecha_ini = $registro['fecha_activacion'];
					$fecha_final = date(Y.'-'.m.'-'.d);
//					$dias_activacion = diferencia_en_dias($fecha_ini,$fecha_final);
                ?>
                
              
                <?php 
				//if($registro['plan'] == 3 && $dias_activacion <= 30)
				//{
					?>
                	
                <?php
                //}
                ?>
                <?php
				//Consultamos la primera imagen del inmueble
				$consulta = "SELECT foto FROM fotos_inm WHERE cod_inm = '".$registro['codigo']."' LIMIT 0,1";
            	$resultadoFoto = mysql_query($consulta, $conexion);
				$nFotos = mysql_num_rows($resultadoFoto);
				$registroFoto = mysql_fetch_array($resultadoFoto);
				
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
                
                
	
   	  <li>
        	<div class="imagen">
             <?php 
					if($nFotos > 0)
					{
					?>
                    <img src="/redimencionar.php?src=fotoinmueble/<?php echo $foto."&w=150&h=120"?>" border="0" title="Ver informacion" />
                    <?php
					}
					else
					{
					?>
                    <img src="/imagenes/sinImagen150.jpg" width="150" height="120" title="Ver informacion" border="0" />
                    <?php
					}
					?>
            </div>
        <div class="detalles">
            	<h2><?php echo tipo_negocio_imprimir($registro['tipo_neg'])." ".$registro['dest_tip']?></h2>
                <p>&nbsp;</p>
          <p><?php echo $registro['campo_1']?> • <?php echo $registro['nombreMunicipio']?> • <?php echo $registro['nombre']?> </p>
            
            <p>&nbsp;</p>
                <p>&nbsp;</p>
                
               
                <p>Area <?php echo $registro['campo_6']?> m&sup2 • <?php echo $registro['campo_24']?> Habitaciones • <?php echo $registro['campo_9']?> Baños &nbsp; • <?php echo $registro['campo_17']?> Garaje</p>
          </div>
            <div class="contacto">
              	<p>                      <?php 
					if($tipoBusqueda == 1)
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
					?>

				</p>
              <?php
                   
						if($registro['banner1'] != '')
						{
                    	?>
                        <img src="/redimencionar.php?src=bannerInmobiliariaConstructora/<?php echo $registro['banner1']."&h=70"?>" border="0" title="Ver informacion" />
                    	<?php
						}
						
						else
					{
					?>
                    <img src="/imagenes/personat.jpg" width="94px" height="56px" title="Ver informacion" border="0" />
                    <?php
					}
					?>
					
              <a href="<?php echo str_replace("nio", "ño", file_get_contents("http://inmueblealaventa.com/short/direct/" . $registro['codigo'])); ?>" class="boton">Ver inmueble</a>
            </div>
      </li>
                 
            <?php
				}
				?>
				</ul>
                
            <?php
			}
			else
			{
				echo "<div align='center' style='clear:left; padding-top:30px;'>No existen inmuebles en el momento</div>";
			}
			?>
            	<div>
                	<?php
                    	require 'funciones/paginador_footer.php';
                	?>
                </div>
            </form>
         
            </div>