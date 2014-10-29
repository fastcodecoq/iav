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
        <label for="tipoFinca"><strong>Tipo de finca*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="tipoFinca" id="tipoFinca" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 3; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro_con['campo_22'] == $i){ echo 'selected';}?>><?php echo tipo_finca($i)?></option>
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

    
    <!--<div class="divCampo">
        <label for="tiempoArriendo"><strong>Tiempo para arriendo(días, semanas, meses)*:</strong></label>
        <input type="text" name="tiempoArriendo" id="tiempoArriendo" class="validate[required] text-input" value="<?php echo $registro['campo_23']?>" />
    </div>-->
    <?php
	if($registro_con['campo_23'] != ''){
	?>
    <div class="divCampo">
        <label for="tiempoArriendo"><strong>Valor Alquiler x Noche(sin puntos)*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="tiempoArriendo" id="tiempoArriendo" class="validate[required] text-input" value="<?php echo $registro_con['campo_23']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
        </span>
    </div>
    <?php } ?>
    <div class="divCampo">
        <label for="tiempoArriendo"><strong>Valor Administración(sin puntos):</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="tiempoArriendo" id="tiempoArriendo" class="text-input" value="<?php echo $registro_con['campo_53']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />
        </span>
    </div>
    
    <div class="divCampo">
        <label for="numLineas"><strong>N&uacute;mero de habitaciones*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="numHabitaciones" id="numHabitaciones" class="validate[required]">
          <option value="">- Escoja -</option>
          <option value="1" <?php if($registro_con['campo_24'] == 1){ echo 'selected';}?>>1</option>
          <option value="2" <?php if($registro_con['campo_24'] == 2){ echo 'selected';}?>>2</option>
          <option value="3" <?php if($registro_con['campo_24'] == 3){ echo 'selected';}?>>3</option>
          <option value="4" <?php if($registro_con['campo_24'] == 4){ echo 'selected';}?>>4</option>
          <option value="+5" <?php if($registro_con['campo_24'] == '+5'){ echo 'selected';}?>>+5</option>
        </select></span>
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
        <label><strong>Área mts2*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="area" id="area" class="validate[required] text-input" value="<?php echo $registro_con['campo_6']?>" /></span>
    </div>
    <div class="divCampo">
      <label><strong>Terreno construido:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="terrenoConstruido" id="terrenoConstruido" class="text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_26'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_26'] == 'No'){ echo 'selected';}?>>No</option>
        </select></span>
	</div>
	
    <div class="divCampo">
      <label><strong>Piscina:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="piscina" id="piscina" class="text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_27'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_27'] == 'No'){ echo 'selected';}?>>No</option>
        </select></span>
	</div>
    <div class="divCampo">
      <label><strong>Cancha(s) de tenis:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="canchaTenis" id="canchaTenis" class="text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_28'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_28'] == 'No'){ echo 'selected';}?>>No</option>
        </select></span>
	</div>
    <div class="divCampo">
      <label><strong>Cancha(s) de futbol:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="canchaFutbol" id="canchaFutbol" class="text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_29'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_29'] == 'No'){ echo 'selected';}?>>No</option>
        </select></span>
	</div>
    <div class="divCampo">
      <label><strong>Otros deportes:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="otrosDeportes" id="otrosDeportes" class="text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_30'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_30'] == 'No'){ echo 'selected';}?>>No</option>
        </select></span>
	</div>
    <div class="divCampo">
        <label><strong>Planta  el&eacute;ctrica:</strong></label>
    <span class="mostrarDatosInmueblesResultados"><select name="planta" id="planta" class="text-input">
      <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_16'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_16'] == 'No'){ echo 'selected';}?>>No</option>
    </select></span>
  	</div>
  	<div class="divCampo">
    <label><strong>Vigilancia*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="vigilancia" id="vigilancia" class="validate[required] text-input">
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

<div style="clear:left;width:450px;text-align:justify;margin-left:100px">
  <div style="color:#346599; padding-top:10px;"><strong>Observaciones</strong></div>
  <div style="color:#346599">Haga aqu&iacute; una breve descripci&oacute;n del inmueble que va a publicar agregue las características m&aacute;s importantes, por favor no agregue correos electr&oacute;nicos ni paginas web inmueblealaventa.com se reserva el derecho a des publicarlos.</div>
    <div><textarea name="comentarioUsuario" cols="" rows="4" id="comentarioUsuario" style="width:450px; margin-top:20px; height: 130px; margin-bottom:20px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; font-family:Arial, Helvetica, sans-serif;"><?php echo $registro_con['comentarioUsuario']?></textarea> </div>
</div>
<div style="clear:left; padding:10px 0" align="left"></div>
