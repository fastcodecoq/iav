<?php
include('../bd.php');

$_POST = array();

$_POST['codigo'] = $_REQUEST['codigo'];
$_POST['estado'] = $_REQUEST['estado'];

if(isset($_POST["codigo"]) && !empty($_POST["codigo"]))
{
	$codigo = $_POST["codigo"] ;
	$estado = $_POST["estado"] ;
	$condicion = '';

	$con = new MongoClient();
	$db  = $con->iav;
	$col = $db->inmuebles;
	
	if($estado == 1)
	{
		$condicion = ", fecha_activacion = NOW()";	
	}

	$actualizar = "UPDATE inmueble SET estado=$estado $condicion WHERE codigo =".$codigo;
	$query = array("codigo" =>  $codigo );

		
		if (!mysql_db_query($bd_nombre, $actualizar))
			echo "Inmueble no actualizado:\n$actualizar";
		else
			$col->update($query , array('$set' => array("estado" => $estado)), array("upsert" => true));    

		exit;
}
?>