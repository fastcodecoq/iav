<?php
// LE ASIGNAMOS LOS PERMISOS QUE PUEDEN VER ESTA PAGINA 
$permisos = array(23);
require_once("../bd.php");
include_once("control_admin.php");
include_once("../funciones/fechas.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $GLOBAL_nombre_pagina?></title>


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
<form id="frm_informes" name="frm_informes" method="post" action="informe_ventas.php">
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
				<h1 style="background-image:url(imagenes/category.png)">&nbsp;<strong>INFORME DE VENTAS</strong></h1>
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
                    <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Inicio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="fec_ini" id="fec_ini" readonly />
                      <img src="imagenes/calendario.png" width="22" height="22" name="btn_fecha_ini" id="btn_fecha_ini" style="cursor:pointer"/>
                      <!-- script que define y configura el calendario-->
                      <script type="text/javascript"> 
                               Calendar.setup({ 
                                 inputField     :    "fec_ini",     // id del campo de texto 
                                 ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                                 button     :    "btn_fecha_ini"     // el id del botón que lanzará el calendario 
                            }); 
                            </script>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      Fecha Final &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="fec_fin" id="fec_fin" readonly />
                      <img src="imagenes/calendario.png" width="22" height="22" name="btn_fecha_fin" id="btn_fecha_fin" style="cursor:pointer"/>
                      <!-- script que define y configura el calendario-->
                      <script type="text/javascript"> 
                               Calendar.setup({ 
                                 inputField     :    "fec_fin",     // id del campo de texto 
                                 ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                                 button     :    "btn_fecha_fin"     // el id del botón que lanzará el calendario 
                            }); 
                            </script></td>
                    </tr>
                  <tr>
                    <td colspan="3" align="left">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="7%" align="left"><input type="button" name="Submit" value="Buscar" onclick="consultar_informe();"/></td>
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

						$periodo = "  (Del ".$_POST['fec_ini']." al ".$_POST['fec_fin'].")";
						
						$consulta = "SELECT SUM(total)as valor, MONTH(fecpedido) AS mes, YEAR(fecpedido) AS anio FROM pedido WHERE DATE(fecpedido) >= '".$_POST['fec_ini']."' AND DATE(fecpedido) <= '".$_POST['fec_fin']."' AND pedido.estadopedido = 1 GROUP BY MONTH(fecpedido), YEAR(fecpedido) ORDER BY fecpedido";
                        $resultado = mysql_query($consulta, $conexion);
						$num_reg = mysql_num_rows($resultado);
						
                        
						
						?>
                        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
						<script type="text/javascript">
                          google.load("visualization", "1", {packages:["corechart"]});
                          google.setOnLoadCallback(drawChart);
                          function drawChart() {
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'meses');
                            data.addColumn('number', 'Ventas');
                            data.addRows([
							<?php
							while($registro= mysql_fetch_array($resultado))
							{
								echo "['".traducir_nombre_mes($registro['mes'])." ".$registro['anio']."', ".$registro['valor']."],";
						  	}
						  	?>
                            ]);
                    
                            var options = {
                              title: 'Informe de ventas <?php echo $periodo?>'
                            };
                    
                            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                            chart.draw(data, options);
                          }
                        </script>
                        <div id="chart_div" style="width: 900px; height: 500px;"></div>
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
