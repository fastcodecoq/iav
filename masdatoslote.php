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
        <label for="vlrAdmon"><strong>Nombre del barrio:</strong></label>
        <input type="text" disabled="disabled"  name="nomBarrio" id="nomBarrio" class="validate[required] text-input" value="<?php echo $registro['campo_1']?>" />
    </div>
    <div class="divCampo">
        <label for="tipoLote"><strong>Tipo de lote:</strong></label>
        <select name="tipoLote" disabled="disabled"  id="tipoLote" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 2; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_46'] == $i){ echo 'selected';}?>><?php echo tipo_lote($i)?></option>
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
        
        <input type="text" disabled="disabled"  name="vlrventa" id="vlrventa" class="validate[required] text-input" value="<?php echo $registro['campo_5']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)" <?php */?>/>    
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo:</strong></label>
        <input type="text" disabled="disabled" name="canon" id="canon" class="validate[required] text-input" value="<?php echo $registro['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
    </div>  
    <?php
	}
	?> 
    
  <div class="divCampo">
        <label for="vlrAdmon"><strong>Valor administración:</strong></label>
    <input type="text" disabled="disabled" name="vlrAdmon" id="vlrAdmon" class="validate[required] text-input" value="<?php echo $registro['campo_19']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
  </div>
    <div class="divCampo">
      <label><strong>Estrato:</strong></label>
      <input type="text"disabled="disabled"  name="estrato" id="estrato" class="validate[required] text-input" value="<?php echo $registro['campo_7']?>" />
    </div>
    <div class="divCampo">
        <label><strong>Metros cuadrados  (no incluye parqueaderos ni dep&oacute;sitos):</strong></label>
      <input type="text" disabled="disabled" name="area" id="area" class="validate[required] text-input" value="<?php echo $registro['campo_6']?>" />
    </div>  
    
</div>


<div style="float:left; width:325px; padding-top:20px">
  <div class="divCampo">
    <label><strong>Esquinero:</strong></label>
    <select name="esquinero" disabled="disabled"  id="esquinero" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro['campo_47'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro['campo_47'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
  </div>
	<div class="divCampo">
      <label for="ubicaLote"><strong>Ubicaci&oacute;n de lote:</strong></label>
      	<select disabled="disabled" name="ubicaLote" id="ubicaLote" class="validate[required]">
		  <?php
            for ($i=0; $i <= 2; $i++)
            {
            ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_48'] == $i){ echo 'selected';}?>><?php echo ubicacion_lote($i)?></option>
          <?
            }
            ?>
      </select>
  	</div>
    <div class="divCampo">
    <label><strong>Con todos los servicios:</strong></label>
        <select disabled="disabled" name="todoServicios" id="todoServicios" class="validate[required] text-input">
          <option value="">- Escoja -</option>
              <option value="Si" <?php if($registro['campo_49'] == 'Si'){ echo 'selected';}?>>Si</option>
              <option value="No" <?php if($registro['campo_49'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
  	</div>
    <div class="divCampo">
   	  <label><strong>Sobre v&iacute;a principal:</strong></label>
    	<select disabled="disabled" name="viaPrincipal" id="viaPrincipal" class="validate[required] text-input">
       	  	<option value="">- Escoja -</option>
        	<option value="Si" <?php if($registro['campo_50'] == 'Si'){ echo 'selected';}?>>Si</option>
            <option value="No" <?php if($registro['campo_50'] == 'No'){ echo 'selected';}?>>No</option>
      	</select>
  	</div>
    <div class="divCampo">
   	  <label><strong>V&iacute;a secundaria:</strong></label>
    	<select disabled="disabled" name="viaSecundaria" id="viaSecundaria" class="validate[required] text-input">
        	<option value="">- Escoja -</option>
        	<option value="Si" <?php if($registro['campo_51'] == 'Si'){ echo 'selected';}?>>Si</option>
            <option value="No" <?php if($registro['campo_51'] == 'No'){ echo 'selected';}?>>No</option>
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