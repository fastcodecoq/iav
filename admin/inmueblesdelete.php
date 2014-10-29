<?php
	include_once('../bd.php');
	
	$eliminados = $no_eliminados = 0;
	
	for ($i = 0; $i < sizeof($_POST["chk_inmuebles"]); $i++)
	{
		$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = ".$_POST["chk_inmuebles"][$i];
		$resultado_del = mysql_query($consulta, $conexion);	
		
		while($imagenes = mysql_fetch_array($resultado_del))
		{
			unlink("../inmuebles/".$imagenes["foto"]);	
		}
		
		// Eliminar fotos de la BD
		$eliminar = "DELETE FROM fotos_inm WHERE cod_inm = ".(int)$_POST["chk_inmuebles"][$i];
		mysql_query($eliminar);
		
		$sql = "DELETE FROM inmueble WHERE codigo = ".(int)$_POST["chk_inmuebles"][$i];
		if(!mysql_query($sql))
			$no_eliminados++;
		else
			$eliminados++;
	}
	
	echo "Inmuebles(s) eliminado(s) ".$eliminados."\nInmueble(s) No Eliminado(s) ".$no_eliminados;
	
?>