<?php
include('controlSesion.php');
require('bd.php');
include('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Inmueble a la Venta ::</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<link rel="stylesheet" href="css/orbit-1.2.3.css">
<link rel="stylesheet" href="css/slideOrbit.css">

<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Estilo de los campos de error-->
<link rel="stylesheet" href="validadorForm/css/validationEngine.jquery.css" type="text/css"/>


</head>

<body>

<section>
	<?php include('cabezote.php')?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php')?></div>
    </div>
</section>

<section>
  <div style="clear:left; padding-top:10px;" class="contenedor">
    	<!-- Registro -->
        <form action="" method="post" id="registro">        
        
        <div class="recuadroAzul">
        	<h1 style="text-transform:uppercase" align="center">PREGUNTAS FRECUENTES</h1>
            <div style="font-size:14px; font-weight:bold; text-transform:uppercase; padding-bottom:20px;" align="center">Informaci&oacute;n para su pago</div>
            
            <div style="width:940px; float:left; margin-left:20px; padding-right:10px; height:400px; overflow:auto" align="justify">
            <p><strong>¿Necesita ayuda para publicar un inmueble?</strong></p>
            <p>Si no entiendes el proceso o tienes dificultades para buscar o publicar un inmueble en inmueblealaventa.com puedes comunicarte al 2267212 de Bogotá o 3118689032 o nos puedes también contactar mediante el correo info@inmueblealaventa.com</p>
            
            <p><strong>¿Puedo saber cuántas personas han visto mi inmueble?</strong></p>
            <p>Junto con los productos que adquirió con la publicación podrá ingresar a su cuneta de usuario y revisar sus publicaciones, en la tabla de publicaciones podrá revisar el número de vistas que recibido, cada uno de sus inmuebles inmueble.</p>
			<p><strong>¿Puedo organizar las búsquedas?</strong></p>
            <p>Después de haber obtenido los resultados que se generan posteriores a la búsqueda por una de nuestras herramientas.
            <ul>
            	<li style="list-style:circle">Puedes utilizar la barra del lado izquierdo de la pantalla para poder filtrar más exactamente tu búsqueda.</li>
     			<li style="list-style:circle">Puedes utilizar la herramienta que se encuentra en la parte superior de la lista de resultados para poder organizar por precio, tiempo de publicación o área.</li>
            </ul></p>
			
            <p><strong>¿No entiendo cómo utilizar las herramientas de búsqueda de inmueblealaventa.com?</strong></p>
            <p>A tu disposición hemos puesto varias herramientas de búsqueda para facilitar y encontrar tu inmueble. 
            <ul>
            	<li style="list-style:circle">Por característica: facilita la búsqueda utilizando características  del inmueble que usted quiere encontrar. Ejemplo: casa, Bogotá</li>
            	<li style="list-style:circle">Por mapa: es una herramienta con la cual puedes ubicar el inmueble que  quieres con la ubicación geográfica.</li>
            	<li style="list-style:circle">Por constructora: en inmueblealaventa.com te facilitamos la búsqueda y tenemos una amplia lista de constructoras en las que podrás encontrar tu inmueble ideal.</li>
            	<li style="list-style:circle">Por inmobiliaria: permite buscar inmuebles por medio de inmobiliarias de confianza.</li>
            </ul></p>
			<p><strong>¿Por qué encuentro inmuebles que ya no están para la venta o arriendo?</strong></p>
            <p>Si sigue encontrando inmuebles que ya no se están vendiendo o arrendando se debe a que el propietario no ha actualizado la información en inmueblealaventa.com.</p>
            <p><strong>¿inmueblealaventa.com cobra comisión por la venta o arriendo de un inmueble?</strong></p>
            <p>No. Inmublealaventa.com es un portal inmobiliario diseñado para comunicar a los proponentes con los vendedores o arrendatarios. Debe dejarse en claro que inmueblalaventa.com nunca interviene en los negocios que se puedan realizar gracias a la información publicada en inmueblealaventa.com.</p>
            <p><strong>¿Quién puede utilizar el servicio de publicación de inmueblealaventa.com?</strong></p>
            <p>Inmueblealaventa.com es una herramienta que esta disponible a cualquier persona o empresa que quiera de forma fácil y segura vender o arrendar  un inmueble.</p>
            <ul>
            	<li style="list-style:circle">Inmobiliarias</li>
            	<li style="list-style:circle">Propietarios</li>
            	<li style="list-style:circle">Constructoras</li>
            	<li style="list-style:circle">Inmuebles vacacionales</li>
            </ul>
            <p><strong>¿Cuándo tiempo debo esperar para ver mi publicación en inmueblealaventa.com?</strong></p>
            <p>Si ya haz realizado el pago deberás esperar a que se hagan las revisiones correspondientes para el trámite de tu publicación, el tiempo en promedio es de 2 a 5 horas.</p>
            <p><strong>¿Cómo puedo actualizar o cambiar información sobre los inmuebles que ya haya publicado?</strong></p>
            <p>Debes ingresar a tu cuenta en inmueblealaveta.com, hacer click en editar y cambiar la publicación con la información nueva solo para datos (las fotos no podrán ser modificadas).</p> 
            <p>Debes de saber que hay tres campos que no se pueden editar, ya que son elementos internos de control: tipo de inmueble y negociación</p>
            <p><strong>¿Cómo puedo renovar el plan que compre anteriormente?</strong> </p>
            <p>Debes de ingresar a tu cuenta en inmueblealaveta.com y haz click en “renovar”<img src="imagenes/renovar.png" width="22" height="22" />.</p>
            <p><strong>¿Como puedo eliminar mi publicación de inmueblealaventa.com?</strong></p>
            <p>Para eliminar el inmueble que quiere, debe ingresar a su cuenta,  seleccionar el inmueble que quiere eliminar y hacer click en “Eliminar” <img src="imagenes/icon-no.gif" width="24" height="24" /> cuando elimine el inmueble que quiere, se borrara de la base de datos de inmueblalaventa.com, entonces no podrá recuperar la información del inmueble.</p>
            <p><strong>¿Cuánto tiempo queda mi publicación en inmueblealaventa.com si no la he renovado o si no he confirmado su venta?</strong></p>
            <p>Cuando la publicación que hiciste se vence, inmueblealaventa.com inactiva la publicación por 90 días, tiempo durante el cual toda la información queda guardada en nuestra base de datos, cumplido este tiempo el sistema eliminara la publicación automáticamente.</p>
            <p>Con el plan gold puedes renovar tu publicación hasta que vendas tu inmueble, solo tienes que llamar o enviar un correo a renovar@inmueblealaventa.com y pedir la renovación de tu inmueble durante los siguientes dos meses.</p> 
            
            <p><strong>¿Cómo me puedo comunicar con el dueño de la publicación del inmueble que me interese? </strong></p>
            <p>En la información de cada inmueble puedes encontrar los datos para contactar a la persona quien hizo la publicación.</p> 
            <p><strong>¿Necesita orientación para vender o arrendar su inmueble?</strong></p>
            <p>Consulta la sección 'Manual de publicación'. Allí encontrarás claves para definir el precio de tu propiedad, trámites y consejos para negociar y sacar la mayor rentabilidad posible. También, puedes suscribirte sin costo alguno al boletín semanal de noticias de inmueblealaventa.com.</p>
            
            <p><strong>¿Cuál es la opción más efectiva para publicar un inmueble?</strong></p>
            <p>La 'Publicación gold' es la mejor opción para promocionar una propiedad en venta o en arriendo, ya que te da cantidad ilimitada de tiempo y un mes en inmuebles destacados. Además de esto puedes utilizar nuestra herramienta “Arma tu plan” en el que puedes escoger el tiempo de publicación, el número de fotos y la cantidad de meses que tu inmueble este en destacados dándole una exposición más alta y así poderlo vender más rápido.</p>
            
            <p><strong>¿Qué es la herramienta "Arma tu plan"?</strong></p>
            <p>"Arma tu plan" es una herramienta en la cual puedes escoger las características que quieras para tu plan y pagando por lo que en realidad necesitas.</p>
            
            <p><strong>¿Qué productos ofrecemos para inmobiliarias? </strong></p>
            <p>Módulo Comercial: Ofrece la oportunidad de publicar todo el inventario de inmuebles en inmueblealaventa.com</p>
            <p>Módulo de Negocios: Los servicios del módulo comercial + una estrategia de publicidad multimedia y el desarrollo, montaje, alojamiento y actualización del sitio web de su inmobiliaria.</p>

            </div>
            
            <div style="clear:left"></div>
            
        </div>
        </form>
        <!-- Registro -->
  </div>
</section>

<section>
	
</section>

<footer>
<?php include('pie.php')?>
</footer>
</body>
</html>