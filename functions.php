<?php

if (!defined('ABSPATH')) {
  exit();
}

define('THEME_VERSION', '1.0.0');
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());

require_once THEME_PATH . '/includes/helpers.php';
require_once THEME_PATH . '/includes/classes/theme-setup.php';
require_once THEME_PATH . '/includes/classes/assets-manager.php';
require_once THEME_PATH . '/includes/classes/ajax-controller.php';
require_once THEME_PATH . '/includes/classes/acf-settings.php';
require_once THEME_PATH . '/includes/classes/security-enhancer.php';
require_once THEME_PATH . '/includes/classes/seo-enhancer.php';
require_once THEME_PATH . '/includes/classes/performance-enhancer.php';

new ThemeSetup();
new AssetsManager();
new AjaxController();
new ACFSettings();
new SecurityEnhancer();
new SEOEnhancer();
new PerformanceEnhancer();
