<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/PHPMailer-master/src/PHPMailer.php';
require '../library/PHPMailer-master/src/SMTP.php';
require '../library/PHPMailer-master/src/Exception.php';

function enviarCorreoVerificacion($email,$name, $last , $token) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'juarezjarengamer@gmail.com'; // Tu correo de Gmail
        $mail->Password = 'xiek qjhe pdok ckip'; // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom('juarezjarengamer@gmail.com', 'SOMAQ');
        $mail->addAddress($email, $name); // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Autenticacion de cuenta - Ferranza';
        $mail->Body    = "Hola $name, $last.<br><br>Por favor, haz clic en el siguiente enlace para verificar tu correo:<br><br>
                      <a href='http://localhost:3000/controller/Check_mail.php?token=$token'>Verificar mi correo</a><br><br>
                      Este enlace expirará en 30 minutos.<br><br>Saludos,<br>Soporte Tecnico";


        // Enviar correo
        $mail->send();
        echo 'El correo de verificación ha sido enviado correctamente a ' . $email;
    } catch (Exception $e) {
        echo 'Hubo un error al enviar el correo: ' . $mail->ErrorInfo;
    }
}
?>
