<div style="float:left; background:#FFF; border:#989898 1px solid; width:200px; min-height:300px;-moz-border-radius: 10px; -webkit-border-radius: 5px; border-radius: 5px;">
                <div style="padding:10px; font-size:18px;">Filtros</div>
                <div style="margin-left:5px; margin-right:5px">
                <form name="filtros" id="filtros" method="get" action="/filtrar-inmobiliaria/<?php echo $inmovi?>">
                <table width="100%" border="0">
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Departamento</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="departamento" id="departamento" style="width:140px;" class="validate[required]" data-errormessage-value-missing="Seleccione un Departamento">
                        <option value="" selected="selected">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM departamento ORDER BY nombre ASC";	
                        $resultado_dep = mysql_query($consulta, $conexion);
                        
                        while ($registro_dep= mysql_fetch_array($resultado_dep))
                        {
                        ?>
                        <option value="<?php echo $registro_dep["iddepartamento"]?>"> <?php echo $registro_dep["nombre"]?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    </td>
                  </tr>
				  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>	
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Ciudad</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="ciudad" style="width:140px;" id="ciudad" class="validate[required]" data-errormessage-value-missing="Seleccione un Municipio">
                        <option value="">- Escoja -</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Barrio</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><select name="barrio" style="width:140px;" id="barrio" >
                      <option value="">- Escoja -</option>
                    </select></td>
                  </tr> 
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de inmueble</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left">
                    <select name="tipoInmueble" id="tipoInmueble" style="width:140px;" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <?php
                        $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
                        $resultado = mysql_query($consulta, $conexion);
                        
                        while ($registro= mysql_fetch_array($resultado))
                        {
                        ?>
                        <option value="<?php echo $registro["tip_inm"]?>"> <?php echo $registro["dest_tip"]?> </option>
                        <?php
                        }
                        ?>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" class="titulosFiltroNaranja">Tipo de negociaci&oacute;n </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" >
                    <select name="para" style="width:140px;" id="para" class="validate[required]">
                        <option value="">- Escoja -</option>
                        <option value="1">Compra</option>
                        <option value="2">Arriendo</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                  </tr>
                  
                   <tr>
                    <td colspan="2">
                    <div id="preciosVenta" style="display:none">
                    <table width="100%" border="0">
                   	  <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Precio (millones)</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 40 millones</td>
                        <td width="19%"><input type="radio" name="precioVenta" id="precioVenta" value="1" /></td>
                      </tr>
                      <tr>
                        <td>40 a 70 millones</td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="2" /></td>
                      </tr>
                      <tr>
                        <td>70 a 100 millones</td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="3" /></td>
                      </tr>
                      <tr>
                        <td>100 a 200 millones</td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="4" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 200 >></td>
                        <td><input type="radio" name="precioVenta" id="precioVenta" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="preciosArriendo" style="display:none">
                    <table width="100%" border="0">
                   	  <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Precio (miles)</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 300.000</td>
                        <td width="19%"><input type="radio" name="precioArriendo" id="precioArriendo" value="1" /></td>
                      </tr>
                      <tr>
                        <td>300.000-1.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="2" /></td>
                      </tr>
                      <tr>
                        <td>1.000.000-1.300.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="3" /></td>
                      </tr>
                      <tr>
                        <td>1.300.000-6.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="4" /></td>
                      </tr>
                      <tr>
                        <td>6.000.000-9.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="5" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 9.000.000</td>
                        <td><input type="radio" name="precioArriendo" id="precioArriendo" value="6" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="area">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">&Aacute;rea m&sup2;</td>
                      </tr>
                      <tr>
                        <td width="81%">Hasta 60</td>
                        <td width="19%"><input type="radio" name="area" id="radio" value="1" /></td>
                      </tr>
                      <tr>
                        <td>60 a 100</td>
                        <td><input type="radio" name="area" id="radio" value="2" /></td>
                      </tr>
                      <tr>
                        <td>100 a 200</td>
                        <td><input type="radio" name="area" id="radio" value="3" /></td>
                      </tr>
                      <tr>
                        <td>200 a 300</td>
                        <td><input type="radio" name="area" id="radio" value="4" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 300</td>
                        <td><input type="radio" name="area" id="radio" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                                                  
                                 
				  <tr>
                    <td colspan="2">
                    <div id="habitaciones">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Habitaciones</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Habitaci&oacute;n</td>
                        <td width="19%"><input type="radio" name="habitaciones" id="habitaciones" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + habitaciones</td>
                        <td><input type="radio" name="habitaciones" id="habitaciones" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                  	</td>
                  </tr>

				  
                  <tr>
                    <td colspan="2">
                    <div id="banos">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Ba&ntilde;os</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Ba&ntilde;o</td>
                        <td width="19%"><input type="radio" name="bano" id="bano" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + Ba&ntilde;os</td>
                        <td><input type="radio" name="bano" id="bano" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  
                  <tr>
                    <td colspan="2">
                    <div id="garajes">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Garajes</td>
                      </tr>
                      <tr>
                        <td width="81%">1 Garaje</td>
                        <td width="19%"><input type="radio" name="garaje" id="garaje" value="1" /></td>
                      </tr>
                      <tr>
                        <td>2 Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="2" /></td>
                      </tr>
                      <tr>
                        <td>3 Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="3" /></td>
                      </tr>
                      <tr>
                        <td>4 Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="4" /></td>
                      </tr>
                      <tr>
                        <td>5 + Garajes</td>
                        <td><input type="radio" name="garaje" id="garaje" value="5" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
				  
                  <tr>
                    <td colspan="2">
                    <div id="antiguedad">
                    <table width="100%" border="0">
                      <tr>
                        <td colspan="2" align="left" class="titulosFiltroNaranja">Antig&uuml;edad</td>
                      </tr>
                      <tr>
                        <td width="81%">Sobre Plano</td>
                        <td width="19%"><input type="radio" name="antiguedad" id="antiguedad" value="1" /></td>
                      </tr>
                      <tr>
                        <td>En construcci&oacute;n</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="2" /></td>
                      </tr>
                      <tr>
                        <td>de 0 a 5 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="3" /></td>
                      </tr>
                      <tr>
                        <td>de 5 a 10 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="4" /></td>
                      </tr>
                      <tr>
                        <td>de 10 a 20 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="5" /></td>
                      </tr>
                      <tr>
                        <td>M&aacute;s de 20 a&ntilde;os</td>
                        <td><input type="radio" name="antiguedad" id="antiguedad" value="6" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border: 0; border-bottom: 1px dashed #F90;" size="1"/></td>
                      </tr>
                    </table>
                    </div>
                    </td>
                  </tr>
                  
                  	
				  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Filtrar" class="boton" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
                </form>
                </div>
                </div>