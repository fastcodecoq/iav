<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(14);
require_once("../bd.php");
include_once("control_admin.php");
include_once('includes/parametros.php');
include_once("../funciones/moneda.php");
include_once("../funciones/fechas.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>

<?php 
if(isset($_POST['estado']))
{
	$actualizar = "UPDATE pedido SET estadopedido = ".$_POST['estado']." WHERE idpedido = ".$_POST["hdd_id"];
	mysql_db_query($bd_nombre, $actualizar);
}
				
?>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<script language="javascript" src="../js/jquery-1.4.2.js"></script>
<link href="estilos/tabs.css" rel="stylesheet" type="text/css" />
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/imagenes_thumbnail.css" rel="stylesheet" type="text/css" />
<script language="javascript">
$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
</script>

</head>

<body style="margin:auto">
<form id="frm_pedidos" name="frm_pedidos" method="post" enctype="multipart/form-data" action="">
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
				<h1 style="background-image:url(imagenes/carrito.png)">&nbsp;<strong>VER PEDIDOS</strong></h1>
				<div align="right" style="padding:8px;"><input type="button" value="Regresar" onClick="document.frm_pedidos.action = 'pedidos.php'; document.frm_pedidos.submit()" /></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
          	<ul class="tabs">
                <li><a href="#tab1">Datos cliente</a></li>
                <li><a href="#tab2">Pedido</a></li>
                <li><a href="#tab3">Estado</a></li>
            </ul>
            
            <div class="tab_container">
                <div id="tab1" class="tab_content">
                    <?php
					$consulta = "SELECT usuario.nomusuario, usuario.apeusuario, usuario.telusuario, usuario.dirusuario, usuario.mailusuario, usuario.datos_confirmados
									FROM usuario 
									INNER JOIN pedido ON usuario.idusuario = pedido.usuario_idusuario 
									INNER JOIN pedido_producto ON pedido.idpedido = pedido_producto.pedido_idpedido 
									WHERE pedido_producto.pedido_idpedido = ".$_POST['hdd_id']." LIMIT 0,1";
		
					$resultado = mysql_query($consulta, $conexion);
					$registro_nom= mysql_fetch_array($resultado);
					?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="2" class="list">
                      <tr>
                        <td width="17%" class="left">Nombre</td>
                        <td width="83%" class="left"><?php  echo $registro_nom['nomusuario']?></td>
                      </tr>
                      <tr>
                        <td class="left">Apellidos</td>
                        <td class="left"><?php  echo $registro_nom['apeusuario']?></td>
                      </tr>
                      <tr>
                        <td class="left">Direcci&oacute;n</td>
                        <td class="left"><?php  echo $registro_nom['dirusuario']?></td>
                      </tr>
                      <tr>
                        <td class="left">Telefono</td>
                        <td class="left"><?php  echo $registro_nom['telusuario']?></td>
                      </tr>
                      <tr>
                        <td class="left">E.mail</td>
                        <td class="left"><?php  echo $registro_nom['mailusuario']?></td>
                      </tr>
                      <tr>
                        <td class="left">Datos confirmados</td>
                        <td class="left">
                        <?php 
						if($registro_nom["datos_confirmados"] == 1)
						{
							echo "<span style='color:#006600; font-weight:bold;'>Datos confirmados</span>";
						}
						else
						{
							echo "<span style='color:#F00; font-weight:bold;'>Datos sin confirmar</span>";
						}
						
						?>
                        </td>
                      </tr>
                    </table>

                </div>
                <div id="tab2" class="tab_content">
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list" >
					<?php	
                    $consulta = "SELECT subcategorias.dessubcategoria, productos.desproducto, pedido_producto.* 
FROM pedido_producto 
JOIN productos ON productos.idproducto = pedido_producto.producto_idproducto
JOIN subcategorias ON subcategorias.idsubcategoria = productos.categoria_idcategoria
WHERE pedido_producto.pedido_idpedido = ".$_POST['hdd_id'];
                    $resultado = mysql_query($consulta, $conexion);
                    if(mysql_num_rows($resultado) > 0)
                    {
                    ?>
                      <tr>
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
                        <td class="center"><?php echo "$".number_format($registro["valproducto"] , 0, ",", ".")?>&nbsp;</td>
                        <td class="center"><?php  $total = ($registro["cantpedido_producto"] * $registro["valproducto"]); echo "$".number_format($total , 0, ",", ".")?>&nbsp;</td>
                      </tr> 
                      <?php
                          $subtotal += $total;
                         }
                      ?>
                      <?php
					  $consulta = "SELECT * from pedido WHERE idpedido = ".$_POST['hdd_id'];
                      $resultado = mysql_query($consulta, $conexion);
					  $pedido= mysql_fetch_array($resultado)
					  ?>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                        <td align="right"><BR />SUBTOTAL</td>
                        <td align="center"><BR /><?php echo "$".number_format($subtotal = $pedido['total'] + $pedido['descuento'], 0, ",", ".");?>&nbsp;</td>
                      </tr>
                      <?php
                      if($pedido['descuento'] != 0)
					  {
						  ?>
						  <tr>
							<td colspan="3">&nbsp;</td>
							<td align="right"><BR />DESCUENTO</td>
							<td align="center"><BR /><?php echo "$".number_format($pedido['descuento'], 0, ",", ".");?>&nbsp;</td>
						  </tr>
                          <tr>
							<td colspan="3">&nbsp;</td>
							<td align="right"><BR />SUBTOTAL FINAL</td>
							<td align="center"><BR /><?php echo "$".number_format($subtotal - $pedido['descuento'], 0, ",", ".");?>&nbsp;</td>
						  </tr>
                      <?php
					  }
					  ?>
						  
						  
                      <tr>
                        <td colspan="3">&nbsp;</td>
                        <td align="right"><BR />IVA</td>
                        <td align="center"><BR /><?php echo "$".number_format($pedido['iva'], 0, ",", ".");?>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                        <td align="right"><BR />TOTAL</td>
                        <td align="center"><BR /><?php echo "$".number_format($pedido['total'] , 0, ",", ".");?>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><a href="pedido_excel.php?id=<?php echo $_POST["hdd_id"]?>" target="_blank"><img src="imagenes/excel.png" width="48" height="48" border="0" title="Exportar a Excel" /></a></td>
                      </tr>
                    <?php  
                    }
                    else
                    {
                        echo "No existen productos creados";
                    }
                    ?>
                    </table>
                </div>
                <div id="tab3" class="tab_content">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="list">
                    <tr>
                      <td bgcolor="#EFEFEF" class="left"><strong>Fecha / Hora</strong></td>
                      <td bgcolor="#EFEFEF" class="left"><strong>Estado</strong></td>
                      <td bgcolor="#EFEFEF" class="left">&nbsp;</td>
                      </tr>
                    <tr class="list">
                      <td class="left"><?php echo $pedido['fecpedido']?>&nbsp;</td>
                      <td class="left"><?php echo estados_pedidos($pedido['estadopedido'])?>&nbsp;</td>
                      <td class="left">&nbsp;</td>
                      </tr>
                  </table>
                  <div class="breadcrumb"><br />
                  <br />
				  <strong>Estado del pedido </strong>
				  	<select name="estado" id="estado">
					<?php
                    for ($i=1; $i <= 5; $i++)
                    {
                    ?>
                      <option value="<?php echo $i?>" <?php if($pedido['estadopedido'] == $i){ echo 'selected';}?>><?php echo estados_pedidos($i)?></option>
                    <?
                    }
                    ?>
                    </select>
                  <br />
                  <input name="Enviar" type="submit" value="Actualizar" /></div>
                  </div>
            </div>            
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
<input type="hidden" name="pagina" value="<?php echo $_POST["pagina"]?>"/>
<input type="hidden" name="hdd_id" value="<?php echo $_POST["hdd_id"]?>"/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
