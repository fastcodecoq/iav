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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/ajax.js"></script>

<?php
if(isset($_POST["txt_nombre"]) && $_POST["txt_nombre"] != "" && isset($_POST["hdd_id"]))
{
	$nombre = $_POST["txt_nombre"] ;
	$apellidos = $_POST["txt_apellidos"] ;
	$telefono = $_POST["txt_telefono"] ;		
	$celular = $_POST["txt_celular"] ;			   
	$direccion = $_POST["txt_direccion"] ;
	$barrio = $_POST["txt_barrio"] ;
	
	if($_POST["codigo_red"] != '')
	{
		$codigo_red = $_POST["codigo_red"] ;
	}
	else
	{
		$codigo_red = 'NULL';
	}
	
	//Información del envio
	$empresa = $_POST["txt_empresa"] ;
	$direccionfac = $_POST["txt_direccion2"] ;
	$telefonofac = $_POST["txt_telefono2"] ;					   
	if($_POST["chk_datosconfirm"] == "")
	{
		$datosconfirmados = 0;
	}
	else
	{
		$datosconfirmados = $_POST["chk_datosconfirm"];
	}

	$actualizar = "UPDATE usuario SET nomusuario = '$nombre', apeusuario = '$apellidos', telusuario = $telefono, celular = '$celular', dirusuario = '$direccion', barrio = '$barrio', nomempresa = '$empresa', dirfacusuario = '$direccionfac', telfacusuario = $telefonofac, datos_confirmados = $datosconfirmados, idred = $codigo_red WHERE idusuario = ".$_POST["hdd_id"];
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Modifico cliente '.$identificacion;
			$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
			mysql_db_query($bd_nombre, $insertar);
		?>
		<script>
			alert("Cliente actualizado con exito!!!!!!");
			document.location.href = "clientes.php";
		</script>
		<?
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
			alert("El Cliente no pudo ser actualizado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
			document.location.href = "clientes.php";
			</script>
		<?
		}
}
?>
<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
</head>

<body style="margin:auto">
<form id="frm_clientes" name="frm_clientes" method="post" action="" enctype="multipart/form-data">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>EDITAR CLIENTE </strong></h1>
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
            $consulta = "SELECT * FROM usuario WHERE idusuario = ".$id;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td colspan="2" align="left"><strong>Informaci&oacute;n Personal</strong></td>
                    </tr>
                  <tr>
                    <td width="20%" align="left"><span class="required">*</span> Nombre</td>
                    <td align="left"><label>
                      <input name="txt_nombre" type="text" id="txt_nombre" size="30" value="<?php echo $registro["nomusuario"]?>" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Apellidos</td>
                    <td align="left"><label>
                      <input name="txt_apellidos" type="text" id="txt_apellidos" size="30" value="<?php echo $registro["apeusuario"]?>" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required"></span> Cedula</td>
                    <td align="left">
                      <?php echo $registro["idusuario"]?>                    </td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Tel&eacute;fono</td>
                    <td align="left"><label>
                      <input name="txt_telefono" type="text" id="txt_telefono" size="30" value="<?php echo $registro["telusuario"]?>" />
                      </label></td>
                  </tr>
                  <tr>
                    <td align="left">Celular</td>
                    <td align="left" class="small"><label>
                      
         <input name="txt_celular" type="text" id="txt_celular" size="30" value="<?php echo $registro["celular"]?>" />           </label></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span> Dirección</td>
                    <td align="left" class="small"><label>
                      <input name="txt_direccion" type="text" id="txt_direccion" size="30" value="<?php echo $registro["dirusuario"]?>" />
                    </label></td>
                  </tr>
                  <tr>
                    <td width="20%" align="left"> Barrio </td>
                    <td align="left"><input name="txt_barrio" type="text" id="txt_barrio" size="30" value="<?php echo $registro["barrio"]?>" />
                      </td>
                  </tr>
                  <tr>
                    <td width="20%" align="left"> Barrio </td>
                    <td align="left"><input name="txt_barrio" type="text" id="txt_barrio" size="30" value="<?php echo $registro["barrio"]?>" />
                      </td>
                  </tr>
                  <tr>
                    <td width="20%" align="left">C&oacute;digo Super Cliente</td>
                    <td align="left"><input name="codigo_red" type="text" id="codigo_red" size="30" value="<?php echo $registro["idred"]?>" /></td>
                  </tr>
                  <tr>
                    <td width="20%" align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><strong>Informaci&oacute;n de Facturaci&oacute;n</strong></td>
                    </tr>
                  <tr>
                    <td width="20%" align="left">Nombre empresa</td>
                    <td align="left"><input name="txt_empresa" type="text" id="txt_empresa" size="30" value="<?php echo $registro["nomempresa"]?>" /></td>
                  </tr>
                  <tr>
                    <td width="20%" align="left"><span class="required">*</span> Dirección factura</td>
                    <td align="left"><input name="txt_direccion2" type="text" id="txt_direccion2" size="30" value="<?php echo $registro["dirfacusuario"]?>" /></td>
                  </tr>
                  <tr>
                    <td width="20%" align="left"><span class="required">*</span> Tel&eacute;fono</td>
                    <td align="left"><input name="txt_telefono2" type="text" id="txt_telefono2" size="30" value="<?php echo $registro["telfacusuario"]?>" onkeyup = "compUsuario(event)" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="20%" align="left">Datos confirmados</td>
                    <td align="left"><input name="chk_datosconfirm" type="checkbox" id="chk_datosconfirm" value="1" <? if($registro["datos_confirmados"] == 1) { echo "checked"; } ?> /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="button" name="Submit" value="Guardar" onclick="modificar_cliente();" />
                      &nbsp;&nbsp;
                      <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_clientes.action = 'clientes.php'; document.frm_clientes.submit() };" value="Cancelar"/>
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
