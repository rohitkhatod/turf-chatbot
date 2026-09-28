<?php
if (! defined('ABSPATH')) {
    exit;
}
?>
</main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <h3>Tirupathi Agro</h3>
      <p>Reliable agriculture solutions for better yield and sustainable growth.</p>
    </div>
    <div>
      <h4>Quick Links</h4>
      <?php
      wp_nav_menu([
          'theme_location' => 'footer',
          'container'      => false,
          'menu_class'     => 'footer-menu',
          'fallback_cb'    => false,
      ]);
      ?>
    </div>
    <div>
      <h4>Contact</h4>
      <p>Email: info@tirupathiagro.com</p>
      <p>Phone: +91-00000-00000</p>
    </div>
  </div>
  <div class="copyright">© <?php echo esc_html(wp_date('Y')); ?> Tirupathi Agro. All rights reserved.</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
