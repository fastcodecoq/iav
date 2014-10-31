<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="/css/general.css" rel="stylesheet" type="text/css" />
<link href="/css/nuevos-estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="/validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="/validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="/validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>

<script language="javascript">
$(document).ready(function() {	

	// Formulario y tipo de datos para el validador
	jQuery("#registro").validationEngine();
	//$("#registro").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("/comboCiudades.php", { elegido: elegido }, function(data){
            $("#ciudad").html(data);
            });            
        });
   })

});
</script>


</head>

<body>

<section>
	<?php  include("cabezote.php")?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
  <div style="clear:left; padding-top:10px;" class="contenedor">
  <br>
  <br>
  <br>
  <br>
  <br>
    	<!-- Registro -->
        <form action="/form_enviar_registro.php" method="post" id="registro">
        <div class="recuadroAzul">
        	<h1 style="color:#808080" align="center">REGISTRO DE USUARIO</h1>
            <div style="color:#346599; text-align:center; margin-bottom: 20px;">Si usted ya est&aacute; registrado en inmueblealaventa.com, por favor, ingrese su nombre de usuario y clave en la parte superior de nuestro sitio para continuar.</div>
            
            <div style="width:430px; float:left; padding-left:20px; line-height: 40px;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2" style="color:#346599; font-weight:bold;">Diligencie todos los campos</td>
                </tr>
                <tr>
                  <td><strong>Nombres</strong></td>
                  <td>
                  <input type="text" name="nombres" id="nombres" class="validate[required] text-input" data-prompt-position="topRight:-70" /></td>
                </tr>
                <tr>
                  <td><strong>Apellidos</strong></td>
                  <td>
                  <input type="text" name="apellidos" id="apellidos" class="validate[required] text-input" /></td>
                </tr>
                <tr>
                  <td><strong>Doc. de identidad</strong></td>
                  <td>
                  <input type="text" name="identificacion" id="identificacion" class="validate[required,custom[onlyNumberSp]] text-input" data-prompt-position="topRight:-70" /></td>
                </tr>
                <tr>
                  <td><strong>Tel&eacute;fono fijo</strong></td>
                  <td>
                  <input type="text" name="telefono" id="telefono" class="validate[required,custom[onlyNumberSp]] text-input" /></td>
                </tr>
                <tr>
                  <td><strong>Tel&eacute;fono celular</strong></td>
                  <td>
                  <input type="text" name="celular" id="celular" class="validate[required,custom[onlyNumberSp]] text-input" /></td>
                </tr>
                <tr>
                  <td><strong>Departamento</strong></td>
                  <td>
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
                  <td><strong>Ciudad</strong></td>
                  <td>
                  	<select name="ciudad" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                    	<option value="">- Escoja -</option>
                	</select>
                  </td>
                </tr>
                <tr>
                  <td><strong>¿Su publicación es para?</strong></td>
                  <td><select name="tipo" id="tipo" class="validate[required]" data-errormessage-value-missing="Seleccione una opcion">
                    <option value="">- Escoja -</option>
                    <option value="1">Persona Natural</option>
                    <option value="2">Persona Jur&iacute;dica</option>
                    <!--<option value="3">Constructora</option>-->
                  </select></td>
                </tr>
                <tr>
                  <td><strong>Nombre de la empresa</strong></td>
                  <td><input type="text" name="nomempresa" id="nomempresa" /></td>
                </tr>
              </table>
            </div>
            <div style="width:430px; float:left; line-height: 25px; margin-top: 10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" style="color:#346599; font-weight:bold; line-height: 20px;">Diligencia sus datos de ingreso al sistema</td>
    </tr>
  <tr>
    <td colspan="2" style="color:#346599; line-height: 20px;">(Recuerde que el usuario sera el e-mail que registre.). Los datos marcados con asterisco (*) son obligatorios</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>E-mail *</strong></td>
    <td><label for="email"></label>
      <input type="text" name="email" id="email" class="validate[required,custom[email],ajax[ajaxConsultarMail]] text-input" /></td>
  </tr>
  <tr>
    <td><strong>Clave * </strong></td>
    <td><label for="clave"></label>
      <input name="clave" type="password" class="validate[required, minSize[6]] text-input" id="clave" maxlength="30" /></td>
  </tr>
  <tr>
    <td><strong>Confirme su clave *</strong></td>
    <td><label for="confirmacion"></label>
      <input type="password" name="confirmacion" id="confirmacion" class="validate[required,equals[clave]] text-input" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="color:#346599; font-weight:bold; line-height: 20px;">C&oacute;mo recuperar su clave</td>
    </tr>
  <tr>
    <td colspan="2"><strong>Pregunta para recuperar clave</strong></td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="pregunta" id="pregunta" style="width:330px" class="validate[required] text-input" /></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Respuesta</strong></td>
    </tr>
  <tr>
    <td colspan="2">
      <input type="text" name="respuesta" id="respuesta" style="width:330px" class="validate[required] text-input"/></td>
  </tr>
  <tr>
  	<td colspan="2" align="left"> 
    <div style="color:#346599; padding-top:10px"><strong>Cuent&eacute;nenos si le gustar&iacute;a recibir informaci&oacute;n del sector inmobiliario</strong></div>
    
    <div style="float:left; width:200px; padding-top:10px; clear:left"><strong>En su celular</strong></div>
    <div style="float:left;padding-top:8px;"><input name="infoCelular" type="checkbox" id="infoCelular" value="1" style="width:50px" /></div>
    
    <!--- -->
  <div style="clear:left;float:left; width:200px; padding-top:10px; ">
        <label><strong>En su correo electr&oacute;nico</strong></label></div>
    <div style="float:left;padding-top:8px;"><input name="infoCorreo" type="checkbox" id="infoCorreo" value="1" style="width:50px" /></div>
    
    <!-- --->
    <div style="float:left; width:200px; padding-top:10px; clear:left;color:#346599; "><strong>Acepta los t&eacute;rminos y condiciones</strong> <a href="terminosycondiciones" class="colorazul" target="_blank">Ir a leer</a></div>
  <div style="float:left;padding-top:8px;"><input name="terminos" type="checkbox" class="validate[required] checkbox" data-errormessage-value-missing="Debe aprobar los t&eacute;rminos y condiciones" id="terminos" value="" style="width:50px" /></div>
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="button" id="button" value="" style="background:url(/imagenes/btnGuardar.png) no-repeat; width:222px; height:26px; border:none; cursor:pointer" title="Enviar" /></td>
  </tr>
            </table>

            </div>
            <div style="clear:left"></div>
            
        </div>
        </form>
        <!-- Registro -->
  </div>

  <br>
  <br>
  <br>
  <br>
  
</section>


<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>