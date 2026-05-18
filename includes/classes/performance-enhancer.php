<?php

if (!defined('ABSPATH')) {
  exit();
}

class PerformanceEnhancer {
  public function __construct() {
    add_action('wp_head', [$this, 'add_critical_css']);
    add_filter('the_content', [$this, 'add_lazy_loading']);
    add_action('wp_footer', [$this, 'add_preload_resources']);
  }

  public function add_critical_css() {
    $critical_css = "body{display:flex;flex-direction:column;min-height:100vh}.container{max-width:1280px;width:100%;margin:0 auto;padding:0 40px}.header{position:sticky;top:0;z-index:100;background:#fff}.header__content{display:flex;align-items:center;justify-content:space-between;height:72px}";
    echo "<style id='critical-css'>{$critical_css}</style>\n";
  }

  public function add_lazy_loading($content) {
    return preg_replace_callback(
      '/<img([^>]+)>/i',
      function ($matches) {
        $img = $matches[0];

        if (strpos($img, 'loading=') === false) {
          $img = str_replace('<img', '<img loading="lazy"', $img);
        }

        return $img;
      },
      $content
    );
  }

  public function add_preload_resources() {
    preload_fonts();
  }
}
