<?php
$permisos = array(1);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/upload.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $GLOBAL_nombre_pagina?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/funciones.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<?php
if(isset($_POST["hdd_accion"]) && $_POST["hdd_accion"] == "guardar")
{
	$nombres = $_POST["nombres"] ;
	$apellidos = $_POST["apellidos"] ;
	$identificacion = $_POST["identificacion"] ;
	$telefono = $_POST["telefono"] ;
	$celular = $_POST["celular"] ;
	$ciudad = $_POST["ciudad"] ;
	$tipo = $_POST["tipo"] ;
	$nomempresa = $_POST["nomempresa"] ;
	$nInmuebles = $_POST["nInmuebles"] ;
	$url = $_POST["url"] ;
	$usuario = $_POST["email"] ;
	$email = $_POST["email"] ;
	$contrasena = $_POST["clave"] ;
	$password = md5(sha1($_POST["confirmacion"]));
	$logo = "";
	$banner = "";

	if (! empty($_FILES["logo"]["name"])) { $logo = subir_archivo($_FILES["logo"]["name"], $_FILES["logo"]["tmp_name"], "../bannerInmobiliariaConstructora/"); }
	
	if (! empty($_FILES["banner"]["name"])){		$banner = subir_archivo($_FILES["banner"]["name"],  $_FILES["banner"]["tmp_name"], "../bannerInmobiliariaConstructora/");}
	//INSERTO DATOS EN LA TABLA USUARIOS
	$insercion = "INSERT INTO usuarios (nombres, apellidos, identificacion, telefono, celular, ciudad, tipoUsuario, nombreEmpresa, usuario, email, pass, rol, fechaCreacion, nInmuebles, banner1, banner2, url) VALUES ('$nombres', '$apellidos', $identificacion, '$telefono', '$celular', $ciudad, $tipo, '$nomempresa', '$usuario', '$email', '$password', $tipo, NOW(), $nInmuebles, '$logo', '$banner', '$url')";
	$resultado = mysql_query($insercion);	
	if ($resultado)
	{
	?>
	<script>
		alert("Usuario creado con exito!!!!!!");
		document.location.href = "usuarios.php";
	</script>
	<?php
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("El Usuario no pudo ser creado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
		document.location.href = "usuarios.php";
		</script>
	<?php
	}	
}
?>
<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="../validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="../validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="../validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>

<script language="javascript">
$(document).ready(function() {	

	// Formulario y tipo de datos para el validador
	jQuery("#frm_usuarios").validationEngine();
	//$("#registro").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("../comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
            });            
        });
   })
   
   // This demo is for hidden elements in the form
	$('#tipo').change(function(){
	var value = $(this).val();
	if (value == 3 || value == 4) $('#section_0').show(),$('#section_1').show(), $('#section_2').show(), $('#section_3').show();
	else if(value != 3 || value != 4) $('#section_0').hide(),$('#section_1').hide(), $('#section_2').hide(), $('#section_3').hide();
	else $('#campo_ocultos').children().hide();
	});

});
</script>

</head>

<body style="margin:auto" onload="document.frm_usuarios.nombres.focus()">
<form id="frm_usuarios" name="frm_usuarios" method="post" action="" enctype="multipart/form-data">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>AGREGAR USUARIO </strong></h1>
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
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="20%" align="left"><strong>Nombre</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="nombres" type="text" id="nombres" size="30" class="validate[required] text-input" />
                      </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Apellidos</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="apellidos" type="text" id="apellidos" size="30" class="validate[required] text-input" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Identificaci&oacute;n</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="identificacion" type="text" id="identificacion" size="30" class="validate[required,custom[onlyNumberSp]] text-input" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Teléfono fijo</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="telefono" type="text" id="telefono" size="30" class="validate[required,custom[onlyNumberSp]] text-input" />
                      </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Tel&eacute;fono celular</strong></td>
                    <td colspan="2" align="left" class="small"><input name="celular" type="text" class="validate[required,custom[onlyNumberSp]] text-input" id="celular" size="30" /></td>
                  </tr>
                  <tr>
                      <td align="left"><strong>Departamento</strong></td>
                      <td align="left">
                        <select name="departamento" id="departamento" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                            <option value="" selected="selected">- Escoja -</option>
                            <?php
                            $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                            $resultado_dep = mysql_query($consulta, $conexion);
                            
                            while ($registro_dep= mysql_fetch_array($resultado_dep))
                            {
                            ?>
                            <option value="<?php echo $registro_dep["iddepartamento"]?>"> <?php echo $registro_dep["nombre"]?> </option>
                            <?php
                            }
                            ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="left"><strong>Ciudad</strong></td>
                      <td align="left">
                        <select name="ciudad" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                            <option value="">- Escoja -</option>
                        </select>
                      </td>
                    </tr>
                  
                  <tr>
                    <td width="20%" align="left"><strong>Tipo de Cliente</strong></td>
                    <td colspan="2" align="left">
                      <select name="tipo" size="1" id="tipo" class="validate[required] text-input">
                     	<option value="">[ Escoja ]</option>
                      	<?php
						$consulta = "SELECT idrol, nomrol FROM rol ORDER BY idrol ASC";
						
						$resultado_cargo = mysql_query($consulta, $conexion);
						
						while ($registro_cargo= mysql_fetch_array($resultado_cargo))
						{
						?>
						<option value="<?php echo $registro_cargo["idrol"]?>"><?php echo $registro_cargo["nomrol"]?></option>
						<?php
						}
						?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                  	<td align="left"><strong>Nombre de la empresa</strong></td>
                  	<td align="left"><input name="nomempresa" type="text" id="nomempresa" size="30"  class="validate[required] text-input"/></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>E-mail / Usuario</strong></td>
                    <td align="left"><label for="email"></label>
                      <input name="email" type="text" class="validate[required,custom[email]] text-input" id="email" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Clave</strong></td>
                    <td align="left"><label for="clave"></label>
                      <input name="clave" type="password" class="validate[required, minSize[6]] text-input" id="clave" size="30" maxlength="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Confirme la clave</strong></td>
                    <td align="left"><label for="logo"></label>
                      <input name="confirmacion" type="password" class="validate[required,equals[clave]] text-input" id="confirmacion" size="30" /></td>
                  </tr>
                  <tr>
                  	<td colspan="2">
                    <div id="campos_ocultos">
                        <div class="divCampo" id="section_0" style="display:none; padding:2px 0; border-bottom:#DDD 1px solid" align="left">
                            <label for="nInmuebles" style="padding-right:40px;"><strong>No. de Inmuebles</strong></label>
                            <input name="nInmuebles" type="text" id="lonInmueblesgo" size="30" value="0" />
                        </div>
                        <div class="divCampo" id="section_1" style="display:none; padding:2px 0; border-bottom:#DDD 1px solid" align="left">
                            <label for="url" style="padding-right:40px;"><strong>URL</strong></label>
                            <input name="url" type="text" id="url" size="30" value="" />
                        </div>
                        <div class="divCampo" id="section_2" style="display:none; padding:2px 0; border-bottom:#DDD 1px solid" align="left">
                            <label for="logo" style="padding-right:40px;"><strong>Logo</strong></label>
                            <input name="logo" type="file" id="logo" size="30" /> <strong>(Tama&ntilde;o 150 x 150)</strong>
                        </div>
                        <div class="divCampo" id="section_3" style="display:none; padding:2px 0;" align="left">
                            <label for="banner" style="padding-right:40px;"><strong>Banner</strong></label>
                            <input name="banner" type="file" id="banner" size="30" /> <strong>(Tama&ntilde;o 550 Ancho x 100 Altura)</strong>
                        </div>   
                    </div>
                    </td>
                  </tr>
                    <tr>
                      <td colspan="3" align="left"><br />
                        <br />
                        <input type="submit" name="Submit" value="Guardar" />
                        &nbsp;&nbsp;
                        <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_usuarios.action = 'usuarios.php'; document.frm_usuarios.submit() };" value="Cancelar"/>
                        <br />
                        <input name="hdd_accion" type="hidden" id="hdd_accion" value="guardar" />
                        <input name="hdd_contrasena" type="hidden" id="hdd_contrasena" />
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
