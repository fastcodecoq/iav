<?php
$permisos = array(6);
require_once("../bd.php");
include_once("control_admin.php");

$id = $_POST["hdd_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<?php
if(isset($_POST["txt_nombre"]) && $_POST["txt_nombre"] != "" && isset($_POST["hdd_id"]))
{
	$nombre = $_POST["txt_nombre"] ;
	
	$actualizar = "UPDATE permiso SET nompermiso = '$nombre' WHERE idpermiso = ".$_POST["hdd_id"];
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Edito permiso '.$_POST["hdd_id"].' - '.$nombre;
			$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
			mysql_db_query($bd_nombre, $insertar);
		?>
		<script>
			alert("Permiso actualizado con exito!!!!!!");
			document.location.href = "permisos.php";
		</script>
		<?
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
			alert("El Permiso no pudo ser actualizada.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
			document.location.href = "permisos.php";
			</script>
		<?
		}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin:auto">
<form id="frm_permisos" name="frm_permisos" method="post" action="">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>EDITAR PERMISO</strong></h1>
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
            $consulta = "SELECT * FROM permiso WHERE idpermiso= ".$id;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">
				<table width="100%" class="form">
                  <tr>
                    <td align="left"><span class="required">*</span> Nombre</td>
                    <td align="left"><input name="txt_nombre" type="text" id="txt_nombre" value="<?php echo $registro["nompermiso"]?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                      <span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="button" name="Submit" value="Guardar" onclick="agregar_permiso();" />&nbsp;&nbsp;<input type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_permisos.action = 'permisos.php'; document.frm_permisos.submit() };" value="Cancelar"/>
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
<input name="hdd_id" type="hidden" value="<?php echo $id?>" />
</form>
</body>
</html>
