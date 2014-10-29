<?php
include('bd.php');

//Abrimos el archivo en modo lectura
$fp = fopen("CAmpos_Inmuebles_IAV.csv","r");
//Leemos linea por linea el contenido del archivo
$i = $contador = 1;

while ($linea= fgets($fp,10000))
{
	
	//Sustituimos las ocurrencias de la cadena que buscamos
	$linea = explode(";",$linea);
	
	$campo = str_replace('', '',$linea[0]);
	//$cadena = substr($cadena, 0, -$num);
	$campo = substr($linea[0],0,-2);

	//echo $campo.'&lt;input name="'.$campo.'" type="text" value="&lt;?php echo $_POST["'.$campo.'"]?&gt;" /&gt;<br>';
	
	//echo "$"."$campo"."_$i = $"."_POST['".$campo."'];<br>";
	
	//echo "campo_$i, ";	
	
	//echo "'$".$campo."_$i', ";
	
	echo '
		  &lt;?php
		  if($registro["campo_'.$i.'"] != "")
		  {
			?&gt;
			&lt;div class="mostrarDatosInmueblesCampos"&gt;'.$campo.'&lt;/div&gt;&lt;div class="mostrarDatosInmueblesResultados"&gt;&lt;?php echo $registro["campo_'.$i.'"]?&gt;&lt;/div&gt;
		  	&lt;?php
		  }
		  ?&gt;
		  <br><br>';

	
	$i++;
	
}

/*for($i=1; $i<=53; $i++)
{
	
	/*$insertar = "alter table inmueble add column campo_$i varchar(255)";
	mysql_db_query($bd_nombre, $insertar);*/
//}*/
?>


