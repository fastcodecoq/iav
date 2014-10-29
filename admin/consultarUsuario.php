<?php
require('../bd.php');

/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];


$validateError= "This username is already taken";
$validateSuccess= "This username is available";

//CONSULTAMOS SI EL CORREO YA ESTA EN LA BASE DE DATOS
$consulta = "SELECT COUNT(usuario) AS cantidad FROM usuarios WHERE usuario = '".$validateValue."'";

$resultado = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado);
$registro = mysql_fetch_array($resultado);

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	//$arrayToJs[2] = $registro['cantidad'];

if($registro['cantidad'] == 0){		// validado??
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}

?>