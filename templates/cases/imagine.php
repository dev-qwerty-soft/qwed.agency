<?php
/**
 * Template Name: Imagine Case
 * Template Post Type: case
 *
 * Imagine brand case study — all 20 frames currently rendered as PNG exports
 * from Figma. Text-heavy frames can be refactored to HTML/CSS on request.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/imagine';

$frames = [
  'desktop-6'  => ['w' => 1440, 'h' => 1024, 'alt' => 'Imagine — hero'],
  'desktop-7'  => ['w' => 1440, 'h' => 608,  'alt' => 'Imagine — section'],
  'desktop-39' => ['w' => 1440, 'h' => 824,  'alt' => 'Imagine — section'],
  'desktop-8'  => ['w' => 1440, 'h' => 1008, 'alt' => 'Imagine — section'],
  'desktop-9'  => ['w' => 1440, 'h' => 783,  'alt' => 'Imagine — section'],
  'desktop-10' => ['w' => 1440, 'h' => 988,  'alt' => 'Imagine — section'],
  'desktop-13' => ['w' => 1440, 'h' => 1061, 'alt' => 'Imagine — section'],
  'desktop-35' => ['w' => 1440, 'h' => 1198, 'alt' => 'Imagine — section'],
  'desktop-16' => ['w' => 1440, 'h' => 1198, 'alt' => 'Imagine — section'],
  'desktop-19' => ['w' => 1440, 'h' => 1089, 'alt' => 'Imagine — section'],
  'desktop-36' => ['w' => 1440, 'h' => 2545, 'alt' => 'Imagine — section'],
  'group-1'    => ['w' => 1440, 'h' => 873,  'alt' => 'Imagine — section'],
  'desktop-26' => ['w' => 1440, 'h' => 1226, 'alt' => 'Imagine — section'],
  'group-2'    => ['w' => 1440, 'h' => 976,  'alt' => 'Imagine — section'],
  'desktop-38' => ['w' => 1440, 'h' => 1202, 'alt' => 'Imagine — section'],
  'desktop-37' => ['w' => 1440, 'h' => 1060, 'alt' => 'Imagine — section'],
  'desktop-28' => ['w' => 1440, 'h' => 784,  'alt' => 'Imagine — section'],
  'desktop-32' => ['w' => 1440, 'h' => 724,  'alt' => 'Imagine — section'],
  'desktop-31' => ['w' => 1440, 'h' => 1219, 'alt' => 'Imagine — section'],
  'desktop-33' => ['w' => 1440, 'h' => 1120, 'alt' => 'Imagine — final'],
];
?>

<main class="case-imagine" id="main-content">
    <div class="case-imagine__page">
        <?php foreach ($frames as $slug => $meta): ?>
        <section class="case-imagine__image-section case-imagine__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>">
            <img src="<?php echo $base; ?>/<?php echo esc_attr($slug); ?>.png" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy" />
        </section>
        <?php endforeach; ?>
    </div>
</main>

<?php
get_footer();
