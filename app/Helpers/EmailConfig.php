<?php

namespace App\Helpers;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailConfig
{
    static  function config(): PHPMailer
    {
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ventas@doomine.com';
        $mail->Password = 'Doomin32024#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->Subject = 'Notificación de informacion Recibida';
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('ventas@doomine.com', 'Doomine');
        return $mail;
    }

    static function checkConnection()
    {
        $mail = self::config();
        try {
            // Configura el destinatario y el cuerpo del mensaje
            $mail->addAddress('destinatario@ejemplo.com'); // Cambia esto a un correo de prueba
            $mail->Subject = 'Correo de prueba';
            $mail->Body = 'Este es un correo de prueba para verificar la conexión SMTP.';

            // Intenta enviar el correo
            if ($mail->send()) {
                echo 'Correo enviado correctamente.';
            } else {
                echo 'No se pudo enviar el correo.';
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}
