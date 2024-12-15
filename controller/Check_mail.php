<?php
session_start();
require_once '../model/conexion.php';

$con = new Conexion();

$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($token) {
    $user_id = $con->verifyToken($token);
    if ($user_id) {
        // Token válido y no expirado
        $con->verifyEmail($user_id);
        $_SESSION['mensaje'] = "Correo verificado correctamente.";
        $_SESSION['tipo_mensaje'] = "exito";
    } else {
        // Token inválido o expirado
        $_SESSION['mensaje'] = "El enlace de verificación ha expirado.";
        $_SESSION['tipo_mensaje'] = "error";
    }
} else {
    $_SESSION['mensaje'] = "El enlace de verificación es inválido.";
    $_SESSION['tipo_mensaje'] = "error";
}

header("Location: /account_session/login/login.php");
exit();
?>
