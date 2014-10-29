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
    <td><div style="float:left; width:325px; margin-top:20px">
	<div class="divCampo">
        <label for="nomBarrio"><strong>Nombre del barrio:</strong></label>
        <input disabled="disabled"  type="text" name="nomBarrio" id="nomBarrio" class="validate[required] text-input" value="<?php echo $registro['campo_1']?>" />
    </div>
    <div class="divCampo">
        <label for="interior"><strong>Interior y/o bloque:</strong></label>
        <select disabled="disabled"  name="interior" id="interior" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="1" <?php if($registro['campo_34'] == 1){ echo 'selected';}?>>Si</option>
          <option value="2" <?php if($registro['campo_34'] == 2){ echo 'selected';}?>>No</option>
        </select>
   	  <label>Cual?</label>
        <input disabled="disabled"  name="cual" type="text" id="cual" size="5" value="<?php echo $registro['campo_32']?>">
    </div>
    <div class="divCampo">
        <label for="numCasa"><strong>Numero de casa:</strong></label>
        <input disabled="disabled"  type="text" name="numCasa" id="numCasa" value="<?php echo $registro['campo_38']?>" />
    </div>
    
    
    <?php
	if($registro['campo_5'] != ''){
	?>
    <div class="divCampo">
        <label for="vlrventa"><strong>Valor venta:</strong></label>
        
        <input disabled="disabled"  type="text" name="vlrventa" id="vlrventa" class="validate[required] text-input" value="<?php echo $registro['campo_5']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />    
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo:</strong></label>
        <input type="text" disabled="disabled"  name="canon" id="canon" class="validate[required] text-input" value="<?php echo $registro['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)" <?php */?>/>
    </div>  
    <?php
	}
	?> 
    
    <?php
	if($registro['campo_23'] != ''){
	?>
    <div class="divCampo">
        <label for="tiempoArriendo"><strong>Valor Alquiler x Noche:</strong></label>
        <input disabled="disabled"  type="text" name="tiempoArriendo" id="tiempoArriendo" class="validate[required] text-input" value="<?php echo $registro['campo_23']?>"  <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?>/>
    </div>
    <?php } ?>
    
    <?php
	if($registro['campo_19'] != ''){
	?>
    <div class="divCampo">
        <label for="vlrAdmon"><strong>Valor administración:</strong></label>
        <input type="text" disabled="disabled"  name="vlrAdmon" id="vlrAdmon" value="<?php echo $registro['campo_19']?>"<?php /*?> onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
    </div>
    <?php } ?>
    </div>


<div style="float:left; width:325px; padding-top:20px">
	<div class="divCampo">
        <label><strong>Numero de garajes:</strong></label>
        <select disabled="disabled"  name="numGarajes" id="numGarajes" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_25'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_25'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_25'] == 2){ echo 'selected';}?>>2</option>
          <option value="+3" <?php if($registro['campo_25'] == '+3'){ echo 'selected';}?>>+3</option>
        </select>
	</div>
    <div class="divCampo">
        <label><strong>Área acercada mts2:</strong></label>
        <input disabled="disabled"  type="text" name="area" id="area" class="validate[required] text-input" value="<?php echo $registro['campo_6']?>" />
    </div>
    <div class="divCampo">
        <label><strong>Estrato:</strong></label>
        <input disabled="disabled"  type="text" name="estrato" id="estrato" class="validate[required] text-input" value="<?php echo $registro['campo_7']?>" />
    </div>
    <div class="divCampo">
      <label><strong>N&uacute;mero de pisos:</strong></label>
        <input disabled="disabled"  type="text" name="numPisos" id="numPisos" class="validate[required] text-input" value="<?php echo $registro['campo_39']?>" />
    </div>
  <div class="divCampo">
        <label><strong>Tipo de Instalación de gas:</strong></label>
      <select disabled="disabled"  name="gas" id="gas" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_37'] == $i){ echo 'selected';}?>><?php echo tipo_instalacionGas($i)?></option>
        <?php
        }
        ?>
        </select>
    </div>
    <div class="divCampo">
        <label><strong>Vigilancia:</strong></label>
        <select disabled="disabled"  name="vigilancia" id="vigilancia" class="validate[required] text-input">
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
        <select disabled="disabled"  name="numLineas" id="numLineas" class="validate[required]">
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
    </div>
</td>
    <td align="center"><img src="/imagenes/logo.png" width="322" height="117" alt="Logo Inmueble a la Venta" /></td>
  </tr>
</table>



<!-- Editar video --><!-- Editar video -->