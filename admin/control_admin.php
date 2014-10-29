<?php
session_start();
//Control de acceso
if (!(isset($_SESSION["autentificado"]) || $_SESSION["autentificado"] == "SI")) 
{
	header ("Location: index.php?error=2");
	exit();
}


$dar_permiso = false;
for ($i=0; $i<sizeof($permisos); $i++)
{
	if (in_array($permisos[$i], $_SESSION["roles"]))
	{
		$dar_permiso = true;
		break;
	}
}

if (!($dar_permiso))
{
	header ("Location: index.php?error=2");
	exit();
}
?>