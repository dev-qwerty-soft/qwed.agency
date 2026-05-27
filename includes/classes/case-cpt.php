<?php
/**
 * Registers the "case" custom post type used for portfolio case studies.
 *
 * URL pattern: /case/{slug}/
 * Each case has a static, per-slug template under templates/cases/{slug}.php
 * routed by single-case.php.
 */

if (!defined('ABSPATH')) {
  exit();
}

class CaseCPT {
  const POST_TYPE = 'case';
  const TEMPLATES_DIR = 'templates/cases';

  public function __construct() {
    add_action('init', [$this, 'register']);
    // WP only scans templates 1 level deep from the theme root, so files under
    // templates/cases/*.php are invisible to the built-in scanner. Register them
    // manually so they appear in the admin Template dropdown and load on the front.
    add_filter('theme_' . self::POST_TYPE . '_templates', [$this, 'register_templates'], 10, 4);
    add_filter('template_include', [$this, 'load_selected_template']);
  }

  public function register_templates($post_templates, $theme, $post, $post_type) {
    $dir = THEME_PATH . '/' . self::TEMPLATES_DIR;
    if (!is_dir($dir)) {
      return $post_templates;
    }
    foreach (glob($dir . '/*.php') as $file) {
      $data = get_file_data($file, ['name' => 'Template Name']);
      $name = isset($data['name']) ? trim($data['name']) : '';
      if ($name === '') {
        continue;
      }
      $relative = self::TEMPLATES_DIR . '/' . basename($file);
      $post_templates[$relative] = $name;
    }
    return $post_templates;
  }

  public function load_selected_template($template) {
    if (!is_singular(self::POST_TYPE)) {
      return $template;
    }
    $selected = get_page_template_slug(get_queried_object_id());
    if (!is_string($selected) || $selected === '') {
      return $template;
    }
    $candidate = THEME_PATH . '/' . $selected;
    if (file_exists($candidate)) {
      return $candidate;
    }
    return $template;
  }

  public function register() {
    $labels = [
      'name' => 'Cases',
      'singular_name' => 'Case',
      'menu_name' => 'Cases',
      'name_admin_bar' => 'Case',
      'add_new' => 'Add Case',
      'add_new_item' => 'Add new Case',
      'edit_item' => 'Edit Case',
      'new_item' => 'New Case',
      'view_item' => 'View Case',
      'search_items' => 'Search Cases',
      'not_found' => 'No cases found',
      'not_found_in_trash' => 'No cases in trash',
      'all_items' => 'All Cases',
    ];

    register_post_type(self::POST_TYPE, [
      'label' => 'Cases',
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-portfolio',
      'menu_position' => 20,
      'has_archive' => false,
      'hierarchical' => false,
      'rewrite' => [
        'slug' => 'case',
        'with_front' => false,
      ],
      'capability_type' => 'post',
      // page-attributes is required so the "Template" dropdown shows up in the
      // admin sidebar — that's how the user picks which case layout to render.
      'supports' => ['title', 'thumbnail', 'page-attributes'],
    ]);
  }
}
