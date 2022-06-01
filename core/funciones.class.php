<?php
class Funciones
{
    /*
     * Funcion qe permite el envio del mail 
     * @param $para destinatario.
     * @param $subject asunto del mensaje.
     * @param $body cuerpo del mensaje
     * @param $altbody
     * @param $mailFROM remitente
     * @param $mailNameCompany nombre Compañia o empresa
     * @return boolean
	 */
    function SendMAIL($para,$subject,$body,$altbody='',$mailFROM,$mailNameCompany)
	{
	//	echo "aqui";
		$mail = new phpmailer();
	
		$mail->PluginDir = _DIR_PLUGIN;
		$mail->Mailer = _MAILER;
		$mail->Host = _HOST_MAIL; # Editar el Host smtp
		$mail->SMTPAuth = _SMTP_AUTH;
		$mail->Username = _SMTP_USER; # editar el usuario
		$mail->Password = _SMTP_PASS; # Editar el password
		$mail->IsHTML(_ES_HTML);
		$mail->From = $mailFROM;
		$mail->FromName = $mailNameCompany;
		$mail->Subject = $subject;
		$email = $para;
		$body = $body;
		$mail->Body = $body;
		$mail->AltBody = $altbody;
		$mail->Timeout=2;
		$mail->AddAddress($email);
		$intentos=1; 
		
		if($mail->Send())
		  return 1;
		else
		  return 0;  
	}

	function getIP() 
	{
	    if (isset($_SERVER)) {
	        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            return $_SERVER['HTTP_X_FORWARDED_FOR'];
	        } else {
	            return $_SERVER['REMOTE_ADDR'];
	        }
	    } else {
	        if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
	            return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
	        } else {
	            return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
	        }
	    }
	}
}
?>
