<?php
$permisos = array(4,5,6);
require_once("../bd.php");
include_once("control_admin.php");
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
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_permisos"]); $i++)
	{
		$eliminacion = "DELETE FROM permiso WHERE idpermiso= ".$_POST["chk_permisos"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Elimino permiso '.$_POST["chk_permisos"][$i];
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
	alert("Permisos eliminados <?php echo $eliminados?> \Permisos No Eliminados <?php echo $no_eliminados?>");
	document.location.href = "permisos.php";
	</script>
	<?
}
?>

</head>

<body style="margin:auto">
<form id="frm_permisos" name="frm_permisos" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "permisos.php"; 	//your file name  (the name of this file)
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>PERMISOS</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">
                <?php
                if (in_array(4, $_SESSION["roles"]))
	  			{
				?>
				<input type="submit" name="Submit" value="Agregar" onclick="document.frm_permisos.action = 'permiso_add.php'; document.frm_permisos.submit()" />
                <?php
				}
				?>
				&nbsp;&nbsp;
                <?php
                if (in_array(5, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar?')) { eliminar_permiso(); }" />
                <?php
				}
				?></td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>

            <label></label>
            <table width="50%" border="0" cellspacing="0" cellpadding="0" class="list">
              <?php
			$consulta = "SELECT * FROM permiso ORDER BY nompermiso ";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT * FROM permiso ORDER BY nompermiso LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion_pagina.php");
			
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left"><strong>Permiso</strong></td>
                <?php
                if (in_array(6, $_SESSION["roles"]))
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
                <td style="text-align: center;"><input name="chk_permisos[]" type="checkbox" value="<?php echo $registro["idpermiso"]; ?>" /></td>
                <td class="left">&nbsp;<?php echo $registro["nompermiso"]?></td>
                <?php
                if (in_array(6, $_SESSION["roles"]))
	  			{
				?>
                <td class="center"><a href="#" onclick="actualizar_permiso(<?php echo $registro["idpermiso"]?>);">[Editar]</a></td>
                <?php
				}
				?>
              </tr>
              <?
				 }
				 ?>
              <tr>
                <td colspan="5"><br /><?php echo $paginacion?></td>
              </tr>
              <?php 
			}
			else
			{
				echo "No existen permisos creados";
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
