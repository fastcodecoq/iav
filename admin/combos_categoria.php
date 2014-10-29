<?php
require_once("../bd.php");
$consulta = "SELECT idsubcategoria, dessubcategoria FROM subcategorias WHERE idcategoria = ".$_POST["elegido"]." ORDER BY dessubcategoria ASC";

$resultado_cat = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado_cat);

$options="";
if ($_POST["elegido"]== !'') {
    
	
		while ($registro_cat= mysql_fetch_array($resultado_cat))
		{
			$options .='
			<option value="'.$registro_cat['idsubcategoria'].'">'.$registro_cat['dessubcategoria'].'</option>';
		}
	
     
}
else
{
	$options='<option value="0">[ Escoja ]</option>';
}
echo $options;    
?>