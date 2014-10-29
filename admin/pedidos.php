<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(13,14);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/moneda.php");
include_once("includes/parametros.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />

<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_pedido"]); $i++)
	{
		$eliminacion = "DELETE FROM pedido_producto WHERE pedido_idpedido = ".$_POST["chk_pedido"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			$eliminacion_ped = "DELETE FROM pedido WHERE idpedido = ".$_POST["chk_pedido"][$i];
			$resultado = mysql_query($eliminacion_ped, $conexion);
			mysql_db_query($bd_nombre, $eliminacion_ped);
			$eliminados++;
		}
		else
		{
			$no_eliminados++;	
		}
		
		//ACTUALIZO LA BITACORA
		$des_bitacora = 'Elimino pedido';
		$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
		mysql_db_query($bd_nombre, $insertar);
	}
	?>
	<script language="javascript" type="text/javascript">
	alert("Pedidos(s) eliminado(s) <?php echo $eliminados?> \Pedido(s) No Eliminado(s) <?php echo $no_eliminados?>");
	document.location.href = "pedidos.php";
	</script>
	<?
}
?>
	
</head>

<body style="margin:auto">
<form id="frm_pedido" name="frm_pedido" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "pedidos.php"; 	//your file name  (the name of this file)
	$TAMANO_PAGINA = 15; 								//how many items to show per page
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
				<h1 style="background-image:url(imagenes/carrito.png)">&nbsp;<strong>PEDIDOS</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">&nbsp;&nbsp;
                <?php
                if (in_array(19, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Generar Informe" onClick="document.frm_pedido.action = 'pedidos_informe.php'; document.frm_pedido.submit();" />
                <?php
				}

                if (in_array(13, $_SESSION["roles"]))
	  			{
				?>
				<input type="button" value="Eliminar" onClick="if (confirm('Esta seguro que desea eliminar?')) { eliminar_pedido(); }" />
                <?php
				}
				?></td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list" >
              	<?php
				$consulta = "SELECT pedido.*, usuario.nomusuario, usuario.apeusuario
							FROM pedido, usuario
							WHERE pedido.usuario_idusuario = usuario.idusuario
							ORDER BY idpedido DESC";
				$resultado = mysql_query($consulta, $conexion);
				$num_registros = mysql_num_rows($resultado);
				$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
				$registro = mysql_fetch_array($resultado);
				
				$consulta = "SELECT pedido.*, usuario.nomusuario, usuario.apeusuario
							FROM pedido, usuario
							WHERE pedido.usuario_idusuario = usuario.idusuario
							ORDER BY idpedido DESC LIMIT $inicio , $TAMANO_PAGINA  ";
				$resultado = mysql_query($consulta, $conexion);
				
				include_once("../funciones/paginacion.php");
				if(mysql_num_rows($resultado) > 0)
				{
				?>
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left"><strong>Pedido No.</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Usuario</strong></td>
                <td bgcolor="#EFEFEF" class="center"><strong>Forma de pago</strong></td>
                <td bgcolor="#EFEFEF" class="center"><strong>Estado</strong></td>
                <td bgcolor="#EFEFEF" class="right"><strong>Total</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Fecha y Hora</strong></td>
                <?php
                if (in_array(14, $_SESSION["roles"]))
	  			{
				?>
                <td bgcolor="#EFEFEF" class="center"><strong>Ver detalle pedido</strong></td>
                <?php
				}
				?>
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{				
				?>
              <tr>
                <td style="text-align: center;"><input name="chk_pedido[]" type="checkbox" value="<?php echo $registro["idpedido"]; ?>" /></td>
                <td class="left">&nbsp;<?php echo $registro["idpedido"]?></td>
				<td class="left">&nbsp;<?php echo $registro["nomusuario"]." ".$registro["apeusuario"]?></td>
               	<td class="center">&nbsp;
				<?php
                if ($registro["forma_pago"] == 1)
	  			{
					echo 'Pagos OnLine';
				}
				elseif($registro["forma_pago"] == 2)
					{
						echo 'Contra entrega';
					}
					else
					{	
						echo 'Por indentificar';
					}
				?></td> 
                <td class="center">&nbsp;<?php echo estados_pedidos($registro["estadopedido"])?></td>
                <td class="right">&nbsp;<?php echo number_format($registro["total"], 0, ",", ".")?></td>
                <td class="left">&nbsp;<?php echo $registro["fecpedido"]?></td>
                <?php
                if (in_array(14, $_SESSION["roles"]))
	  			{
				?>
                <td align="right"><a href="#" onclick="ver_pedido(<?php echo $registro["idpedido"]?>);">[Ver]</a></td>
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
				echo "No existen pedidos creados";
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
