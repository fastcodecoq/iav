<?php 
require_once("bd.php");

if($_GET['usu'] != '')
{
	$clave=$_GET["pass"];
	$usuario=$_GET["usu"];
}
else
{
	$clave=md5(sha1($_POST["password"]));
	$usuario=$_POST["username"];
}

//vemos si el usuario y contraseña es válido 
$consulta = "SELECT * FROM usuarios WHERE usuario ='$usuario' AND pass ='$clave'";

$resultado = mysql_query($consulta, $conexion);
$num_registros = mysql_num_rows($resultado);

if ($num_registros > 0) 
{
    //defino una sesion y guardo datos 
    session_start(); 
	$registro_usuario= mysql_fetch_array($resultado);

	$_SESSION["usuario"] = $registro_usuario["usuario"];
	$_SESSION["idusuario"] = $registro_usuario["identificacion"];
	$_SESSION["nombre_usuario"] = $registro_usuario["nombres"];
	$_SESSION["apellido_usuario"] = $registro_usuario["apellidos"];
	$_SESSION["email_usuario"] = $registro_usuario["email"];
	$_SESSION["rol"] = $registro_usuario["rol"];

	//ACTUALIZO LA BITACORA
	$des_bitacora = 'Logueado Correctamente';
	$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
	mysql_db_query($bd_nombre, $insertar);
	/////////////////////////

	header ("Location: inicio");

}
else 
{ 
    //si no existe le mando otra vez a la portada 
    header("Location: index.php?error=1");
	
} 
?>