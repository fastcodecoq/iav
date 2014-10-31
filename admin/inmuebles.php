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

<script language="javascript" src="../js/funciones.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.blockUI.js"></script>

<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />
<link href="../css/PHPPaging.lib.css" rel="stylesheet" type="text/css" />

<script>

$(document).ready(function(){
	fn_buscar();
 /*gomosoft*/ 
 $("#frm_inmuebles select").change(fn_buscar);
 /*gomosoft*/
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});


   $("*[data-activar]").live("click", activar_inmueble);
   $("*[data-eliminar]").live("click", fn_eliminar);

   $loader = $("#cargando");

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

function fn_buscar(e){
  
  

	$('#cargando').show(); 
	$("#div_listar").html("");
	var str = $("#frm_inmuebles").serialize();
	$.ajax({
		url: 'ajax_inmuebles.php',
		type: 'get',
		data: str,
		success: function(data){
			$("#div_listar").html(data);
			$('#cargando').hide(); 
		}
	});
}


function fn_eliminar(e){

  e.preventDefault();  
  var $this = $(this);
	var respuesta = confirm("Desea eliminar este inmueble?");
	if (respuesta){
    $loader.show();
		$.ajax({
			url: 'inmuebledelete.php',
			data: 'id=' + ide_per,
			type: 'post',
			success: function(data){
				if(data!="")
					alert(data);
        $this.parents("tr:first").remove();
        $loader.hide();
				//fn_buscar()
			}
		});
	}  
}

function activar_inmueble(e){      

   e.preventDefault();

   $loader.show();  

   var $this = $(this);


   var codigo = $this.attr("data-codigo");
   var estado = $this.attr("data-estado");

	var parametros = {
                codigo : codigo,
                estado : estado
    };

    console.log($this);

	$.ajax({
		url: 'activarInmueble.php',
		data: parametros,
		type: 'post',
		success: function(data){
      console.log("data",data);
			if(data!="")
			{
        console.log(estado);
        if(estado === "1")
          {
            $this.find("img").attr("src", "imagenes/activo.png");
            $this.attr("data-estado", "0");
          }
        else
          {
            $this.find("img").attr("src", "imagenes/inactivo.png");
            $this.attr("data-estado", "1");
          }

      }
$loader.hide();

			//fn_buscar()
		}
	});
}


function fn_eliminarInmuebles(e){
		var str = $("#frm_inmu").serialize();
		$.ajax({
			url: 'inmueblesdelete.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
			//	fn_buscar();
			}
		});
	};




  
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
                <h1><strong>INMUEBLES</strong></h1>
                <div align="right"></div>
              </div></td>
          </tr>
          <tr>
            <td class="box" valign="top" bgcolor="#eeeeee">
            <div class="content" align="left">
            <form action="javascript: fn_buscar();" id="frm_inmuebles" name="frm_inmuebles" method="post">
                <table class="formulario">
                    <tbody>
                        <tr>
                          <!--gomosoft-->
                            <td><input name="criterio_usu_per" type="text" id="criterio_usu_per" placeholder="Ciudad / C&oacute;digo"/></td>
                            
                            <td>
                            	<select name="criterio_ordenar_por" id="criterio_ordenar_por">
                                  <option value="">Filtro</option>                                                                  
                                    
                                	<option value="fecha_inscripcion">Fecha inscripci&oacute;n</option>
                                    <option value="codigo">C&oacute;digo</option>
                                    <option value="plan">Plan</option>
                                    <option value="estado">Estado</option>
                                    
                                </select>
                            </td>
                            <td>
                            	<select name="criterio_orden" id="criterio_orden">
                                  <option value="">Orden</option>                                
                                	<option value="ASC">Ascendente</option>
                                    <option value="DESC">Descendente</option>
                                    
                                </select>
                            </td>                    
                            <td>
                            	<select name="criterio_mostrar" id="criterio_mostrar">
                                  <option value="">Mostrar por página</option>
                                	<option value="1">1</option>
                                	<option value="2">2</option>
                                	<option value="5">5</option>
                                	<option value="10">10</option>
                                	<option value="20">20</option>
                                	<option value="40">40</option>
                                </select>
                            </td>
                            <!--gomosoft-->
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Buscar" /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="hdd_id" value=""/>
            </form>
            <div id="cargando" align="center">
            	<div style="margin-top:20px;"></div>
            </div>
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
