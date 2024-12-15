<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/PHPMailer-master/src/PHPMailer.php';
require '../library/PHPMailer-master/src/SMTP.php';
require '../library/PHPMailer-master/src/Exception.php';

function enviarCorreoReclamacion($correo,$telefono,$asunto,$descripcion){
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
        $mail->addAddress($correo, $asunto); // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Reclamacion enviada';
        $mail->Body    = "Hemos registrado correctamente tu reclamación con el asunto $asunto, te estaremos contactactando al número $telefono<br><br>La razón de tu reclamación es:<br><br>
                        <p>$descripcion</p><br><br>
                      Te responderemos lo antes posible, revisa el estado de tu reclamación en Mis Reclamaciones desde la página web.<br><br>Saludos,<br>Tu equipo SOMAQ";


        // Enviar correo
        $mail->send();
        echo 'El correo de verificación ha sido enviado correctamente a ' . $correo;
    } catch (Exception $e) {
        echo 'Hubo un error al enviar el correo: ' . $mail->ErrorInfo;
    }
}
?>
