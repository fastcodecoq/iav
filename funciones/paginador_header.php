<?php
$datos=mysql_query($consulta);
$num_rows=mysql_num_rows($datos);
$rows_per_page= 35;
$lastpage= ceil($num_rows / $rows_per_page);
$page=(int)$page;
if($page > $lastpage)
	{
    $page= $lastpage;
	}
if($page < 1)
	{
    $page=1;
	}
$limit= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
$consulta .=" $limit";

$buscarver=mysql_query($consulta);
?>