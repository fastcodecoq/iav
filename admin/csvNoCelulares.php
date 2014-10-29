<?php
$permisos = array(1);
require_once("../bd.php");
include_once("control_admin.php");

$consulta = "SELECT * FROM usuarios WHERE infoCel = 1 ORDER BY nombres DESC";
$resultado = mysql_query($consulta, $conexion);

while ($registro = mysql_fetch_array($resultado))
{$shtml = $shtml.$registro["nombres"]." ".$registro["apellidos"].",".$registro["celular"]."\n";}
//aqui le decimos al navegador que vamos a mandar un archivo del tipo CSV
header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=listaNoCelulares.csv");
echo $shtml;
?>
