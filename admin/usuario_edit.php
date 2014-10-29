<?php
$permisos = array(3);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/upload.php");

$id = $_POST["hdd_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $GLOBAL_nombre_pagina?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/ajax.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<?php
if(isset($_POST["hdd_accion"]) && $_POST["hdd_accion"] == "editar")
{
	$nombres = $_POST["nombres"] ;
	$apellidos = $_POST["apellidos"] ;
	$identificacion = $_POST["identificacion"] ;
	$telefono = $_POST["telefono"] ;
	$celular = $_POST["celular"] ;
	$ciudad = $_POST["ciudad"] ;
	$nInmuebles = $_POST["nInmuebles"] ;
	$url = $_POST["url"] ;
	$usuario = $_POST["email"] ;
	$email = $_POST["email"] ;
	$nomempresa = $_POST["nomempresa"] ;
	$logo = "";
	$banner = "";
$valLogo="";
 $valBanner ="";
	if ($_FILES["logo"]["name"] != "")
	{
		
		
				$numero_azar = rand();
				$nombre = $_FILES['logo']['name'];
				$temp   = $_FILES['logo']['tmp_name'];
				$nombre_real = $numero_azar."_".$nombre;
				
				
				
		if ($_POST["hdd_banner1"] != "")
		{
			unlink("../bannerInmobiliariaConstructora/".$_POST["hdd_banner1"]);
		}
		
		//echo "23";
		
		//$logo = subir_archivo($_FILES["logo"]["name"], $_FILES["logo"]["size"], 2000000, $_FILES["logo"]["tmp_name"], "../bannerInmobiliariaConstructora/");
		//$valLogo .= ", banner1 = '$nombre_real'";
				$destino = "../bannerInmobiliariaConstructora/";
				
				if(move_uploaded_file($temp, $destino.$nombre_real))
				{
					$valLogo .= ", banner1 = '$nombre_real'";
					?>
				<script language="javascript" type="text/javascript">
				//alert("No se pudo adjuntar el archivo!!");
				</script>
				<?php
					
				}

	}
	
	if ($_FILES["banner"]["name"] != "")
	{
					$numero_azar = rand();
				$nombre = $_FILES['banner']['name'];
				$temp   = $_FILES['banner']['tmp_name'];
				$nombre_real = $numero_azar."_".$nombre;
				
				
				
		if ($_POST["hdd_banner2"] != "")
		{
			unlink("../bannerInmobiliariaConstructora/".$_POST["hdd_banner2"]);
		}
		
		
		
		//$banner = subir_archivo($_FILES["banner"]["name"], $_FILES["banner"]["size"], 2000000, $_FILES["banner"]["tmp_name"], "../bannerInmobiliariaConstructora/");
		
		
				$destino = "../bannerInmobiliariaConstructora/";
		if(move_uploaded_file($temp, $destino.$nombre_real))
				{
					$valBanner .= ", banner2 = '$nombre_real'";
					?>
				<script language="javascript" type="text/javascript">
				//alert("No se pudo adjuntar el archivo!!");
				</script>
				<?php
					
				}
/*		if ($_POT["hdd_banner2"] != "")
		{
			unlink("../bannerInmobiliariaConstructora/".$_POST["hdd_banner2"]);
		}*/

	}
	//INSERTO DATOS EN LA TABLA USUARIOS
	
	$actualizar = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', identificacion='$identificacion', telefono='$telefono', celular='$celular', nombreEmpresa='$nomempresa',ciudad=$ciudad, usuario='$usuario', email='$email', nInmuebles=$nInmuebles, url='$url' $valLogo $valBanner WHERE id = $id";
	$actu=mysql_query( $actualizar);
	if ($actualizar)
	{
	?>
	<script>
		alert("Usuario editado con exito!!!!!!");
		document.location.href = "usuarios.php";
	</script>
	<?php
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("El Usuario no pudo ser editado.  Intentelo mas tarde y si el problema persiste contacte a su webmaster");
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

<body style="margin:auto">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>EDITAR USUARIO </strong></h1>
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
            $consulta = "SELECT * FROM usuarios WHERE id = ".$id;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="20%" align="left"><strong>Nombre</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="nombres" type="text" id="nombres" size="30" class="validate[required] text-input" value="<?php echo $registro['nombres']?>" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Apellidos</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="apellidos" type="text" id="apellidos" size="30" class="validate[required] text-input" value="<?php echo $registro['apellidos']?>"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Identificaci&oacute;n</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="identificacion" type="text" id="identificacion" size="30" class="validate[required,custom[onlyNumberSp]] text-input" value="<?php echo $registro['identificacion']?>"/>
                    </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Teléfono fijo</strong></td>
                    <td colspan="2" align="left"><label>
                      <input name="telefono" type="text" id="telefono" size="30" class="validate[required,custom[onlyNumberSp]] text-input" value="<?php echo $registro['telefono']?>"/>
                      </label></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>Tel&eacute;fono celular</strong></td>
                    <td colspan="2" align="left" class="small"><input name="celular" type="text" class="validate[required,custom[onlyNumberSp]] text-input" id="celular" size="30" value="<?php echo $registro['celular']?>" /></td>
                  </tr>
                  <tr>
                      <td align="left"><strong>Departamento</strong></td>
                      	<?php
						//Consultamos el departamento del municipio
						$consulta = "SELECT * FROM municipio WHERE idmunicipio = ".$registro['ciudad'];	
						$resultado_mun = mysql_query($consulta, $conexion);
						$registro_mun= mysql_fetch_array($resultado_mun);
						?>
                      <td align="left">
                        <select name="departamento" id="departamento" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                            <option value="" selected="selected">- Escoja -</option>
                            <?php
                            $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                            $resultado_dep = mysql_query($consulta, $conexion);
                            
                            while ($registro_dep= mysql_fetch_array($resultado_dep))
                            {
                            ?>
                            <option value="<?php echo $registro_dep["iddepartamento"]?>" <?php if($registro_mun["departamento_iddepartamento"] == $registro_dep["iddepartamento"]) { echo "selected"; } ?>> <?php echo $registro_dep["nombre"]?> </option>
                            <?php
                            }
                            ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="left"><strong>Ciudad</strong></td>
                      <td align="left">
                        <!--<select name="ciudad" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                            <option value="">- Escoja -</option>
                        </select>-->
                        <select name="ciudad" style="width:140px;" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
							<?php
                            $consulta = "SELECT * FROM municipio WHERE departamento_iddepartamento = ".$registro_mun["departamento_iddepartamento"]." ORDER BY nombreMunicipio ASC";
                            
                            $resultado_ciu = mysql_query($consulta, $conexion);
                            
                            while ($registro_ciu= mysql_fetch_array($resultado_ciu))
                            {
                            ?>
                                <option value="<?php echo $registro_ciu["idmunicipio"]?>" <?php if($registro['ciudad'] == $registro_ciu["idmunicipio"]) { echo "selected"; } ?> ><?php echo $registro_ciu["nombreMunicipio"]?></option>
                            <?php
                            }
                            ?>
                            <option value="">- Escoja -</option>
                         </select>
                      </td>
                    </tr>
                  
                  <tr>
                    <td width="20%" height="25px" align="left"><strong>Tipo de Cliente</strong></td>
                    <td colspan="2" align="left"><?php
						$consulta = "SELECT idrol, nomrol FROM rol WHERE idrol = ".$registro['rol'];					
						$resultado_cargo = mysql_query($consulta, $conexion);					
						$registro_cargo= mysql_fetch_array($resultado_cargo);
						echo $registro_cargo['nomrol'];
						?>
                    </td>
                  </tr>
                  <tr>
                  	<td align="left"><strong>Nombre de la empresa</strong></td>
                  	<td align="left"><input name="nomempresa" type="text" id="nomempresa" class="validate[required] text-input"  value="<?php echo $registro['nombreEmpresa']?>" size="30" /></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>E-mail / Usuario</strong></td>
                    <td align="left"><label for="email"></label>
                      <input name="email" type="text" class="validate[required,custom[email]] text-input" id="email" size="30" value="<?php echo $registro['email']?>"/></td>
                  </tr>
                  <?php
				  if($registro['rol'] == 3 || $registro['rol'] == 4)
				  {
				  ?>
                  <tr>
                    <td colspan="2">
                      <div id="campos_ocultos">
                        <div class="divCampo" id="section_0" style="padding:2px 0; border-bottom:#DDD 1px solid" align="left">
                          <label for="nInmuebles" style="padding-right:40px;"><strong>No. de Inmuebles</strong></label>
                          <input name="nInmuebles" type="text" id="lonInmueblesgo" size="30" value="<?php echo $registro['nInmuebles']?>" />
                          </div>
                          <div class="divCampo" id="section_1" style="padding:2px 0; border-bottom:#DDD 1px solid" align="left">
                          <label for="url" style="padding-right:40px;"><strong>URL</strong></label>
                          <input name="url" type="text" id="url" size="30" value="<?php echo $registro['url']?>" />
                          </div>
                          <div class="divCampo" id="section_2" style="padding:2px 0; border-bottom:#DDD 1px solid" align="left">
                          <label for="logo" style="padding-right:40px;"><strong>Logo</strong></label>
                          <input name="logo" type="file" id="logo" size="30" />
                          <input name="hdd_banner1" type="hidden" id="hdd_banner1" value="<?php echo $registro['banner1']?>" /> 
                          <strong>(Tama&ntilde;o 150 x 150)</strong>
                          </div>
                          <div class="divCampo" id="section_3" style="padding:2px 0;" align="left">
                          <label for="banner" style="padding-right:40px;"><strong>Banner</strong></label>
                          <input name="banner" type="file" id="banner" size="30" /> 
                          <input name="hdd_banner2" type="hidden" id="hdd_banner2" value="<?php echo $registro['banner2']?>" />
                          <strong>(Tama&ntilde;o 550 Ancho x 100 Altura)</strong>
                          </div>   
                        </div>
                      </td>
                  </tr>
                  <?php
				  }
				  ?>
                    <tr>
                      <td colspan="3" align="left"><br />
                        <br />
                        <input type="submit" name="Submit" value="Guardar" />
                        &nbsp;&nbsp;
                        <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_usuarios.action = 'usuarios.php'; document.frm_usuarios.submit() };" value="Cancelar"/>
                        <br />
                        <input name="hdd_accion" type="hidden" id="hdd_accion" value="editar" />
                        <input name="hdd_id" type="hidden" id="hdd_id" value="<?php echo $id?>" />
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
