<?php
	include_once('../bd.php');
	$consulta = "SELECT * FROM fotos_hotel WHERE cod_hot = ".(int)$_POST['id'];
	$resultado_del = mysql_query($consulta, $conexion);	
	
	while($imagenes = mysql_fetch_array($resultado_del))
	{
		if($imagenes["foto"] != "")
		{
			unlink("../fotosHoteles/".$imagenes["foto"]);	
		}
	}
	
	$sql = "DELETE FROM hoteles WHERE id = ".(int)$_POST['id'];
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	else
		echo "Hotel eliminado";
	exit;
?>