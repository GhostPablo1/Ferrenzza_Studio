<?php
session_start();
require_once '../model/conexion.php';
require_once '../library/PHPMailer-master/verification_email.php';
date_default_timezone_set('America/Lima');

$con = new Conexion();

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'registrar') {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmar_password'];
    $last = $_POST['last'];

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

        if ($password !== $confirm_password) {
            $_SESSION['mensaje'] = "Las contraseñas no coinciden.";
            $_SESSION['tipo_mensaje'] = "error";
        } else {

        $registro_exitoso = $con->registerUser($name, $last, $email, $password);

        if ($registro_exitoso == true) {
                    $user_id = $con->getLastInsertedUserId($email);

                    $con->createPersonaRecord($user_id);

                    $token_verificacion = bin2hex(random_bytes(30));
                    $token_verificacion_expira = date('Y-m-d H:i:s', strtotime('+30 minutes'));
                    $con->saveVerificationToken($user_id, $token_verificacion, $token_verificacion_expira);

                    enviarCorreoVerificacion($email, $name, $last, $token_verificacion);
                    $_SESSION['mensaje'] = "Correo de verificación enviado correctamente, verifique su correo $email!";
                    $_SESSION['tipo_mensaje'] = "exito";

                    // Limpiar los valores de nombre y email de la sesión si el registro es exitoso
                    unset($_SESSION['name']);
                    unset($_SESSION['email']);
        } else {
            $_SESSION['mensaje'] = "Error al registrar usuario.";
            $_SESSION['tipo_mensaje'] = "error";
        }
    }
}
 header("Location: /account_session/register/register.php");
    exit();
}
?>