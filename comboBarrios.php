<?php
require_once("bd.php");
$consulta = "SELECT * FROM municipio_barrios WHERE idmunicipio = ".$_POST["elegido"]." ORDER BY nombrebarrio ASC";

$resultado_mun = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado_mun);

$options="";
if ($_POST["elegido"]== !'') {
    
	
		while ($registro_mun= mysql_fetch_assoc($resultado_mun))
		{
			$options .='
			<option value="'.$registro_mun['idbarrio'].'">'.$registro_mun['nombrebarrio'].'</option>';
		}
	
     
}
else
{
	$options='<option value="0">[ Escoja ]</option>';
}
echo $options;    
?>