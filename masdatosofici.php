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
    <td>
<div style="float:left; width:325px; margin-top:20px">
	<div class="divCampo">
        <label for="vlrAdmon"><strong>Nombre del barrio:</strong></label>
        <input type="text" name="nomBarrio" id="nomBarrio" class="validate[required] text-input" value="<?php echo $registro['campo_1']?>" />
    </div>
    <div class="divCampo">
        <label for="tipoOficina"><strong>Tipo de oficina:</strong></label>
        <select name="tipoOficina" id="tipoOficina" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 2; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_40'] == $i){ echo 'selected';}?>><?php echo tipo_oficina($i)?></option>
        <?
        }
        ?>
        </select>
    </div>
    <div class="divCampo">
      <label for="vlrAdmon"><strong>N&uacute;mero de oficina:</strong></label>
        <input type="text" name="numOficina" id="numOficina" class="validate[required] text-input" value="<?php echo $registro['campo_41']?>" />
    </div>
    <div class="divCampo">
        <label for="tiempo"><strong>Tiempo de construcción:</strong></label>
        <select name="tiempo" id="tiempo" class="validate[required] text-input">
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
        
        <input type="text" name="vlrventa" id="vlrventa" class="validate[required] text-input" value="<?php echo $registro['campo_5']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)" <?php */?>/>    
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo:</strong></label>
        <input type="text" name="canon" id="canon" class="validate[required] text-input" value="<?php echo $registro['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?>/>
    </div>  
    <?php
	}
	?> 
    
  <div class="divCampo">
        <label for="vlrAdmon"><strong>Valor administración:</strong></label>
        <input type="text" name="vlrAdmon" id="vlrAdmon" class="validate[required,custom[onlyNumberSp]] text-input" value="<?php echo $registro['campo_19']?>" />
    </div>
    <div class="divCampo">
        <label><strong>Numero de baños:</strong></label>
      <select name="numBanos" id="numBanos" class="validate[required] text-input">
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
        <select name="numGarajes" id="numGarajes" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_25'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_25'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_25'] == 2){ echo 'selected';}?>>2</option>
          <option value="+3" <?php if($registro['campo_25'] == '+3'){ echo 'selected';}?>>+3</option>
        </select>
	</div>
    <div class="divCampo">
        <label><strong>Estrato:</strong></label>
        <input type="text" name="estrato" id="estrato" class="validate[required] text-input" value="<?php echo $registro['campo_7']?>" />
    </div>
    <div class="divCampo">
        <label><strong>Metros cuadrados  (no incluye parqueaderos ni dep&oacute;sitos):</strong></label>
        <input type="text" name="area" id="area" class="validate[required] text-input" value="<?php echo $registro['campo_6']?>" />
    </div>  
    
</div>


<div style="float:left; width:325px; padding-top:20px">
  
    <!--<div class="divCampo">
      <label for="tipoTecho"><strong>Tipo  de techo*:</strong></label>
      	<select name="tipoTecho" id="tipoTecho" class="validate[required]">
		  <?php
            for ($i=0; $i <= 3; $i++)
            {
            ?>
          <option value="<?php if($i != 0) { echo $i;}?>"><?php echo tipoPiso($i)?></option>
          <?
            }
            ?>
      </select>
  </div>-->
  	<div class="divCampo">
        <label><strong>Numero de piso:</strong></label>
        <input type="text" name="numPiso" id="numPiso" class="validate[required] text-input"  value="<?php echo $registro['campo_36']?>" />
    </div>
	<div class="divCampo">
      <label for="tipoTecho"><strong>Tipo de pisos:</strong></label>
      	<select name="tipoPiso" id="tipoPiso" class="validate[required]">
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
      <label><strong>Ba&ntilde;os interiores:</strong></label>
      <select name="numBanosInter" id="numBanosInter" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_52'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_52'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_52'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_52'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro['campo_52'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro['campo_52'] == '+5'){ echo 'selected';}?>>+5</option>
      </select>
    </div>
    <div class="divCampo">
        <label><strong>Vigilancia:</strong></label>
        <select name="vigilancia" id="vigilancia" class="validate[required] text-input">
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
    <!--<div class="divCampo">
        <label><strong>Cocineta*:</strong></label>
        <select name="cocineta" id="cocineta" class="validate[required] text-input">
          	<option value="">- Escoja -</option>
        	<option value="Si" <?php if($registro['campo_43'] == 'Si'){ echo 'selected';}?>>Si</option>
          	<option value="No" <?php if($registro['campo_43'] == 'No'){ echo 'selected';}?>>No</option>
      	</select>
  	</div>-->
    <div class="divCampo">
   	  <label><strong>N&uacute;mero de ascensores:</strong></label>
        <select name="numAscensores" id="numAscensores" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_44'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_44'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_44'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_44'] == 3){ echo 'selected';}?>>3</option>
          <option value="+4" <?php if($registro['campo_44'] == '+4'){ echo 'selected';}?>>+4</option>
        </select>
  	</div>
    <div class="divCampo">
    	<label><strong>Deposito:</strong></label>
    	<select name="numDepositos" id="numDepositos" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro['campo_33'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro['campo_33'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro['campo_33'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro['campo_33'] == 3){ echo 'selected';}?>>3</option>
          <option value="+4" <?php if($registro['campo_33'] == '+4'){ echo 'selected';}?>>+4</option>
        </select>
        
  	</div>
    <div class="divCampo">
    	<label><strong>Parqueadero visitante:</strong></label>
    	<select name="parqVisitantes" id="parqVisitantes" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="0" <?php if($registro['campo_20'] == 0){ echo 'selected';}?>>0</option>
        <option value="1" <?php if($registro['campo_20'] == 1){ echo 'selected';}?>>1</option>
        <option value="2" <?php if($registro['campo_20'] == 2){ echo 'selected';}?>>2</option>
        <option value="3" <?php if($registro['campo_20'] == 3){ echo 'selected';}?>>3</option>
        <option value="4" <?php if($registro['campo_20'] == 4){ echo 'selected';}?>>4</option>
        <option value="+5" <?php if($registro['campo_20'] == '+5'){ echo 'selected';}?>>+5</option>
      </select>
  	</div>
    <!--<div class="divCampo">
        <label><strong>Planta  el&eacute;ctrica*:</strong></label>
        <select name="planta" id="planta" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro['campo_16'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro['campo_16'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
  	</div>
    <div class="divCampo">
    <label><strong>Gabinete de incendio*:</strong></label>
    <select name="gabinete" id="gabinete" class="validate[required] text-input">
        <option value="">- Escoja -</option>
    	<option value="Si" <?php if($registro['campo_13'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro['campo_13'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  	</div>
    <div class="divCampo">
      <label><strong>Alarma de incendio*:</strong></label>
        <select name="alarma" id="alarma" class="validate[required] text-input">
          	<option value="">- Escoja -</option>
            <option value="Si" <?php if($registro['campo_11'] == 'Si'){ echo 'selected';}?>>Si</option>
            <option value="No" <?php if($registro['campo_11'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
    </div>
  	<div class="divCampo">
    <label><strong>Detecci&oacute;n de humo*:</strong></label>
    <select name="humo" id="humo" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro['campo_12'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro['campo_12'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
  	</div>
    <div class="divCampo">
    <label><strong>Rociadores de agua*:</strong></label>
    <select name="rociadores" id="rociadores" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro['campo_14'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro['campo_14'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
 	</div>
    <div class="divCampo">
    <label><strong>Escaleras de emergencia*:</strong></label>
    <select name="escaleras" id="escaleras" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro['campo_45'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro['campo_45'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  	</div>-->
  <div class="divCampo">
        <label for="numLineas"><strong>L&iacute;neas telef&oacute;nicas:</strong></label>
        <select name="numLineas" id="numLineas" class="validate[required]">
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