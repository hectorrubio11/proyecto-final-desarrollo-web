<style>
    .main-footer {
        background-color: #1a1d20;
        color: #adb5bd;
        /* Reducimos el padding de 50px a 25px para que no esté tan alto */
        padding: 25px 0 15px 0; 
        margin-top: 10px;
        font-family: 'Segoe UI', sans-serif;
        border-top: 3px solid #ffc107;
    }

    .footer-container {
        /* Limitamos el ancho para que el texto no se vaya a los extremos */
        max-width: 1000px; 
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0 10px;
    }

    .footer-section {
        width: 30%; 
    }

    .footer-section h4 {
        color: #ffffff;
        font-size: 0.85rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .footer-section p, .footer-section li {
        font-size: 0.75rem; 
        line-height: 1.4;
        margin-bottom: 5px;
    }

    .text-center { text-align: center; }
    .text-right { text-align: right; }
    
    .team-list { list-style: none; padding: 0; margin: 0; }
    .highlight { color: #ffc107; font-weight: bold; }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #2d3238;
        font-size: 0.7rem;
        opacity: 0.7;
    }
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; 
        margin: 0;
    }

    main, .container { 
        flex: 1; 
    }

</style>
</div>
</body>
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>FIMAZ - UAS</h4>
            <p>Desarrollo Web Avanzado</p>
            <p class="highlight">Dr. José Alfonso Aguilar Calderón</p>
        </div>
        
        <div class="footer-section text-center">
            <h4>Integrantes</h4>
            <ul class="team-list">
                <li>Castillo Torres | Hernández Camacho</li>
                <li>Palacios Navidad | Rubio Ayala | Torrero Rojo</li>
            </ul>
        </div>

        <div class="footer-section text-right">
            <h4>Ubicación</h4>
            <p>Av. Universidad, Av. Leonismo Internacional y, Tellería, 82000 Mazatlán, Sin.<br>C.P. 82000</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2026 Facultad de Informática Mazatlán.</p>
    </div>
</footer>