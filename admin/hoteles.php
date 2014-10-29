<?php
$permisos = array(16,17,18);
require_once("../bd.php");
include_once("control_admin.php");
include_once("includes/parametros.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.blockUI.js"></script>

<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<link href="../css/PHPPaging.lib.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function(){
	fn_buscar();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});

function fn_cerrar(){
	$.unblockUI({ 
		onUnblock: function(){
			$("#div_oculto").html("");
		}
	}); 
};

function fn_paginar(var_div, url){
	var div = $("#" + var_div);
	$(div).load(url);
	/*
	div.fadeOut("fast", function(){
		$(div).load(url, function(){
			$(div).fadeIn("fast");
		});
	});
	*/
};

function fn_buscar(){
	var str = $("#frm_hoteles").serialize();
	$.ajax({
		url: 'ajax_hoteles.php',
		type: 'get',
		data: str,
		success: function(data){
			$("#div_listar").html(data);
		}
	});
}

function fn_eliminar(ide_per){
	var respuesta = confirm("Desea eliminar este hotel?");
	if (respuesta){
		$.ajax({
			url: 'hoteldelete.php',
			data: 'id=' + ide_per,
			type: 'post',
			success: function(data){
				if(data!="")
					alert(data);
				fn_buscar()
			}
		});
	}
}


</script>


</head>

<body style="margin:auto">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php");?></td>
  </tr>
  <tr>
    <td bgcolor="#056C46"><?php include_once("menu.php");?></td>
  </tr>
  <tr>
    <td>
    <div>
    <table width="100%" border="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
        <table width="93%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="box"><div class="left"></div>
              <div class="right"></div>
              <div class="heading">
                <h1><strong>HOTELES</strong></h1>
                <div align="right"></div>
              </div></td>
          </tr>
          <tr>
            <td class="box" valign="top" bgcolor="#eeeeee">
            <div class="content" align="left">
            <form action="javascript: fn_buscar();" id="frm_hoteles" name="frm_hoteles" method="post">
                <table class="formulario">
                    <tbody>
                        <tr>
                            <td>Nombre</td>
                            <td><input name="criterio_usu_per" type="text" id="criterio_usu_per" /></td>
                            <td>Ordenar </td>
                            <td>
                            	<select name="criterio_ordenar_por" id="criterio_ordenar_por">
                                    
                                	<option value="nombre">Nombre</option>
                                    <option value="nombreMunicipio">Ciudad</option>
                                    
                                </select>
                            </td>
                            <td> En</td>
                            <td>
                            	<select name="criterio_orden" id="criterio_orden">
                                	<option value="ASC">Ascendente</option>
                                    <option value="DESC">Descendente</option>
                                    
                                </select>
                            </td>
                            <td>Registros</td>
                            <td>
                            	<select name="criterio_mostrar" id="criterio_mostrar">
                                	<option value="1">1</option>
                                	<option value="2">2</option>
                                	<option value="5">5</option>
                                	<option value="10">10</option>
                                	<option value="20" selected="selected">20</option>
                                	<option value="40">40</option>
                                </select>
                            </td>
                            <td><input type="submit" value="Buscar" /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="hdd_id" value=""/>
            </form>
            <div id="div_listar"></div>
            <div id="div_oculto" style="display: none;"></div> 
            </div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    </div>
    </td>
  </tr>
  <tr>
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
</body>
</html>
