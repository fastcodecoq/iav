<?php
include('includes/parametros.php');
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
</style>
<div style="float:left; width:500px; margin-top:20px;margin-left: 100px; font-size: 12px;">
<div class="divCampo">
        <label for="codigoinm"><strong>Codigo Inmobiliaria:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="codigoinm" id="codigoinm" class="text-input" /></span>
    </div>
	<div class="divCampo">
        <label for="vlrAdmon"><strong>Nombre del barrio:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="nomBarrio" id="nomBarrio" class="text-input" /></span>
    </div>
    
    <div class="divCampo">
        <label for="tipoConsultorio"><strong>Tiempo de construcción*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="tiempo" id="tiempo" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 6; $i++)
        {
        ?>
          <option value="<?php if($i != 0) { echo $i;}?>"><?php echo tiempoConstruccion($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    
    <div id="campos_ocultos">
        <div class="divCampo" id="section_1" style="display:none">
            <label for="vlrventa"><strong>Valor venta(sin puntos)*:</strong></label>
            <span class="mostrarDatosInmueblesResultados"><input type="text" name="vlrventa" id="vlrventa" class="validate[required] text-input" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> /></span>
        </div>
        <div class="divCampo" id="section_2" style="display:none">
      		<label for="canon"><strong>Valor arriendo(sin puntos)*:</strong></label>
        	<span class="mostrarDatosInmueblesResultados"><input type="text" name="canon" id="canon" class="validate[required] text-input" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> /></span>
  		</div>   
    </div>
    
    <div class="divCampo">
        <label for="vlrAdmon"><strong>Valor administración(sin puntos):</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="vlrAdmon" id="vlrAdmon" class="text-input" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> /></span>
    </div>
  <div class="divCampo">
        <label><strong>Numero de garajes*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="numGarajes" id="numGarajes" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="+3">+3</option>
        </select></span>
	</div>
    <!-- <div class="divCampo">
      <label><strong>Parqueadero visitante:</strong></label>
      <span class="mostrarDatosInmueblesResultados"><select name="parqVisitantes" id="parqVisitantes" class="text-input">
        <option value="">- Escoja -</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="+5">+5</option>
      </select></span>
    </div>-->
    <div class="divCampo">
        <label><strong>Numero de baños*:</strong></label>
      <span class="mostrarDatosInmueblesResultados"><select name="numBanos" id="numBanos" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="+5">+5</option>
        </select></span>
    </div>
      

	<div class="divCampo">
      <label><strong>Área mts2*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="area" id="area" class="validate[required] text-input" /></span>
  	</div>
    <div class="divCampo">
        <label><strong>Estrato*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="estrato" id="estrato" class="validate[required] text-input" /></span>
    </div>
    <div class="divCampo">
        <label for="tipoConsultorio"><strong>Tipo de local:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="tipoLocal" id="tipoConsultorio" class="text-input">
		<?php
        for ($i=0; $i <= 2; $i++)
        {
        ?>
          <option value="<?php if($i != 0) { echo $i;}?>"><?php echo tipo_local($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    
  	<div class="divCampo">
        <label for="tipoPiso"><strong>Tipo de pisos:</strong></label>
      	<span class="mostrarDatosInmueblesResultados"><select name="tipoPiso" id="tipoPiso" class="">
		  <?php
            for ($i=0; $i <= 8; $i++)
            {
            ?>
            <option value="<?php if($i != 0) { echo $i;}?>"><?php echo tipoPiso($i)?></option>
          <?php
            }
            ?>
      </select></span>
  	</div>
    <div class="divCampo">
      <label><strong>Dep&oacute;sitos:</strong></label>
      <span class="mostrarDatosInmueblesResultados"><select name="numDepositos" id="numDepositos" class="text-input">
          <option value="">- Escoja -</option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="+4">+4</option>
        </select></span>
    </div>
    <div class="divCampo">
        <label><strong>Planta  el&eacute;ctrica:</strong></label>
    <span class="mostrarDatosInmueblesResultados"><select name="planta" id="planta" class="text-input">
      <option value="">- Escoja -</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
    </select></span>
  	</div>
  	<div class="divCampo">
      <label><strong>Vigilancia:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="vigilancia" id="vigilancia" class="text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php if($i != 0) { echo $i;}?>"><?php echo tipo_vigilancia($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    <div class="divCampo">
        <label for="numLineas"><strong>L&iacute;neas telef&oacute;nicas:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="numLineas" id="numLineas" class="">
          <option value="">- Escoja -</option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="+5">+5</option>
      </select></span>
  	</div>
</div>
<div style="clear:left;width:450px;text-align:justify;margin-left:100px">
  <div style="color:#346599; padding-top:10px;"><strong>Observaciones</strong></div>
  <div style="color:#346599">Haga aqu&iacute; una breve descripci&oacute;n del inmueble que va a publicar agregue las características m&aacute;s importantes, por favor no agregue correos electr&oacute;nicos ni paginas web inmueblealaventa.com se reserva el derecho a des publicarlos.</div>
    <div><textarea name="comentarioUsuario" cols="" rows="4" id="comentarioUsuario" style="width:450px; margin-top:20px; height:130px; margin-bottom:20px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; font-family:Arial, Helvetica, sans-serif;"></textarea> </div>
</div>
<div> 
    <!--- -->
  
    
</div>
<div style="clear:left; padding:10px 0" align="left"><!--<a href="#" onclick='jQuery("#registro").validationEngine("validate", "#email");'><img src="imagenes/btnSiguiente.png" width="222" height="25" /></a>--><input type="submit" name="button" id="button" value="" style="background:url(imagenes/btnSiguiente.png) no-repeat; width:222px; height:25px; border:none; cursor:pointer; margin-left: 100px;" title="Enviar" /></div>
