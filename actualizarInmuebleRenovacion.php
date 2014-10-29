<?php
include('controlSesion.php');
require('bd.php');

//Consultamos el numero de fotos por plan

if($_POST['codigo'] != '' && $_POST['cod_temp'] != '' &&  $_POST['hdd_accion'] == 'renovar')
{
	
	$codigo = $_POST['codigo'];
	$plan = $_POST['plan'];
	$cod_temp = $_POST['cod_temp'];
	
	$actualizar = "UPDATE inmueble SET plan=$plan, fecha_inscripcion=NOW(), fecha_activacion='0000-00-00' WHERE codigo = ".$codigo;
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{
			$eliminar = "DELETE FROM fotos_inm WHERE cod_inm = ".$codigo;
			mysql_query($eliminar);
			
			//consultamos las fotos que fueron guardadas temporalmente para este inmueble y las agregamos a la tabla fotos_inm
			$consulta = "SELECT * FROM fotostemp WHERE cod_temp = '".$cod_temp."'";			
			$resultado = mysql_query($consulta, $conexion);
			while($registro = mysql_fetch_array($resultado))
			{			
				$insercion = "INSERT INTO fotos_inm (foto, cod_inm, fecha_creacion) VALUES ('".$registro['nombre_foto']."', '".$codigo."', NOW())";
				mysql_db_query($bd_nombre, $insercion);
			}
			
			//Eliminamos las fotos de este inmueble de la tabla temporal de fotos
			$eliminacion = "DELETE FROM fotostemp WHERE cod_temp = '".$cod_temp."'";
			mysql_db_query($bd_nombre, $eliminacion);
			
			//COdigo aleatorio
			$str = "1234567890";
			$cad = "";
			for($i=0;$i<5;$i++) {
				$cad .= substr($str,rand(0,10),1);
			}
			?>
			<script language="javascript" type="text/javascript">
                alert("El inmueble fue actualizado con exito");
                document.location.href = "ordenPago.php?plan=<?php echo $plan?>&cod=<?php echo $codigo.'RE'.$cad?>";
            </script>
			<?		
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
                alert("El inmueble no pudo ser actualizado");
                document.location.href = "cuenta.php";
            </script>
		<?
		}	

}
else
{
	header ("Location: index.php");	
}	

?>