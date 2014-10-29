<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(1,2,3,21);
require_once("../bd.php");
include_once("control_admin.php");

if (isset($_POST["hdd_accion"])){	$_POST["hdd_accion"]=$_POST["hdd_accion"];}else{	$_POST["hdd_accion"]="";}
if (isset($_POST["pagina"])){	$_POST["pagina"]=$_POST["pagina"];}else{	$_POST["pagina"]="";}

//if (isset($page)){	$page=$page;}else{	$page="";}
if (isset($_GET["page"])){	$_GET["page"]=$_GET["page"];}else{	$_GET["page"]="";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_usuarios"]); $i++)
	{
		$eliminacion = "DELETE FROM usuarios WHERE identificacion = '".$_POST["chk_usuarios"][$i]."'";
		$resultado = mysql_query($eliminacion);
		
		if ($resultado)
		{
			$eliminados++;
		}
		else
		{
			$no_eliminados++;	
		}
	}
	?>
	<script language="javascript" type="text/javascript">
	alert("Usuario(s) eliminado(s) <?php echo $eliminados?> \nUsuario(s) No Eliminado(s) <?php echo $no_eliminados?>");
	document.location.href = "usuarios.php";
	</script>
	<?php
}
?>
	
</head>

<body style="margin:auto">
<form id="frm_usuarios" name="frm_usuarios" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "usuarios.php"; 	//your file name  (the name of this file)
	$TAMANO_PAGINA = 8; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$inicio = ($page - 1) * $TAMANO_PAGINA; 			//first item to display on this page
	else
		$inicio = 0;		
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php");?></td>
  </tr>
  <tr>
    <td bgcolor="#056C46"><?php include_once("menu.php");?></td>
  </tr>
  <tr>
    <td id="content" align="center"><br />
      <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="box">
		  	<div class="left"></div>
  			<div class="right"></div>
  			<div class="heading">
				<h1 style="background-image:url(imagenes/usuarios.png)">&nbsp;<strong>USUARIOS</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">
                <?php
                if (in_array(1, $_SESSION["roles"]))
	  			{
				?>
				<input type="submit" name="Submit" value="Agregar" onclick="document.frm_usuarios.action = 'usuario_add.php'; document.frm_usuarios.submit()" />
                <?php
				}
				?>
				&nbsp;&nbsp;
                <?php
                if (in_array(2, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar el usuario?')) { eliminar_usuarios(); }" />
                <?php
				}
				?></td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>

            <label></label>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list" >
              <?php
			$consulta = "SELECT usuarios.*, rol.nomrol AS cargo, municipio.nombreMunicipio
						FROM usuarios
						INNER JOIN rol ON usuarios.rol = rol.idrol
						JOIN municipio ON municipio.idmunicipio = usuarios.ciudad
						ORDER BY nombres,apellidos DESC";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT usuarios.*, rol.nomrol AS cargo, municipio.nombreMunicipio 
						FROM usuarios
						INNER JOIN rol ON usuarios.rol = rol.idrol
						JOIN municipio ON municipio.idmunicipio = usuarios.ciudad
						ORDER BY nombres,apellidos LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion_pagina.php");
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
              	<?php
                if (in_array(2, $_SESSION["roles"]))
	  			{
				?>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <?php
				}
				?>
                <td bgcolor="#EFEFEF" class="left"><strong>Cedula</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Nombres</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Apellidos</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Telefono</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Celular</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Ciudad</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>E-mail</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Rol</strong></td>
				<?php
                if (in_array(3, $_SESSION["roles"]))
	  			{
				?>
                <td bgcolor="#EFEFEF" class="right"><strong>Acci&oacute;n</strong></td>
                <?php
				}
				?>
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{
								
				?>
              <tr >
                <?php
                if (in_array(2, $_SESSION["roles"]))
	  			{
				?>
                <td style="text-align: center;"><input name="chk_usuarios[]" type="checkbox" value="<?php echo $registro["identificacion"]; ?>" /></td>
                <?php
				}
				?>
                <td class="left">&nbsp;<?php echo $registro["identificacion"]?></td>
                <td class="left">&nbsp;<?php echo $registro["nombres"]?></td>
				<td class="left">&nbsp;<?php echo $registro["apellidos"]?></td>
				<td class="left">&nbsp;<?php echo $registro["telefono"]?></td>
				<td class="left">&nbsp;<?php echo $registro["celular"]?></td>
                <td class="left">&nbsp;<?php echo $registro["nombreMunicipio"]?></td>
                <td class="left">&nbsp;<?php echo $registro["email"]?></td>				
				<td class="left">&nbsp;<?php echo $registro["cargo"]?></td>
                <?php
                if (in_array(3, $_SESSION["roles"]))
	  			{
				?>
                <td align="center"><a href="#" onclick="editar_usuario(<?php echo $registro["id"]?>);"><img src="imagenes/edit.png" width="22" height="22" border="0" title="Editar" /></a></td>
              </tr>
                <?php
				}
				?>
              <?php
				 }
				 ?>
              <tr>
                <td colspan="14"><br /><?php echo $paginacion?></td>
              </tr>
              <?php 
			}
			else
			{
				echo "No existen usuarios creados";
			}
			?>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
<input type="hidden" name="pagina" value="<?php $_POST["pagina"]?>"/>
<input type="hidden" name="hdd_id" value=""/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
