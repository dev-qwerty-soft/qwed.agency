<footer class="footer">
  <div class="container">


    <div class="footer__menus">
      <div class="footer__logo">
        <?php if (function_exists('get_field')) {
          $footer_logo = get_field('footer_logo', 'option');
          if ($footer_logo) { ?>
            <img src="<?php echo esc_url($footer_logo['url']); ?>"
              alt="<?php echo esc_attr($footer_logo['alt']); ?>"
              draggable="false">
        <?php } else {if (has_custom_logo()) {
              the_custom_logo();
            }}
        } else {
          if (has_custom_logo()) {
            the_custom_logo();
          }
        } ?>

      </div>

      <nav class="footer__menu">
        <?php wp_nav_menu([
          'theme_location' => 'footer-menu',
          'container' => false,
          'menu_class' => 'footer__menu',
          'fallback_cb' => function () {
            echo '<ul class="footer__menu-aside">';
            echo '<li><a href="' . home_url('/about') . '">About</a></li>';
            echo '<li><a href="' . home_url('/contact') . '">Contact</a></li>';
            echo '</ul>';
          },
        ]); ?>
      </nav>
    </div>

    <div class="footer__bottom">
      <p class="copyright">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
        Developed by <a href="https://qwerty-soft.com/" target="_blank" rel="noopener">Qwerty Soft</a>
      </p>
      <nav class="footer__menu-aside">
        <?php wp_nav_menu([
          'theme_location' => 'footer-menu-aside',
          'container' => false,
          'menu_class' => 'footer__menu-aside',
          'fallback_cb' => function () {
            echo '<ul class="footer__menu">';
            echo '<li><a href="' . home_url('/privacy') . '">Privacy</a></li>';
            echo '<li><a href="' . home_url('/terms') . '">Terms</a></li>';
            echo '</ul>';
          },
        ]); ?>
      </nav>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>