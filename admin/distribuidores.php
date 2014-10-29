<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(10,11,12);
require_once("../bd.php");
include_once("control_admin.php");;
include_once("../funciones/moneda.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="estilos/menu.css" rel="stylesheet" type="text/css" />
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/imagenes_thumbnail.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_distribuidores"]); $i++)
	{
		$eliminacion = "DELETE FROM distribuidores WHERE id = ".$_POST["chk_distribuidores"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Elimino distribuidor';
			$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
			mysql_db_query($bd_nombre, $insertar);
			$eliminados++;
		}
		else
		{
			$no_eliminados++;	
		}
	}
	?>
	<script language="javascript" type="text/javascript">
	alert("Distribuidor(es) eliminado(s) <?php echo $eliminados?> \nDistribuidor(es) No Eliminado(s) <?php echo $no_eliminados?>");
	document.location.href = "distribuidores.php";
	</script>
	<?
}
?>
	
</head>

<body style="margin:auto">
<form id="frm_distribuidores" name="frm_distribuidores" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "distribuidores.php"; 	//your file name  (the name of this file)
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
				<h1 style="background-image:url(imagenes/carrito.png)">&nbsp;<strong>DISTRIBUIDORES</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">
                <?php
                if (in_array(10, $_SESSION["roles"]))
	  			{
				?>
				<input type="submit" name="Submit" value="Agregar" onclick="document.frm_distribuidores.action = 'distribuidor_add.php'; document.frm_distribuidores.submit()" />
                <?php
				}
				?>
				&nbsp;&nbsp;
                <?php
                if (in_array(11, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar?')) { eliminar_distribuidor(); }" />
                <?php
				}
				?>
                </td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list" >
              <?php
			$consulta = "SELECT distribuidores.id, distribuidores.nombre, distribuidores.direccion, distribuidores.telefono, lugardis.nombre AS zona
						FROM distribuidores
						INNER JOIN lugardis ON distribuidores.id_lugardis_fk = lugardis.id
						ORDER BY distribuidores.nombre ";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT distribuidores.id,distribuidores.nombre, distribuidores.direccion, distribuidores.telefono, lugardis.nombre AS zona
						FROM distribuidores
						INNER JOIN lugardis ON distribuidores.id_lugardis_fk = lugardis.id
						ORDER BY distribuidores.nombre LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion.php");
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left"><strong>Nombre</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Direcci&oacute;n</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Tel&eacute;fono</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Zona distribuci&oacute;n</strong></td>
                <?php
                if (in_array(12, $_SESSION["roles"]))
	  			{
				?>
                <td bgcolor="#EFEFEF" class="center"><strong>Acci&oacute;n</strong></td>
                <?php
				}
				?>
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{				
				?>
              <tr>
                <td style="text-align: center;"><input name="chk_distribuidores[]" type="checkbox" value="<?php echo $registro["id"]; ?>" /></td>
                <td class="left">&nbsp;<?php echo $registro["nombre"]?></td>
				<td class="left">&nbsp;<?php echo $registro["direccion"]?></td>
				<td class="left">&nbsp;<?php echo $registro["telefono"]?></td>
				<td class="left">&nbsp;<?php echo $registro["zona"]?></td>
                <?php
                if (in_array(12, $_SESSION["roles"]))
	  			{
				?>
                <td class="center"><a href="#" onclick="editar_distribuidor(<?php echo $registro["id"]?>);">[Editar]</a></td>
                <?php
				}
				?>
              </tr>
              <?
				 }
				 ?>
              <tr>
                <td colspan="14"><br /><?php echo $paginacion?></td>
              </tr>
              <?php 
			}
			else
			{
				echo "No existen distribuidores creados";
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
<input type="hidden" name="pagina" value="<?= $_POST["pagina"]?>"/>
<input type="hidden" name="hdd_id" value=""/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
