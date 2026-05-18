<!DOCTYPE html>
<html lang="<?= get_bloginfo('language') ?>" dir="<?= is_rtl() ? 'rtl' : 'ltr' ?>">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= title() ?></title>
  <?php preload_fonts(); ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="header" role="banner">
        <div class="container">
            <div class="header__content">
                <div class="header__logo">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php if (is_front_page()): ?>
                                <h1><?php bloginfo('name'); ?></h1>
                            <?php else: ?>
                                <span><?php bloginfo('name'); ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <nav class="header__nav" aria-label="Main navigation">
                    <?php wp_nav_menu([
                      'theme_location' => 'header-menu',
                      'container' => false,
                      'menu_class' => 'header__menu',
                      'fallback_cb' => function () {
                        echo '<ul class="header__menu">';
                        echo '<li><a href="' . home_url() . '">Home</a></li>';
                        echo '<li><a href="' . home_url('/about') . '">About</a></li>';
                        echo '<li><a href="' . home_url('/contact') . '">Contact</a></li>';
                        echo '</ul>';
                      },
                    ]); ?>
                </nav>
                <button class="burger" id="mobile-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <nav class="mobile-menu__nav" aria-label="Mobile navigation">
            <?php wp_nav_menu([
              'theme_location' => 'header-menu',
              'container' => false,
              'menu_class' => 'mobile-menu__list',
              'fallback_cb' => function () {
                echo '<ul class="mobile-menu__list">';
                echo '<li><a href="' . home_url() . '">Home</a></li>';
                echo '<li><a href="' . home_url('/about') . '">About</a></li>';
                echo '<li><a href="' . home_url('/contact') . '">Contact</a></li>';
                echo '</ul>';
              },
            ]); ?>
        </nav>
    </div>