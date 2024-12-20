<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<?php
require('model/conexion.php');
$con = new Conexion();

$name = '';
//var_dump($name);
if (isset($_SESSION['user_id'])) {
  $name = $con->getNombreByUserId($_SESSION['user_id']);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ferrenzza_Studios</title>
  <link rel="icon" href="/imagenes/FERRANZZA LOGO.png" />
  <link rel="stylesheet" href="/css/index_style.css">
  <link rel="stylesheet" href="/global-css/scroll.css">
  <link rel="stylesheet" href="/global-css/mmesage.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header>
    <button id="menu-toggle" class="menu-btn">
      <i class="fas fa-bars"></i>
    </button>

    <nav class="nav-bar">
      <ul>
        <li>
          <a href="index.php" class="logo">
            <img src="/imagenes/LOGO.ico" alt="Logo">

          </a>
        </li>
        <li><a href="#" class="link">Productos</a></li>
        <li><a href="#" class="link">Promos</a></li>
        <li><a href="#" class="link">Proximamente</a></li>
      </ul>

        <div class="input-wrapper">
        <button class="icon">
          <svg
            width="25px"
            height="25px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
              stroke="#fff"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"></path>
            <path
              d="M22 22L20 20"
              stroke="#fff"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"></path>
          </svg>
        </button>
        <input type="text" name="text" class="input" placeholder="search.." />
      </div>  
    </nav>
    
    <div class="user-options">
    <a class="usuario-nombre">
            <?php if (isset($_SESSION['user_nombre'])) : ?><span><?php echo $name['nombres'] ?></span>
          </a>
          <div class="dropdown">
              <a class="login">
              <button class="btn-2" id="accountToggle">
                <img class="user-icon" src="/imagenes/user-2.png">
            </button>
           </a>
           <div class="dropdown-menu" id="dropdownMenu">
                <a href="/restaurante_Cevicheria/Principal_admin/index.php" class="dropdown-item">Mi Cuenta</a>
                <?php if (isset($_SESSION['user_rol_id']) && $_SESSION['user_rol_id'] == 1) : ?>
                <a class="dropdown-item" href="/restaurante_Cevicheria/Principal_admin/index.php">Admin</a>
                <?php endif; ?>
                <a href="/controller/logout-session.php" class="dropdown-item">Salir</a>
            </div>
            </div>
        <?php else : ?>
        <a href="/account_session/login/login.php" class="login">
            <button class="btn-2">Login</button>
        </a>
            <?php endif; ?>
          </a>
    </div>
</div>
  </header>

    <div class="mensaje-container">
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
    </div>

    <!-- Modal de imagenes de productos -->
  <main class="container">
    <section class="product-carousel">
      <div class="carousel-container">
        <button class="carousel-btn prev-btn">
          <i class="fas fa-chevron-left"></i>
        </button>
        <div class="carousel-track">
          <div class="carousel-item">
            <img src="/imagenes/polos.jpg">
          </div>
          <div class="carousel-item">
            <img src="/imagenes/polos2.jpg">
          </div>
          <div class="carousel-item">
            <img src="/imagenes/polos3.jpg">
          </div>
        </div>
        <button class="carousel-btn next-btn">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </section>

    <div class="cards">
      <div class="card red">
        <p class="tip">Hover Me</p>
        <p class="second-text">Lorem Ipsum</p>
      </div>
      <div class="card blue">
        <p class="tip">Hover Me</p>
        <p class="second-text">Lorem Ipsum</p>
      </div>
      <div class="card green">
        <p class="tip">Hover Me</p>
        <p class="second-text">Lorem Ipsum</p>
      </div>
      <div class="card black">
        <p class="tip">Hover Me</p>
        <p class="second-text">Lorem Ipsum</p>
      </div>
    </div>

    <div class="chart">
          <div class="chart-img"><img src="/imagenes/polo4.jpeg" alt=""></div>
          <div class="chart-info">
            <p class="text-title">Product title </p>
            <p class="text-body">Product description and details</p>
          </div>
          <div class="chart-footer">
            <span class="text-title">$499.49</span>
            <div class="chart-button">
              <svg class="svg-icon" viewBox="0 0 20 20">
                <path d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                <path d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                <path d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
              </svg>
            </div>
          </div>
    </div>
  </main>
<!-- Parte inferior de la página -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h3>Horario</h3>
        <div class="schedule-container">
          <div class="schedule-item">
            <h4>Lunes a Viernes</h4>
            <p>9:00 am - 7:00 pm</p>
          </div>
          <div class="schedule-item">
            <h4>Sábado</h4>
            <p>10:00 am - 6:00 pm</p>
          </div>
        </div>
      </div>

      <div class="footer-section help">
        <h3>Ayuda</h3>
        <ul>
          <li><a href="#">Termino y condiciones</a></li>
          <li><a href="#">Servicio al cliente</a></li>
          <li><a href="#">Reclamos</a></li>
          <li><a href="#">Mi cuenta</a></li>

        </ul>
      </div>

      <div class="footer-section">
        <h3>Contactos</h3>
        <ul class="wrapper">
          <li class="icono facebook">
            <span class="tooltip">Facebook</span>
            <span><i class="fab fa-facebook-f"></i></span>
          </li>

          <li class="icono instagram">
            <span class="tooltip">Instagram</span>
            <span><i class="fab fa-instagram"></i></span>
          </li>
          <li class="icono tiktok">
            <span class="tooltip">Tik Tok</span>
            <span><i class="fab fa-tiktok"></i></span>
          </li>
        </ul>
      </div>

      <div class="footer-section">
        <h3>Términos y Condiciones</h3>
        <ul>
          <li><a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB+ElEQVR4nO2bTUoDQRCFx517CcTD6NplFuoVxL16GE+gJ9CVgiGnUDdxK4ph5pUL5cmMP4iaGO1M/837oGFIJ+nKx0x1F6GKQgghhBBCCCGEEEJEBs3ocdwROCGw9rE+sE7glMC9z1hSFchmAE8026HZLoHnEDEsXODCvnAGLMtVAvsEHhuJr6O+3qvnCg8kLfAdAgef7sa9wiN5CCzL/ofAsux7Xdvl99Jsg2Y3reaEyJmSE8e1m3k+PG49qUbOjI1lPPeHf3vNBzQb0WwYYN3/O4hM4JBmFwHWzUNgKCQwJYFs8cT/Ww5sa+2cBA5n5cAsBOaIBDqSjUDqHOhGJ86BXPDG8RfaWlsCLSGBbaIc6EgncmCOSKAjOZVyI9XCplpYObDQJtLNTYSqhd3oxDmQqoUl8CvKgY7kJHCYfQ7MEQnswi5M1cJeBOp/4RRRDnQkG4FULeyGzoGJks0jHIpsBFI50A3lwERp7RHucrcmExLIGLs1nQT6hBF0a/4YVyoCY+jWzENgGa5b01Xg1GZDL6OqBlNjq6pB0NjmbDbcCCoRuOZk0vsW12TSa+YCypur3TUkBA7fJF4S2ObDw0oz6mvg6m3uMHSc0UJymWbHM+6Co/o9oeOMGpJLBLYInNPsthnAGatqs54LHZ8QQgghhBBCFMF5Acvdr5ceeeVqAAAAAElFTkSuQmCC" alt="literature"></a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2024 Ferrenzza_Studios. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>