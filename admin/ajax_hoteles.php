<?php
//$permisos = array(33,34,35,36);
//include ('control_admin.php');
include_once('../bd.php');
include "../funciones/PHPPaging.lib.php";
include "../funciones/funciones.php";
include "../includes/parametros.php";


	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
	header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
	header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE


	$paging = new PHPPaging;
	$consulta = "SELECT municipio.nombreMunicipio, hoteles.* 
FROM hoteles 
JOIN municipio ON hoteles.ciudad = municipio.idmunicipio";

	if (isset($_GET['criterio_usu_per']))
		$consulta .= " WHERE hoteles.nombre like '%".fn_filtro(substr($_GET['criterio_usu_per'], 0, 16))."%'";
	if (isset($_GET['criterio_ordenar_por']))
		$consulta .= sprintf(" ORDER BY %s %s", fn_filtro($_GET['criterio_ordenar_por']), fn_filtro($_GET['criterio_orden']));
	else
		$consulta .= " ORDER BY nombre ASC";
	
	$paging->agregarConsulta($consulta); 
	$paging->div('div_listar');
	$paging->modo('desarrollo'); 
	if (isset($_GET['criterio_mostrar']))
		$paging->porPagina(fn_filtro((int)$_GET['criterio_mostrar']));
	$paging->verPost(true);
	$paging->mantenerVar("criterio_usu_per", "criterio_ordenar_por", "criterio_orden", "criterio_mostrar");
	$paging->ejecutar();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list" >

<tr>
	<td colspan="10" align="right" style="border:none"><a href="#" onclick="document.frm_hoteles.action = 'hotel_add.php'; document.frm_hoteles.submit()"><img src="imagenes/addHotel.png" alt="Agregar Hotel" width="48" height="48" border="0" title="Agregar Hotel"></a></td>
</tr>

<tr bgcolor="#CCCCCC">
    <td class="left"><strong>Nombre</strong></td>
    <td class="left"><strong>Ciudad</strong></td>
    <td class="left"><strong>Precio</strong></td>
    <td class="left"><strong>Fecha Creaci&oacute;n</strong></td>
    <td class="center"><strong></strong></td>
    <td class="center"><strong></strong></td>
</tr>
<?php
while ($registro = $paging->fetchResultado())
{
		
?>
<tr bgcolor="#FFFFFF" >
<td class="left">&nbsp;<?php echo $registro["nombre"]?></td>
<td class="left">&nbsp;<?php echo $registro["nombreMunicipio"]?></td>
<td class="left">&nbsp;<?php echo '$'.number_format($registro["precioNoche"],0,',','.')?></td>
<td class="left">&nbsp;<?php echo $registro["fechaCreacion"]?></td>

<td class="center"><a href="#" onclick="editar_hotel(<?php echo $registro["id"]?>);"><img src="imagenes/edit.png" width="17" height="18" border="0" /></a></td>
<td class="center"><a href="javascript: fn_eliminar(<?php echo $registro['id']?>)"><img src="imagenes/delete.gif" width="18" height="18" border="0" /></a></td>
</tr>
<?
}
?>
</table>
<div align="center" style="padding-top:10px"><?php echo $paging->fetchNavegacion()?></div>
<input type="hidden" name="hdd_id" value=""/>