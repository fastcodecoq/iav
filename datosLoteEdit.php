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
        <label for="tipoLote"><strong>Tipo de lote*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="tipoLote" id="tipoLote" class="validate[required] text-input">
		<?php
        for ($i=0; $i <= 2; $i++)
        {
        ?>
          <option value="<?php echo $i?>" <?php if($registro_con['campo_46'] == $i){ echo 'selected';}?>><?php echo tipo_lote($i)?></option>
        <?php
        }
        ?>
        </select></span>
    </div>
    
    <?php
	if($registro['campo_5'] != ''){
	?>
    <div class="divCampo">
        <label for="vlrventa"><strong>Valor venta(sin puntos)*:</strong></label>        
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="vlrventa" id="vlrventa" class="validate[required] text-input" value="<?php echo $registro_con['campo_5']?>"  <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> />   
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
        <label for="vlrAdmon"><strong>Valor administración(sin puntos):</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="vlrAdmon" id="vlrAdmon" class="text-input" value="<?php echo $registro_con['campo_19']?>" <?php /*?>onkeyup="puntillos(this)" onchange="puntillos(this)"<?php */?> /></span>
  </div>
    <div class="divCampo">
      <label><strong>Estrato*:</strong></label>
      <span class="mostrarDatosInmueblesResultados"><input type="text" name="estrato" id="estrato" class="validate[required] text-input" value="<?php echo $registro_con['campo_7']?>" /></span>
    </div>
    <div class="divCampo">
        <label><strong>Área mts2*:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><input type="text" name="area" id="area" class="text-input" value="<?php echo $registro_con['campo_6']?>" /></span>
    </div>  
    
  <div class="divCampo">
    <label><strong>Esquinero:</strong></label>
    <span class="mostrarDatosInmueblesResultados"><select name="esquinero" id="esquinero" class="text-input">
          <option value="">- Escoja -</option>
          <option value="Si" <?php if($registro_con['campo_47'] == 'Si'){ echo 'selected';}?>>Si</option>
          <option value="No" <?php if($registro_con['campo_47'] == 'No'){ echo 'selected';}?>>No</option>
      </select></span>
  </div>
	<div class="divCampo">
      <label for="ubicaLote"><strong>Ubicaci&oacute;n de lote:</strong></label>
      	<span class="mostrarDatosInmueblesResultados"><select name="ubicaLote" id="ubicaLote" class="">
		  <?php
            for ($i=0; $i <= 2; $i++)
            {
            ?>
          <option value="<?php echo $i?>" <?php if($registro_con['campo_48'] == $i){ echo 'selected';}?>><?php echo ubicacion_lote($i)?></option>
          <?php
            }
            ?>
      </select></span>
  	</div>
    <div class="divCampo">
    <label><strong>Con todos los servicios:</strong></label>
        <span class="mostrarDatosInmueblesResultados"><select name="todoServicios" id="todoServicios" class="text-input">
          <option value="">- Escoja -</option>
              <option value="Si" <?php if($registro_con['campo_49'] == 'Si'){ echo 'selected';}?>>Si</option>
              <option value="No" <?php if($registro_con['campo_49'] == 'No'){ echo 'selected';}?>>No</option>
      </select></span>
  	</div>
    <div class="divCampo">
   	  <label><strong>Sobre v&iacute;a principal:</strong></label>
    	<span class="mostrarDatosInmueblesResultados"><select name="viaPrincipal" id="viaPrincipal" class="text-input">
       	  	<option value="">- Escoja -</option>
        	<option value="Si" <?php if($registro_con['campo_50'] == 'Si'){ echo 'selected';}?>>Si</option>
            <option value="No" <?php if($registro_con['campo_50'] == 'No'){ echo 'selected';}?>>No</option>
      	</select></span>
  	</div>
    <div class="divCampo">
   	  <label><strong>V&iacute;a secundaria:</strong></label>
    	<span class="mostrarDatosInmueblesResultados"><select name="viaSecundaria" id="viaSecundaria" class="text-input">
        	<option value="">- Escoja -</option>
        	<option value="Si" <?php if($registro_con['campo_51'] == 'Si'){ echo 'selected';}?>>Si</option>
            <option value="No" <?php if($registro_con['campo_51'] == 'No'){ echo 'selected';}?>>No</option>
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
