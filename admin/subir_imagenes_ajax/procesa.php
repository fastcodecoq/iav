<?php 
include('../../bd.php');


if($_GET['action'] == 'listFotos'){
	
	$consulta = "SELECT * FROM fotostemp WHERE cod_temp = '9999999' ORDER BY id_foto DESC";
	$resultado = mysql_query($consulta, $conexion);
	while($row = mysql_fetch_array($resultado))
	{
		/*echo  '<li>
				<a href="javascript:;" id="'.$row['id_foto'].'"><img src="delete.png" /></a>
				<img src="photos/'.$row['nombre_foto'].'" />
				<span>'.$row['nombre_foto'].'</span>
			</li>';*/
		echo  '<li>
				<a href="javascript:;" id="'.$row['id_foto'].'"><img src="../imagenes/delete.png" border="0" /></a>
				<img src="../fotosHoteles/'.$row['nombre_foto'].'" />
			</li>';
	}

}else if($_GET['action'] == 'eliminar'){
	
	//consulto la foto que se va a eliminar	
	$consulta = "SELECT * FROM fotostemp WHERE id_foto = '".$_GET['id']."'";
	$resultado = mysql_query($consulta, $conexion);
	$registro = mysql_fetch_array($resultado);
	
	$eliminar = "DELETE FROM fotostemp WHERE id_foto = '".$_GET['id']."'";
	mysql_db_query($bd_nombre, $eliminar);
	unlink("../../fotosHoteles/".$registro['nombre_foto']);

}else
{
	$tot = count($_FILES["image"]["name"]);
	
	$destino = "../../fotosHoteles/";
	if(isset($_FILES['image'])){		
		
		//este for recorre el arreglo
		for ($i = 0; $i < $tot; $i++)
		{
			srand((double)microtime()*1000000);
			$numero_azar = rand();
			$nombre = $_FILES['image']['name'][$i];
			$temp   = $_FILES['image']['tmp_name'][$i];
			$nombre_real = $numero_azar." ".$nombre."";
			
			// subir imagen al servidor
			if(move_uploaded_file($temp, $destino.$nombre_real))
			{
				$insertar = "INSERT INTO fotostemp VALUES('','".$nombre_real."', '".$_POST['codTemp']."')";	
				mysql_db_query($bd_nombre, $insertar);
				$ID = mysql_insert_id();
			}
			
			
			/*echo  '<li>
					<a href="javascript:;" id="'.$ID.'"><img src="imagenes/delete.png" /></a>
					<img src="inmuebles/'.$nombre_real.'" />
					<span>'.$nombre_real.'</span>
				</li>';*/
			echo  '<li>
					<a href="javascript:;" id="'.$ID.'"><img src="../imagenes/delete.png" border="0" /></a>
					<img src="../fotosHoteles/'.$nombre_real.'" />
				</li>';
		}
	}
}
?>