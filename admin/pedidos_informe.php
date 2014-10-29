<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(19);
require_once("../bd.php");
include_once("control_admin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>
<?php
if(isset($_POST["txt_nombre"]) && $_POST["txt_nombre"] != "")
{
	$nombre = $_POST["txt_nombre"] ;
	
	$insercion = "INSERT INTO permiso (idpermiso, nompermiso) VALUES (NULL, '$nombre')";
		
	if (mysql_db_query($bd_nombre, $insercion))
	{
		//ACTUALIZO LA BITACORA
		$des_bitacora = 'Creo permiso '.$nombre;
		$insertar = "INSERT INTO bitacora (idbitacora, usuario_idusuario, desbitacora, fecbitacora) VALUES (NULL, ".$_SESSION["idusuario"].", '$des_bitacora ', CURRENT_TIMESTAMP())";
		mysql_db_query($bd_nombre, $insertar);
	?>
	<script>
		alert("Permiso ingresado con exito!!!!!!");
		document.location.href = "permisos.php";
	</script>
	<?
	}
	else
	{
	?>
		<script language="javascript" type="text/javascript">
		alert("El Permiso no pudo ser insertado.  Intenteo mas tarde y si el problema persiste contacte a su webmaster");
		document.location.href = "permisos.php";
		</script>
	<?
	}
}
?>

<script language="javascript" src="../js/administrador.js"></script>
<link href="estilos/administrador.css" rel="stylesheet" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="../jscalendar-1.0/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librería principal del calendario --> 
<script type="text/javascript" src="../jscalendar-1.0/calendar.js"></script> 
<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="../jscalendar-1.0/lang/calendar-es.js"></script> 
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="../jscalendar-1.0/calendar-setup.js"></script>
</head>

<body style="margin:auto">
<form id="frm_pedidos" name="frm_pedidos" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once("cabezote.php")?></td>
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>INFORME DE PEDIDOS</strong></h1>
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
            <table width="98%" border="0" cellspacing="0" cellpadding="0" class="list">
              <tr>
                <td bgcolor="#EFEFEF" style="text-align: center;">
				<table width="100%" class="form">
                  <tr>
                    <td colspan="3" align="left"><strong>FILTROS DE BUSQUEDA</strong></td>
                    </tr>
                  <tr>
                    <td align="right" colspan="3">&nbsp;&nbsp;
                    <input type="button" value="Ver Pedidos" onClick="document.frm_pedidos.action = 'pedidos.php'; document.frm_pedidos.submit()" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="left">Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="fec_ini" id="fec_ini" value="<?php echo date('Y-m-d')?>" readonly />
                      <img src="imagenes/calendario.png" width="22" height="22" name="btn_fecha_ini" id="btn_fecha_ini" style="cursor:pointer"/>
                      <!-- script que define y configura el calendario-->
                      <script type="text/javascript"> 
                               Calendar.setup({ 
                                 inputField     :    "fec_ini",     // id del campo de texto 
                                 ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                                 button     :    "btn_fecha_ini"     // el id del botón que lanzará el calendario 
                            }); 
                            </script></td>
                    </tr>
                  <tr>
                    <td colspan="3" align="left">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="7%" align="left"><input type="submit" name="Submit" value="Ver Informe"/></td>
                    <td colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="left">
                    <?php
					if(isset($_POST['fec_ini']) && $_POST['fec_ini'] != '')
					{
						
						$consulta = "SELECT CONCAT(usuario.nomusuario,' ',usuario.apeusuario) AS nombre, pedido.* 
									FROM pedido 
									INNER JOIN usuario ON pedido.usuario_idusuario = usuario.idusuario
									WHERE DATE(pedido.fecpedido) = '".$_POST['fec_ini']."' ";
                        $resultado = mysql_query($consulta, $conexion);
						$num_reg = mysql_num_rows($resultado);
                        
						?>
                    <table width="70%" border="0" cellspacing="0" cellpadding="0">
                      <?php
					  if($num_reg > 0)
					  {
						  ?>
                      <tr>
                        <td colspan="3"><strong>Informe de Pedidos <?php echo "(".$_POST['fec_ini'].")"?></strong></td>
                        </tr>
                      <tr>
                        <td><strong>Usuario</strong></td>
                        <td><strong>No. Pedido</strong></td>
                        <td><strong>Fecha/Hora</strong></td>
                      </tr>
						  <?php
                          while ($registro= mysql_fetch_array($resultado))
                          {
                              ?>
                          <tr>
                            <td><?php echo $registro['nombre']?></td>
                            <td><?php echo $registro['idpedido']?></td>
                            <td><?php echo $registro['fecpedido']?></td>
                          </tr>
                          <?php
                          }
						  ?>
                          <tr>
                            <td colspan="3"><br /><a href="pedidos_informe_excel.php?fecha=<?php echo $_POST["fec_ini"]?>" target="_blank"><img src="imagenes/excel.png" width="48" height="48" /> Exportar a Excel</a></td>
                          </tr>
                          <?php
					  }
					  else
					  {
                      ?>
                      <tr>
                        <td colspan="3">No existen pedidos creados en esta fecha</td>
                      </tr>
                      <?php
					  }
					  ?>
                    </table>
                    <?php
					}
					?>
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
