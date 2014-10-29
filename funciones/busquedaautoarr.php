<?php


require('../bd.php');
$keyword = $_POST['data'];
	$sql = "SELECT m.idmunicipio, m.nombreMunicipio, d.nombre FROM municipio m, departamento d
	WHERE m.nombreMunicipio like '".$keyword."%' and d.iddepartamento=m.departamento_iddepartamento limit 0,20";
	//$sql = "select name from ".$db_table."";
	$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result))
	{
		echo '<ul class="listarr">';
		while($row = mysql_fetch_array($result))
		{
			$id=strtolower($row['idmunicipio']);
			$dep=strtolower($row['nombre']);
			$str = strtolower($row['nombreMunicipio']);
			$start = strpos($str,$keyword); 
			$end   = similar_text($str,$keyword); 
			$last = substr($str,$end,strlen($str));
			$first = substr($str,$start,$end);
			
			$final = '<span  class="bold">'.$first.'</span>'.$last;
			
		
			echo '<li >
			
			<a href=\'javascript:void(0);\' >'.$final."-".$dep."-".$id.'</a></li>';
		}
		echo "</ul>";
	}
	else
		echo 0;


?>