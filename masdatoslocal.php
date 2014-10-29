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
        <label for="vlrAdmon"><strong>Nombre del barrio:</strong></label>
        <input type="text" name="nomBarrio" disabled="disabled"  id="nomBarrio" class="validate[required] text-input" value="<?php echo $registro['campo_1']?>" />
    </div>
    <div class="divCampo">
        <label for="tipoConsultorio"><strong>Tipo de local:</strong></label>
        <select name="tipoLocal" id="tipoConsultorio" disabled="disabled"  class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 2; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_31'] == $i){ echo 'selected';}?>><?php echo tipo_local($i)?></option>
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
        
        <input type="text" name="vlrventa" disabled="disabled"  id="vlrventa" class="validate[required] text-input" value="<?php echo $registro['campo_5']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)" <?php */?>/>    
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo:</strong></label>
        <input type="text" name="canon" disabled="disabled"  id="canon" class="validate[required] text-input" value="<?php echo $registro['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
    </div>  
    <?php
	}
	?> 

    
  <div class="divCampo">
        <label for="vlrAdmon"><strong>Valor administración:</strong></label>
        <input type="text" name="vlrAdmon" disabled="disabled"  id="vlrAdmon" class="validate[required,custom[onlyNumberSp]] text-input" value="<?php echo $registro['campo_19']?>" />
    </div>
  <div class="divCampo">
        <label><strong>Numero de garajes:</strong></label>
        <select name="numGarajes" id="numGarajes" disabled="disabled"  class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_25'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_25'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_25'] == 2){ echo 'selected';}?>>2</option>
          <option value="+3" <?php if($registro['campo_25'] == '+3'){ echo 'selected';}?>>+3</option>
        </select></div>
    <div class="divCampo">
      <label><strong>Parqueadero visitante:</strong></label>
      <select name="parqVisitantes" id="parqVisitantes" disabled="disabled"  class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="0" <?php if($registro['campo_20'] == 0){ echo 'selected';}?>>0</option>
        <option value="1" <?php if($registro['campo_20'] == 1){ echo 'selected';}?>>1</option>
        <option value="2" <?php if($registro['campo_20'] == 2){ echo 'selected';}?>>2</option>
        <option value="3" <?php if($registro['campo_20'] == 3){ echo 'selected';}?>>3</option>
        <option value="4" <?php if($registro['campo_20'] == 4){ echo 'selected';}?>>4</option>
        <option value="+5" <?php if($registro['campo_20'] == '+5'){ echo 'selected';}?>>+5</option>
      </select>
    </div>
    <div class="divCampo">
        <label><strong>Numero de baños:</strong></label>
      <select name="numBanos" id="numBanos" disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_9'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_9'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_9'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_9'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro['campo_9'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro['campo_9'] == '+5'){ echo 'selected';}?>>+5</option>
        </select>
    </div>
      
</div>


<div style="float:left; width:325px; padding-top:20px">
	<div class="divCampo">
      <label><strong>Metros cuadrados  (no incluye parqueaderos ni dep&oacute;sitos):</strong></label>
        <input type="text" name="area" disabled="disabled" id="area" class="validate[required] text-input" value="<?php echo $registro['campo_6']?>" />
  	</div>
    <div class="divCampo">
        <label><strong>Estrato:</strong></label>
        <input type="text" name="estrato" disabled="disabled" id="estrato" class="validate[required] text-input" value="<?php echo $registro['campo_7']?>" />
    </div>
    
    
  	<div class="divCampo">
        <label for="tipoPiso"><strong>Tipo de pisos:</strong></label>
      	<select name="tipoPiso" id="tipoPiso" disabled="disabled"  class="validate[required]">
		  <?php
            for ($i=0; $i <= 8; $i++)
            {
            ?>
            <option value="<?php echo $i?>" <?php if($registro['campo_8'] == $i){ echo 'selected';}?>><?php echo tipoPiso($i)?></option>
          <?php
            }
            ?>
      </select>
  	</div>
    <div class="divCampo">
      <label><strong>Dep&oacute;sitos:</strong></label>
      <select name="numDepositos" id="numDepositos" disabled="disabled" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_33'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_33'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_33'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_33'] == 3){ echo 'selected';}?>>3</option>
          <option value="+4" <?php if($registro['campo_33'] == '+4'){ echo 'selected';}?>>+4</option>
        </select>
    </div>
    <div class="divCampo">
        <label><strong>Planta  el&eacute;ctrica:</strong></label>
    <select name="planta" id="planta" disabled="disabled" class="validate[required] text-input">
      <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_16'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_16'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  	</div>
  	<div class="divCampo">
      <label><strong>Vigilancia:</strong></label>
        <select name="vigilancia" id="vigilancia" disabled="disabled" class="validate[required] text-input">
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
        <select name="numLineas" id="numLineas" disabled="disabled"  class="validate[required]">
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



<!-- Editar video -->