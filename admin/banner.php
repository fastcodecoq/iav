<?php
session_start();
require_once("../bd.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />


<?php
if(($_POST["hdd_accion"] == "activar") || ($_POST["hdd_accion"] == "desactivar"))
{
$actualizados = $no_actualizados = 0;

if($_POST["hdd_accion"] == "activar")
{
	$valor = 1;
}
if($_POST["hdd_accion"] == "desactivar")
{
	$valor = 2;
}

	for ($i = 0; $i < sizeof($_POST["chk_id"]); $i++)
	{
		$eliminacion = "UPDATE banner SET estado = $valor WHERE id = '".$_POST["chk_id"][$i]."'";
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			$actualizados++;
		}
		else
		{
			$no_actualizados++;	
		}
	}
	
	if($i==0)
	{
	?>
		<script language="javascript" type="text/javascript">
        alert("No ha seleccionado ningun banner");
        document.location.href = "banner.php";
        </script>
	<?php
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
        alert("Cambios realizados correctamente");
        document.location.href = "banner.php";
        </script>
	<?php
	}
}

if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_id"]); $i++)
	{
		$consulta = "SELECT * FROM banner WHERE id = ".$_POST["chk_id"][$i];;
		$resultado_del = mysql_query($consulta, $conexion);	
		$imagenes = mysql_fetch_array($resultado_del);
		
		$eliminacion = "DELETE FROM banner WHERE id = '".$_POST["chk_id"][$i]."'";
		$resultado = mysql_query($eliminacion, $conexion);
		
		unlink("../banner/".$imagenes["archivo"]);	
		
		if (mysql_db_query($bd_nombre, $eliminacion))
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
	alert("Banner(s) eliminado(s) <?php echo $eliminados?>");
	document.location.href = "banner.php";
	</script>
	<?
}
?>

</head>

<body style="margin:auto">
<form id="frm_banner" name="frm_banner" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "banner.php"; 	//your file name  (the name of this file)
	$TAMANO_PAGINA = 5; 								//how many items to show per page
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
              <td class="box"><div class="left"></div>
                <div class="right"></div>
                <div class="heading">
                  <h1 style="background-image:url(imagenes/computer.png)">&nbsp;<strong>BANNERS</strong></h1>
                  <div align="right"></div>
                </div></td>
            </tr>
            <tr>
              <td class="box" valign="top"><div class="content">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left"><label>Filtro
                              <select name="filtro" id="filtro" onChange="document.frm_banner.action = 'banner.php'; document.frm_banner.submit();">
                                <option value="0" <? if ($_POST["filtro"] == 0) { echo "selected"; }?>>- Todos -</option>
                                <option value="1" <? if ($_POST["filtro"] == 1) { echo "selected"; }?>>Activos</option>
                                <option value="2" <? if ($_POST["filtro"] == 2) { echo "selected"; }?>>Inactivos</option>
                              </select>
                            </label></td>
                            <td align="right">
                            <input type="button" value="Activar" onclick="document.frm_banner.hdd_accion.value = 'activar'; document.frm_banner.submit();" />
                            &nbsp;&nbsp;
                            <input type="button" value="Desactivar" onclick="document.frm_banner.hdd_accion.value = 'desactivar'; document.frm_banner.submit();" />
                            &nbsp;&nbsp;
                            <input type="submit" name="Submit" value="Agregar" onclick="document.frm_banner.action = 'banner_add.php'; document.frm_banner.submit()" />
							&nbsp;&nbsp;
							<input type="button" value="Eliminar" onclick="if (confirm('Esta seguro que desea eliminar el banner?')) { document.frm_banner.hdd_accion.value = 'eliminar'; document.frm_banner.submit(); }" /></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="right">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table width="98%" border="0" cellspacing="0" cellpadding="0" class="list" >
						<?php
						$condicion = "";
						// Ordeno por filtro
						if (isset($_POST["filtro"]) && $_POST["filtro"] != "0")
						{
							$condicion .= "WHERE estado = ".$_POST["filtro"]." ";
						}
						else
						{	
							$condicion = "";
						}
						
                        $consulta = "SELECT * FROM banner $condicion ORDER BY fecha DESC";
                        $resultado = mysql_query($consulta, $conexion);
                        $num_registros = mysql_num_rows($resultado);
                        $total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
                        $registro = mysql_fetch_array($resultado);
                        
                        $consulta = "SELECT * FROM banner $condicion ORDER BY fecha LIMIT $inicio , $TAMANO_PAGINA  ";
                        $resultado = mysql_query($consulta, $conexion);
                        
                        include_once("../funciones/paginacion.php");
                        if(mysql_num_rows($resultado) > 0)
                        {
                        ?>
                          <tr>
                            <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                            <td bgcolor="#EFEFEF" class="left"><strong>Nombre</strong></td>
                            <td bgcolor="#EFEFEF" class="center"><strong>Posicion</strong></td>
                            <td bgcolor="#EFEFEF" class="center"><strong>Fecha</strong></td>
                            <td bgcolor="#EFEFEF" class="center"><strong>Estado</strong></td>
                            <td bgcolor="#EFEFEF" class="center"><strong>Tipo</strong></td>
                          </tr>
                          	<?php
							while ($registro= mysql_fetch_array($resultado))
							{
											
							?>
                          <tr >
                            <td style="text-align: center;"><input name="chk_id[]" type="checkbox" value="<?php echo $registro["id"]; ?>" /></td>
                            <td class="left">&nbsp;<?php echo $registro["nombre"]?></td>
                            <td class="center">&nbsp;<?php if($registro["posicion"] == 1){ echo "Pagina Principal"; } else if($registro["posicion"] == 2){ echo "Pagina Interna - Lateral"; }?></td>
                            <td class="center">&nbsp;<?php echo $registro["fecha"]?></td>
                            <td class="center">&nbsp;
                              <?php if($registro["estado"] == 1){ echo "<img src='imagenes/activo.png' title='Activo' />"; } else if($registro["estado"] == 2){ echo "<img src='imagenes/inactivo.png' title='Inactivo' />"; }?></td>
                            <td align="center">
							<?php 
							$archivo = $registro["archivo"];
							$dot = (strlen($archivo) - strrpos($archivo, ".")-1)*(-1);
							$ext = substr($archivo, $dot);
							$ext = strtolower($ext);  	
							
							if($ext == 'swf')
							{
								echo "<img src='imagenes/adobe_flash.png'/>";
							}
							elseif($ext == 'jpg' || $ext == 'png')
									{
										echo "<img src='imagenes/jpeg_file.png'/>";
									}
							?>
                            </td>
                          </tr>
                          	<?php
							 }
							 ?>
                          <tr>
                            <td colspan="14" align="center"><br />
                              <?php echo $paginacion?></td>
                          </tr>
                        <?php 
						}
						else
						{
							echo "No existen banner creados";
						}
						?>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
              </div>
              </td>
            </tr>
          </table></td>
  </tr>
</table>
<div id="footer"><?php include ('pie.php')?></div>
<input type="hidden" name="hdd_id" value=""/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
