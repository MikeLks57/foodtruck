<?php

namespace Service;


class MailerService
{

    public function sendMail($destAddress, $destName, $subject, $messageHtml, $messagePlain)
    {
        $mail = new \PHPMailer();

        $mail->isSMTP();                                      	// On va se servir de SMTP
        $mail->Host = 'smtp.gmail.com';  						// Serveur SMTP
        $mail->SMTPAuth = true;                               	// Active l'autentification SMTP
        $mail->Username = 'pizztruck@gmail.com';             	// SMTP username
        $mail->Password = 'MikaNico';                   		// SMTP password
        $mail->SMTPSecure = 'tls';                            	// TLS Mode
        $mail->Port = 587;                                    	// Port TCP à utiliser
        $mail->CharSet = 'UTF-8';
        
        /*Pour ne pas être ennuyé par les certificats ssl*/
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

        // $mail->SMTPDebug = 2;

        $mail->setFrom('pizztruck@gmail.com', 'Pizz\'Truck', false);
        $mail->addAddress($destAddress, $destName);     		// Ajouter un destinataire

        $mail->isHTML(true);                                  	 // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $messageHtml;
        $mail->AltBody = $messagePlain;

        $mail->send();

    }

}