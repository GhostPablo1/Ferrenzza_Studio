<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/PHPMailer-master/src/PHPMailer.php';
require '../library/PHPMailer-master/src/SMTP.php';
require '../library/PHPMailer-master/src/Exception.php';

function enviarCorreoVerificacion($nombres,$apellidos,$email, $mensaje) {
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
        $mail->addAddress($email, $nombres); // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = '¡Gracias por contactarnos!';
        $mail->Body    = "Hola, $nombres $apellidos<br><br>Nos haz contactado con nosotros a través del siguiente mensaje:<br><br>
                        <label>$mensaje</label><br><br>
                      Te responderemos lo antes posible, revisa el estado de tu consulta en Mis Consultas desde la página web.<br><br>Saludos,<br>Tu equipo SOMAQ";


        // Enviar correo
        $mail->send();
        echo 'El correo de verificación ha sido enviado correctamente a ' . $email;
    } catch (Exception $e) {
        echo 'Hubo un error al enviar el correo: ' . $mail->ErrorInfo;
    }
}
?>
