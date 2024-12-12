<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Mi Tienda</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="auth.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/global-css/mmesage.css">
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

  $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
  ?>
  <section>

    <div class="form-box">
      <div class="form-value">
        <form action="/controller/register.php?accion=registrar" method="POST">
          <div class="neo-orwell__eye">
            <div class="neo-orwell__eye-inner">
              <div class="neo-orwell__iris">
                <div class="neo-orwell__pupil"></div>
              </div>
            </div>
          </div>

          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="text" id="name" name="name" required>
            <label for="name">Nombre</label>
          </div>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="text" id="last" name="last" required>
            <label for="name">Apellidos</label>
          </div>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" name="email" required>
            <label for="">Correo Electrónico</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" required>
            <label for="">Contraseña</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="confirmar_password" required>
            <label for="">Confirmar contraseña</label>
          </div>
          <div class="forget">
            <label>
          </div>
          <button>Registrate</button>
          <div class="register">
            <span>¿Ya tienes cuenta?</span>
            <a href="/account_session/login/login.html" class="small-link">Iniciar Sesión</a>
            <a href="/index.html" class="back-link"><i class="fas fa-arrow-left"></i> Volver a la tienda</a>
          </div>
        </form>
      </div>
    </div>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var mensaje = document.querySelector('.mensaje');
      if (mensaje) {
        setTimeout(function() {
          mensaje.style.opacity = '0';
          setTimeout(function() {
            mensaje.remove();
          }, 500);
        }, 3000);
      }
    });
  </script>
  <script src="/account_session/register/auth.js"></script>
</body>

</html>