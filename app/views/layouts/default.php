<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo AssetHelper::css("default.css")?>">

    <?php $this->renderStyles(); ?>
    <title><?php echo $data['title']; ?></title>
</head>
<body>
    <!-- Header de la página principal -->
    <header>
      <div class="container-hero">
        <div class="container hero">
          <div class="llamar">
            <i class="fa-brands fa-whatsapp"></i>
            <div class="content-llamar">
              <span class="text">Llamanos</span>
              <span class="number">(+51)989 297 765</span>
            </div>
          </div>

          <div class="container-logo">
            <a href="#" title="Ir a mi perfil">
              <img
                class="logo"
                src="<?php echo AssetHelper::image('logo.png'); ?>" alt="Travel agency" 
                height="50"
                width="50"
              >
            </a> 
            <h1 class="logo"><a href='https://localhost/DB-PF/landing.php'>Around the world</a></h1>
          </div>

          <div class="container-user">
            <i class="fa-solid fa-user"></i>
            <div class="iniciar-sesion">
              <div class="text-container">
              <?php if (isset($_SESSION['username'])): ?>
                <h2 class="hover-area"> <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario Desconocido') . ' ' . htmlspecialchars($_SESSION['apellidos'] ?? ''); ?></h2>
                <div class="hover-container">
                  <p>
                  <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario Desconocido') . ' ' . htmlspecialchars($_SESSION['apellidos'] ?? ''); ?></h2>
                  <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                  <p><strong>DNI:</strong> <?php echo htmlspecialchars($_SESSION['dni'] ?? 'No disponible'); ?></p>
                  <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($_SESSION['telefono'] ?? 'No disponible'); ?></p>
                  <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? 'No disponible'); ?></p>
                  </p>
                  <container id="boton_logout" >Cerrar sesión</container>
                </div>
              
              <?php else: ?>
                <span id="iniciar-sesion-click" class="text">Iniciar sesión</span>
              <?php endif; ?>

              </div>
            </div>
          </div>
          
          <script>
            var iniciarSesionBtn = document.getElementById('iniciar-sesion-click');
            iniciarSesionBtn.addEventListener('click', function() {
              window.location.href = 'https://localhost/DB-PF/login.php';
            });
          </script>
          <script>
            var cerrarSesionBtn = document.getElementById('boton_logout');
            cerrarSesionBtn.addEventListener('click', function() {
              window.location.href = 'https://localhost/DB-PF/logout.php';
            });
          </script>
        </div>
      </div>

      <div class="container-navbar">
        <nav class="navbar container">
          <i class="fa-solid fa-bars"></i>
          <ul class="menu">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Nosotros</a></li>
            <li><a href="#">Destinos</a></li>
            <li><a href="#">Tours</a></li>
            <li><a id="enlace-contacto" href="#">Contacto</a></li>
          </ul>

          <form class="search-form">
            <input type="search" placeholder="Buscar..." />
            <button class="btn-search">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </nav>
      </div>
      
      
    </header>

    <!-- Contenido principal -->
    <main>
        <?php echo $content; ?>
    </main>

    <!-- Footer del sitio -->
    <footer class="footer">
      <div class="container container-footer">
        <div class="menu-footer">
          <div class="contact-info">
            <p class="title-footer">Información de Contacto</p>
            <ul>
              <li>
                Dirección: San Agustin 324
              </li>
              <li>Teléfono: 989 297 765</li>
              <li>EmaiL: aroundtheworld@support.com</li>
            </ul>
            <div class="social-icons">
              <span class="facebook">
                <i class="fa-brands fa-facebook-f"></i>
              </span>
              <span class="twitter">
                <i class="fa-brands fa-twitter"></i>
              </span>
              <span class="youtube">
                <i class="fa-brands fa-youtube"></i>
              </span>
              <span class="instagram">
                <i class="fa-brands fa-instagram"></i>
              </span>
            </div>
          </div>

          <div class="information">
            <p class="title-footer">Información</p>
            <ul>
              <li><a href="#">Acerca de Nosotros</a></li>
              <li><a href="#">Politicas de Privacidad</a></li>
              <li><a href="#">Términos y condiciones</a></li>
              <li><a href="#">Contactános</a></li>
            </ul>
          </div>

          <div class="my-account">
            <p class="title-footer">Mi cuenta</p>

            <ul>
              <li><a href="#">Mi cuenta</a></li>
              <li><a href="#">Historial de ordenes</a></li>
            </ul>
          </div>

          <div class="newsletter">
            <p class="title-footer">Boletín informativo</p>

            <div class="content">
              <p>
                Suscríbete a nuestra revista turística, en Arequipa siempre hay por descubrir.
              </p>
              <input type="email" placeholder="Ingresa el correo aquí...">
              <button>Suscríbete</button>
            </div>
          </div>
        </div>

      </div>
    </footer>

</body>
</html>