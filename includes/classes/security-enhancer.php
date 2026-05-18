<?php

if (!defined('ABSPATH')) {
  exit();
}

class SecurityEnhancer {
  public function __construct() {
    add_action('wp_head', [$this, 'add_security_headers']);
    add_filter('wp_headers', [$this, 'add_security_headers_filter']);
    add_action('wp_ajax_rate_limit', [$this, 'rate_limit_check']);
    add_action('wp_ajax_nopriv_rate_limit', [$this, 'rate_limit_check']);
  }

  public function add_security_headers() {
    if (!headers_sent()) {
      header('X-Content-Type-Options: nosniff');
      header('X-Frame-Options: SAMEORIGIN');
      header('X-XSS-Protection: 1; mode=block');
      header('Referrer-Policy: strict-origin-when-cross-origin');
      header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com data:; img-src 'self' data: https:; connect-src 'self'; frame-ancestors 'self';");
      header("Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()");
    }
  }

  public function add_security_headers_filter($headers) {
    $headers['X-Content-Type-Options'] = 'nosniff';
    $headers['X-Frame-Options'] = 'SAMEORIGIN';
    $headers['X-XSS-Protection'] = '1; mode=block';
    $headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';
    $headers['Content-Security-Policy'] = "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com data:; img-src 'self' data: https:; connect-src 'self'; frame-ancestors 'self';";
    $headers['Permissions-Policy'] = 'camera=(), microphone=(), geolocation=(), payment=()';
    return $headers;
  }

  public function rate_limit_check() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = 'rate_limit_' . md5($ip);
    $requests = get_transient($key) ?: 0;

    if ($requests >= 30) {
      wp_die('Rate limit exceeded', 429);
    }

    set_transient($key, $requests + 1, HOUR_IN_SECONDS);
  }
}
