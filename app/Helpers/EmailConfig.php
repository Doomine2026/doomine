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
        $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME', 'ventas@doomine.com');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = env('MAIL_PORT', 465);
        $mail->Subject = 'Notificación de informacion Recibida';
        $mail->CharSet = 'UTF-8';
        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        return $mail;
    }

    static function checkConnection()
    {
        $mail = self::config();
        try {
            // Configura el destinatario y el cuerpo del mensaje
            $mail->addAddress('carlosecolina89@gmail.com'); // Cambia esto a un correo de prueba
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
