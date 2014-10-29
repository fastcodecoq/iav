<?php 
require_once("../bd.php");
$clave=md5(sha1($_POST["txt_clave_ne"]));
//vemos si el usuario y contraseña es válido 
$consulta = "SELECT * FROM usuarios WHERE usuario ='".$_POST["txt_usuario"]."' AND pass ='$clave' AND rol != 1 ";

$resultado = mysql_query($consulta, $conexion);
$num_registros = mysql_num_rows($resultado);

if ($num_registros > 0) 
{
    //usuario y contraseña válidos 
    //defino una sesion y guardo datos 
    session_start(); 
	$registro_usuario= mysql_fetch_array($resultado);
    $_SESSION["autentificado"]= "SI"; 

	$_SESSION["usuario"] = $registro_usuario["usuario"];
	$_SESSION["idusuario"] = $registro_usuario["identificacion"];
	$_SESSION["nombre_usuario"] = $registro_usuario["nombres"];
	$_SESSION["apellido_usuario"] = $registro_usuario["apellidos"];
	$_SESSION["email_usuario"] = $registro_usuario["email"];
	
	$permisos = array();
	//CONSULTO LOS PERMISOS
	$consulta = "SELECT * FROM permiso_rol WHERE rol_idrol = ".$registro_usuario["rol"];
	$resultado_rol = mysql_query($consulta, $conexion);
	
	while($registro_rol= mysql_fetch_array($resultado_rol))
	{
		array_push($permisos, $registro_rol["permiso_idpermiso"]);
	}
	
	// ENCAPSULAMOS LOS PERMISOS A UNA SESSION
	$_SESSION["roles"] = $permisos;
	

	mysql_db_query($bd_nombre, $insertar);
	
    header ("Location: contenido.php");
	echo "BIEN LOGUEADO!!!!"; 
	

}
else 
{ 
    //si no existe le mando otra vez a la portada 
   header("Location: index.php?error=1");
} 
?>