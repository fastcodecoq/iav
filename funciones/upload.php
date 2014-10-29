<?php	
//FUNCION PARA SUBIR ARCHIVOS
//si el archivo es subido exitosamente, devuelve el nombre real del archivo que subio, en 
//caso contrario, devuelve false


function subir_archivo($nombre,  $nombre_tmp, $directorio)
{		
	if ($tamano <= $max_tamano)
	{
		$nombre_real = "";
		
		//busca un nombre que no exista
		do
		{
			srand((double)microtime()*1000000);
			$numero_azar = rand();
			$nombre_real = $numero_azar."_".$nombre."";
			
			//echo "sdf".$nombre_tmp.$directorio.$nombre_real;
		} while (file_exists("$directorio".$nombre_real));
		
		if (!file_exists("$directorio".$nombre_real))
		{
			if (move_uploaded_file ($nombre_tmp,$directorio.$nombre_real)) {
				//echo "El archivo fue subido con exito";
				return $nombre_real;
			} else {
				?>
				<script language="javascript" type="text/javascript">
					alert("No se pudo adjuntar el archivo!!");
				</script>
				<?php
			//	return false;
			}
	
		} else {
			?>
			<script language="javascript" type="text/javascript">
			alert("Ya existe un archivo con el mismo nombre de archivo, intente cambiándole el nombre");
			</script>
			<?php
			return false;
		}
	}
	else
	{
		?>
		<script language="javascript" type="text/javascript">
		alert("Mas del peso permitido <?=$max_tamano?>");
		</script>
		<?php
		return false;
	}
}	
?>