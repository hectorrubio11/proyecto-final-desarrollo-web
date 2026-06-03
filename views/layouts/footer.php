</div> <footer class="footer">
        <div class="footer__top-bar"></div>

        <div class="footer__container">
            <div class="footer__col footer__col--brand">
                <div class="footer__logo-icon">🎓</div>
                <h2 class="footer__institution">Facultad de Informática<br/><span>Mazatlán</span></h2>
                <p class="footer__subject">Fundamentos de Desarrollo Web Avanzado</p>
                <p class="footer__professor">
                    <span class="footer__label">Profesor:</span><br/>
                    Dr. José Alfonso Aguilar Calderón
                </p>
            </div>

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

        <div class="footer__bottom">
            <div class="footer__divider"></div>
            <p class="footer__rights">
                &copy; <span id="year"></span> Facultad de Informática Mazatlán — Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>