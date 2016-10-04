</body>
<footer id="footer" class="cs-fcc">
    <div id="map-iframe" class="hidden">
        <div id="map-overlay"></div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3002.792780895281!2d-77.32535278455312!3d41.182686679283385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89cef8fc9caf242f%3A0xc5fd059b7e6c0fbb!2s3265+Woodward+Ave%2C+Avis%2C+PA+17721!5e0!3m2!1sen!2sus!4v1475524783636" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
        <button id="toggle-overlay">Remove Overlay</button>
    </div>
    <div class="max-width">
        <div class="contact-info">
            <div class="site-name">
                <h1>Avis Building Supply</h1>
            </div>
            <div class="address cs-fcc">
                <p>3265 Woodward Ave.<br/>Avis, PA 17721</p>
                <p>Phone: 570-753-5332</p>
                <button id="map-btn" class="cs-fc cs-aic">Directions<img src="<?php bloginfo('stylesheet_directory'); ?>/img/map-icon.png" height="30" width="30"></button>
            </div>
        </div>
        <?php if(is_active_sidebar('quicklinks')): ?>
            <div id="quicklinks" >
                <?php dynamic_sidebar('quicklinks'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="copyright cs-fc">
        <div class="max-width cs-fc cs-jc">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - Designed &amp; Developed by Christopher Schultz - <?php wp_loginout(); ?></p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</html>