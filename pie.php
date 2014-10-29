<div class="pie">
<div class="pie_pagina">
	<div class="contenedor">
      
      <div style="width:100%">
        
   	  	<div class="menu">
        <ul>Oficinas inmueblealaventa.com
        	<li style="font-weight:100">Calle 53B No. 27-24 Of.508</li>
            <li style="font-weight:100">Inmueblealaventa.com, Bogot&aacute;, Colombia.</li>
            <li style="font-weight:100">Tel&eacute;fonos: Bogot&aacute;: (571) 226 7212 </li>
            <li style="font-weight:100">Celular: 311 868 9032</li>
            <li style="font-weight:100">Fax: 226 7212</li>
            <li style="font-weight:100">info@inmueblealaventa.com</li>
        </ul>
        </div>
        <!--
        <div class="menu">
        <ul>Inmuebles a la venta
        	<li><a href="#">Apartamentos</a></li>
            <li><a href="#">Casas</a></li>
            <li><a href="#">Oficinas</a></li>
            <li><a href="#">Locales</a></li>
            <li><a href="#">Finca</a></li>
        </ul>
        </div>-->
        
        <div class="menu">
        <ul>Encontrar inmueble
        	<li><a href="/inmobiliarias">Por inmobiliaria</a></li>
            <!--<li><a href="/constructoras">Por cosntructora</a></li>-->
            <li><a href="/busqueda-mapa">En el mapa</a></li>
        </ul>
        </div>
        
        <div class="menu">
        <ul>Publicar inmueble
        <?php 
		if(@$_SESSION["idusuario"] == "")
		{
		?>
       	  	<li><a href="http://www.inmueblealaventa.com/planes-venta">Ingresa y publica</a></li>
        <?php
		}
		else
		{
		?>
        	<li><a href="http://www.inmueblealaventa.com/planes-venta">Ingresa y publica</a></li>
        <?php
		}
		?>
            <li><a href="http://www.inmueblealaventa.com/planes-venta">Planes y tarifas</a></li>
            <li><a href="http://www.inmueblealaventa.com/planes-venta">Basic</a></li>
            <li><a href="http://www.inmueblealaventa.com/planes-venta">Silver</a></li>
            <li><a href="http://www.inmueblealaventa.com/planes-venta">Gold</a></li>
        </ul>
        </div>
        
        <div class="menu">
        <ul>Inmuebles
            <li><a href="http://www.inmueblealaventa.com/proyectos-en-construccion">En Construcción</a></li>
            <li><a href="http://www.inmueblealaventa.com/proyectos-sobre-planos">Sobre Planos</a></li>
            <li><a href="http://www.inmueblealaventa.com/arriendo">Arriendo</a></li>
       	  	<li><a href="http://www.inmueblealaventa.com/venta">Venta</a></li>     
       </ul>
        </div>
        
        <!--<div class="menu">
        <ul>Turismo
       	  	<li><a href="alquileres.php">Imuebles para alquilar</a></li>
            <li><a href="guiaTurismo.php">Gu&iacute;a de turismo</a></li>
            <li><a href="hoteles.php">Hoteles</a></li>
        </ul>
        </div>-->
        
        <div class="menu">
        <ul>Ayuda
       	  	<li><a href="/faq">Preguntas frecuentes</a></li>
            <li><a href="/terminos-y-condiciones" target="_blank">T&eacute;rminos legales</a></li>
            <li><a href="/manual" target="_blank">Manual de publicaci&oacute;n</a></li>
        </ul>
        </div>
        <!--<div class="menu">
        <ul>
        <li><div style="width:97px;"> <a rel="nofollow" href="http://www.qweb.es/empresas-de-directorios-de-inmobiliarias.html" target="_blank" title="Directorio de Empresas de Directorios de inmobiliarias"> <img src="http://www.qweb.es/certqweb-inmueblealaventa.com.gif" width="97" height="31" style="border:0" alt="Directorio de Empresas de Directorios de inmobiliarias" /> </a> </div></li>
        </ul>
        </div>
        <div class="menu">
        <ul>
        <li><div id="webutation-badge">
<script type="text/javascript">
(function() {
window.domain = 'inmueblealaventa.com';
function async_load(){
 var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
 var p = ('https:' == document.location.protocol ? 'https://' : 'http://');
 s.src = p+'www.webutations.net/js/load_badge.js';
 var x = document.getElementById('webutation-link'); x.parentNode.insertBefore(s, x); }
if (window.attachEvent) window.attachEvent('onload', async_load); else window.addEventListener('load', async_load, false);
})();
</script>
<a id="webutation-link"  href="http://www.webutations.net/go/review/inmueblealaventa.com">inmueblealaventa.com Webutation</a>
</div>
        </li>
        <li><div id="webutation-pixelbadge">
<script type="text/javascript">
(function() {
window.domain = 'inmueblealaventa.com';
function async_load(){
 var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
 var p = ('https:' == document.location.protocol ? 'https://' : 'http://');
 s.src = p+'www.webutations.net/js/load_pixelbadge.js';
 var x = document.getElementById('webutation-pixelbadge-link'); x.parentNode.insertBefore(s, x); }
if (window.attachEvent) window.attachEvent('onload', async_load); else window.addEventListener('load', async_load, false);
})();
</script>
<a id="webutation-pixelbadge-link"  href="http://www.webutations.net/go/review/inmueblealaventa.com">inmueblealaventa.com Webutation</a>
</div>
        </li>
        </ul>
        </div>-->
        
        
        
        </div>
        
        
        
      <div style="width:100%; clear:left; text-align:center">&copy; 
	  <?php 
	  // Desactivar toda notificación de error  
	  error_reporting(0);
      echo date(Y)?> Inmueble a la venta. Todos los derechos reservados
      </div> 
    </div>
</div>
</div>
</div>
