<?php
$permisos = array(16,17,18);
require_once("../bd.php");
include_once("control_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<link href="../estilos/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="../estilos/invoice.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="../estilos/menu.css" rel="stylesheet" type="text/css" />
<link href="../estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="../estilos/paginacion.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_categoria"]); $i++)
	{
		$eliminacion = "DELETE FROM categoria WHERE idcategoria = ".$_POST["chk_categoria"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Elimino categoria ';
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
	alert("Categorias eliminadas <?php echo $eliminados?> \nCategorias No Eliminadas <?php echo $no_eliminados?>");
	document.location.href = "categorias.php";
	</script>
	<?
}
?>

</head>

<body style="margin:auto">
<form id="frm_categoria" name="frm_categoria" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "categorias.php"; 	//your file name  (the name of this file)
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
    <td id="content" align="center"><br />
      <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="box">
		  	<div class="left"></div>
  			<div class="right"></div>
  			<div class="heading">
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>CATEGORIAS</strong></h1>
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
				<input type="submit" name="Submit" value="Agregar" onclick="document.frm_categoria.action = 'categoria_add.php'; document.frm_categoria.submit()" />
                <?php
                }
                ?>
				&nbsp;&nbsp;
                <?php
                if (in_array(17, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar?')) { eliminar_categoria(); }" /></td>
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
			$consulta = "SELECT * FROM categoria ORDER BY idcategoria ";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT * FROM categoria ORDER BY descategoria LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion.php");
			
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left"><strong>Categoria</strong></td>
                <td bgcolor="#EFEFEF" class="center"><strong>Acci&oacute;n</strong></td>
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{
				?>
              <tr>
                <td style="text-align: center;"><input name="chk_categoria[]" type="checkbox" value="<?php echo $registro["idcategoria"]; ?>" /></td>
                <td class="left">&nbsp;<?php echo $registro["descategoria"]?></td>
                <td align="right"><a href="#" onclick="editar_categoria(<?php echo $registro["idcategoria"]?>);">[Editar]</a></td>
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
				echo "No existen categorias creadas";
			}
			?>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer">Yamile Style © 2011 Todos los Derechos Reservados</td>
  </tr>
</table>
<input type="hidden" name="pagina" value="<?= $_POST["pagina"]?>"/>
<input type="hidden" name="hdd_id" value=""/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
