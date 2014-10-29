<?php
include('controlSesion.php');
require('bd.php');

//Consultamos el numero de fotos por plan

if($_POST['cod_temp'] != '' )
{
	//hallamos el codigo que va a tener el inmueble
	$consulta = "SELECT MAX(codigo) AS codigo FROM inmueble";
	
	$resultado = mysql_query($consulta, $conexion);
	$registro = mysql_fetch_array($resultado);
	
	if($registro['codigo'] == "")
		$codigo = 100;
		else
		$codigo = ($registro['codigo'] + 1);


	
	$mongo = array();

	
	//Consultamos si el cliente ya a registrado inmuebles
	$consulta = "SELECT * FROM inmueble WHERE usuario = '".$_SESSION["idusuario"]."'";	
	$resultado = mysql_query($consulta, $conexion);
	$numInmReg = mysql_num_rows($resultado);
	$registroUsu = mysql_fetch_array($resultado);
	
	
	$tipoCliente = $_POST['hdd_tipoCliente']; 
	
	$usuario = $mongo["usuario"] = $_SESSION["idusuario"];
	$cod_temp = $_POST['cod_temp'];
	$plan = $_POST['plan'];
	$negociacion = $mongo["tipo_neg"]  = $_POST['negociacion'];
	$tipoInmueble  = $mongo["tipo_inm"] = $_POST['tipoInmueble'];
	$ciudad  = $mongo["ciudad"] = $_POST['ciudad'];
	$direccion  = $mongo["dir"] = $_POST['direccion'];
	$nomContacto  = $mongo["nomContacto"] = $_POST['nomContacto'];
	$telContacto  = $mongo["telContacto"] = $_POST['telContacto'];
	$celContacto  = $mongo["celContacto"] = $_POST['celContacto'];
	$mailContacto  = $mongo["mailContacto"] = $_POST['mailContacto'];
	$nomBarrio  = $mongo["nomBarrio"] = $_POST['nomBarrio'];
	$nomBarrio_1  = $mongo["campo_1"]  = $_POST['nomBarrio'];
	$tipoBodega_2 = $mongo["campo_2"]  = $_POST['tipoBodega'];
	$numOficinas_3 = $mongo["campo_3"]  = $_POST['numOficinas'];
	$tiempo_4 = $mongo["campo_4"]  = $_POST['tiempo'];
	$vlrventa_5 = $mongo["campo_5"]  = $_POST['vlrventa'];
	$area_6 = $mongo["campo_6"]  = $_POST['area'];
	$estrato_7 = $mongo["campo_7"]  = $_POST['estrato'];
	$tipoPiso_8 = $mongo["campo_8"]  = $_POST['tipoPiso'];
	$numBanos_9 = $mongo["campo_9"]  = $_POST['numBanos'];
	$puertaMulas_10 = $mongo["campo_10"]  = $_POST['puertaMulas'];
	$alarma_11 = $mongo["campo_11"]  = $_POST['alarma'];
	$humo_12= $mongo["campo_12"]   = $_POST['humo'];
	$gabinete_13 = $mongo["campo_13"]  = $_POST['gabinete'];
	$rociadores_14 = $mongo["campo_14"]  = $_POST['rociadores'];
	$tanques_15 = $mongo["campo_15"]  = $_POST['tanques'];
	$planta_16= $mongo["campo_16"]   = $_POST['planta'];
	$vigilancia_17 = $mongo["campo_17"]  = $_POST['vigilancia'];
	$tipoConsultorio_18= $mongo["campo_18"]   = $_POST['tipoConsultorio'];
	$vlrAdmon_19 = $mongo["campo_19"]  = $_POST['vlrAdmon'];
	$parqVisitantes_20 = $mongo["campo_20"]  = $_POST['parqVisitantes'];
	$numLineas_21 = $mongo["campo_21"]  = $_POST['numLineas'];
	$tipoFinca_22 = $mongo["campo_22"]  = $_POST['tipoFinca'];
	$tiempoArriendo_23 = $mongo["campo_23"]  = $_POST['tiempoArriendo'];
	$numHabitaciones_24= $mongo["campo_24"]  = $_POST['numHabitaciones'];
	$numGarajes_25 = $mongo["campo_25"]  = $_POST['numGarajes'];
	$terrenoConstruido_26 = $mongo["campo_26"]  = $_POST['terrenoConstruido'];
	$piscina_27 = $mongo["campo_27"]  = $_POST['piscina'];
	$canchaTenis_28 = $mongo["campo_28"]  = $_POST['canchaTenis'];
	$canchaFutbol_29 = $mongo["campo_29"]  = $_POST['canchaFutbol'];
	$otrosDeportes_30 = $mongo["campo_30"]  = $_POST['otrosDeportes'];
	$tipoLocal_31= $mongo["campo_31"]   = $_POST['tipoLocal'];
	$cual_32 = $mongo["campo_32"]  = isset($_POST['cual']) ? $_POST['cual'] : '';
	$numDepositos_33 = $mongo["campo_33"]  = $_POST['numDepositos'];
	$interior_34 = $mongo["campo_34"]  = $_POST['interior'];
	$numApartamento_35 = $mongo["campo_35"]  = $_POST['numApartamento'];
	$numPiso_36 = $mongo["campo_36"]  = $_POST['numPiso'];
	$gas_37 = $mongo["campo_37"]  = $_POST['gas'];
	$numCasa_38 = $mongo["campo_38"]  = $_POST['numCasa'];
	$numPisos_39 = $mongo["campo_39"]  = $_POST['numPisos'];
	$tipoOficina_40 = $mongo["campo_40"]  = $_POST['tipoOficina'];
	$numOficina_41 = $mongo["campo_41"]  = $_POST['numOficina'];
	$tipoTecho_42 = $mongo["campo_42"]  = $_POST['tipoTecho'];
	$cocineta_43 = $mongo["campo_43"]  = $_POST['cocineta'];
	$numAscensores_44 = $mongo["campo_44"]  = $_POST['numAscensores'];
	$escaleras_45= $mongo["campo_45"]   = $_POST['escaleras'];
	$tipoLote_46 = $mongo["campo_46"]  = $_POST['tipoLote'];
	$esquinero_47 = $mongo["campo_47"]  = $_POST['esquinero'];
	$ubicaLote_48 = $mongo["campo_48"]  = $_POST['ubicaLote'];
	$todoServicios_49= $mongo["campo_49"]  = $_POST['todoServicios'];
	$viaPrincipal_50= $mongo["campo_50"]   = $_POST['viaPrincipal'];
	$viaSecundaria_51 = $mongo["campo_51"]  = $_POST['viaSecundaria'];
	$numBanosInter_52 = $mongo["campo_52"]  = $_POST['numBanosInter'];
	$canon_53 = $mongo["campo_53"]  = $_POST['canon'];	
	$textoDestacado = $mongo["textoDestacado"]  = $_POST['textoDestacado'];
	$comentarioUsuario = $mongo["comentarioUsuario"]  = $_POST['comentarioUsuario'];
	$url_video = $mongo["video"]  = $_POST['video'];
	$latitud= $mongo["lat"]   = $_POST['latitud'];
	$longitud = $mongo["lon"]  = $_POST['longitud'];
	$direccionMap = $mongo["campo_1"]  = $_POST['direccionMap'];
	$codigo= $mongo["codigo"]  = $codigo;
	$barrio= $mongo["barrio"]  =$_POST['barrio'];
	$codigoinm= $mongo["codigoinm"]  =$_POST['codigoinm'];
	$mongo["estado"] = "1";
	if($url_video != "")
	{
		//$url = explode("=",$url_video); 
		//$video = "http://www.youtube.com/v/" . $url[1];
		$video = substr($url_video,-11);
	}
	else{
		$video="";
	}
		




	$insercion = "INSERT INTO inmueble 
	(usuario, codigo, tipo_neg, ciudad, tipo_inm, plan, dir, nomContacto, telContacto, celContacto, mailContacto, campo_1, campo_2, campo_3, campo_4, campo_5, campo_6, campo_7, campo_8, campo_9, campo_10, campo_11, campo_12, campo_13, campo_14, campo_15, campo_16, campo_17, campo_18, campo_19, campo_20, campo_21, campo_22, campo_23, campo_24, campo_25, campo_26, campo_27, campo_28, campo_29, campo_30, campo_31, campo_32, campo_33, campo_34, campo_35, campo_36, campo_37, campo_38, campo_39, campo_40, campo_41, campo_42, campo_43, campo_44, campo_45, campo_46, campo_47, campo_48, campo_49, campo_50, campo_51, campo_52, campo_53, comentarioUsuario, video, lat, lon, dirMapa, estado, destacado, textoDestacado, fecha_inscripcion,barrio,codigoinm) 
	VALUES ('$usuario', '$codigo', $negociacion, $ciudad, $tipoInmueble, $plan, '$direccion', '$nomContacto', '$telContacto', '$celContacto', 
	'$mailContacto', '$nomBarrio_1', '$tipoBodega_2', '$numOficinas_3', '$tiempo_4', '$vlrventa_5', '$area_6', '$estrato_7', '$tipoPiso_8', '$numBanos_9', '$puertaMulas_10', '$alarma_11', '$humo_12', '$gabinete_13', '$rociadores_14', '$tanques_15', '$planta_16', '$vigilancia_17', '$tipoConsultorio_18', '$vlrAdmon_19', '$parqVisitantes_20', '$numLineas_21', '$tipoFinca_22', '$tiempoArriendo_23', '$numHabitaciones_24', '$numGarajes_25', '$terrenoConstruido_26', '$piscina_27', '$canchaTenis_28', '$canchaFutbol_29', '$otrosDeportes_30', '$tipoLocal_31', '$cual_32', '$numDepositos_33', '$interior_34', '$numApartamento_35', '$numPiso_36', '$gas_37', '$numCasa_38', '$numPisos_39', '$tipoOficina_40', '$numOficina_41', '$tipoTecho_42', '$cocineta_43', '$numAscensores_44', '$escaleras_45', '$tipoLote_46', '$esquinero_47', '$ubicaLote_48', '$todoServicios_49', '$viaPrincipal_50', '$viaSecundaria_51', '$numBanosInter_52', '$canon_53', '$comentarioUsuario',
	'$video', '$latitud', '$longitud', '$direccionMap', 0, 0, '$textoDestacado', NOW(),'$barrio','$codigoinm')";

		
		if (mysql_db_query($bd_nombre, $insercion))
		{


          
			$req = file_get_contents("http://www.inmueblealaventa.com/apps/migrate/index.php?cod={$codigo}");
		   
		 
			//Id del inmueble ingresado
			$ID = mysql_insert_id();
			
			//consultamos el codigo del inmueble creado
			$consulta = "SELECT codigo FROM inmueble WHERE id = ".$ID;			
			$resultado_cod = mysql_query($consulta, $conexion);
			$registro_cod = mysql_fetch_array($resultado_cod);
			
			//Campos que traigo del plan personalizado
			if($plan == 4)
			{
				$nFotos = $_POST['nFotos']; 
				$nVideo = $_POST['nVideo'];
				$nDestacados = $_POST['nDestacados'];
				$nMeses = $_POST['nMeses'];
				$tomaFoto =  $_POST['tomaFoto'];
				$valor_plan = $_POST['hdd_valor_plan'];
				
				//Insertamos en la tabla de planes especiales
				$insercionPlan = "INSERT INTO planpersonalizado (codinmueble, nFotos, nDestacados, nMeses, valorPlan, fecha) VALUES ('".$registro_cod['codigo']."', $nFotos, $nDestacados, $nMeses, $valor_plan, NOW())";
				mysql_db_query($bd_nombre, $insercionPlan);
				
			}
			
			//consultamos las fotos que fueron guardadas temporalmente para este inmueble y las agregamos a la tabla fotos_inm
			$consulta = "SELECT * FROM fotostemp WHERE cod_temp = '".$cod_temp."'";			
			$resultado = mysql_query($consulta, $conexion);
			while($registro = mysql_fetch_array($resultado))
			{			
				$insercion = "INSERT INTO fotos_inm (foto, cod_inm, fecha_creacion) VALUES ('".$registro['nombre_foto']."', '".$registro_cod['codigo']."', NOW())";
				mysql_db_query($bd_nombre, $insercion);
			}
			
			//Eliminamos las fotos de este inmueble de la tabla temporal de fotos
			$eliminacion = "DELETE FROM fotostemp WHERE cod_temp = '".$cod_temp."'";
			mysql_db_query($bd_nombre, $eliminacion);
			
			
			?>
			<script language="javascript" type="text/javascript">
                alert("El inmueble fue creado con exito");
				<?php	
				if($tipoCliente == 3)
				{
					?>
					document.location.href = "cuenta.php";
					<?php
				}
				else
				{
					if($numInmReg > 0)
					{
					?>
					document.location.href = "ordenPago.php?plan=<?php echo $plan?>&cod=<?php echo $registro_cod['codigo']?>";
					<?php
					}
					else
					{
						if($plan == 2)
						{
						?>
						document.location.href = "index.php";
						<?php
						}
						else
						{
						?>
						document.location.href = "ordenPago.php?plan=<?php echo $plan?>&cod=<?php echo $registro_cod['codigo']?>";
						<?php
						}
					}
				}
				?>
            </script>
			<?	
			
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
                alert("El inmueble no pudo ser ingresado");
                document.location.href = "registroInmueble.php";
            </script>
		<?
		}	

}
else
{
	header ("Location: index.php");	
}	

?>