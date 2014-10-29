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
<table width="100%" border="0">
  <tr>
    <td width="66%"><div style="float:left; width:325px; margin-top:20px">
	<div class="divCampo">
        <label for="vlrAdmon"><strong>Nombre del barrio:</strong></label>
        <input type="text" disabled="disabled" name="nomBarrio" id="nomBarrio" class="validate[required] text-input" value="<?php echo $registro['campo_1']?>" />
    </div>
    <div class="divCampo">
        <label for="tipoBodega"><strong>Tipo de bodega:</strong></label>
        <select name="tipoBodega" disabled="disabled" id="tipoBodega" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_2'] == $i){ echo 'selected';}?>><?php echo tipo_bodega($i)?></option>
        <?
        }
        ?>
        </select>
    </div>
    <div class="divCampo">
        <label for="numOficinas"><strong>Con oficinas:</strong></label>
        <select name="numOficinas" disabled="disabled" id="numOficinas" class="validate[required]">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_3'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_3'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_3'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_3'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro['campo_3'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro['campo_3'] == '+5'){ echo 'selected';}?>>+5</option>
        </select>
    </div>
    <div class="divCampo">
        <label for="tipoBodega"><strong>Tiempo de construcción:</strong></label>
        <select name="tiempo" disabled="disabled" id="tiempo" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 6; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_4'] == $i){ echo 'selected';}?>><?php echo tiempoConstruccion($i)?></option>
        <?
        }
        ?>
        </select>
    </div>
    
    <?php
	if($registro['campo_5'] != ''){
	?>
    <div class="divCampo">
        <label for="vlrventa"><strong>Valor venta:</strong></label>
        
        <input type="text" disabled="disabled" name="vlrventa" id="vlrventa" class="validate[required]] text-input" value="<?php echo $registro['campo_5']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?>/>   
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo:</strong></label>
        <input type="text" name="canon" disabled="disabled" id="canon" class="validate[required] text-input" value="<?php echo $registro['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
    </div>  
    <?php
	}
	?> 
    
    <div class="divCampo">
        <label><strong>Área acercada mts2:</strong></label>
        <input type="text" name="area" disabled="disabled" id="area" class="validate[required] text-input" value="<?php echo $registro['campo_6']?>" />
    </div>
    <div class="divCampo">
        <label><strong>Estrato:</strong></label>
        <input type="text" name="estrato" disabled="disabled" id="estrato" class="validate[required] text-input" value="<?php echo $registro['campo_7']?>" />
    </div>

  <div class="divCampo">
        <label for="tipoPiso"><strong>Tipo de pisos:</strong></label>
      <select name="tipoPiso" id="tipoPiso" disabled="disabled" class="validate[required]">
		  <?php
            for ($i=0; $i <= 8; $i++)
            {
            ?>
            <option value="<?php echo $i?>" <?php if($registro['campo_8'] == $i){ echo 'selected';}?>><?php echo tipoPiso($i)?></option>
          <?
            }
            ?>
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
	<!--<div class="divCampo">
        <label><strong>Puerta acceso para tracto mulas*:</strong></label>
        <select name="puertaMulas" id="puertaMulas" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_10'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_10'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
	</div>-->
    
    
  <div class="divCampo">
      <label><strong>Alarma de incendio:</strong></label>
        <select disabled="disabled" name="alarma" id="alarma" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_11'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_11'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
    </div>
  <div class="divCampo">
    <label><strong>Detecci&oacute;n de humo:</strong></label>
    <select disabled="disabled" name="humo" id="humo" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_12'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_12'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
  </div>
  <div class="divCampo">
    <label><strong>Gabinete de incendio:</strong></label>
    <select disabled="disabled" name="gabinete" id="gabinete" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_13'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_13'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
  </div>
  <div class="divCampo">
    <label><strong>Rociadores de agua:</strong></label>
    <select disabled="disabled" name="rociadores" id="rociadores" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_14'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_14'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
  </div>
  <div class="divCampo">
    <label><strong>Tanques de agua:</strong></label>
    <select disabled="disabled" name="tanques" id="tanques" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_15'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_15'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
  </div>
  <div disabled="disabled" class="divCampo">
        <label><strong>Planta  el&eacute;ctrica:</strong></label>
    <select name="planta" disabled="disabled" id="planta" class="validate[required] text-input">
      <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_16'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_16'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  </div>
    <div class="divCampo">
        <label><strong>Vigilancia:</strong></label>
        <select disabled="disabled" name="vigilancia" id="vigilancia" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_17'] == $i){ echo 'selected';}?>><?php echo tipo_vigilancia($i)?></option>
        <?
        }
        ?>
        </select>
    </div>
</div> </td>
    <td width="34%" align="center"><a href="index.php"><img src="/imagenes/logo.png" width="270" height="98" alt="Logo Inmueble a la Venta" /></a></td>
  </tr>
</table>



<!-- Editar video --><!-- Editar video -->