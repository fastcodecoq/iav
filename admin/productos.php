<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(10,11,12);
require_once("../bd.php");
include_once("control_admin.php");;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Luna Sanches - Soluciones Eficientes para la Construcción | VENTA - REPARACION - ALQUILER DE MAQUINARIA PARA CONSTRUCCION - BLOQUERAS - MEZCLADORAS - ELEVADORES - VIBROCOMPACTADORES - CANGUROS -TALADROS -DEMOLEDORES-CORTADORAS PARA PISO-CERCHAS-PARALES Y ANCLAJES</title>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/imagenes_thumbnail.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_productos"]); $i++)
	{
		$consulta = "SELECT * FROM productos WHERE id = ".$_POST["chk_productos"][$i];
		$resultado_del = mysql_query($consulta, $conexion);	
		$registro_del = mysql_fetch_array($resultado_del);
	
		$eliminacion = "DELETE FROM productos WHERE id = ".$_POST["chk_productos"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			//Elimino la imagen del producto
			unlink("../img_productos/".$registro_del["imagen"]);
			if($registro_del["imagen2"] != '')
				unlink("../img_productos/".$registro_del["imagen2"]);

				if($registro_del["imagen3"] != '')
				unlink("../img_productos/".$registro_del["imagen3"]);

			$eliminados++;
		}
		else
		{
			$no_eliminados++;	
		}
	}
	?>
	<script language="javascript" type="text/javascript">
	alert("Producto(s) eliminado(s) <?php echo $eliminados?> \nProducto(s) No Eliminado(s) <?php echo $no_eliminados?>");
	document.location.href = "productos.php";
	</script>
	<?
}
?>
	
</head>

<body style="margin:auto">
<form id="frm_productos" name="frm_productos" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "productos.php"; 	//your file name  (the name of this file)
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
				<h1 style="background-image:url(imagenes/carrito.png)">&nbsp;<strong>PRODUCTOS</strong></h1>
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
				<input type="submit" name="Submit" value="Agregar" onclick="document.frm_productos.action = 'producto_add.php'; document.frm_productos.submit()" />
                <?php
				}
				?>
				&nbsp;&nbsp;
                <?php
                if (in_array(11, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar?')) { eliminar_producto(); }" />
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
			$consulta = "SELECT * FROM productos ORDER BY nombre ";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT * FROM productos ORDER BY nombre LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion_pagina.php");
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left"><strong>Producto</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Precio</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Categoria</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Estado</strong></td>
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
                <td style="text-align: center;"><input name="chk_productos[]" type="checkbox" value="<?php echo $registro["id"]; ?>" /></td>
                <td class="left">&nbsp;<?php echo $registro["nombre"]?></td>
				<td class="left">&nbsp;<?php echo "$".number_format($registro["valor"], 0, ",", ".")?></td>
				<td class="left">&nbsp;
				<?php 
				$consulta = "SELECT * FROM categorias WHERE id = ".$registro["categoria_id"];
				$resultado_cat = mysql_query($consulta, $conexion);
				$registro_cat = mysql_fetch_array($resultado_cat);
				echo $registro_cat["nombre"];
				?>
				</td>
                <td class="left">&nbsp;
				<?php 
				
				if($registro["agotado"] == 0) { echo "Disponible"; } else { echo "Agotado";}?></td>
                <?php
                if (in_array(12, $_SESSION["roles"]))
	  			{
				?>
                <td class="center"><a href="#" onclick="editar_producto(<?php echo $registro["id"]?>);">[Editar]</a></td>
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
				echo "No existen productos creados";
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
