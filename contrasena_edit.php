<?php
include('controlSesion.php');
require('bd.php');
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
<?php
if(isset($_POST["hdd_accion"]) && ($_POST["hdd_accion"] == "editar"))
{
	$clave_act = md5(sha1($_POST["contrasena_actual"]));
	$clave = $_POST["contrasena_nueva"];
	$clave_nue = md5(sha1($_POST["confirmar_contrasena"]));
	
	//VERIFICAMOS QUE LA CONTRASENA ACTUAL ES LA QUE ESTA ALMACENADA verifico la contrasena actual
	$consulta = "SELECT nombres FROM usuarios WHERE identificacion = '".$_SESSION["idusuario"]."' AND pass = '$clave_act'";
	$resultado = mysql_query($consulta, $conexion);
	
	if (mysql_num_rows($resultado) > 0)
	{
		$actualizacion = "UPDATE usuarios SET pass = '$clave_nue' WHERE identificacion = ".$_SESSION["idusuario"];
		
		if (mysql_db_query($bd_nombre, $actualizacion))
		{
			?>
			<script language="javascript" type="text/javascript">
			alert("El cambio de contrasena se realizó exitosamente");
			document.location.href = "cuenta.php";
			</script>
			<?php
		}
		else
		{
			?>
			<script language="javascript" type="text/javascript">
			alert("Hubo un error y no se pudo cambiar la contrasena de pago. Intentelo más tarde y si el problema persiste póngase en contacto con su webmaster");
			document.location.href = "cuenta.php";
			</script>
			<?php
		}
	}
	else
	{
		?>
		<script type="text/javascript" language="javascript">
		alert("La contrasena actual ingresada es incorrecta");
		</script>
		<?php
	}
}
?>
</head>

<body>

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
		  <h1>Mi Cuenta / Cambio contrase&ntilde;a</h1></div>
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
          <table width="100%" border="0" cellspacing="2" cellpadding="0" style="padding:5px">
            <tr>
              <td width="26%" align="left" style="padding:5px"><strong>Usuario</strong></td>
              <td width="74%" align="left" style="padding:5px"><strong><?php echo $registro['usuario']?></strong></td>
            </tr>
            <tr>
              <td width="26%" align="left" style="padding:5px"><strong>Contrase&ntilde;a actual</strong></td>
              <td width="74%" align="left" style="padding:5px"><label>
                <input name="contrasena_actual" type="password" id="contrasena_actual" size="30" class="validate[required] text-input" />
              </label></td>
            </tr>
            <tr>
              <td align="left" style="padding:5px"><strong>Nueva contrase&ntilde;a</strong></td>
              <td align="left" style="padding:5px"><label>
                <input name="contrasena_nueva" type="password" class="validate[required, minSize[6]] text-input" id="contrasena_nueva" size="30" maxlength="30" />
              </label></td>
            </tr>
            <tr>
              <td align="left" style="padding:5px"><strong>Confirmar contrase&ntilde;a</strong></td>
              <td align="left" style="padding:5px"><label>
                <input name="confirmar_contrasena" type="password" id="confirmar_contrasena" size="30" class="validate[required,equals[contrasena_nueva]] text-input" /></label></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
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