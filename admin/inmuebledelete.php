<?php
	include_once('../bd.php');
	$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = ".(int)$_POST['id'];
	$resultado_del = mysql_query($consulta, $conexion);	
	
	while($imagenes = mysql_fetch_array($resultado_del))
	{
		if($imagenes["foto"] != "")
		{
			unlink("../inmuebles/".$imagenes["foto"]);	
		}
	}
	// Eliminar fotos de la BD
	$eliminar = "DELETE FROM fotos_inm WHERE cod_inm = ".(int)$_POST['id'];
	mysql_query($eliminar);

	$con = new MongoClient();
	$db  = $con->iav2;
	$col = $db->inmuebles;

	$col->remove(array('id' => (int) $_POST['id']), array("justOne" => true));
	
	$sql = "DELETE FROM inmueble WHERE codigo = ".(int)$_POST['id'];
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
	else
		echo "Inmueble eliminado";
	exit;
?>