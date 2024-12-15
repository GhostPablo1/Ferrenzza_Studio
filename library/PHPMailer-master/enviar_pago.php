<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/PHPMailer-master/src/PHPMailer.php';
require '../library/PHPMailer-master/src/SMTP.php';
require '../library/PHPMailer-master/src/Exception.php';

function enviarCorreoPago($correo, $nombreCompleto, $cod_venta, $monto_total, $metodo_pago, $n_operacion, $estado){
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
        $mail->addAddress($correo, $cod_venta); // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de Pago';
        $mail->Body = "Hola $nombreCompleto,<br><br>
                      Hemos registrado tu pago correctamente.<br>
                      Detalles del pago:<br>
                      Código de Venta: $cod_venta<br>
                      Método de pago: $metodo_pago<br>
                      N° de operación: $n_operacion<br>
                      Estado: $estado<br>
                      Monto Total: $monto_total<br><br>
                      Gracias por tu compra.<br><br>
                      Saludos,<br>
                      Tu equipo SOMAQ";

        // Enviar correo
        $mail->send();
        echo 'El correo de confirmación de pago ha sido enviado correctamente a ' . $correo;
    } catch (Exception $e) {
        echo 'Hubo un error al enviar el correo: ' . $mail->ErrorInfo;
    }
}