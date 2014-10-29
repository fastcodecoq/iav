<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" href="/validadorForm/css/validationEngine.jquery.css" type="text/css"/>

<script src="/validadorForm/js/jquery-1.8.2.min.js" type="text/javascript">
</script>
<script src="/validadorForm/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
</script>
<script src="/validadorForm/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script>
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#contacto").validationEngine();
		jQuery('input').attr('data-prompt-position','bottomLeft');
		jQuery('textarea').attr('data-prompt-position','bottomLeft');
	});
</script>

<style>
body{
	background:#006665;
	color:#FFF;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	padding:0px 10px 10px 10px;
}
.input{
	height:20px;
	width:280px;
	padding:2px 4px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
}
textarea{
	width:280px;
	padding:2px 4px;
	font-family:Arial, Helvetica, sans-serif;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

</style>
<link href="css/botones.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="/form_enviar_contacto.php" method="post" name="contacto" id="contacto">

	<div>
        <span>Nombre </span><br />
        <input value="" class="validate[required,minSize[3]] text-input input" type="text" name="nombre" id="nombre" placeholder="Nombre"/>
    </div>
    
  	<div style="padding-top:10px">
        <span>E-mail </span><br />
      <input value="" class="validate[required,custom[email]] text-input input" type="text" name="mail" id="mail" placeholder="E-mail" />
    </div>
    
  	<div style="padding-top:10px">
        <span>Ciudad </span><br />
      <input value="" class="validate[required] text-input input" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" />
    </div>
    
  	<div style="padding-top:10px">
        <span>Tel&eacute;fono fijio o celular </span>		<br />
      <input value="" class="validate[required] text-input input" type="text" name="telefono" id="telefono" placeholder="Tel&eacute;fono fijio o celular" />
    </div>
    
  	<div style="padding-top:10px">
        <span>Asunto </span><br />
      <input value="" class="validate[required,minSize[4]] text-input input" type="text" name="asunto" id="asunto" placeholder="Asunto" />
    </div>
    
  	<div style="padding-top:10px">
        <span>Mensaje </span><br />
      <textarea name="mensaje" rows="4" class="validate[required] text-input" id="mensaje" placeholder="Mensaje"></textarea>
    </div>
    
<div style="display:block; padding-top:10px">    
<input name="" type="submit" class="boton azul medium" value="Enviar" />
</div>

</form>
</body>
</html>