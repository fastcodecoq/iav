<?php
$permisos = array(16,17,18);
require_once("../bd.php");
include_once("control_admin.php");
include_once('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="../estilos/menu.css" rel="stylesheet" type="text/css" />
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_cupon"]); $i++)
	{
		$eliminacion = "DELETE FROM cupon WHERE id = ".$_POST["chk_cupon"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Elimino cupon';
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
	alert("Cupon(es) eliminado(s) <?php echo $eliminados?> \nCupon(es) No Eliminado(s) <?php echo $no_eliminados?>");
	document.location.href = "cupones.php";
	</script>
	<?
}
?>

</head>

<body style="margin:auto">
<form id="frm_cupon" name="frm_cupon" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "cupones.php"; 	//your file name  (the name of this file)
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>CUPONES</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">
                <?php
                if (in_array(16, $_SESSION["roles"]))
	  			{
				?>
				<input type="submit" name="Submit" value="Agregar" onclick="document.frm_cupon.action = 'cupon_add.php'; document.frm_cupon.submit()" />
                <?php
                }
                ?>
				&nbsp;&nbsp;
                <?php
                if (in_array(17, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar?')) { eliminar_cupon(); }" /></td>
                <?php
				}
				?>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>

            <label></label>
            <table width="50%" border="0" cellspacing="0" cellpadding="0" class="list">
              <?php
			$consulta = "SELECT * FROM cupon ORDER BY fecregcupon ";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT * FROM cupon ORDER BY fecregcupon LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion.php");
			
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left"><strong>Nombre cup&oacute;n</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>C&oacute;digo</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Descuento</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Fecha inicio</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Fecha final</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Estado</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>No. veces usado</strong></td>
                <td bgcolor="#EFEFEF" class="center"><strong>Acci&oacute;n</strong></td>
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{
				?>
              <tr>
                <td style="text-align: center;"><input name="chk_cupon[]" type="checkbox" value="<?php echo $registro["id"]; ?>" /></td>
                <td class="left">&nbsp;<?php echo $registro["nomcupon"]?></td>
                <td class="left">&nbsp;<?php echo $registro["codcupon"]?></td>
                <td class="left">&nbsp;<?php if($registro["tipo"] == 1) { echo $registro["descuento"].'%';} else if($registro["tipo"] == 2){ echo number_format($registro["descuento"], 2, ",", ".");}?></td>
                <td class="left">&nbsp;<?php echo $registro["fecini"]?></td>
                <td class="left">&nbsp;<?php echo $registro["fecfin"]?></td>
                <td class="left">&nbsp;<?php echo estados($registro["estado"])?></td>
                <td class="left">&nbsp;<?php echo $registro["contador"]?></td>
                <td align="right"><a href="#" onclick="editar_categoria(<?php echo $registro["id"]?>);">[Editar]</a></td>
              </tr>
              <?
				 }
				 ?>
              <tr>
                <td colspan="9"><br /><?php echo $paginacion?></td>
              </tr>
              <?php 
			}
			else
			{
				echo "No existen cupones creados";
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
