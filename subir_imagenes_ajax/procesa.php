<?php 
include('../bd.php');
extract($_GET);
 
$_GET["action"] = (isset($_GET["action"])) ? $_GET["action"] : "";
//$_GET["codTemp"] = (isset($_GET["codTemp"])) ? $_GET["codTemp"] : "";
$_POST['numFotos'] = (isset($_POST['numFotos'])) ? $_POST['numFotos'] : "";

 if($_SESSION["rol"] === "3")
 	$_POST['numFotos'] = 35;

//echo "dfd".$_GET["codTemp"];
if($_GET["action"] == 'listFotos'){
	
	$consulta = "SELECT * FROM fotostemp WHERE cod_temp = '".$_GET["codTemp"]."' ORDER BY id_foto DESC";
	$resultado = mysql_query($consulta, $conexion);
	
	while($row = mysql_fetch_array($resultado))
	{
		/*echo  '<li>
				<a href="javascript:;" id="'.$row['id_foto'].'"><img src="imagenes/delete.png" /></a>
				<img src="inmuebles/'.$row['nombre_foto'].'" />
				<span>'.$row['nombre_foto'].'</span>
			</li>';*/
		echo  '<li>
				<a href="javascript:;" id="'.$row['id_foto'].'"><img src="imagenes/delete.png" border="0" /></a>
				<img src="/pic.php?i=/fotoinmueble/'.$row['nombre_foto'].'&w=160&c=60&make=show" />
			</li>';
	}

}else if($_GET["action"] == 'eliminar'){
	
	//consulto la foto que se va a eliminar	
	$consulta = "SELECT * FROM fotostemp WHERE id_foto = '".$_GET['id']."'";
	$resultado = mysql_query($consulta, $conexion);
	$registro = mysql_fetch_array($resultado);
	
	$eliminar = "DELETE FROM fotostemp WHERE id_foto = '".$_GET['id']."'";
	mysql_db_query($bd_nombre, $eliminar);
	unlink("fotoinmueble/".$registro['nombre_foto']);

}else
{
	$consulta = "SELECT count(*) as total FROM fotostemp WHERE cod_temp = '".$_GET["codTemp"]."'";
	$resultado = mysql_query($consulta, $conexion);
	$registro = mysql_fetch_array($resultado);
	$code = $_GET["codTemp"];
	
	//obtenemos la cantidad de elementos que tiene el arreglo archivos a cargar
    $tot = count($_FILES["image"]["name"]);
			
	if(($registro['total'] + $tot) > $_POST['numFotos'])
	{
		return 0;	
	}
	
	$destino = "../fotoinmueble/";
	$idTemp = "";
	/*$filetype =  $_FILES['image']['type'];
	$type = substr($filetype, (strpos($filetype,"/"))+1);
	$types=array("jpeg","gif","png");*/
	
	//if(in_array($type, $types)){
		
		if(isset($_FILES['image'])){
			
			
			//este for recorre el arreglo
        	for ($i = 0; $i < $tot; $i++)
			{
			    $nombre = $_FILES['image']['name'][$i];
				$temp   = $_FILES['image']['tmp_name'][$i];
				/*gomosoft*/
				$name_rand = substr(md5(microtime()), 0, 7);
				$ext = end(explode(".", $nombre));
				$nombre_real = $name_rand. "_[" . $code . "]." . $ext;
				/*gomosoft*/
				
						
				
				if(move_uploaded_file($temp, $destino.$nombre_real))
				{
					$insertar = "INSERT INTO fotostemp VALUES('','".$nombre_real."', '".$_GET["codTemp"]."')";	
					$inser=mysql_query($insertar);
					$ID = mysql_insert_id();
					
					
				}
				
			//echo $insertar ;	
				echo  '<li>
						<a href="javascript:;" id="'.$ID.'"><img src="imagenes/delete.png" border="0" /></a>
						<img src="/pic.php?i=/fotoinmueble/'.$nombre_real.'&w=160&make=show&c=60" />
					</li>';
			}
		}
	//}else{
		//echo "Solo imagenes jpg,png,gif";
	//}
}
?>