<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Mi Tienda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/css/login-auth.css">
    <link rel="stylesheet" href="/global-css/mmesage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php
  if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $tipo_mensaje = $_SESSION['tipo_mensaje'];
    echo "
  <div class='mensaje $tipo_mensaje'>
      <i class='icono bi " . ($tipo_mensaje == 'error' ? 'bi-exclamation-circle-fill' : 'bi-check-circle-fill') . "'></i>
      <span class='mensaje-texto'>$mensaje</span>
      <span class='mensaje-cerrar' onclick='this.parentElement.style.display=\"none\";'>&times;</span>
  </div>";
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo_mensaje']);
  }
  ?>
    <section>
        <div class="form-box">
          <div class="form-value">
            <form action="/controller/login.php?accion=login" method="POST">
              <h2>Iniciar Sesion</h2>
              <div class="neo-orwell">
                <div class="neo-orwell__eye">
                  <div class="neo-orwell__eye-inner">
                    <div class="neo-orwell__iris">
                      <div class="neo-orwell__pupil"></div>
                    </div>
                  </div>
                </div>
              <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="email" title="Ingrese un correo Electrónico" required>
                <label for="">Email</label>
              </div>
              <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" title="Ingrese su contraseña" name="password" id="password" required>
                <label for="">Password</label>
                <span class="password-toggle" id="password-toggle" onclick="togglePasswordVisibility('password')">
              <i id="password-toggle-icon" class="fa fa-eye-slash"></i>
            </span>
              </div>
              <div class="forget">
                <label>
                  <input type="checkbox"> Recuerdamelo
                </label>
                <label>
                  <a href="#">Olvidaste tu contraseña?</a>
                </label>
              </div>
              <button>Iniciar Sesion</button>
              <div class="register">
                <p><a href="/account_session/register/register.php">Registrate</a></p>
              </div>
              <a href="/index.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Volver a la tienda
            </a>
            </form>
          </div>
        </div>
      </section>
      <script src="auth.js"></script>
</body>
</html>