<?php
session_start();
include_once('bd.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php 
if($_POST['hdd_num_reg'] != '')
{
	?>
    <script>
    alert('entra');</script>
    <?php
	for($i=1; $i<=$_POST['hdd_num_reg']; $i++)
	{

        $actualizar = "UPDATE municipio SET nombreMunicipio = '".$_POST['desmun_'.$i]."' WHERE idmunicipio = ".$_POST['idmun_'.$i];
		if (!mysql_db_query($bd_nombre, $actualizar))
			echo "Error al guardar datos:\n$actualizar";
		else
			echo "Medico actualizado<BR>";

	}
}
?>
</head>


<body>
<form action="" method="post">
<?php  
$consulta = "SELECT * FROM municipio";
$resultado = mysql_query($consulta, $conexion);
$num_reg = mysql_num_rows($resultado);
$i=1;
while ($registro_esp= mysql_fetch_array($resultado))
{
	?>
	<input type="text" value="<?php echo $registro_esp['idmunicipio'];?>" size="10" name="idmun_<?php echo $i?>" readonly="readonly" />
  <input type="text" value="<?php echo $registro_esp['nombreMunicipio'];?>" size="50" name="desmun_<?php echo $i?>" /><?php echo $registro_esp['nombreMunicipio'];?><br/>
	<?php	
	$i++;
}

?>
<input name="hdd_num_reg" type="text" value="<?php echo $num_reg ?>" /><br />
<input name="" type="submit" value="Enviar" />
</form>
</body>
</html>