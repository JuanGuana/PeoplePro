<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php'; 


function enviarCorreoRecuperacion($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jguanapintto@gmail.com';  
        $mail->Password   = 'oriorljatrjntgjk'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Configuración del correo
        $mail->setFrom('TUCORREO@gmail.com', 'PeoplePro App');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = '🔐 Recuperar contraseña';
        
        $enlace = "http://localhost/peoplepro/public/index.php?action=login&method=resetear&token=$token";
        $mail->Body = "
            <p>Hola,</p>
            <p>Recibimos una solicitud para restablecer tu contraseña.</p>
            <p>Haz clic en el siguiente enlace para continuar:</p>
            <p><a href='$enlace'>$enlace</a></p>
            <p>Este enlace expirará en 1 hora.</p>
            <p>Si no solicitaste este cambio, ignora este mensaje.</p>
        ";

        $mail->send();
        
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
    }
}
