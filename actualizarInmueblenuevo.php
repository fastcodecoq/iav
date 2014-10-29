<?php
include('controlSesion.php');
require('bd.php');

//Consultamos el numero de fotos por plan

if(isset($_POST['codigo']) != '' && $_POST['cod_temp'] != '' &&  $_POST['hdd_accion'] == 'editar')
{

	$mongo = array();

	$cod_temp = $mongo['cod_temp'] = $_POST['cod_temp']; 
	$codigo = $mongo['codigo'] = $_POST['codigo'];	
	$ciudad = $mongo['ciudad'] =  $_POST['ciudad'];
	$direccion = $mongo['direccion'] = $_POST['direccion'];
	$nomContacto = $mongo['nomContacto'] = $_POST['nomContacto'];
	$telContacto = $mongo['telContacto'] = $_POST['telContacto'];
	$celContacto = $mongo['celContacto'] = $_POST['celContacto'];
	$mailContacto = $mongo['mailContacto'] = $_POST['mailContacto'];
	$nomBarrio_1 = $mongo['campo_1'] = $_POST['nomBarrio'];
	$tipoBodega_2 = $mongo['campo_2'] = $_POST['tipoBodega'];
	$numOficinas_3 = $mongo['campo_3'] = $_POST['numOficinas'];
	$tiempo_4 = $mongo['campo_4'] = $_POST['tiempo'];
	$vlrventa_5  = $mongo['campo_5'] = $_POST['vlrventa'];
	$area_6 = $mongo['campo_6'] = $_POST['area'];
	$estrato_7 = $mongo['campo_7'] = $_POST['estrato'];
	$tipoPiso_8 = $mongo['campo_8'] = $_POST['tipoPiso'];
	$numBanos_9 = $mongo['campo_9']  = $_POST['numBanos'];
	$puertaMulas_10  = $mongo['campo_10'] = $_POST['puertaMulas'];
	$alarma_11  = $mongo['campo_11'] = $_POST['alarma'];
	$humo_12  = $mongo['campo_12'] = $_POST['humo'];
	$gabinete_13  = $mongo['campo_13'] = $_POST['gabinete'];
	$rociadores_14  = $mongo['campo_14'] = $_POST['rociadores'];
	$tanques_15 = $mongo['campo_15']  = $_POST['tanques'];
	$planta_16  = $mongo['campo_16'] = $_POST['planta'];
	$vigilancia_17  = $mongo['campo_17'] = $_POST['vigilancia'];
	$tipoConsultorio_18  = $mongo['campo_18'] = $_POST['tipoConsultorio'];
	$vlrAdmon_19 = $mongo['campo_19']  = $_POST['vlrAdmon'];
	$parqVisitantes_20  = $mongo['campo_20'] = $_POST['parqVisitantes'];
	$numLineas_21  = $mongo['campo_21'] = $_POST['numLineas'];
	$tipoFinca_22  = $mongo['campo_22'] = $_POST['tipoFinca'];
	$tiempoArriendo_23  = $mongo['campo_23'] = $_POST['tiempoArriendo'];
	$numHabitaciones_24 = $mongo['campo_24']  = $_POST['numHabitaciones'];
	$numGarajes_25 = $mongo['campo_25']  = $_POST['numGarajes'];
	$terrenoConstruido_26  = $mongo['campo_26'] = $_POST['terrenoConstruido'];
	$piscina_27  = $mongo['campo_27'] = $_POST['piscina'];
	$canchaTenis_28  = $mongo['campo_28'] = $_POST['canchaTenis'];
	$canchaFutbol_29  = $mongo['campo_29'] = $_POST['canchaFutbol'];
	$otrosDeportes_30  = $mongo['campo_30'] = $_POST['otrosDeportes'];
	$tipoLocal_31  = $mongo['campo_31'] = $_POST['tipoLocal'];
	$cual_32  = $mongo['campo_31'] = $_POST['cual'];
	$numDepositos_33 = $mongo['campo_33'] = $_POST['numDepositos'];
	$interior_34  = $mongo['campo_34'] = $_POST['interior'];
	$numApartamento_35  = $mongo['campo_35'] = $_POST['numApartamento'];
	$numPiso_36 = $mongo['campo_36']  = $_POST['numPiso'];
	$gas_37 = $mongo['campo_37']  = $_POST['gas'];
	$numCasa_38  = $mongo['campo_38'] = $_POST['numCasa'];
	$numPisos_39 = $mongo['campo_39']  = $_POST['numPisos'];
	$tipoOficina_40  = $mongo['campo_40'] = $_POST['tipoOficina'];
	$numOficina_41  = $mongo['campo_41'] = $_POST['numOficina'];
	$tipoTecho_42 = $mongo['campo_42']  = $_POST['tipoTecho'];
	$cocineta_43  = $mongo['campo_43'] = $_POST['cocineta'];
	$numAscensores_44  = $mongo['campo_44'] = $_POST['numAscensores'];
	$escaleras_45  = $mongo['campo_45'] = $_POST['escaleras'];
	$tipoLote_46  = $mongo['campo_46'] = $_POST['tipoLote'];
	$esquinero_47  = $mongo['campo_47'] = $_POST['esquinero'];
	$ubicaLote_48  = $mongo['campo_48'] = $_POST['ubicaLote'];
	$todoServicios_49  = $mongo['campo_49'] = $_POST['todoServicios'];
	$viaPrincipal_50  = $mongo['campo_50'] = $_POST['viaPrincipal'];
	$viaSecundaria_51  = $mongo['campo_51'] = $_POST['viaSecundaria'];
	$numBanosInter_52  = $mongo['campo_52'] = $_POST['numBanosInter'];
	$canon_53 = $mongo['campo_53']  = $_POST['canon'];	
	$comentarioUsuario  = $mongo['comentarioUsuario'] = $_POST['comentarioUsuario'];
	$url_video  = $mongo['video'] = $_POST['video'];
	
	/*gomosoft  correción de barrio */

	if(!empty($_POST["barrio"]))
	 $barrio = $mongo['barrio']  = $_POST['barrio'];

	if(!empty($_POST["barrrio"]))
	 $barrio = $mongo['barrio']  = $_POST['barrrio'];

    /*gomosoft*/

	$codigoinm = $mongo['codigoinm'] = $_POST["codigoinm"];
	
	if($url_video != "")
	{
		//$url = explode("=",$url_video); 
		//$video = "http://www.youtube.com/v/" . $url[1];
		$video = substr($url_video,-11);
	}
	else{
		$video="";
	}
	
	$actualizar = "UPDATE inmueble SET ciudad=$ciudad, codigoinm = '$codigoinm' ,dir='$direccion', nomContacto='$nomContacto', telContacto='$telContacto', celContacto='$celContacto', mailContacto='$mailContacto', campo_1 = '$nomBarrio_1', campo_2 = '$tipoBodega_2', campo_3 = '$numOficinas_3', campo_4 = '$tiempo_4', campo_5 = '$vlrventa_5', campo_6 = '$area_6', campo_7 = '$estrato_7', campo_8 = '$tipoPiso_8', campo_9 = '$numBanos_9', campo_10 = '$puertaMulas_10', campo_11 = '$alarma_11', campo_12 = '$humo_12', campo_13 = '$gabinete_13', campo_14 = '$rociadores_14', campo_15 = '$tanques_15', campo_16 = '$planta_16', campo_17 = '$vigilancia_17', campo_18 = '$tipoConsultorio_18', campo_19 = '$vlrAdmon_19', campo_20 = '$parqVisitantes_20', campo_21 = '$numLineas_21', campo_22 = '$tipoFinca_22', campo_23 = '$tiempoArriendo_23', campo_24 = '$numHabitaciones_24', campo_25 = '$numGarajes_25', campo_26 = '$terrenoConstruido_26', campo_27 = '$piscina_27', campo_28 = '$canchaTenis_28', campo_29 = '$canchaFutbol_29', campo_30 = '$otrosDeportes_30', campo_31 = '$tipoLocal_31', campo_32 = '$cual_32', campo_33 = '$numDepositos_33', campo_34 = '$interior_34', campo_35 = '$numApartamento_35', campo_36 = '$numPiso_36', campo_37 = '$gas_37', campo_38 = '$numCasa_38', campo_39 = '$numPisos_39', campo_40 = '$tipoOficina_40', campo_41 = '$numOficina_41', campo_42 = '$tipoTecho_42', campo_43 = '$cocineta_43', campo_44 = '$numAscensores_44', campo_45 = '$escaleras_45', campo_46 = '$tipoLote_46', campo_47 = '$esquinero_47', campo_48 = '$ubicaLote_48', campo_49 = '$todoServicios_49', campo_50 = '$viaPrincipal_50', campo_51 = '$viaSecundaria_51', campo_52 = '$numBanosInter_52', campo_53 = '$canon_53', comentarioUsuario='$comentarioUsuario', video='$video', barrio='$barrio' WHERE codigo = ".$codigo;
		
		
		$ejecutar=mysql_query($actualizar);
		if ($ejecutar)			
		{

	
			
			$con = new MongoClient();
			$db = $con->iav;
			$col = $db->inmuebles;

			foreach($mongo as $key => $val){
				if($val === NULL)
					unset($mongo[$key]);
			}
	

			$query = array("codigo" =>  $_POST["codigo"]);

            $col->update($query , array('$set' => $mongo), array("upsert" => false));         
      

			//echo $actualizar;
			/*$eliminar = "DELETE FROM fotos_inm WHERE cod_inm = ".$codigo;
			mysql_query($eliminar);


			
			//consultamos las fotos que fueron guardadas temporalmente para este inmueble y las agregamos a la tabla fotos_inm
			$consulta = "SELECT * FROM fotostemp WHERE cod_temp = '".$cod_temp."'";			
			$resultado = mysql_query($consulta, $conexion);
			while($registro = mysql_fetch_array($resultado))
			{			
				$insercion = "INSERT INTO fotos_inm (foto, cod_inm, fecha_creacion) VALUES ('".$registro['nombre_foto']."', '".$codigo."', NOW())";
				//echo $insercion;
				mysql_db_query($bd_nombre, $insercion);
			}
			
			//Eliminamos las fotos de este inmueble de la tabla temporal de fotos
			$eliminacion = "DELETE FROM fotostemp WHERE cod_temp = '".$cod_temp."'";
			mysql_db_query($bd_nombre, $eliminacion);*/
			?>
			<script language="javascript" type="text/javascript">
               alert("El inmueble fue actualizado con exito");
                document.location.href = "cuenta.php";
            </script>
			<?php		
		/*}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
                //alert("El inmueble no pudo ser actualizado");
                //document.location.href = "cuenta.php";
            </script>
		<?php
		}	*/
	
}

}
/*else
{
	header ("Location: index.php");	
}	*/

?>