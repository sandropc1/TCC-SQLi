<footer id="footer">
        <div id="social-container">
        <ul>
            <li>
            <a href="https://www.linkedin.com/in/sandrochriste/"><i class="fab fa-linkedin"></i></a>
            </li>
            <li>
            <a href="https://www.instagram.com/sandropchriste/"><i class="fab fa-instagram"></i></a>
            </li>
            <li>
            <a href="https://github.com/sandropc1"><i class="fab fa-github"></i></a>
            </li>
        </ul>
        </div>
        <div id = "footer-links-container">
            <ul>
                <!--
                <li><a href="#">Adicionar objeto</a></li>
                
                <li><a href="#">Adicionar review</a></li>
                -->
                <?php if(!$userData): ?>
                <li><a href="<?= $BASE_URL ?>auth.php">Entrar / Registrar</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <p>&copy; 2025 Sandro Pinheiro Christe</p>
    </div>
    </footer>
    <!--JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.js" integrity="sha512-lsA4IzLaXH0A+uH6JQTuz6DbhqxmVygrWv1CpC/s5vGyMqlnP0y+RYt65vKxbaVq+H6OzbbRtxzf+Zbj20alGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>