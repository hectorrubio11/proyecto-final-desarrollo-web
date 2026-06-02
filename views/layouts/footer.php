        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Footer - Facultad de Informática Mazatlán</title>
  <link rel="stylesheet" href="footer.css" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet" />
</head>
<body>

  <footer class="footer">
    <div class="footer__top-bar"></div>

    <div class="footer__container">

      <!-- Columna 1: Institución -->
      <div class="footer__col footer__col--brand">
        <div class="footer__logo-icon">🎓</div>
        <h2 class="footer__institution">Facultad de Informática<br/><span>Mazatlán</span></h2>
        <p class="footer__subject">Fundamentos de Desarrollo Web Avanzado</p>
        <p class="footer__professor">
          <span class="footer__label">Profesor:</span><br/>
          Dr. José Alfonso Aguilar Calderón
        </p>
      </div>

      <!-- Columna 2: Contacto -->
      <div class="footer__col">
        <h3 class="footer__col-title">Contacto</h3>
        <ul class="footer__list">
          <li class="footer__list-item">
            <span class="footer__icon">📞</span>
            <span>669 239 0470</span>
          </li>
          <li class="footer__list-item footer__list-item--address">
            <span class="footer__icon">📍</span>
            <span>Av. Universidad, Av. Leonismo Internacional y, Tellería, 82000 Mazatlán, Sin.</span>
          </li>
        </ul>
      </div>

      <!-- Columna 3: Equipo -->
      <div class="footer__col">
        <h3 class="footer__col-title">Equipo</h3>
        <ul class="footer__team">
          <li>Castillo Torres Luis Andres</li>
          <li>Hernández Camacho Lennyn Jahir</li>
          <li>Palacios Navidad Jesús Antonio</li>
          <li>Rubio Ayala Héctor Armando</li>
          <li>Torrero Rojo Jassiel Efrain</li>
        </ul>
      </div>

    </div>

    <!-- Línea de derechos -->
    <div class="footer__bottom">
      <div class="footer__divider"></div>
      <p class="footer__rights">
        &copy; <span id="year"></span> Facultad de Informática Mazatlán — Todos los derechos reservados.
      </p>
    </div>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>