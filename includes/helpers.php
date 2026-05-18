<?php

add_filter('upload_mimes', function ($mimes) {
  $mimes['json'] = 'application/json';
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
});

function getUrl($relative_path) {
  $file_path = get_template_directory() . '/' . ltrim($relative_path, '/');
  $file_url = get_template_directory_uri() . '/' . ltrim($relative_path, '/');
  if (file_exists($file_path)) {
    return $file_url . '?v=' . filemtime($file_path);
  }
  return $file_url;
}

function dump($var, $label = null, $echo = true) {
  $style = '<style>
  .pretty-dump {
    font-family: monospace;
    font-size: 14px;
    background: #1e1e1e;
    color: #dcdcdc;
    padding: 1em;
    margin: 1em 0;
    border-radius: 8px;
    overflow: auto;
    position: fixed;
    white-space: pre-wrap;
    line-height: 1.4;
    word-break: break-word;
    z-index: 9999999;
    inset: 10%;
  }
  .pretty-dump b {
    color: #9cdcfe;
  }
  .pretty-dump .label {
    font-weight: bold;
    font-size: 1.1em;
    margin-bottom: 0.5em;
    display: block;
    color: #ce9178;
  }
  </style>';
  $output = $style;
  $output .= '<div class="pretty-dump">';
  if ($label) {
    $output .= '<span class="label">' . htmlspecialchars($label) . '</span>';
  }
  $output .= '<pre>' . htmlspecialchars(print_r($var, true)) . '</pre>';
  $output .= '</div>';
  if ($echo) {
    echo $output;
  } else {
    return $output;
  }
}

function console($data): void {
  $json = json_encode($data);
  echo "<script>console.log($json)</script>";
}

function getPosts($slug, $args = []) {
  $defaultArgs = [
    'post_type' => $slug,
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
  ];
  $queryArgs = is_array($args) && !empty($args) ? array_merge($defaultArgs, $args) : $defaultArgs;
  $query = new WP_Query($queryArgs);
  $posts = $query->posts;
  wp_reset_postdata();
  return $posts;
}

function displaySvg($path) {
  $file_path = THEME_PATH . '/' . ltrim($path, '/');
  if (!file_exists($file_path)) {
    return '';
  }
  return file_get_contents($file_path);
}

function title() {
  $title = str_replace(' - ', ' | ', wp_get_document_title());
  return esc_html($title);
}

function preload_fonts() {
  $fonts_dir = get_template_directory() . '/dist/fonts/';
  $fonts_url = get_template_directory_uri() . '/dist/fonts/';
  if (!is_dir($fonts_dir)) {
    return;
  }
  $font_files = glob($fonts_dir . '*');
  foreach ($font_files as $font_file) {
    $filename = basename($font_file);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $font_url = $fonts_url . $filename;
    $mime_type = '';
    switch ($extension) {
      case 'woff2':
        $mime_type = 'font/woff2';
        break;
      case 'woff':
        $mime_type = 'font/woff';
        break;
      case 'ttf':
        $mime_type = 'font/ttf';
        break;
      case 'otf':
        $mime_type = 'font/otf';
        break;
    }

    if ($mime_type) {
      echo '<link rel="preload" href="' .
        esc_url($font_url) .
        '" as="font" type="' .
        $mime_type .
        '" crossorigin>' .
        "\n";
      echo '<noscript><link rel="preload" href="' .
        esc_url($font_url) .
        '" as="font" type="' .
        $mime_type .
        '" crossorigin></noscript>' .
        "\n";
    }
  }
}

function clsx(...$args) {
  $classes = [];

  foreach ($args as $arg) {
    if (!$arg) {
      continue;
    }

    $type = gettype($arg);

    if ($type === 'string' || $type === 'integer') {
      $classes[] = $arg;
    } elseif ($type === 'array') {
      foreach ($arg as $key => $value) {
        if (is_string($key) && $value) {
          $classes[] = $key;
        } elseif (is_int($key) && $value) {
          $classes[] = $value;
        }
      }
    }
  }

  return implode(
    ' ',
    array_filter($classes, function ($class) {
      return is_string($class) && trim($class) !== '';
    })
  );
}

function cleanContent($content) {
  $content = preg_replace('/\[vc_[^\]]*\]|\[\/vc_[^\]]*\]/i', '', $content);
  $content = preg_replace('/\[dt_[^\]]*\]|\[\/dt_[^\]]*\]/i', '', $content);

  while (preg_match('/<span[^>]*>/', $content)) {
    $content = preg_replace('/<span[^>]*>(.*?)<\/span>/is', '$1', $content);
  }

  $content = preg_replace('/<h1([^>]*)>(.*?)<\/h1>/is', '<h2$1>$2</h2>', $content);
  $content = preg_replace('/\s*style\s*=\s*["\'][^"\']*["\']/i', '', $content);
  $content = preg_replace('/<br\s*\/?>/i', '', $content);
  $content = preg_replace('/<hr\s*\/?>/i', '<div class="line"></div>', $content);
  $content = preg_replace('/<p[^>]*>\s*(&nbsp;|\s)*\s*<\/p>/i', '', $content);
  $content = preg_replace('/<div[^>]*>\s*(&nbsp;|\s)*\s*<\/div>/i', '', $content);
  $content = preg_replace('/<div[^>]*>\s*<\/div>/i', '', $content);
  $content = preg_replace('/<figure[^>]*>\s*<\/figure>/i', '', $content);
  $content = preg_replace('/<(\w+)[^>]*>\s*<\/\1>/i', '', $content);
  $content = preg_replace_callback(
    '/<h2[^>]*>(.*?)<\/h2>/is',
    function ($matches) {
      $text = strip_tags($matches[1]);
      if (trim($text)) {
        return '<h2>' . trim($text) . '</h2>';
      }
      return '';
    },
    $content
  );
  $content = preg_replace('/<(\w+)[^>]*>\s*<\/\1>/i', '', $content);
  return $content;
}

if (!function_exists('get_field')) {
  function get_field($selector, $post_id = false) {
    return false;
  }
}

if (!function_exists('get_sub_field')) {
  function get_sub_field($selector) {
    return false;
  }
}

if (!function_exists('have_rows')) {
  function have_rows($selector, $post_id = false) {
    return false;
  }
}

if (!function_exists('the_row')) {
  function the_row() {
    return false;
  }
}

if (!function_exists('get_row_layout')) {
  function get_row_layout() {
    return '';
  }
}
