<?php
include_once('../bd.php');

// Llamo funciones externas
include_once('../funciones/moneda.php');
include_once('../funciones/fechas.php');

header("Pragma: ");
header('Cache-control: ');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
/*header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);*/
 header("Content-type: application/vnd.ms-excel");
// Exporta en CSVheader ("Content-type: application/x-msexcel"); 
header("Content-disposition: attachment; filename=pedido.xls");

$pedido = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="3">
<?php
$consulta = "SELECT CONCAT(usuario.nomusuario, ' ',usuario.apeusuario) AS nombre, usuario.idusuario 
				FROM usuario 
				INNER JOIN pedido ON usuario.idusuario = pedido.usuario_idusuario 
				INNER JOIN pedido_producto ON pedido.idpedido = pedido_producto.pedido_idpedido 
				WHERE pedido_producto.pedido_idpedido = ".$pedido." LIMIT 0,1";

$resultado = mysql_query($consulta, $conexion);
$registro_nom= mysql_fetch_array($resultado);
?>
  <tr>
    <td width="405" align="left"><strong>Cliente:</strong> <?php echo $registro_nom['nombre']?></td>
  </tr>
  <tr>
    <td align="left"><strong>Cedula:</strong> <?php echo $registro_nom['idusuario']?></td>
  </tr>
  <tr>
    <td align="left"><strong>Pedido No. </strong> <?php echo $pedido?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>   
	<table width="98%" border="0" cellspacing="0" cellpadding="0" >
	<?php	
    $consulta = "SELECT subcategorias.dessubcategoria, productos.desproducto, pedido_producto.* 
FROM pedido_producto 
JOIN productos ON productos.idproducto = pedido_producto.producto_idproducto
JOIN subcategorias ON subcategorias.idsubcategoria = productos.categoria_idcategoria
WHERE pedido_producto.pedido_idpedido = ".$pedido;
    $resultado = mysql_query($consulta, $conexion);
    if(mysql_num_rows($resultado) > 0)
    {
    ?>
	  <tr class="list">
	    <td bgcolor="#EFEFEF" class="left"><strong>Producto</strong></td>
	    <td bgcolor="#EFEFEF" class="left"><strong>Categoria</strong></td>
	    <td bgcolor="#EFEFEF" class="left"><strong>Cantidad</strong></td>
	    <td bgcolor="#EFEFEF" class="center"><strong>Vlr Unitario</strong></td>
	    <td bgcolor="#EFEFEF" class="center"><strong>Total</strong></td>
	    </tr>
	  	<?php
		while ($registro= mysql_fetch_array($resultado))
		{				
		?>
	  <tr class="list">
	    <td class="left"><?php echo $registro["desproducto"]?>&nbsp;</td>
	    <td class="left"><?php echo $registro["dessubcategoria"]?>&nbsp;</td>
	    <td class="left"><?php echo $registro["cantpedido_producto"]?>&nbsp;</td>
	    <td class="center"><?php echo "$".numero_moneda($registro["valproducto"])?>&nbsp;</td>
	    <td class="center"><?php  $total = ($registro["cantpedido_producto"] * $registro["valproducto"]); echo "$".numero_moneda($total)?>
	      &nbsp;</td>
	    </tr>
	  	<?php
		$subtotal += $total;
		}
	  	?>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="center"><br />
	      TOTAL</td>
	    <td align="left"><br />
	      <?php echo "$".numero_moneda($subtotal);?>&nbsp;</td>
	    </tr>
	  <?php  
	}
	else
	{
		echo "No existe el pedido";
	}
	?>
	  </table>
      <table width="100%" border="0">
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>