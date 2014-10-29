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
header("Content-disposition: attachment; filename=Informe de pedidos.xls");

$fecha = $_GET['fecha'];
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
$consulta = "SELECT CONCAT(usuario.nomusuario,' ',usuario.apeusuario) AS nombre, pedido.* 
			FROM pedido 
			INNER JOIN usuario ON pedido.usuario_idusuario = usuario.idusuario
			WHERE DATE(pedido.fecpedido) = '".$fecha."' ";

$resultado = mysql_query($consulta, $conexion);
?>
  <tr>
    <td width="405">Informe de pedidos (<?php echo $fecha?>)</td>
  </tr>
  <tr>
    <td>   
	<table width="98%" border="0" cellspacing="0" cellpadding="0" >
	  <tr class="list">
	    <td bgcolor="#EFEFEF" class="left"><strong>Usuario</strong></td>
	    <td bgcolor="#EFEFEF" class="center"><strong>No. Pedido</strong></td>
	    <td bgcolor="#EFEFEF" class="center"><strong>Fecha/Hora</strong></td>
	    </tr>
	  	<?php
		while ($registro= mysql_fetch_array($resultado))
		{				
		?>
	  <tr class="list">
	    <td class="left"><?php echo $registro["nombre"]?>&nbsp;</td>
	    <td class="left"><?php echo $registro["idpedido"]?>&nbsp;</td>
	    <td class="left"><?php echo $registro["fecpedido"]?>&nbsp;</td>
	    </tr>
	  	<?php
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