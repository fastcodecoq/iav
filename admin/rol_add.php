<?php
$permisos = array(7);
require_once("../bd.php");
include_once("control_admin.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<?php
if(isset($_POST["hdd_accion"]) && ($_POST["hdd_accion"] == "crear"))
{
	$nombre = $_POST["txt_nombre"] ;
	
	$insertar = "INSERT INTO rol (nomrol) VALUES ('$nombre')";
		
		if (mysql_db_query($bd_nombre, $insertar))
		{
			// ID ULTIMO REGISTRO
			$id_rol = mysql_insert_id($conexion);
			
			//CREAMOS LOS PERMISOS
			for ($i = 0; $i < sizeof($_POST["chk_permisos"]); $i++)
			{
				$insertar = "INSERT INTO permiso_rol (permiso_idpermiso, rol_idrol) VALUES (".$_POST["chk_permisos"][$i].",".$id_rol.")";
				mysql_db_query($bd_nombre, $insertar);
			}
			
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Creo rol '.$_POST["hdd_id"].' - '.$nombre;
			$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
			mysql_db_query($bd_nombre, $insertar);
		?>
		<script>
			alert("Rol creado con exito!!!!!!");
			document.location.href = "roles.php";
		</script>
		<?
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
			alert("El Rol no pudo ser creado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
			document.location.href = "roles.php";
			</script>
		<?
		}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin:auto">
<form id="frm_rol" name="frm_rol" method="post" action="">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>AGREGAR ROL</strong></h1>
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
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">
				<table width="100%" class="form">
                  <tr>
                    <td align="left"><span class="required">*</span> Nombre</td>
                    <td align="left"><input name="txt_nombre" type="text" id="txt_nombre" value="" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><table width="60%" border="0">
                      <tr>
                        <td colspan="3"><strong>PERMISOS</strong></td>
                        </tr>
                      <tr>
                        <td>Permiso</td>
                        <td>Seleccionar </td>
                      </tr>
                      <?php						
					  $consulta = "SELECT * FROM permiso ORDER BY idpermiso";
					  $resultado = mysql_query($consulta, $conexion);
					  $num_registros = mysql_num_rows($resultado);

					  while ($registro = mysql_fetch_array($resultado))
					  {
					  ?>
                      <tr>
                        <td><?php echo $registro["nompermiso"]?></td>
                        <td><input name="chk_permisos[]" type="checkbox" class="tabla_grande" value="<?php echo $registro["idpermiso"]?>"></td>
                      </tr>
                      <?php
					  }
					  ?>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                      <span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="button" name="Submit" value="Guardar" onclick="agregar_roles();" />&nbsp;&nbsp;<input type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_rol.action = 'roles.php'; document.frm_rol.submit() };" value="Cancelar"/>
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
<input name="hdd_accion" type="hidden" />
</form>
</body>
</html>
