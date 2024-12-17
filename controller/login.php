<?php
session_start();
require_once '../model/conexion.php';

$con = new Conexion();
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['email'] = $email;
$_SESSION['user_email'] = $email;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@([a-zA-Z0-9.-]+\.)?(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com|live\.com|icloud\.com|edu\.pe)$/', $email)) {
        $_SESSION['mensaje'] = "Por favor, ingrese un correo válido";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: /account_session/login/login.php");
        exit();
    }
    
    if (!$con->isEmailRegistered($email)) {
        $_SESSION['mensaje'] = "El correo electrónico no está registrado";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: /account_session/login/login.php");
        exit();
    }

    // Verificar si el correo está verificado
    if (!$con->isEmailVerified($email)) {
        $_SESSION['mensaje'] = "El correo electrónico no está verificado. Por favor, verifica tu correo electrónico";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: /account_session/login/login.php");
        exit();
    }

    $login_exitoso = $con->loginUser($email, $password);

    if ($login_exitoso) {
        $_SESSION['loggedin'] = true;
        $_SESSION['mensaje'] = "Inicio de sesión exitoso";
        $_SESSION['tipo_mensaje'] = "exito";

        $rol_id = $con->getUserRole($email);

        if ($rol_id == 1) {
            header("Location: ../admin/index.php");
        } else {
            header("Location: /index.php");
        }
        exit();
        
    } else {
        $_SESSION['mensaje'] = "Credenciales incorrectas.";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: /account_session/login/login.php");
        exit();
    }
}
?>
