<?php
header("Content-type:image");

require_once('apps/config.inc.php');


$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


$query = "SELECT * FROM fotos_inm WHERE cod_inm = " . $_GET['cod'] . " LIMIT 1";

$rs = $db->query($query) or die ($db->error);


if($rs->num_rows > 0)
{

	$rs = $rs->fetch_assoc();

	$p =  urlencode($rs['foto']);

    echo file_get_contents('http://inmueblealaventa.com/pic.php?i=/fotoinmueble/' . $p . '&w=160&h=120&make=show&c=60');

}else
echo file_get_contents('http://inmueblealaventa.com/pic.php?i=/imagenes/sinImagen150.jpg&w=160&h=120&make=show&c=60');