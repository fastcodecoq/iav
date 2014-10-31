<?php 
header('Content-Type: application/json');

require_once($_SERVER["DOCUMENT_ROOT"] . "/PHPMailer/Mail.php");




/*$toemail = 'informacion@srrseguridadprivada.com';
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
if(mail($toemail, 'Subject', $message, 'From: ' . $email)) {
	echo 'Your email was sent successfully.';
} else {
	echo 'There was a problem sending your email.';
}
*/


    $your_email = isset($_POST['txtemailcontac']) && $_POST['txtemailcontac'] ? $_POST['txtemailcontac'] : ''; // Your email address
	$subject = 'Enviado desde la www.inmueblealaventa.com'; // Email subject
	
	$name = isset($_POST['txtnombre']) && $_POST['txtnombre'] ? $_POST['txtnombre'] : ''; // Visitor Name 
	$email = isset($_POST['txtcorreo']) && $_POST['txtcorreo'] ? $_POST['txtcorreo'] : ''; // Visitor Email
	$message = isset($_POST['txtcoment']) && $_POST['txtcoment'] ? $_POST['txtcoment'] : ''; // Visitor Message
	$website = isset($_POST['txttelefono']) && $_POST['txttelefono'] ? $_POST['txttelefono'] : ''; // Visitor Message
	
	$full_message = 'Email: '.($_POST['txtcorreo']).'<br>Nombre: '.strtoupper($name).'<br>Telefono contacto: '.$website. "<br><br> Mensaje:".$_POST['txtcoment'];

	if($name && $email && $message)
    {


      //esto hará un envío de 2 correos a través de http
    	 //un correo al mail info@inmueblealaventa.com
    	//otro correo al mail del usuario que solicitó la información, notificandole que se ha recibido su solicitud.


		$mail = new PHPMailer;
		
		$mail->isSMTP();                   
		$mail->Host = "smtp.live.com";
		$mail->Port = 587;  
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;                               
		$mail->Username = 'contacto@inmueblealaventa.com';         
		$mail->Password = '#inmueble.2014';                                                   
		$mail->CharSet = 'UTF-8';

		$mail->From = 'contacto@inmueblealaventa.com';
		$mail->FromName = 'Inmueble a la venta';
		$mail->addAddress($your_email);               
		$mail->addReplyTo('noresponder@inmueblealaventa.com', 'noresponder');
		
		$mail->WordWrap = 50;                                 
		$mail->isHTML(true);                                  
		
		$mail->Subject = 'Contacto desde inmueblealaventa.com';
		$mail->Body    = $full_message;
		$mail->AltBody = strip_tags($full_message);

  
			
		//------------------------------------------------
		// Send out email to site admin
		//------------------------------------------------
		if($mail->send())
			{

				//se cambia el contenido del mensaje
				$name = strtoupper($name);
				$full_message = "Hola {$name}, <br><br><br>Hemos recibido tu solicitud. Nos pondremos en contacto dentro del menor tiempo posible, para brindarte mas información acerca del inmueble en el cual estas intersado.<br><br><br><br>Saludos Cordiales, <br><br>Ventas<br>inmueblealaventa.com";
				$mail->clearAddresses();  //se borran los destinatarios
			    $mail->addAddress($email);  //se agrega la dirección del nuevo destinatario (cliente)
			    $mail->Body = $full_message;
			    $mail->AltBody = strip_tags($full_message);

			    if($mail->send())
				echo json_encode(array( "response" => "Mensaje enviado con exito, revise su correo."));
			    else
				echo json_encode(array( "response" => "Error interno del servidor, por favor intente mas tarde."));
			    

			}
		else
		   echo json_encode(array( "response" => "Error interno del servidor, por favor intente mas tarde."));
			
			
	}
	else
	{
				echo json_encode(array( "response" => "Recuerde que debe rellenar los campos del formulario."));		
		
	}
?>