<?php
$permisos = array(3);
require_once("../bd.php");
include_once("control_admin.php");

$id = $_POST["hdd_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $GLOBAL_nombre_pagina?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../js/ajax.js"></script>

<?php
if(isset($_POST["txt_nombre"]) && $_POST["txt_nombre"] != "" && isset($_POST["hdd_id"]))
{
	$nombre = $_POST["txt_nombre"] ;
	$direccion = $_POST["txt_direccion"] ;
	$telefono = $_POST["txt_telefono"] ;
	$zona = $_POST["cmb_zona"] ;
	
	if($_POST['checktop'] == 1)
	{
		$top = 1;
	}
	else
	{
		$top = 0;
	}

	$actualizar = "UPDATE distribuidores SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', top = $top, id_lugardis_fk = $zona WHERE id = ".$_POST["hdd_id"];
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Modifico distribuidor '.$identificacion;
			$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
			mysql_db_query($bd_nombre, $insertar);
		?>
		<script>
			alert("Distribuidor actualizado con exito!!!!!!");
			document.location.href = "distribuidores.php";
		</script>
		<?
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
			alert("El distribuidor no pudo ser actualizado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
			document.location.href = "distribuidores.php";
			</script>
		<?
		}
}
?>
<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin:auto">
<form id="frm_distribuidores" name="frm_distribuidores" method="post" action="" enctype="multipart/form-data">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>EDITAR DISTRIBUIDOR </strong></h1>
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
			<?php
            $consulta = "SELECT * FROM distribuidores WHERE id = ".$id;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="20%" align="left"><span class="required">*</span> Nombre</td>
                    <td align="left"><label>
                      <input name="txt_nombre" type="text" id="txt_nombre" size="30" value="<?php echo $registro["nombre"]?>" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left">Direcci&oacute;n</td>
                    <td align="left" class="small"><label>
                      <input name="txt_direccion" type="text" id="txt_direccion" size="30" value="<?php echo $registro["direccion"]?>" />
                      </label></td>
                  </tr>
                  <tr>
                    <td align="left">Telefono</td>
                    <td align="left" class="small"><label>
                      <input name="txt_telefono" type="text" id="txt_telefono" size="30" value="<?php echo $registro["telefono"]?>" />
                    </label></td>
                  </tr>
                  <tr>
                    <td width="20%" align="left"> Zona </td>
                    <td align="left">
                      <select name="cmb_zona" size="1" id="cmb_zona">
                      	<?
						$consulta = "SELECT id, nombre FROM lugardis ORDER BY nombre ASC";
						
						$resultado_zona = mysql_query($consulta, $conexion);
						
						while ($registro_zona= mysql_fetch_array($resultado_zona))
						{
						?>
						<option value="<?php echo $registro_zona["id"]?>" <?php if($registro["id_lugardis_fk"] == $registro_zona["id"]) { echo "selected"; } ?> ><?=$registro_zona["nombre"]?></option>
						<?
						}
						?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                  	<td align="left">Top 5</td>
                    <td align="left">
                      <input type="checkbox" name="checktop" id="checktop" value="1" <?php if($registro['top'] == 1) { echo "checked";} ?>/>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="button" name="Submit" value="Guardar" onclick="agregar_distribuidor();" />
                      &nbsp;&nbsp;
                      <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_distribuidores.action = 'distribuidores.php'; document.frm_distribuidores.submit() };" value="Cancelar"/>
                      <br />
                      <input name="hdd_tipo" type="hidden" id="hdd_tipo" />
                      <input name="hdd_contrasena" type="hidden" id="hdd_contrasena" /></td>
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
<input name="hdd_id" type="hidden" value="<?php echo $id?>" />
</form>
</body>
</html>
