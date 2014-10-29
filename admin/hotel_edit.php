<?php
$permisos = array(4,5,6);
require_once("../bd.php");
include_once("control_admin.php");
//include_once("../funciones/upload.php");

$id = $_POST["hdd_id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $GLOBAL_nombre_pagina?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="editortxt/jwysiwyg/jquery.wysiwyg.css" type="text/css" />

<!-- Validador -->
<link rel="stylesheet" href="../validadorForm/css/validationEngine.jquery.css" type="text/css"/>
<script src="../validadorForm/js/jquery-1.8.2.min.js" type="text/javascript">
</script>
<script src="../validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="../validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script type="text/javascript" src="subir_imagenes_ajax/ajaxupload.js"></script>
<style type="text/css">
	#content{
		width:970px;
		margin:10px auto;
		/*height:550px;
		border:6px solid #F3F3F3;*/
		padding-top:10px;
		overflow-y:auto;
		border:0;
	}
	#upload{  
		padding:12px;  
		font:bold 12px Arial, Helvetica, sans-serif;
        text-align:center;  
        background:#f2f2f2;  
        color:#3366cc;  
        border:1px solid #ccc;  
        width:150px;
		display:block;  
        -moz-border-radius:5px;
		-webkit-border-radius:5px; 
		margin:0 auto; 
		text-decoration:none
    }
	#gallery{
		list-style:none;
		margin:10px 0 0 0;
		padding:0
	}
	#gallery li{
		display:block;
		float:left;
		width:100px;
		height:100px;
		background:#CCC;
		border:1px solid #999;
		text-align:center;
		padding:6px 0;
		margin:5px 0 5px 20px;
		position:relative
	}
	#gallery li img{
		width:95px;
		height:95px
	}
	#gallery li a{
		position:absolute;
		right:10px;
		top:10px
	}
	#gallery li a img{ width:auto; height:auto}
	
</style>
<script>
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#frm_hoteles").validationEngine();
		
		//consultamos las ciudades del departamento seleccionado 
		$("#departamento").change(function () {
			   $("#departamento option:selected").each(function () {
				elegido=$(this).val();
				$.post("../comboCiudades.php", { elegido: elegido }, function(data){
				$("#ciudad").html(data);
				});            
			});
	  	})
		
		var button = $('#upload'), interval;
		new AjaxUpload(button,{
			action: 'subir_imagenes_ajax/procesa.php', 
			name: 'image[]',
			onSubmit : function(file, ext){
				// cambiar el texto del boton cuando se selecicione la imagen	
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
            	// extensiones permitidas
            	alert('Solo se permiten imagenes');
            	// cancela upload
            	return false;
        		} 
				else {	
					this.setData({
					codTemp: '9999999',
					});	
					button.text('Subiendo');
					// desabilitar el boton
					this.disable();
					
					interval = window.setInterval(function(){
						var text = button.text();
						if (text.length < 11){
							button.text(text + '.');					
						} else {
							button.text('Subiendo');				
						}
					}, 200);
				};
			},
			onComplete: function(file, response){
				button.text('Subir Foto');
							
				window.clearInterval(interval);
							
				// Habilitar boton otra vez
				this.enable();
				
				// Añadiendo las imagenes a mi lista
				
				if($('#gallery li').length == 0){
					$('#gallery').html(response).fadeIn("fast");
					$('#gallery li').eq(0).hide().show("slow");
				}else{
					$('#gallery').prepend(response);
					$('#gallery li').eq(0).hide().show("slow");
				}
			}
		});
		
		// Listar  fotos que hay en mi tabla
		$("#gallery").load("subir_imagenes_ajax/procesa.php?action=listFotos&codTemp=9999999");
		
		// Eliminar
		
		$("#gallery li a").live("click",function(){
			var a = $(this)
			$.get("subir_imagenes_ajax/procesa.php?action=eliminar",{id:a.attr("id")},function(){
				a.parent().fadeOut("slow")
			})
		})

	});
</script>

<?php
if(isset($_POST["hdd_accion"]) && $_POST["hdd_accion"] == "editar")
{
	$nombre = $_POST["nombre"] ;
	$direccion = $_POST["direccion"] ;;
	$ciudad = $_POST["ciudad"] ;
	$precio = $_POST["precio"] ;
	$descripcion = $_POST["descripcion"] ;
	$id_hotel = $_POST["id_hotel"] ;
	
	
	$actualizar = "UPDATE hoteles SET nombre = '$nombre', direccion = '$direccion', ciudad = $ciudad, precioNoche = $precio, descripcion = '$descripcion' WHERE id = ".$id_hotel;
		
		if (mysql_db_query($bd_nombre, $actualizar))
		{			
			?>
			<script language="javascript" type="text/javascript">
                alert("El hotel fue actualizado con exito");
                document.location.href = "hoteles.php";
            </script>
			<?php
		}
		else
		{
		?>
			<script language="javascript" type="text/javascript">
				alert("El hotel no pudo ser actualizado.  Intentelo mas tarde y si el problema persiste contacte a su webmaster");
				document.location.href = "hoteles.php";
			</script>
		<?
		}
}
?>

</head>

<body style="margin:auto">
<form id="frm_hoteles" name="frm_hoteles" method="post" action="" enctype="multipart/form-data">
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
				<h1>&nbsp;<strong>AGREGAR HOTEL </strong></h1>
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
            $consulta = "SELECT * FROM hoteles WHERE id = ".$id;
			$resultado = mysql_query($consulta, $conexion);
			$registro = mysql_fetch_array($resultado);
			
			//Consultamos el departamento del municipio
			$consulta = "SELECT * FROM municipio WHERE idmunicipio = ".$registro['ciudad'];	
			$resultado_mun = mysql_query($consulta, $conexion);
			$registro_mun= mysql_fetch_array($resultado_mun);
			
			?>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;"><table width="100%" class="form">
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Nombre del hotel</td>
                    <td align="left"><input name="nombre" type="text" id="nombre" size="80" class="validate[required]" data-errormessage-value-missing="* Campo obligatorio" value="<?php echo $registro['nombre']?>"/></td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Direcci&oacute;n</td>
                    <td align="left"><input name="direccion" type="text" class="validate[required] text-input" id="direccion" value="<?php echo $registro['direccion']?>" size="80"/>
                    </td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Departamento</td>
                    <td align="left">
                    <select name="departamento" id="departamento" style="width:140px;" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                        <option value="" selected="selected">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                        $resultado_dep = mysql_query($consulta, $conexion);
                        
                        while ($registro_dep= mysql_fetch_array($resultado_dep))
                        {
                        ?>
                        <option value="<?php echo $registro_dep["iddepartamento"]?>" <?php if($registro_mun["departamento_iddepartamento"] == $registro_dep["iddepartamento"]) { echo "selected"; } ?>> <?php echo $registro_dep["nombre"]?> </option>
                        <?
                        }
                        ?>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Ciudad</td>
                    <td align="left">
                    <select name="ciudad" style="width:140px;" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                    	<?php
						$consulta = "SELECT * FROM municipio WHERE departamento_iddepartamento = ".$registro_mun["departamento_iddepartamento"]." ORDER BY nombreMunicipio ASC";
						
						$resultado_ciu = mysql_query($consulta, $conexion);
						
						while ($registro_ciu= mysql_fetch_array($resultado_ciu))
						{
						?>
                            <option value="<?php echo $registro_ciu["idmunicipio"]?>" <?php if($registro['ciudad'] == $registro_ciu["idmunicipio"]) { echo "selected"; } ?> ><?php echo $registro_ciu["nombreMunicipio"]?></option>
                            <?
                            }
                            ?>
                        <option value="">- Escoja -</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="left"><span class="required">*</span>&nbsp;Precio</td>
                    <td align="left"><input name="precio" type="text" class="validate[required,custom[onlyNumberSp]] text-input" id="precio" value="<?php echo $registro['precioNoche']?>"/>
                    </td>
                  </tr>
				  <tr>
				    <td align="left"><span class="required">*</span>Descripci&oacute;n</td>
				    <td align="left"><textarea cols="120" id="descripcion" name="descripcion" rows="10" class="validate[required] text-input"><?php echo $registro['descripcion']?></textarea>
				      <script type="text/javascript" src="editortxt/jwysiwyg/jquery.wysiwyg.js"></script>
				      <script type="text/javascript">
                    (function($)
                    {
                      $('#descripcion').wysiwyg({
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
                    <td align="left">Fotos</td>
                    <td align="left">
                    <div id="content" align="center">
                        <a href="javascript:('2');" id="upload">Subir Foto</a>
                        <ul id="gallery">
                            <!-- Cargar Fotos -->
                        </ul>
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><span class="required">* Campos Obligatorios </span><br />
                      <br />
                      <input type="submit" name="Submit" value="Guardar" />
                      &nbsp;&nbsp;
                      <input name="button" type="button" onclick="if(confirm('Desea continuar sin guardar\nSe perderan los cambios')) { document.frm_hoteles.action = 'hoteles.php'; document.frm_hoteles.submit() };" value="Cancelar"/>
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
<input name="hdd_accion" type="hidden" value="editar" />
<input name="id_hotel" type="hidden" value="<?php echo $id?>" />
</form>
</body>
</html>
