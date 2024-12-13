<?php
session_start();
require_once '../model/conexion.php';
//require_once '../library/PHPMailer-master/enviar_correo.php'; // Ajusta la ruta según donde tengas tu archivo enviar_correo.php
date_default_timezone_set('America/Lima');

$con = new Conexion();

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'registrar') {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['password'];
    $last = $_POST['last'];
    $confirm_password = $_POST['confirm_contrasena'];

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@([a-zA-Z0-9.-]+\.)?(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com|live\.com|icloud\.com|edu\.pe)$/', $email)) {
        $_SESSION['mensaje'] = "Por favor, ingrese un correo válido";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: /account_session/register/register.php");
        exit();
    }

    if ($con->isEmailRegistered($email)) {
        $_SESSION['mensaje'] = "El correo ya se encuentra registrado";
        $_SESSION['tipo_mensaje'] = "error";
    } else {
        // Validar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            $_SESSION['mensaje'] = "Las contraseñas no coinciden";
            $_SESSION['tipo_mensaje'] = "error";
        } else {
            // Validar la fortaleza de la contraseña
            if (strlen($password) < 8) {
                $_SESSION['mensaje'] = "La contraseña debe tener al menos 8 caracteres";
                $_SESSION['tipo_mensaje'] = "error";
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $_SESSION['mensaje'] = "La contraseña debe tener al menos una letra mayúscula";
                $_SESSION['tipo_mensaje'] = "error";
            } elseif (!preg_match('/\d/', $password)) {
                $_SESSION['mensaje'] = "La contraseña debe tener al menos un número";
                $_SESSION['tipo_mensaje'] = "error";
            } elseif (!preg_match('/[!@#$%^&*()\-_=+{}\[\]:;"\'<>,.?\/|\\\`~¡¿]/', $password)) {
                $_SESSION['mensaje'] = "La contraseña debe tener al menos un carácter especial";
                $_SESSION['tipo_mensaje'] = "error";
            
            } else {
                // Registrar usuario
                $registro_exitoso = $con->registerUser($name, $last ,$email, $contrasena);
                if ($registro_exitoso === true) {
                    $usuario_id = $con->getLastInsertedUserId($email);

                    //$con->createPersonaRecord($usuario_id);

                    /* 
                    $token_verificacion = bin2hex(random_bytes(32));
                    $token_verificacion_expira = date('Y-m-d H:i:s', strtotime('+30 minutes'));
                    $con->saveVerificationToken($usuario_id, $token_verificacion, $token_verificacion_expira);

                    enviarCorreoVerificacion($email, $nombre, $token_verificacion);
                    $_SESSION['mensaje'] = "Correo de verificación enviado correctamente. Expira en 30 minutos.";
                    $_SESSION['tipo_mensaje'] = "exito";
                    // Limpiar los valores de nombre y email de la sesión si el registro es exitoso
                    unset($_SESSION['nombre']);
                    unset($_SESSION['email']);*/
                } else {
                    $_SESSION['mensaje'] = "Error al registrar usuario";
                    $_SESSION['tipo_mensaje'] = "error";
                }
            }
        }
    }

    header("Location: /account_session/register/register.php");
    exit();
}
?>
