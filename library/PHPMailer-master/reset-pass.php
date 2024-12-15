<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/PHPMailer-master/src/PHPMailer.php';
require '../library/PHPMailer-master/src/SMTP.php';
require '../library/PHPMailer-master/src/Exception.php';

function enviarCorreoRecuperacionPass($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agurtoveliz2@gmail.com'; // Tu correo de Gmail
        $mail->Password = 'sjbu jsom irec mxdi'; // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom('agurtoveliz2@gmail.com', 'SOMAQ');
        $mail->addAddress($email); // Email del destinatario

        $resetPasswordLink = 'http://localhost:3000/reset-pass-token-form.php';

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperacion de contrasena';
        $mail->Body    = 'Tu token para reestablecer tu contraseña es  ' . $token . '. Haz clic en el siguiente enlace para restaurar tu contraseña: <a href="' . $resetPasswordLink . '">Nueva contraseña</a>';

        // Enviar correo
        $mail->send();
        echo 'Se ha enviado un correo con instrucciones para restablecer tu contraseña a ' . $email;
    } catch (Exception $e) {
        echo 'Hubo un error al enviar el correo: ' . $mail->ErrorInfo;
    }
}
?>
