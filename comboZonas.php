<?php
/*require_once("bd.php");
$consulta = "SELECT * from municipio_zonas where idmunicipio = ".$_POST["elegido"]." ORDER BY nombrezona ASC";

$resultado_mun = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado_mun);

$options="";

    
	if ($num_reg)
	{
		while ($registro_mun= mysql_fetch_assoc($resultado_mun))
		{
			
			echo '<option value="'.$registro_mun['izona'].'">'.$registro_mun['nombrezona'].'</option>';
		}
	
	}
	else
	{

	echo "no";

	}*/
	
	require_once("bd.php");
$consulta = "SELECT * from municipio_zonas where idmunicipio = ".$_POST["elegido"]." ORDER BY nombrezona ASC";

$resultado_mun = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado_mun);

$val1="";
    
	if ($num_reg)
	{
		$val1='<option value="0"> Escoja </option>';
		while ($registro_mun= mysql_fetch_assoc($resultado_mun))
		{
			
			$val1=$val1.'<option value="'.$registro_mun['idzona'].'">'.$registro_mun['nombrezona'].'</option>';
		}
	
	}
	

$val2="";
	
	
	$consulta = "SELECT * FROM municipio_barrios WHERE idmunicipio = ".$_POST["elegido"]." ORDER BY nombrebarrio ASC";

$resultado_mun = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado_mun);
if ($num_reg)
	{
	
	
		$val2='<option value="0"> Escoja </option>';
		while ($registro_mun= mysql_fetch_assoc($resultado_mun))
		{
			$val2=$val2.'<option value="'.$registro_mun['idbarrio'].'">'.$registro_mun['nombrebarrio'].'</option>';
		}
	
     
}
	
	echo $val1.":".$val2;
?>


