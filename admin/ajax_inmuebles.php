<?php
//$permisos = array(33,34,35,36);
//include ('control_admin.php');
include_once('../bd.php');
include "../funciones/PHPPaging.lib.php";
include "../funciones/funciones.php";
include "../includes/parametros.php";
include "../funciones/fechas.php";


	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
	header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
	header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE


	$paging = new PHPPaging;
	$consulta = "SELECT  CONCAT(usuarios.nombres,' ',usuarios.apellidos)AS nombreUsuario, tipo_in.dest_tip, municipio.nombreMunicipio, inmueble.* 
FROM inmueble 
JOIN municipio ON inmueble.ciudad = municipio.idmunicipio
JOIN usuarios ON inmueble.usuario = usuarios.identificacion
JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm";

	if (isset($_GET['criterio_usu_per']))
		if(!empty($_GET['criterio_usu_per']))
		$consulta .= " WHERE municipio.nombreMunicipio like '%".fn_filtro(substr($_GET['criterio_usu_per'], 0, 16))."%' OR inmueble.codigo like '%".fn_filtro(substr($_GET['criterio_usu_per'], 0, 16))."%'";
	/*gomosoft*/
	if (isset($_GET['criterio_orden']))
		if(!empty($_GET['criterio_orden']))
         if(empty($_GET['criterio_ordenar_por']))
		$consulta .= sprintf(" ORDER BY inmueble.codigo %s", fn_filtro($_GET['criterio_orden']));
	     else
		$consulta .= sprintf(" ORDER BY %s %s", fn_filtro($_GET['criterio_ordenar_por']),fn_filtro($_GET['criterio_orden']));

	else
		$consulta .= " ORDER BY inmueble.codigo ASC";
   /*gomosoft*/

	$paging->agregarConsulta($consulta); 
	$paging->div('div_listar');
	$paging->modo('desarrollo'); 

 /*gomosoft*/
	if (isset($_GET['criterio_mostrar']))
		if(!empty($_GET['criterio_mostrar']))		
		$paging->porPagina(fn_filtro((int)$_GET['criterio_mostrar']));
	 else
		$paging->porPagina(20);

    $mantVar = array();

    if(isset($_GET["criterio_usu_per"]))
    	if(!empty($_GET["criterio_usu_per"]))
    	$mantVar[] = "criterio_usu_per";

    if(isset($_GET["criterio_orden"]))
    	if(!empty($_GET["criterio_orden"]))    	
    	  $mantVar[] = "criterio_orden";

    if(isset($_GET["criterio_mostrar"]))
    	if(!empty($_GET["criterio_mostrar"]))    	
    	$mantVar[] = "criterio_mostrar";

    if(isset($_GET["criterio_ordenar_por"]))
    	if(!empty($_GET["criterio_ordenar_por"]))   
    	   $mantVar[] = "criterio_ordenar_por";


    if(count($mantVar) > 0)
     $paging->mantenerVar(implode(",", $mantVar));

/*gomosoft*/

	$paging->verPost(true);
	$paging->ejecutar();
?>
<form action="" id="frm_inmu" name="frm_inmu" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list" >
<!--
<tr>
	<td colspan="10" align="right" style="border:none"><a href="#" onclick="document.frm_productos.action = 'productos_add.php'; document.frm_productos.submit()"><img src="imagenes/producto_add.png" alt="Agregar producto" width="48" height="48" border="0" title="Agregar producto"></a></td>
</tr>-->
<tr>
	<td colspan="13" style="padding:10px 0" align="right"><input type="button" value="Eliminar Inmuebles" onClick=" fn_eliminarInmuebles()" /></td>
</tr>
<tr bgcolor="#CCCCCC">
	<td class="left">&nbsp;</td>
    <td class="left"><strong>Codigo</strong></td>
    <td class="left"><strong>Tipo Inmueble</strong></td>
    <td class="left"><strong>Destino</strong></td>
    <td class="left"><strong>Ciudad</strong></td>
    <td class="left"><strong>Usuario</strong></td>
    <td class="left"><strong>Fecha Inscripción</strong></td>
    <td class="left"><strong>Fecha Activaci&oacute;n</strong></td>
    <td class="left"><strong>Fecha Desactivaci&oacute;n</strong></td>
    <td class="left"><strong>D&iacute;as faltantes</strong></td>
    <td class="left"><strong>Plan</strong></td>
    <td class="center"><strong>Estado</strong></td>
    <!--<td class="center"><strong></strong></td>-->
    <td class="center"><strong></strong></td>
</tr>
<?php
while ($registro = $paging->fetchResultado())
{
$fechaDesactivacion = '';
?>
<tr bgcolor="#FFFFFF" >
<td class="left"><input name="chk_inmuebles[]" type="checkbox" value="<?php echo $registro["codigo"]; ?>" /></td>
<td class="left">&nbsp;<?php echo $registro["codigo"]?></td>
<td class="left">&nbsp;<?php echo $registro["dest_tip"]?></td>
<td class="left">&nbsp;<?php echo tipo_negocio($registro["tipo_neg"])?></td>
<td class="left">&nbsp;<?php echo $registro["nombreMunicipio"]?></td>
<td class="left">&nbsp;<?php echo $registro["nombreUsuario"]?></td>
<td class="left">&nbsp;<?php echo $registro["fecha_inscripcion"]?></td>
<td class="left">&nbsp;<?php echo $registro["fecha_activacion"]?></td>
<td class="left">
<?php
if($registro['fecha_activacion'] != '0000-00-00')
{
	//Consultamos los dias de los planes
	$consulta = "SELECT * FROM planes WHERE id = ".$registro['plan'];
	$resultado_plan = mysql_query($consulta, $conexion);
	$registro_plan= mysql_fetch_array($resultado_plan);
	
	if($registro['plan'] == 1 || $registro['plan'] == 2)
	{
		echo $fechaDesactivacion = suma_dia_fecha($registro['fecha_activacion'],$registro_plan['dias']);
	}
	
	if($registro['plan'] == 3)
	{
		echo "Hasta que se venda";
	}
	
	if($registro['plan'] == 4)
	{
		$consulta = "SELECT * FROM planpersonalizado WHERE codinmueble = ".$registro['codigo'];
		$resultado_planper = mysql_query($consulta, $conexion);
		$registro_planper = mysql_fetch_array($resultado_planper);
		
		$dias = ($registro_planper['nMeses'] * 30);
		echo $fechaDesactivacion = suma_dia_fecha($registro['fecha_activacion'],$dias);
	}
}
?>
</td>
<td class="left">
<?php 
if($fechaDesactivacion != ''){

	$diasRestantes = diferencia_en_dias(date(Y.'-'.m.'-'.d),$fechaDesactivacion);
	
	if($diasRestantes <= 0)
	{
		echo '<span style="color:#F00"><strong>'.$diasRestantes.'</strong></span>';
	}
	else
	{
		echo '<span style="color:#000"><strong>'.$diasRestantes.'</strong></span>';
	}
}
?></td>
<td class="left">&nbsp;<?php echo planes($registro['plan'])?></td>

<td class="center">
<?php
if($registro["estado"] == 0)
{
	?>
	<a href="#" onclick="activar_inmueble(<?php echo $registro["codigo"]?>, 1)"><img src="imagenes/inactivo.png" width="22" height="22" border="0" /></a>
    <?php
}
else if($registro["estado"] == 1)
{
?>
<a href="#" onclick="activar_inmueble(<?php echo $registro["codigo"]?>, 0)"><img src="imagenes/activo.png" width="22" height="22" border="0" /></a>
<?php
}
?>
</td>
<!--<td class="center"><img src="imagenes/edit.png" width="17" height="18" border="0" /></td>-->
<td class="center"><a href="javascript: fn_eliminar(<?php echo $registro['codigo']?>)"><img src="imagenes/delete.gif" width="18" height="18" border="0" /></a></td>
</tr>
<?
}
?>
</table>
</form>
<div align="center" style="padding-top:10px"><?php echo $paging->fetchNavegacion()?></div>
<input type="hidden" name="hdd_id" value=""/>