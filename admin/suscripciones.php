<?php
$permisos = array(1);
require_once("../bd.php");
include_once("control_admin.php");
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
<link href="../css/botones.css" rel="stylesheet" type="text/css" />
<?php
if($_POST["hdd_accion"] == "eliminar")
{
$eliminados = $no_eliminados = 0;

	for ($i = 0; $i < sizeof($_POST["chk_usuarios"]); $i++)
	{
		$consulta = "SELECT * FROM noticias WHERE id = ".$_POST["chk_usuarios"][$i];;
		$resultado_del = mysql_query($consulta, $conexion);	
		$imagenes = mysql_fetch_array($resultado_del);
		
		if($imagenes["imagen"] != "")
		{
			unlink("../imgNoticias/".$imagenes["imagen"]);	
		}
			
		$eliminacion = "DELETE FROM noticias WHERE id = ".$_POST["chk_usuarios"][$i];
		$resultado = mysql_query($eliminacion, $conexion);
		
		if (mysql_db_query($bd_nombre, $eliminacion))
		{
			$eliminados++;
		}
		else
		{
			$no_eliminados++;	
		}
	}
	?>
	<script language="javascript" type="text/javascript">
	alert("Noticia(s) eliminada(s) <?php echo $eliminados?> \Noticia(s) No Eliminada(s) <?php echo $no_eliminados?>");
	document.location.href = "noticias.php";
	</script>
	<?
}
?>
	
</head>

<body style="margin:auto">
<form id="frm_noticias" name="frm_noticias" method="post" enctype="multipart/form-data" action="">
<?php					
	$pagina = "suscripciones.php"; 	//your file name  (the name of this file)
	$TAMANO_PAGINA = 30; 								//how many items to show per page
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
				<h1>&nbsp;<strong>SUSCRIPCIONES</strong></h1>
				<div align="right"></div>
		  	</div>		  </td>
        </tr>
        <tr>
          <td class="box" valign="top"><div class="content">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="right">
                <a href="csvCorreos.php" target="_blank" class="boton medium white">Generar CSV Correos</a>
				&nbsp;&nbsp;
                <a href="csvNoCelulares.php" target="_blank" class="boton medium white">Generar CSV No. Celulares</a>
				</td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
			  </tr>
			</table>

            <label></label>
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list" >
            <?php
			$consulta = "SELECT * FROM usuarios WHERE infoCel = 1 OR infoMail = 1 ORDER BY nombres DESC";
			$resultado = mysql_query($consulta, $conexion);
			$num_registros = mysql_num_rows($resultado);
			$total_paginas = ceil($num_registros / $TAMANO_PAGINA); 
			$registro = mysql_fetch_array($resultado);
			
			$consulta = "SELECT * FROM usuarios WHERE infoCel = 1 OR infoMail = 1 ORDER BY nombres DESC LIMIT $inicio , $TAMANO_PAGINA  ";
			$resultado = mysql_query($consulta, $conexion);
			
			include_once("../funciones/paginacion.php");
			if(mysql_num_rows($resultado) > 0)
			{
			?>
              <tr>
                <td bgcolor="#EFEFEF" class="left"><strong>Email</strong></td>
				<td bgcolor="#EFEFEF" class="left"><strong>Nombre</strong></td>
                <td bgcolor="#EFEFEF" class="left"><strong>Celular</strong></td>
                <td bgcolor="#EFEFEF" class="center"><strong>Recibir por Correo</strong></td>
                <td bgcolor="#EFEFEF" class="center"><strong>Recibir en el Celular</strong></td>
              </tr>
              <?php
				while ($registro= mysql_fetch_array($resultado))
				{
								
				?>
              <tr >                
                <td class="left">&nbsp;<?php echo $registro["email"]?></td>
				<td class="left">&nbsp;<?php echo $registro["nombres"].' '.$registro["apellidos"]?></td>
                <td align="left">&nbsp;<?php echo $registro["celular"]?></td>
                <td align="center">
                <?php 
				if($registro["infoMail"] == 1)
				{
					echo '<img src="imagenes/valid.png" width="20" height="20" />';	
				}				
				?>
                </td>
                <td align="center">
                <?php 
				if($registro["infoCel"] == 1)
				{
					echo '<img src="imagenes/valid.png" width="20" height="20" />';	
				}				
				?>
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
				echo "No existen noticias creadas";
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
<input type="hidden" name="pagina" value="<?= $_POST["pagina"]?>"/>
<input type="hidden" name="hdd_id" value=""/>
<input type="hidden" name="hdd_accion" value=""/>
</form>
</body>
</html>
