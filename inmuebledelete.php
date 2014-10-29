<?php
	include_once('bd.php');
	$consulta = "SELECT * FROM fotos_inm WHERE cod_inm = ".(int)$_POST['hdd_id'];
	$resultado_del = mysql_query($consulta, $conexion);	
	
	while($imagenes = mysql_fetch_array($resultado_del))
	{
		if($imagenes["foto"] != "")
		{
			unlink("fotoinmueble/".$imagenes["foto"]);	
		}
	}

	// Eliminar fotos de la BD
	$eliminar = "DELETE FROM fotos_inm WHERE cod_inm = ".(int)$_POST['hdd_id'];
	mysql_query($eliminar);
	
	$sql = "DELETE FROM inmueble WHERE codigo = ".(int)$_POST['hdd_id'];

	    $con = new MongoCLient();
		$db = $con->iav;
		$col = $db->inmuebles;
		$rs = $col->remove(array("codigo" => $_POST['hdd_id']), array("justOne" => true));
	

	if(!mysql_query($sql)) {

		?>
		<script language="javascript" type="text/javascript">
                alert("El inmueble no pudo ser eliminado");
                document.location.href = "cuenta.php";
            </script>
        <?php
	}
	else {
		?>
		<script language="javascript" type="text/javascript">
            alert("El inmueble fue eliminado con exito");
            document.location.href = "cuenta.php";
        </script>
		<?php
	}
?>