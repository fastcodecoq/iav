<?php
include('controlSesion.php');
require('bd.php');

if(isset($_POST["hdd_accion"]) && ($_POST["hdd_accion"] == "editar"))
{
	$nombres = $_POST["nombres"] ;
	$apellidos = $_POST["apellidos"] ;
	$telefono = $_POST["telefono"] ;
	$celular = $_POST["celular"] ;
	$ciudad = $_POST["ciudad"] ;
	

	//ACTUALIZO LOS DATOS EN LA TABLA USUARIOS
	$actualizar = "UPDATE usuarios SET nombres = '$nombres', apellidos = '$apellidos', telefono = $telefono, celular = $celular, ciudad = $ciudad WHERE identificacion = ".$_SESSION["idusuario"];
		
	if (mysql_db_query($bd_nombre, $actualizar))
	{
	?>
	<script>
		alert("Cuenta editada con exito!!!!!!");
		document.location.href = "cuenta.php";
	</script>
	<?php
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("La Cuenta no pudo ser editada.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
		document.location.href = "cuenta.php";
		</script>
	<?php
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="admin/estilos/tabs.css" rel="stylesheet" type="text/css" />
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/nuevos-estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<!-- Script de los validadores-->
<script src="validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script language="javascript">
$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	
	// Formulario a validar
	jQuery("#frm_cuenta").validationEngine();
	
	//consultamos las ciudades del departamento seleccionado 
	$("#departamento").change(function () {
		   $("#departamento option:selected").each(function () {
			elegido=$(this).val();
			$.post("comboCiudades.php", { elegido: elegido }, function(data){
			$("#ciudad").html(data);
			});            
		});
	})

});
</script>  
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
	<div class="contenedor">
    </div>    
</section>

<section>
  <div class="contenedor">
		<div>
		  <h1>Editar Cuenta</h1></div>
  </div>
</section>

<section>
<div class="contenedor">
    <div class="recuadroAzul">
    <form id="frm_cuenta" name="frm_cuenta" method="post" action="">
	<?php
    $consulta = "SELECT * FROM usuarios WHERE identificacion =".$_SESSION['idusuario'];
    $resultado = mysql_query($consulta, $conexion);
    $registro= mysql_fetch_array($resultado);                 
    ?>
  	<table width="90%" border="0" cellspacing="0" cellpadding="0" style="padding-left:10px">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="left" style="color:#346599; font-weight:bold; padding:5px 0"><strong>Informaci&oacute;n Personal</strong></td>
        </tr>
        <tr>
          <td bgcolor="#F7F7F7" style="border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid; border-top:#CCCCCC 1px solid;">
          <table width="100%" border="0" cellspacing="2" cellpadding="3">
            <tr>
              <td width="20%" align="left"><strong>Nombres</strong></td>
              <td width="80%" align="left"><label>
                <input name="nombres" type="text" id="nombres" size="30" value="<?php echo $registro['nombres']?>" class="validate[required] text-input" />
              </label></td>
            </tr>
            <tr>
              <td align="left"><strong>Apellidos</strong></td>
              <td align="left"><label>
                <input name="apellidos" type="text" id="apellidos" size="30" value="<?php echo $registro['apellidos']?>" class="validate[required] text-input" />
              </label></td>
            </tr>
            <tr>
              <td align="left"><strong>Tel&eacute;fono fijo</strong></td>
              <td align="left">
                <input name="telefono" type="text" id="telefono" size="30" value="<?php echo $registro['telefono']?>" class="validate[required,custom[onlyNumberSp]] text-input" /></td>
            </tr>
            <tr>
              <td align="left"><strong>Tel&eacute;fono celular</strong></td>
              <td align="left"><input name="celular" type="text" id="celular" size="30" value="<?php echo $registro['celular']?>" class="validate[required,custom[onlyNumberSp]] text-input" /></td>
            </tr>
            <tr>
              <td align="left"><strong>Departamento</strong></td>
              <td align="left">
              	<select name="departamento" id="departamento" style="width:140px;" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                    <option value="" selected="selected">- Escoja -</option>
                    <?php
					//Consultamos el departamento del municipio
					$consulta = "SELECT * FROM municipio WHERE idmunicipio = ".$registro['ciudad'];	
					$resultado_mun = mysql_query($consulta, $conexion);
					$registro_mun= mysql_fetch_array($resultado_mun);
					
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
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="left" style="color:#346599; font-weight:bold; padding:5px 0">C&oacute;mo recuperar su clave</td>
        </tr>
        <tr>
          <td bgcolor="#F7F7F7" style="border-bottom:#CCCCCC 1px solid; border-left:#CCCCCC 1px solid; border-right:#CCCCCC 1px solid; border-top:#CCCCCC 1px solid;">
          <table width="100%" border="0" cellspacing="2" cellpadding="3">
            <tr>
              <td width="20%" align="left"><strong>Pregunta para recuperar clave</strong></td>
              <td width="80%" align="left" class="small"><input type="text" name="pregunta" id="pregunta" style="width:330px" class="validate[required] text-input" value="<?php echo $registro['preguntaClave']?>" readonly /></td>
            </tr>
            <tr>
              <td width="20%" align="left"><strong>Respuesta</strong></td>
              <td width="80%" align="left" class="small"><input type="password" name="respuesta" id="respuesta" style="width:330px" class="validate[required] text-input" value="<?php echo $registro['respuestaPregunta']?>" readonly/></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="left">
          	<input type="submit" value="Guardar" class="boton medium naranja"/>&nbsp;&nbsp;<input type="button" name="cancelar" class="boton medium red" onClick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_cuenta.action = 'cuenta.php'; document.frm_cuenta.submit() };" value="Cancelar" />
    
            <input name="hdd_accion" type="hidden" id="hdd_accion" value="editar" />
            
    
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form>
    </div>
</div>
<div style="clear:left">&nbsp;</div>
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>