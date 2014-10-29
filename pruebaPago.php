<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
//$llave_encripcion = "13ecd041d9c"; //Llave produccion
$llave_encripcion = "852b589c1ad"; //Llave pruebas
$usuarioId=101741;
$refVenta=0008;
$valor=116000;
$baseDevolucionIva=100000;
$iva=16000;
$moneda=COP;
$url_respuesta = "http://www.inmueblealaventa.com/respuesta.php";
$url_confirmacion = "http://www.inmueblealaventa.com/confirmacion.php";
$descripcion = "Pruebas de Generacion de Firmas";
$firma= "$llave_encripcion~$usuarioId~$refVenta~$valor~$moneda";
$firma_codificada = md5($firma);
?>

<form method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html">
<table width="500" border="0" cellpadding="0" cellspacing="2">
<tr bgcolor="#FF8000 ">
<th> Campo</th>
<th >Valor</th>
</tr>
<tr bgcolor="#CCCCCC">
<td>Usuario:</td>
<td><input name="usuarioId" type="text" value="<?php echo($usuarioId) ?>"></td>
</tr>
<tr bgcolor="#DEDEDE">
<td>Descripci&oacute;n:</td>
<td><input name="descripcion" type="text" value="<?php echo $descripcion ?>" > </td>
</tr>
<tr bgcolor="#CCCCCC">
<td>Ref. Venta:</td>
<td><input name="refVenta" type="text" value="<?php echo $refVenta ?>"></td>
</tr>
1 Para consultar la llave de encripción debe ingresar al módulo administrativo en https://secure.pagosonline.net/ y seleccionar la
pestaña Opciones
11<tr bgcolor="#DEDEDE">
<td>Valor:</td>
<td><input name="valor" type="text" value="<?php echo $valor ?>">
 </td> </tr> </tr>
<tr bgcolor="#CCCCCC">
<td bgcolor="#CCCCCC">IVA:</td>
<td><input name="iva" type="text" value="<?php echo $iva ?>"></td>
</tr>
<tr bgcolor="#DEDEDE">
<td bgcolor="#DEDEDE">Base Devolución Iva:</td>
<td>
<input name="baseDevolucionIva" type="text" value="<?php echo $baseDevolucionIva ?>" >
</td>
</tr>
<tr bgcolor="#CCCCCC">
<td bgcolor="#CCCCCC">Moneda:</td>
<td><input name="moneda" type="text" value="<?php echo $moneda ?>"></td>
</tr>
<tr bgcolor="#DEDEDE">
<td>Firma:</td>
<td><input name="firma" type="text" value="<?php echo $firma_codificada ?>"></td>
</tr>
<tr bgcolor="#CCCCCC">
<td>&nbsp;</td>
<td><input name="Submit" type="submit" value="Enviar"></td>
</tr>
</table>
<input name="prueba" type="hidden" value="1">
<input name="url_confirmacion" type="hidden" value="<?php echo $url_confirmacion?>">
<input name="url_respuesta" type="hidden" value="<?php echo $url_respuesta?>">
</form>

</body>
</html>