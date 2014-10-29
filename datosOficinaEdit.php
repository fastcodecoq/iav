<?php
include('includes/parametros.php');
require('bd.php');

$codigo = $_GET['cod'];

$consulta = "SELECT * FROM inmueble, usuarios
 WHERE codigo = '$codigo' and usuarios.identificacion=inmueble.usuario";
$resultado_con= mysql_query($consulta);
$registro_con = mysql_fetch_assoc($resultado_con);
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
    <?php
	 if ($registro_con['tipoUsuario']==3)
	{
	?>
    <div class="divCampo">
        <label for="codigoinm"><strong>Codigo Inmobiliaria:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="codigoinm" id="codigoinm" class="text-input" value="<?php echo $registro_con['codigoinm']?>" /></span>
    </div>
    <?php
	}
    ?>
	<div class="divCampo">
        <label for="vlrAdmon"><strong>Nombre del barrio:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="nomBarrio" id="nomBarrio" class="text-input" value="<?php echo $registro_con['campo_1']?>" /></span>
    </div>
    <div class="divCampo">
        <label for="tipoOficina"><strong>Tipo de oficina*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="tipoOficina" id="tipoOficina" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 2; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro_con['campo_40'] == $i){ echo 'selected';}?>><?php echo tipo_oficina($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    <!--<div class="divCampo">
      <label for="vlrAdmon"><strong>N&uacute;mero de oficina:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="numOficina" id="numOficina" class="text-input" value="<?php echo $registro_con['campo_41']?>" /></span>
    </div>-->
    <div class="divCampo">
        <label for="tiempo"><strong>Tiempo de construcción*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="tiempo" id="tiempo" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 6; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro['campo_4'] == $i){ echo 'selected';}?>><?php echo tiempoConstruccion($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    
    <?php
	if($registro_con['campo_5'] != ''){
	?>
    <div class="divCampo">
        <label for="vlrventa"><strong>Valor venta(sin puntos)*:</strong></label>        
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="vlrventa" id="vlrventa" class="validate[required] text-input" value="<?php echo $registro_con['campo_5']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />     
        </span>
    </div>
	<?php
	}
	?>
    
    <?php
	if($registro_con['campo_53'] != ''){
	?>
    <div class="divCampo">
        <label for="canon"><strong>Valor arriendo(sin puntos)*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="canon" id="canon" class="validate[required] text-input" value="<?php echo $registro_con['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> /> 
        </span>
    </div>  
    <?php
	}
	?> 
    
  <div class="divCampo">
        <label for="vlrAdmon"><strong>Valor administración(sin puntos)*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="vlrAdmon" id="vlrAdmon" class="text-input" value="<?php echo $registro_con['campo_19']?>" /></span>
    </div>
    <div class="divCampo">
        <label><strong>Numero de baños*:</strong></label>
      <span class="mostrarDatosInmueblesResultados"><select name="numBanos" id="numBanos" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro_con['campo_9'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro_con['campo_9'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_9'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro_con['campo_9'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro_con['campo_9'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro_con['campo_9'] == '+5'){ echo 'selected';}?>>+5</option>
        </select></span>
    </div>
    <div class="divCampo">
        <label><strong>Numero de garajes*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="numGarajes" id="numGarajes" class="validate[required] text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro_con['campo_25'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro_con['campo_25'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_25'] == 2){ echo 'selected';}?>>2</option>
          <option value="+3" <?php if($registro_con['campo_25'] == '+3'){ echo 'selected';}?>>+3</option>
        </select></span>
	</div>
    <div class="divCampo">
        <label><strong>Estrato*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="estrato" id="estrato" class="validate[required] text-input" value="<?php echo $registro_con['campo_7']?>" /></span>
    </div>
    <div class="divCampo">
        <label><strong>Área mts2*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="area" id="area" class="validate[required] text-input" value="<?php echo $registro_con['campo_6']?>" /></span>
    </div>  

  
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
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="numPiso" id="numPiso" class="text-input"  value="<?php echo $registro_con['campo_36']?>" /></span>
    </div>
	<div class="divCampo">
      <label for="tipoTecho"><strong>Tipo de pisos:</strong></label>
      	<span class="mostrarDatosInmueblesResultados"><select name="tipoPiso" id="tipoPiso" class="">
		  <?php
            for ($i=0; $i <= 8; $i++)
            {
            ?>
            <option value="<?php echo $i?>" <?php if($registro_con['campo_8'] == $i){ echo 'selected';}?>><?php echo tipoPiso($i)?></option>
          <?php
            }
            ?>
      </select></span>
  	<!--</div>
    <div class="divCampo">
      <label><strong>Ba&ntilde;os interiores:</strong></label>
      <span class="mostrarDatosInmueblesResultados"><select name="numBanosInter" id="numBanosInter" class="text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro_con['campo_52'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro_con['campo_52'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_52'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro_con['campo_52'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro_con['campo_52'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro_con['campo_52'] == '+5'){ echo 'selected';}?>>+5</option>
      </select></span>
    </div>-->
    <div class="divCampo">
        <label><strong>Vigilancia:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="vigilancia" id="vigilancia" class="text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro_con['campo_17'] == $i){ echo 'selected';}?>><?php echo tipo_vigilancia($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    <!--<div class="divCampo">
        <label><strong>Cocineta*:</strong></label>
        <select name="cocineta" id="cocineta" class="validate[required] text-input">
          	<option value="">- Escoja -</option>
        	<option value="Si" <?php if($registro_con['campo_43'] == 'Si'){ echo 'selected';}?>>Si</option>
          	<option value="No" <?php if($registro_con['campo_43'] == 'No'){ echo 'selected';}?>>No</option>
      	</select>
  	</div>-->
    <div class="divCampo">
   	  <label><strong>N&uacute;mero de ascensores:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="numAscensores" id="numAscensores" class="text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro_con['campo_44'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro_con['campo_44'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_44'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro_con['campo_44'] == 3){ echo 'selected';}?>>3</option>
          <option value="+4" <?php if($registro_con['campo_44'] == '+4'){ echo 'selected';}?>>+4</option>
        </select></span>
  	</div>
    <div class="divCampo">
    	<label><strong>Deposito:</strong></label>
    	<span class="mostrarDatosInmueblesResultados"><select name="numDepositos" id="numDepositos" class="text-input">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro_con['campo_33'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro_con['campo_33'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_33'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro_con['campo_33'] == 3){ echo 'selected';}?>>3</option>
          <option value="+4" <?php if($registro_con['campo_33'] == '+4'){ echo 'selected';}?>>+4</option>
        </select></span>
        
  	</div>
    <div class="divCampo">
    	<label><strong>Parqueadero visitante:</strong></label>
    	<span class="mostrarDatosInmueblesResultados"><select name="parqVisitantes" id="parqVisitantes" class="text-input">
        <option value="">- Escoja -</option>
        <option value="0" <?php if($registro_con['campo_20'] == 0){ echo 'selected';}?>>0</option>
        <option value="1" <?php if($registro_con['campo_20'] == 1){ echo 'selected';}?>>1</option>
        <option value="2" <?php if($registro_con['campo_20'] == 2){ echo 'selected';}?>>2</option>
        <option value="3" <?php if($registro_con['campo_20'] == 3){ echo 'selected';}?>>3</option>
        <option value="4" <?php if($registro_con['campo_20'] == 4){ echo 'selected';}?>>4</option>
        <option value="+5" <?php if($registro_con['campo_20'] == '+5'){ echo 'selected';}?>>+5</option>
      </select></span>
  	</div>
    <!--<div class="divCampo">
        <label><strong>Planta  el&eacute;ctrica*:</strong></label>
        <select name="planta" id="planta" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro_con['campo_16'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro_con['campo_16'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
  	</div>
    <div class="divCampo">
    <label><strong>Gabinete de incendio*:</strong></label>
    <select name="gabinete" id="gabinete" class="validate[required] text-input">
        <option value="">- Escoja -</option>
    	<option value="Si" <?php if($registro_con['campo_13'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro_con['campo_13'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  	</div>
    <div class="divCampo">
      <label><strong>Alarma de incendio*:</strong></label>
        <select name="alarma" id="alarma" class="validate[required] text-input">
          	<option value="">- Escoja -</option>
            <option value="Si" <?php if($registro_con['campo_11'] == 'Si'){ echo 'selected';}?>>Si</option>
            <option value="No" <?php if($registro_con['campo_11'] == 'No'){ echo 'selected';}?>>No</option>
        </select>
    </div>
  	<div class="divCampo">
    <label><strong>Detecci&oacute;n de humo*:</strong></label>
    <select name="humo" id="humo" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro_con['campo_12'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro_con['campo_12'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
  	</div>
    <div class="divCampo">
    <label><strong>Rociadores de agua*:</strong></label>
    <select name="rociadores" id="rociadores" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro_con['campo_14'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro_con['campo_14'] == 'No'){ echo 'selected';}?>>No</option>
      </select>
 	</div>
    <div class="divCampo">
    <label><strong>Escaleras de emergencia*:</strong></label>
    <select name="escaleras" id="escaleras" class="validate[required] text-input">
        <option value="">- Escoja -</option>
        <option value="Si" <?php if($registro_con['campo_45'] == 'Si'){ echo 'selected';}?>>Si</option>
        <option value="No" <?php if($registro_con['campo_45'] == 'No'){ echo 'selected';}?>>No</option>
    </select>
  	</div>-->
  <div class="divCampo">
        <label for="numLineas"><strong>L&iacute;neas telef&oacute;nicas:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="numLineas" id="numLineas" class="">
          <option value="">- Escoja -</option>
          <option value="0" <?php if($registro_con['campo_21'] == 0){ echo 'selected';}?>>0</option>
          <option value="1" <?php if($registro_con['campo_21'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_21'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro_con['campo_21'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro_con['campo_21'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro_con['campo_21'] == '+5'){ echo 'selected';}?>>+5</option>
      </select></span>
  	</div>
<div class="divCampo">
<!-- Editar video -->
<label for="numLineas"><strong>Video</strong></label>
<span class="mostrarDatosInmueblesResultados"><input name="video" type="text" id="video" size="35" value="<?php echo $registro_con['video']?>"/><span>(URL del video)</span>
<!-- Editar video -->
</div>
</div>

<div style="clear:left;width:450px;text-align:justify;margin-left:px">
  <div style="color:#346599; padding-top:10px;"><strong>Observaciones</strong></div>
  <div style="color:#346599">Haga aqu&iacute; una breve descripci&oacute;n del inmueble que va a publicar agregue las características m&aacute;s importantes, por favor no agregue correos electr&oacute;nicos ni paginas web inmueblealaventa.com se reserva el derecho a des publicarlos.</div>
    <div><textarea name="comentarioUsuario" cols="" rows="4" id="comentarioUsuario" style="width:450px; margin-top:20px; height: 130px; margin-bottom:20px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; font-family:Arial, Helvetica, sans-serif;"><?php echo $registro_con['comentarioUsuario']?></textarea> </div>
</div>
<div style="clear:left; padding:10px 0" align="left"></div>
