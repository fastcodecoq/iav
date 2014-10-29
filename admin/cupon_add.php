<?php
$permisos = array(16);
require_once("../bd.php");
include_once("control_admin.php");
include_once('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<?php
if(isset($_POST["nombre"]) && $_POST["nombre"] != "")
{
	$nombre = $_POST["nombre"] ;
	$codigo = $_POST["codigo"] ;
	$tipo = $_POST["tipo"] ;
	$descuento = $_POST["descuento"] ;
	$fecini = $_POST["fecini"] ;
	$fecfin = $_POST["fecfin"] ;
	$estado = $_POST["estado"] ;
	if($_POST["n_usos"] == '')
	{
		$n_usos = 0;
	}
	else
	{
		$n_usos = $_POST["n_usos"];
	}
	
	$insercion = "INSERT INTO cupon (nomcupon, codcupon, tipo, descuento, fecini, fecfin, n_usos, estado, fecregcupon) VALUES ( '$nombre', '$codigo', $tipo, $descuento, '$fecini', '$fecfin', $n_usos, $estado, NOW())";
		
	if (mysql_db_query($bd_nombre, $insercion))
	{
		//ACTUALIZO LA BITACORA
		$des_bitacora = 'Creo cupon - '.$nombre;
		$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
		mysql_db_query($bd_nombre, $insertar);
	?>
	<script>
		alert("Cupon creado con exito!!!!!!");
		document.location.href = "cupones.php";
	</script>
	<?
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("El Cupon no pudo ser creado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
		document.location.href = "cupones.php";
		</script>
	<?
	}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../jscalendar-1.0/calendar-blue.css" title="win2k-cold-1" /> 

<script type="text/javascript" src="../jscalendar-1.0/calendar.js"></script> 
<script type="text/javascript" src="../jscalendar-1.0/lang/calendar-es.js"></script> 
<script type="text/javascript" src="../jscalendar-1.0/calendar-setup.js"></script>
</head>

<body style="margin:auto">
<form id="frm_cupon" name="frm_cupon" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php")?></td>
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>NUEVO CUP&Oacute;N</strong></h1>
				<div align="right"></div>
		  	</div>
		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>

            <label></label>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">
				<table width="100%" class="form">
                  <tr>
                    <td width="28%" align="left"><span class="required">*</span> Nombre Cup&oacute;n</td>
                    <td width="72%" align="left"><input name="nombre" type="text" id="nombre" /></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> C&oacute;digo <br/>(El c&oacute;digo que el cliente entra para obtener el descuento)</td>
                    <td align="left"><input name="codigo" type="text" id="codigo" /></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Tipo</td>
                    <td align="left">
                    <select name="tipo" id="tipo">
                        <?php
                    	for ($i=1; $i <= 2; $i++)
                    	{
                        ?>
                        	<option value="<?php echo $i?>"><?php echo tipos_cupon($i)?></option>
                        <?
                    	}
                    	?>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Descuento</td>
                    <td align="left"><input name="descuento" type="text" id="descuento" onkeypress="return soloNumeros(event);" /></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Fecha de Inicio</td>
                    <td align="left"><input type="text" name="fecini" id="fecini" value="" readonly />
                      <img src="imagenes/calendario.png" width="22" height="22" name="btn_fecha_ini" id="btn_fecha_ini" style="cursor:pointer" align="absmiddle"/>
                      <!-- script que define y configura el calendario-->
                      <script type="text/javascript"> 
                               Calendar.setup({ 
                                 inputField     :    "fecini",     // id del campo de texto 
                                 ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                                 button     :    "btn_fecha_ini"     // el id del botón que lanzará el calendario 
                            }); 
                            </script></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Fecha de finalizaci&oacute;n: </td>
                    <td align="left"><input name="fecfin" type="text" id="fecfin" />
                    <img src="imagenes/calendario.png" width="22" height="22" name="btn_fecha_fin" id="btn_fecha_fin" style="cursor:pointer" align="absmiddle"/>
                      <!-- script que define y configura el calendario-->
                      <script type="text/javascript"> 
                               Calendar.setup({ 
                                 inputField     :    "fecfin",     // id del campo de texto 
                                 ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                                 button     :    "btn_fecha_fin"     // el id del botón que lanzará el calendario 
                            }); 
                            </script></td>
                  </tr>
                  <tr>
                    <td align="left">Usos por cupón:<br />
(El número máximo de veces que el cupón puede ser utilizado por cualquier cliente.
Dejar en blanco para un número ilimitado)</td>
                    <td align="left"><input name="n_usos" type="text" id="n_usos" onkeypress="return soloNumeros(event);" /></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Estado</td>
                    <td align="left">
                    <select name="estado" id="estado">
                        <?php
                    	for ($i=1; $i <= 2; $i++)
                    	{
                        ?>
                        	<option value="<?php echo $i?>"><?php echo estados($i)?></option>
                        <?
                    	}
                    	?>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                      <span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="button" name="Submit" value="Guardar" onclick="agregar_cupon();" />&nbsp;&nbsp;<input type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_cupon.action = 'cupones.php'; document.frm_cupon.submit() };" value="Cancelar"/>
                      <br />
                      </td>
                  </tr>
                  
                </table></td>
                </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
</form>
</body>
</html>
