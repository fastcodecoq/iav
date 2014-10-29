<?php
$permisos = array(12);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/upload.php");


$id_cat = $_POST["hdd_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $GLOBAL_nombre_pagina?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../editortxt2/lib/blueprint/print.css" media="print" />
<!--[if lt IE 8]><link rel="stylesheet" href="../lib/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" href="../editortxt2/jquery.wysiwyg.css" type="text/css"/>
<link type="text/css" href="../editortxt2/lib/ui/jquery.ui.all.css" rel="stylesheet"/>
<script type="text/javascript" src="../editortxt2/lib/jquery.js"></script>
<script type="text/javascript" src="../editortxt2/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="../editortxt2/lib/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../editortxt2/lib/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../editortxt2/lib/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="../editortxt2/lib/ui/jquery.ui.resizable.js"></script>

<script type="text/javascript" src="../editortxt2/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="../editortxt2/controls/wysiwyg.table.js"></script>
<script type="text/javascript">
(function ($) {
	$(document).ready(function () {
		$('#caracteristicas').wysiwyg({
			resizeOptions: {},

			controls: {
				html: { visible: true }
			}
		});
		$('#produccion').wysiwyg({
			resizeOptions: {},

			controls: {
				html: { visible: true }
			}
		});
	});
})(jQuery);
</script>


<script type="text/javascript" src="../js/funciones.js"></script>

<?php
if(isset($_POST["txt_nombre"]) && $_POST["txt_nombre"] != "" && isset($_POST["hdd_id"]))
{

	$nombre = $_POST["txt_nombre"] ;
	$categoria = $_POST["categoria"] ;
	$precio = $_POST["txt_precio"] ;
	$video = $_POST["video"];
	$caracteristicas = $_POST["caracteristicas"];
	$produccion = $_POST["produccion"];
	$url = $_POST["url"];
	$h1 = $_POST["h1"];
	$h2 = $_POST["h2"];
	$h3 = $_POST["h3"];
	$h4 = $_POST["h4"];
	$h5 = $_POST["h5"];
	$h6 = $_POST["h6"];
	$title = $_POST["title"];
	$description = $_POST["description"];
	$keywords = $_POST["keywords"];
	
	
	if($_POST["chk_agotado"] == "")
		$agotado = 0;
		else
		$agotado = $_POST["chk_agotado"];

	
	if($_POST["chk_deshabilitar"] == "")
		$deshabilitar = 0;
		else
		$deshabilitar = $_POST["chk_deshabilitar"];

	
	if ($_FILES["txt_imagen"]["name"] != "")
	{
		$foto = subir_archivo($_FILES["txt_imagen"]["name"], $_FILES["txt_imagen"]["size"], 2000000, $_FILES["txt_imagen"]["tmp_name"], "../img_productos/");
		$fotos .= ", imagen = '$foto'";
		
		if ($_POST["hdd_imagen"] != "")
		{
			unlink("../img_productos/".$_POST["hdd_imagen"]);
		}
		
		$j++;
	}
	
	if ($_FILES["txt_imagen2"]["name"] != "")
	{
		$foto = subir_archivo($_FILES["txt_imagen2"]["name"], $_FILES["txt_imagen2"]["size"], 2000000, $_FILES["txt_imagen2"]["tmp_name"], "../img_productos/");
		$fotos .= ", imagen2 = '$foto'";
		
		if ($_POST["hdd_imagen2"] != "")
		{
			unlink("../img_productos/".$_POST["hdd_imagen2"]);
		}
		
		$j++;
	}
	
	if ($_FILES["txt_imagen3"]["name"] != "")
	{
		$foto = subir_archivo($_FILES["txt_imagen3"]["name"], $_FILES["txt_imagen3"]["size"], 2000000, $_FILES["txt_imagen3"]["tmp_name"], "../img_productos/");
		$fotos .= ", imagen3 = '$foto'";
		
		if ($_POST["hdd_imagen3"] != "")
		{
			unlink("../img_productos/".$_POST["hdd_imagen3"]);
		}
		
		$j++;
	}
	
	$actualizar = "UPDATE productos SET categoria_id = $categoria, nombre = '$nombre', valor = $precio $fotos, agotado = $agotado, deshabilitar=$deshabilitar, video='$video', caracteristicas = '$caracteristicas', produccion = '$produccion', url = '$url', h1 = '$h1',h2 = '$h2',h3 = '$h3',h4 = '$h4',h5 = '$h5',h6 = '$h6', title = '$title', description = '$description', keywords = '$keywords' WHERE id = ".$_POST["hdd_id"];
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{
			//ACTUALIZO LA BITACORA
			$des_bitacora = 'Modifico el producto '.$nombre;
			$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
			mysql_db_query($bd_nombre, $insertar);
		?>
		<script>
			alert("Producto actualizado con exito!!!!!!");
			document.location.href = "productos.php";
		</script>
		<?
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
			alert("El Producto no pudo ser actualizado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
			//document.location.href = "productos.php";
			</script>
		<?
		}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/jquery-1.6.js"></script>
<link href="estilos/tabs.css" rel="stylesheet" type="text/css" />
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/imagenes_thumbnail.css" rel="stylesheet" type="text/css" />
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
	
	$("#categoria").change(function () {
           $("#categoria option:selected").each(function () {
            elegido=$(this).val();
            $.post("combos_categoria.php", { elegido: elegido }, function(data){
            $("#subcategoria").html(data);
            });            
        });
   })

});
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="textarea/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="textarea/config.js"></script>
<!-- /TinyMCE -->
</head>

<body style="margin:auto">
<form id="frm_productos" name="frm_productos" method="post" action="" enctype="multipart/form-data">
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
				<h1 style="background-image:url(imagenes/carrito.png)">&nbsp;<strong>EDITAR PRODUCTO </strong></h1>
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
            $consulta = "SELECT categorias.id AS categoria, productos.* FROM productos JOIN categorias ON categorias.id = productos.categoria_id WHERE productos.id = ".$id_cat;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			?>
            <ul class="tabs">
                <li><a href="#tab1">Datos b&aacute;sicos</a></li>
                <li><a href="#tab7">SEO</a></li>
            </ul>
            <div class="tab_container">
                <div id="tab1" class="tab_content">
                <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
                  <tr>
                    <td bgcolor="#EFEFEF" style="text-align: center;">
                    <table width="100%" class="form">
                      <tr>
                        <td align="left"><span class="required">*</span>&nbsp;Nombre</td>
                        <td align="left"><input name="txt_nombre" type="text" id="txt_nombre" value="<?php echo $registro["nombre"]?>" size="50" /></td>
                      </tr>
                      <tr>
                        <td align="left">Imagen</td>
                        <td align="left"><input name="txt_imagen" type="file" size="40" id="txt_imagen" />
                        <?
                        if($registro["imagen"] != "")
                        {
                        ?>
                          <a class="thumbnail" ><img src="thumb.php?image=../img_productos/<?php echo $registro["imagen"]?>&amp;w=30" style="border:#AAAAAA 1px solid; white-space:inherit" /><span><img src="thumb.php?image=../img_productos/<?php echo $registro["imagen"]?>&amp;w=120" style="border:#AAAAAA 1px solid; white-space:inherit" /></span></a>
                          <?
                        }
                        ?>
                          <input name="hdd_imagen" type="hidden" value="<?php echo $registro["imagen"]?>" /></td>
                      </tr>
                      <tr>
                        <td align="left">Imagen 2</td>
                        <td align="left"><input name="txt_imagen2" type="file" size="40" id="txt_imagen2" />
                        <?
                        if($registro["imagen2"] != "")
                        {
                        ?>
                          <a class="thumbnail" ><img src="thumb.php?image=../img_productos/<?php echo $registro["imagen2"]?>&amp;w=30" style="border:#AAAAAA 1px solid; white-space:inherit" /><span><img src="thumb.php?image=../img_productos/<?php echo $registro["imagen2"]?>&amp;w=120" style="border:#AAAAAA 1px solid; white-space:inherit" /></span></a>
                          <?
                        }
                        ?>
                          <input name="hdd_imagen2" type="hidden" value="<?php echo $registro["imagen2"]?>" /></td>
                      </tr>
                      <tr>
                        <td align="left">Imagen 3</td>
                        <td align="left"><input name="txt_imagen3" type="file" size="40" id="txt_imagen3" />
                        <?
                        if($registro["imagen3"] != "")
                        {
                        ?>
                          <a class="thumbnail" ><img src="thumb.php?image=../img_productos/<?php echo $registro["imagen3"]?>&amp;w=30" style="border:#AAAAAA 1px solid; white-space:inherit" /><span><img src="thumb.php?image=../img_productos/<?php echo $registro["imagen3"]?>&amp;w=120" style="border:#AAAAAA 1px solid; white-space:inherit" /></span></a>
                          <?
                        }
                        ?>
                          <input name="hdd_imagen3" type="hidden" value="<?php echo $registro["imagen3"]?>" /></td>
                      </tr>
                      <tr>
                        <td align="left"><span class="required">*</span>&nbsp;Categoria</td>
                        <td align="left">
    
                        <select name="categoria" id="categoria">    
                            <option value="0">[ Escoja ]</option>
                            <?php
                            $consulta = "SELECT id, nombre FROM categorias ORDER BY nombre ASC";	
                            $resultado_cat = mysql_query($consulta, $conexion);
                            
                            while ($registro_cat= mysql_fetch_array($resultado_cat))
                            {
                            ?>
                            <option value="<?php echo $registro_cat["id"]?>" <?php if($registro["categoria_id"] == $registro_cat["id"]) echo 'selected'?>>
                              <?php echo $registro_cat["nombre"]?>
                              </option>
                            <?
                            }
                            ?>
                          </select>
                        
                        </td>
                      </tr>
                      <!--
                      <tr>
                        <td align="left"><span class="required">*</span>&nbsp;Descripci&oacute;n </td>
                        <td align="left"><label>
                          <input name="descripcion" type="text" id="descripcion" size="50" value="<?php echo $registro["descripcion1"]?>"  />
                          </label></td>
                      </tr>-->
                      <tr>
                        <td align="left"><span class="required">*</span>&nbsp;Precio </td>
                        <td align="left"><label>
                          <input name="txt_precio" type="text" id="txt_precio" value="<?php echo $registro["valor"]?>" onkeypress="return soloNumeros(event);" />
                          </label></td>
                        </tr>
                      <tr>
                        <td align="left">&nbsp;Video </td>
                        <td align="left"><label>
                          <input name="video" type="text" id="video" value="<?php echo $registro["video"]?>" size="50" />
                          </label></td>
                      </tr>
                      <tr>
                        <td align="left">Agotado </td>
                        <td align="left">
                          <input name="chk_agotado" type="checkbox" id="chk_agotado" value="1" <? if($registro["agotado"] == 1) { echo "checked"; } ?> /></td>
                      </tr>
                      <tr>
                        <td align="left">Deshabilitado</td>
                        <td align="left">
                          <input name="chk_deshabilitar" type="checkbox" id="chk_deshabilitar" value="1" <? if($registro["deshabilitar"] == 1) { echo "checked"; } ?> /></td>
                      </tr>
                      <tr>
                        <td align="left">Caracteristicas</td>
                        <td align="left">
                        <textarea cols="120" id="caracteristicas" name="caracteristicas" rows="10"><?php echo $registro["caracteristicas"]?></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td align="left">Cuadro de Producci&oacute;n</td>
                        <td align="left">
                        <textarea cols="120" id="produccion" name="produccion" rows="10"><?php echo $registro["produccion"]?></textarea>
				      
                        </td>
                  	  </tr>
                    </table></td>
                    </tr>
                </table>
                </div>
                
               
                <div id="tab7" class="tab_content">              
                    <table bgcolor="#EFEFEF" style="text-align: left;" width="90%" border="0" class="form">
                    <tr>
                      <td width="102"><strong>Nombre en Url</strong></td>
                      <td>
                        <input name="url" type="text" id="url" size="30" value="<?php echo $registro["url"] ?>" />
                        (Ejemplo: ginkgo biloba panama) sin signos</td>
                    </tr>
                    <tr>
                      <td width="102"><strong>Title</strong></td>
                      <td>
                        <input name="title" type="text" id="title" size="30" value="<?php echo $registro["title"] ?>" /></td>
                    </tr>
                    <tr>
                      <td width="102" height="38"><strong>Meta Tag Keywords</strong></td>
                      <td><textarea name="keywords" cols="50" rows="4" id="keywords"><?php echo $registro["keywords"] ?></textarea></td>
                    </tr>
                    <tr>
                      <td width="102"><strong>Meta tag   Description</strong></td>
                      <td><textarea name="description" cols="50" rows="4" id="description"><?php echo $registro["description"] ?></textarea></td>
                    </tr>
                    <tr>
                      <td><strong>Etiquetas &lt;h&gt;</strong></td>
                      <td>
                        (h1)<input type="text" name="h1" id="h1" value="<?php echo $registro["h1"] ?>" /><br /> 
                        (h2)<input type="text" name="h2" id="h2" value="<?php echo $registro["h2"] ?>" /> <br />
                        (h3)<input type="text" name="h3" id="h3" value="<?php echo $registro["h3"] ?>" /> <br />
                        (h4)<input type="text" name="h4" id="h4" value="<?php echo $registro["h4"] ?>" /><br />
                        (h5)<input type="text" name="h5" id="h5" value="<?php echo $registro["h5"] ?>" /><br />
                        (h6)<input type="text" name="h6" id="h6" value="<?php echo $registro["h6"] ?>" /><br />
                      </td>
                    </tr>
                  </table>
                </div>
            </div>
            <span class="required">* Campos Obligatorios </span><br />
          	<br />
          	<input type="button" name="Submit" value="Guardar" onclick="actualizar_producto();" />&nbsp;&nbsp;<input type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_productos.action = 'productos.php'; document.frm_productos.submit() };" value="Cancelar"/>
          	<br /> 
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
<input name="hdd_id" type="hidden" value="<?php echo $id_cat?>" />
</form>
</body>
</html>
