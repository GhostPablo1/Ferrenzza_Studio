<?php

session_start();

require_once '../database/conexion.php';

$con = new Conexion();
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'login') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com)$/', $email)) {
        $_SESSION['mensaje'] = "Por favor, ingrese un correo válido.";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: ../login.php");
        exit();
    }
    
    /* Verificar si el correo está registrado
    if (!$con->isEmailRegistered($email)) {
        $_SESSION['mensaje'] = "El correo electrónico no está registrado.";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: ../login.php");
        exit();
    }

    // Verificar si el correo está verificado
    if (!$con->isEmailVerified($email)) {
        $_SESSION['mensaje'] = "El correo electrónico no está verificado. Por favor, verifica tu correo electrónico.";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: ../login.php");
        exit();
    }
*/
    // Llamar a la función para verificar las credenciales
    $login_exitoso = $con->loginUser($email, $contrasena);

    if ($login_exitoso) {
        $_SESSION['loggedin'] = true;
        $_SESSION['mensaje'] = "Inicio de sesión exitoso.";
        $_SESSION['tipo_mensaje'] = "exito";

       // $rol_id = $con->getUserRole($email);

        if ($rol_id == 1) {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../profile.php");
        }
        exit();
        
    } else {
        $_SESSION['mensaje'] = "Credenciales incorrectas.";
        $_SESSION['tipo_mensaje'] = "error";
        header("Location: ../login.php");
        exit();
    }
}
?>
