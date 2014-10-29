<?php
	//session_start();

if(@$_SESSION["idusuario"] == ""){
    $link = "/_login.php";
}else{
   if($_SESSION["rol"] === "3")
     $link = "/registroInmueble.php";
   else
     $link = "/planes-venta";
}

?>
<div class="centrado">
<div class="cabezote">
    <div class="logotipo"><a href="/inicio"><img src="/imagenes/logo.png" width="322" height="117" alt="Inmueble a la Venta.com"></a></div>
    <div class="login">
    <?php 
    
    if(@$_SESSION["idusuario"] == "")
    {
        ?>
    <form action="/autenticacion.php" method="post" name="login">
      <table width="180" border="0" cellspacing="0" cellpadding="0">
        <tr>
        
         <?php
            if (@$_GET["error"] == 1)
			
			{
            ?>
              <div align="center" style="clear:left; color:#F00; font-size:11px;"><strong>Usuario &oacute; Contrase&ntilde;a incorrecta</strong></div>
                <?php
            }
            ?>
          <td><strong>Ingresa y publica!</strong></td>
        </tr>
        <tr>
          <td><label for="textfield"></label>
          <input type="text" name="username" id="username" placeholder="Usuario">
         
          </td>
        </tr>
        <tr>
          <td><label for="textfield2"></label>
          <input name="password" type="password" id="password" placeholder="Contraseña" autocomplete="off" size="20">
          <input type="image" name="imageField" id="imageField" src="/imagenes/btnIngresarLoginSmall.png"></td>
        </tr>
        <tr>
          <td><a href="/registrarse">Nuevo</a><a href="/recuperar-contraseña"> | ¿Olvidó su usuario o clave?</a></td>
        </tr>
      </table>
    </form>
    <?php
    }
    else
    {
    ?>
        <div style="padding-top:20px; height:40px;">Hola,<br /> <strong><?php echo $_SESSION["nombre_usuario"].' '.$_SESSION["apellido_usuario"]?>.</strong></div>
        <div style="height:20px; border-top:#666 1px dotted; padding-top:7px">( <a href="/cuenta.php" class="colorazul">Mi cuenta</a>&nbsp;&nbsp;   | &nbsp;&nbsp;<a href="salir.php" class="colorazul">Salir</a> )</div>
    <?php
    }
    ?>
  </div>
    <div class="redes">
    <table>
    <tr>
      <td><a href="<?php echo $link; ?>" class="boton-cool">Publicar Inmueble</a></td>
    </tr>
    <tr>
    <td>
    <img src="/imagenes/redes.png" alt="Redes sociales" width="255" height="32" usemap="#Map">
      <map name="Map">
        <area shape="circle" coords="245,15,15" href="enviarMail.php" id="mail" target="_blank" title="Correo">
        <area shape="circle" coords="195,15,15" href="http://www.youtube.com/watch?feature=player_embedded&v=ikkvemPCJTk#t=0" target="_blank" title="Youtube">
        <area shape="circle" coords="150,15,15" href="http://google.com/+Inmueblealaventacom" rel="publisher" target="_blank" title="Google+" >
        <area shape="circle" coords="105,15,15" href="http://linkedin.com/company/inmueble-a-la-venta?trk=company_logo" target="_blank" title="Linked in">
        <area shape="circle" coords="60,15,15" href="http://twitter.com/iavcom" target="_blank" title="Twitter">
        <area shape="circle" coords="15,15,15" href="https://www.facebook.com/pages/inmueblealaventacom/151453635007598" target="_blank" title="Facebook">
      </map>
      </td>      
      </tr>
      </table>
  </div>
</div>
</div>

