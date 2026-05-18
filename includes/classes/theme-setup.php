<?php

if (!defined('ABSPATH')) {
  exit();
}

class ThemeSetup {
  public function __construct() {
    add_action('after_setup_theme', [$this, 'setup']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('init', [$this, 'init']);

    // Include separate setup files if they exist
    $setup_files = [
      '/includes/setup/menus.php',
      '/includes/setup/clean-head.php',
      '/includes/setup/disable-comments.php',
    ];

    foreach ($setup_files as $file) {
      if (file_exists(THEME_PATH . $file)) {
        require_once THEME_PATH . $file;
      }
    }
  }

  public function setup() {
    load_theme_textdomain('custom-base-theme', THEME_PATH . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', [
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ]);

    // Image sizes
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('card-image', 400, 300, true);
  }

  /**
   * Enqueue assets
   */
  public function enqueue_assets() {
    // CSS
    wp_enqueue_style('theme-styles', THEME_URL . '/dist/css/index.min.css', [], THEME_VERSION);

    // JS
    wp_enqueue_script(
      'theme-scripts',
      THEME_URL . '/dist/js/index.min.js',
      [],
      THEME_VERSION,
      true
    );

    // Localization
    wp_localize_script('theme-scripts', 'themeAjax', [
      'ajaxurl' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('theme_nonce'),
    ]);

    // Per-case page assets — loaded based on the template selected for the current case.
    // Template path looks like "templates/cases/{key}.php"; the bundle key is "case-{key}".
    if (is_singular('case')) {
      $template = get_page_template_slug(get_queried_object_id());
      if (is_string($template) && preg_match('#^templates/cases/([a-z0-9_-]+)\.php$#', $template, $m)) {
        $key = $m[1];
        $handle = 'theme-case-' . $key;
        $css = THEME_PATH . '/dist/css/case-' . $key . '.min.css';
        if (file_exists($css)) {
          wp_enqueue_style(
            $handle,
            THEME_URL . '/dist/css/case-' . $key . '.min.css',
            ['theme-styles'],
            THEME_VERSION
          );
        }
        $js = THEME_PATH . '/dist/js/case-' . $key . '.min.js';
        if (file_exists($js)) {
          wp_enqueue_script(
            $handle,
            THEME_URL . '/dist/js/case-' . $key . '.min.js',
            [],
            THEME_VERSION,
            true
          );
        }
      }
    }
  }

  /**
   * Initialize theme
   */
  public function init() {
    // ACF Options Page
    if (function_exists('acf_add_options_page')) {
      acf_add_options_page([
        'page_title' => __('General theme settings', 'custom-theme'),
        'menu_title' => __('Theme settings', 'custom-theme'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
      ]);
    }
  }
}
