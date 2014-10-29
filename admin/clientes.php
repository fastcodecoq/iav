<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(22);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/moneda.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBAL_nombre_pagina?></title>

<script language="javascript" src="../js/administrador.js"></script>
<script language="javascript" src="../js/funciones.js">
</script>
<script language="javascript" src="../js/ajax.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<link href="estilos/paginacion.css" rel="stylesheet" type="text/css" />

	
</head>

<body style="margin:auto" onload="document.frm_clientes.txt_buscar.focus()">
<form id="frm_clientes" name="frm_clientes" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "clientes.php"; 	//your file name  (the name of this file)
	$TAMANO_PAGINA = 20; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$inicio = ($page - 1) * $TAMANO_PAGINA; 			//first item to display on this page
	else
		$inicio = 0;		
?>
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
				<h1><strong>CLIENTES</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="left" style="padding:10px 0;">
                <input name="txt_buscar" type="text" id="txt_buscar" placeholder="Buscar cliente" value="<?php echo  $_POST["expr_busqueda"]?>" onkeypress="pulsar(event,Submit)" />
                <input type="button" name="Submit" id="Submit" value="Buscar" onclick="document.frm_clientes.expr_busqueda.value = document.frm_clientes.txt_buscar.value; document.frm_clientes.submit();" />
                </td>
			  </tr>
			</table>

            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list" >
            <?php
			if (isset($_POST["expr_busqueda"]) && ($_POST["expr_busqueda"] != ""))
			{
				//EXPRESION DE BUSQUEDA
				$expresion = $_POST["expr_busqueda"];
				$inicio = 0;
			}
			else
			{
				//EXPRESION DE BUSQUEDA VACIA
				$expresion = "";
			}
			
			$consulta = "SELECT * FROM usuario WHERE rol_idrol = 1 AND (nomusuario like '%$expresion%' OR apeusuario like '%$expresion%') ORDER BY nomusuario";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT * FROM usuario WHERE rol_idrol = 1 AND (nomusuario like '%$expresion%' OR apeusuario like '%$expresion%') ORDER BY nomusuario LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion.php");
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" class="left"><strong>Cedula</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Nombres</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Apellidos</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Telefono</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Direccion</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>E-mail</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Puntos acumulados</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Datos</strong></td>
                <td bgcolor="#EFEFEF" class="left">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left">&nbsp;</td>
                <td bgcolor="#EFEFEF" class="left">&nbsp;</td>
                
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{
								
				?>
              <tr >
                <td class="left"><?php echo $registro["idusuario"]?></td>
                <td class="left"><?php echo $registro["nomusuario"]?></td>
				<td class="left"><?php echo $registro["apeusuario"]?></td>
				<td class="left"><?php echo $registro["telusuario"]?></td>
				<td class="left"><?php echo $registro["dirusuario"]?></td>
                <td class="left"><?php echo $registro["mailusuario"]?></td>
                <td class="left"><?php echo $registro["puntos"]?></td>
                <td class="left">
				<?php 
				if($registro["datos_confirmados"] == 1)
				{
					echo "<span style='color:#006600; font-weight:bold;'>Datos confirmados</span>";
				}
				else
				{
					echo "<span style='color:#F00; font-weight:bold;'>Datos sin confirmar</span>";
				}
				
				?></td>
                <td align="center">
                	<a href="#" onclick="red_cliente(<?php echo $registro["idusuario"]?>);"><img src="../imagenes/red.png" width="22" height="22" border="0" title="Ver Red Cliente" /></a>
                </td>
                <td align="center">
                	<a href="#" onclick="editar_cliente(<?php echo $registro["idusuario"]?>);"><img src="../imagenes/edit2.png" width="22" height="22" border="0" title="Editar Cliente" /></a>
                </td>
                <td align="center">
                	<a href="#" onclick="referidos(<?php echo $registro["idusuario"]?>);"><img src="../imagenes/list.png" width="23" height="31" border="0" title="Referidos" /></a>
                </td>
              </tr>
              <?
				 }
				 ?>
              <tr>
                <td colspan="14"><br /><?php echo $paginacion?></td>
              </tr>
              <?php 
			}
			else
			{
				echo "No existen clientes creados";
			}
			?>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td id="footer"><?php include ('pie.php')?></td>
  </tr>
</table>
<input type="hidden" name="pagina" value="<?php echo $_POST["pagina"]?>"/>
<input name="expr_busqueda" type="hidden" value="<?php echo $_POST["expr_busqueda"]?>" />
<input type="hidden" name="hdd_id" value=""/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
