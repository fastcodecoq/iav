<?php
require("bd.php");

$tipo_inm = "";
$para = "";
$ciudad = "";

if($_GET['tipo'] != 0)
{
	$tipo_inm .= "AND tipo_inm = ".$_GET['tipo'];	
}

if($_GET['para'] != 0)
{
	$para .= "AND tipo_neg = ".$_GET['para'];	
}

if($_GET['ciudad'] != 0)
{
	$ciudad .= "AND ciudad = ".$_GET['ciudad'];	
}

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Select all the rows in the markers table
$query = "SELECT tipo_in.dest_tip, inmueble.* FROM inmueble JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm WHERE estado = 1 $tipo_inm $para $ciudad";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){

  if($row['tipo_neg'] == 1)
  {
	$valor = $row['campo_5'];  
  }
  else
  {
	$valor = $row['campo_53'];
  }
  //Consultamos la foto del inmueble
  $consulta = "SELECT * FROM fotos_inm WHERE cod_inm = '".$row['codigo']."' LIMIT 0,1";
  $resultadoFoto = mysql_query($consulta, $conexion);
  $num_fotos = mysql_num_rows($resultadoFoto);
  $registroFoto = mysql_fetch_array($resultadoFoto);
  
  if($num_fotos > 0)
  {
	$foto = $registroFoto['foto'];  
  }
  else
  {
	$foto = "sinImagen150.jpg";	  
  }
  

   $short = file_get_contents( "http://inmueblealaventa.com/short/get/" . $row['codigo'] );
   $short = json_decode($short, true);
   $short = $short["rs"]["short"];
  
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($row['codigo']) . '" ';
  echo 'precio="' . number_format($valor,0,',','.') . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lon'] . '" ';
  echo 'type="' . $row['dirMapa'] . '" ';
  echo 'foto= "' . $foto . '" ';
  echo 'tipoIn= "' . $row['dest_tip'] . '" ';
  echo 'barrio= "' . $row['campo_1'] . '" ';
  echo 'short= "' . $short . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>