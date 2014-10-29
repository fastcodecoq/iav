<?php
include_once('bd.php');

$usuarioId = $_POST['usuario_id'];
$fecha = date("d.m.Y-H:i:s");
$refVenta = $_POST['ref_venta'];
$refPol = $_POST['ref_pol'];
$estadoPol = $_POST['estado_pol'];
$formaPago = $_POST['tipo_medio_pago'];
$banco = $_POST['medio_pago'];
$codigo = $_POST['codigo_respuesta_pol'];
$mensaje = $_POST['mensaje'];
$valor = $_POST['valor'];


// Inserto la transacción
$insertar = "INSERT INTO transacciones (usuario, fecha, refVenta, refPol, estadoPol, formaPago, banco, codigo ) VALUES ($usuarioId ,'$fecha', '$refVenta', '$refPol', '$estadoPol', '$formaPago', '$banco', '$codigo')";
mysql_db_query($bd_nombre, $insertar);


// select para actualizar la bd pedidos_confir y jos_vm_orders

switch($estadoPol)

{

case 4: $actualizar = "UPDATE pedido SET estadopedido = 1 WHERE idpedido = ".$refVenta;
mysql_db_query($bd_nombre, $actualizar);
break;

case 5: $actualizar = "UPDATE pedido SET estadopedido = 3 WHERE idpedido = ".$refVenta;
mysql_db_query($bd_nombre, $actualizar);
break;

case 6: $actualizar = "UPDATE pedido SET estadopedido = 4 WHERE idpedido = ".$refVenta;
mysql_db_query($bd_nombre, $actualizar);
break;

case 12: $actualizar = "UPDATE pedido SET estadopedido = 2 WHERE idpedido = ".$refVenta;
mysql_db_query($bd_nombre, $actualizar);
break;

}


?>