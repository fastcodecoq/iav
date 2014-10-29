<?php
$permisos = array(4,5,6);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/upload.php");
//include_once("../funciones/imagenes.php");

$id = $_POST["hdd_id"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<script language="javascript" src="../js/noticias.js"></script>

<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="editortxt/jwysiwyg/jquery.wysiwyg.css" type="text/css" />

<!-- Validador -->
<link rel="stylesheet" href="../validadorForm/css/validationEngine.jquery.css" type="text/css"/>
<script src="../validadorForm/js/jquery-1.8.2.min.js" type="text/javascript">
</script>
<script src="../validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="../validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script>
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#frm_noticias").validationEngine();

	});
</script>

<?php
if(isset($_POST["txt_titulo"]) && $_POST["txt_titulo"] != "")
{
	$id = $_POST["hdd_id"] ;
	$titulo = $_POST["txt_titulo"] ;
	$fecha = $_POST["txt_fecha"];
	$contenido = $_POST["txt_descripcion"];
	
	if ($_FILES["txt_imagen"]["name"] != "")
	{
		$foto = subir_archivo($_FILES["txt_imagen"]["name"], $_FILES["txt_imagen"]["size"], 2000000, $_FILES["txt_imagen"]["tmp_name"], "../imgNoticias/");
		$fotos .= ", imagen = '$foto'";
		
		if ($_POST["hdd_imagen"] != "")
		{
			unlink("../imgNoticias/".$_POST["hdd_imagen"]);
		}
	}
	
		$actualizar = "UPDATE noticias SET titulo='$titulo' $fotos, fecha='$fecha', contenido='$contenido' WHERE id = $id";
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{
		?>
		<script>
			alert("Noticia editada con exito!!!!!!");
			document.location.href = "noticias.php";
		</script>
		<?php
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
				alert("La noticia no pudo ser editada.  Intentelo mas tarde y si el problema persiste contacte a su webmaster");
				document.location.href = "noticias.php";
			</script>
		<?
		}
}
?>
</head>

<body style="margin:auto">
<form id="frm_noticias" name="frm_noticias" method="post" action="" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php");?></td>
  </tr>
  <tr>
    <td bgcolor="#056C46"><?php include_once("menu.php")?></td>
  </tr>
  <tr>
    <td id="content" align="center"><br />
      <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="box">
		  	<div class="left"></div>
  			<div class="right"></div>
  			<div class="heading">
				<h1>&nbsp;<strong>EDITAR NOTICIA</strong></h1>
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
            $consulta = "SELECT * FROM noticias WHERE id = ".$id;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" class="form">
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Titulo</td>
                    <td align="left"><input name="txt_titulo" type="text" id="txt_titulo" value="<?php echo $registro['titulo']?>" size="80" class="validate[required]" data-errormessage-value-missing="* Campo obligatorio"/></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Fecha</td>
                    <td align="left"><input name="txt_fecha" type="text" id="txt_fecha" class="validate[required,custom[date]] text-input" value="<?php echo $registro['fecha']?>"/>
                    </td>
                  </tr>
				  <tr>
				    <td align="left">Descripci&oacute;n</td>
				    <td align="left">
				      <textarea name="txt_descripcion" id="txt_descripcion" rows="10" cols="120" class="validate[required] text-input"><?php echo $registro['contenido']?></textarea>
				      <script type="text/javascript" src="editortxt/jwysiwyg/jquery.wysiwyg.js"></script>
				      <script type="text/javascript">
					(function($)
					{
					  $('#txt_descripcion').wysiwyg({
						controls: {
                          strikeThrough : { visible : true },
                          underline     : { visible : true },
                          
                          separator00 : { visible : true },
                          
                          justifyLeft   : { visible : true },
                          justifyCenter : { visible : true },
                          justifyRight  : { visible : true },
                          justifyFull   : { visible : true },
                          
                          separator01 : { visible : true },
                          
                          indent  : { visible : true },
                          outdent : { visible : true },
                          
                          separator02 : { visible : false },
                          
                          subscript   : { visible : false },
                          superscript : { visible : false },
                          
                          separator03 : { visible : false },
                          
                          undo : { visible : true },
                          redo : { visible : true },
                          
                          separator04 : { visible : true },
                          
                          insertOrderedList    : { visible : true },
                          insertUnorderedList  : { visible : true },
                          insertHorizontalRule : { visible : false },
                          
                          h4mozilla : { visible : false && $.browser.mozilla, className : 'h4', command : 'heading', arguments : ['h4'], tags : ['h4'], tooltip : "Header 4" },
                          h5mozilla : { visible : false && $.browser.mozilla, className : 'h5', command : 'heading', arguments : ['h5'], tags : ['h5'], tooltip : "Header 5" },
                          h6mozilla : { visible : false && $.browser.mozilla, className : 'h6', command : 'heading', arguments : ['h6'], tags : ['h6'], tooltip : "Header 6" },
                          
                          h4 : { visible : false && !( $.browser.mozilla ), className : 'h4', command : 'formatBlock', arguments : ['<H4>'], tags : ['h4'], tooltip : "Header 4" },
                          h5 : { visible : false && !( $.browser.mozilla ), className : 'h5', command : 'formatBlock', arguments : ['<H5>'], tags : ['h5'], tooltip : "Header 5" },
                          h6 : { visible : false && !( $.browser.mozilla ), className : 'h6', command : 'formatBlock', arguments : ['<H6>'], tags : ['h6'], tooltip : "Header 6" },
                          
                          separator07 : { visible : true },
                          
                          cut   : { visible : true },
                          copy  : { visible : true },
                          paste : { visible : true }
                        }
                      });
                    })(jQuery);
                    </script>
				      </td>
				    </tr>
                  <tr>
                    <td align="left">Imagen</td>
                    <td align="left">
                    <input name="txt_imagen" type="file" size="40" id="txt_imagen" />
                    <input name="hdd_imagen" type="hidden" id="hdd_imagen" value="<?php echo $registro['imagen']?>" />
                    <input name="hdd_id" type="hidden" id="hdd_id" value="<?php echo $id?>" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="submit" name="Submit" value="Guardar" />
                      &nbsp;&nbsp;
                      <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_noticias.action = 'noticias.php'; document.frm_noticias.submit() };" value="Cancelar"/>
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
</form>
</body>
</html>
