<?php
include('includes/parametros.php');
require('bd.php');
extract($_GET);
$codigo = $_GET['cod'];

$consulta = "SELECT tipo_in.dest_tip, inmueble.* FROM inmueble 
JOIN tipo_in ON inmueble.tipo_inm = tipo_in.tip_inm WHERE codigo = ".$codigo;
$resultado = mysql_query($consulta, $conexion);
$registro= mysql_fetch_array($resultado);
?>
<style>
.divCampo{
	padding:8px 0;
}
input{
	margin-left:5px;
}
select{
	margin-left:5px;
}
.recuadroAzul {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 3px solid #346599;
    border-radius: 10px 10px 10px 10px;
    padding: 10px 5px;
}

.boton{
background-color: #CE6833;
   
    background-position: 108px 12px;
    background-repeat: no-repeat;
    border-radius: 10px 10px 10px 10px;
    color: #FFFFFF;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
    padding: 4px 20px 4px 15px;
}
</style>
<table width="100%" border="0" class="recuadroAzul">
  <tr>
    <td width="65%"><div style="float:left; width:325px; margin-top:20px">
    <div class="divCampo">
        <label for="tipoFinca"><strong>Tipo de finca:</strong></label>
        <select name="tipoFinca" id="tipoFinca"  disabled="disabled" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_22'] == $i){ echo 'selected';}?>><?php echo tipo_finca($i)?></option>
        <?php
        }
        ?>
        </select>
    </div>
    
    <?php
	if($registro['campo_5'] != ''){
	?>
    <div class="divCampo">
        <label for="vlrventa"><strong>Valor venta:</strong></label>
        
        <input type="text" name="vlrventa"  disabled="disabled" id="vlrventa" class="validate[required] text-input" value="<?php echo $registro['campo_5']?>"<?php /*?> onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />    
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo:</strong></label>
        <input type="text" name="canon" id="canon"  disabled="disabled" class="validate[required] text-input" value="<?php echo $registro['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)" <?php */?>/>
    </div>  
    <?php
	}
	?> 

    
    <!--<div class="divCampo">
        <label for="tiempoArriendo"><strong>Tiempo para arriendo(días, semanas, meses)*:</strong></label>
        <input type="text" name="tiempoArriendo" id="tiempoArriendo" class="validate[required] text-input" value="<?php echo $registro['campo_23']?>" />
    </div>-->
    <?php
	if($registro['campo_23'] != ''){
	?>
    <div class="divCampo">
        <label for="tiempoArriendo"><strong>Valor Alquiler x Noche:</strong></label>
        <input type="text" name="tiempoArriendo" id="tiempoArriendo" disabled="disabled"  class="validate[required] text-input" value="<?php echo $registro['campo_23']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
    </div>
    <?php } ?>
    
    <div class="divCampo">
        <label for="numLineas"><strong>N&uacute;mero de habitaciones:</strong></label>
        <select name="numHabitaciones" id="numHabitaciones" disabled="disabled"  class="validate[required]">
          <option value="">- Escoja -</option>
          <option value="1" <?php if($registro['campo_24'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_24'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_24'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro['campo_24'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro['campo_24'] == '+5'){ echo 'selected';}?>>+5</option>
        </select>
    </div>
    <div class="divCampo">
        <label><strong>Numero de baños:</strong></label>
      <select name="numBanos" id="numBanos"  disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_9'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_9'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_9'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_9'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro['campo_9'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro['campo_9'] == '+5'){ echo 'selected';}?>>+5</option>
      </select>
    </div>
  <div class="divCampo">
        <label><strong>Numero de garajes:</strong></label>
        <select name="numGarajes" id="numGarajes"  disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_25'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_25'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_25'] == 2){ echo 'selected';}?>>2</option>
          <option value="+3" <?php if($registro['campo_25'] == '+3'){ echo 'selected';}?>>+3</option>
        </select>
  </div>
    <div class="divCampo">
        <label><strong>Área  aproximada:</strong></label>
        <input type="text" name="area" id="area"  disabled="disabled" class="validate[required] text-input" value="<?php echo $registro['campo_6']?>" />
    </div>
    <div class="divCampo">
      <label><strong>Terreno construido:</strong></label>
        <select name="terrenoConstruido" id="terrenoConstruido"  disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_26'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_26'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
	</div>
</div>


<div style="float:left; width:325px; padding-top:20px">
	
    <div class="divCampo">
      <label><strong>Piscina:</strong></label>
        <select name="piscina" id="piscina"  disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_27'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_27'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
	</div>
    <div class="divCampo">
      <label><strong>Cancha(s) de tenis:</strong></label>
        <select name="canchaTenis" id="canchaTenis"  disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_28'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_28'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
	</div>
    <div class="divCampo">
      <label><strong>Cancha(s) de futbol:</strong></label>
        <select name="canchaFutbol" id="canchaFutbol" disabled="disabled"  class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_29'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_29'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
	</div>
    <div class="divCampo">
      <label><strong>Otros deportes:</strong></label>
        <select name="otrosDeportes" id="otrosDeportes"  disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_30'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_30'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
	</div>
    <div class="divCampo">
        <label><strong>Planta  el&eacute;ctrica:</strong></label>
    <select name="planta" id="planta" class="validate[required] text-input">
      <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_16'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_16'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  	</div>
  	<div class="divCampo">
    <label><strong>Vigilancia:</strong></label>
        <select name="vigilancia" id="vigilancia" disabled="disabled"  class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_17'] == $i){ echo 'selected';}?>><?php echo tipo_vigilancia($i)?></option>
        <?php
        }
        ?>
        </select>
    </div>
    <div class="divCampo">
        <label for="numLineas"><strong>L&iacute;neas telef&oacute;nicas:</strong></label>
        <select name="numLineas" id="numLineas"  disabled="disabled" class="validate[required]">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_21'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_21'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_21'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_21'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro['campo_21'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro['campo_21'] == '+5'){ echo 'selected';}?>>+5</option>
      </select>
 	</div>
</div>
<div style="clear:left; padding:10px 0; " align="center" >
      <input name="cancelar" class="boton" type="button" id="cancelar" value="Salir" onclick="fn_cerrar();" />
</div></td>
    <td width="35%" align="center"><img src="/imagenes/logo.png" width="322" height="117" alt="Logo Inmueble a la Venta" /></td>
  </tr>
</table>

<!-- Editar video --><!-- Editar video -->