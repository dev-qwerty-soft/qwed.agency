<?php get_header(); ?>
<main id="main-content">
  <section class="error-section">
    <div class="container">
      <h1 class="error-section__title">404</h1>
      <p class="error-section__message">Page not found.</p>
      <div class="error-section__actions">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">Go Home</a>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
