<?php
/**
 * Template Name: Cobble Case
 * Template Post Type: case
 *
 * Desktop from 1114:147289 (1440px), mobile from 2349:216681 (375px).
 * Sections 9, 11 are JPG; 14, 23, 24 desktop exported at 0.5x (off-canvas elements).
 */

if (!defined('ABSPATH')) {
    exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/cobble';

$frames = [
    'section-1'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — hero',                'mob_ext' => 'png', 'mob_h' => 266],
    'section-2'  => ['ext' => 'png', 'w' => 1440, 'h' => 1648, 'alt' => 'Cobble — concept',             'mob_ext' => 'png', 'mob_h' => 860],
    'section-3'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — player',              'mob_ext' => 'png', 'mob_h' => 460],
    'section-4'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — content',             'mob_ext' => 'png', 'mob_h' => 1068],
    'section-5'  => ['ext' => 'jpg', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — content',             'mob_ext' => 'png', 'mob_h' => 1068],
    'section-6'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — uncover',             'mob_ext' => 'png', 'mob_h' => 674],
    'section-7'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — content',             'mob_ext' => 'png', 'mob_h' => 1068],
    'section-8'  => ['ext' => 'png', 'w' => 1440, 'h' => 1612, 'alt' => 'Cobble — map',                 'mob_ext' => 'png', 'mob_h' => 920],
    'section-9'  => ['ext' => 'jpg', 'w' => 1440, 'h' => 3286, 'alt' => 'Cobble — typeface and colors', 'mob_ext' => 'jpg', 'mob_h' => 2100],
    'section-10' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — final',               'mob_ext' => 'png', 'mob_h' => 266],
    'section-11' => ['ext' => 'jpg', 'w' => 1440, 'h' => 3084, 'alt' => 'Cobble — section 11',          'mob_ext' => 'jpg', 'mob_h' => 2078],
    'section-12' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 12',          'mob_ext' => 'png', 'mob_h' => 266],
    'section-13' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 13',          'mob_ext' => 'png', 'mob_h' => 266],
    'section-14' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 14',          'mob_ext' => 'png', 'mob_h' => 267],
    'section-15' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 15',          'mob_ext' => 'png', 'mob_h' => 1068],
    'section-16' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 16',          'mob_ext' => 'png', 'mob_h' => 1068],
    'section-17' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 17',          'mob_ext' => 'png', 'mob_h' => 1068],
    'section-18' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 18',          'mob_ext' => 'png', 'mob_h' => 267],
    'section-19' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 19',          'mob_ext' => 'png', 'mob_h' => 266],
    'section-20' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 20',          'mob_ext' => 'png', 'mob_h' => 534],
    'section-21' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 21',          'mob_ext' => 'png', 'mob_h' => 534],
    'section-22' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 22',          'mob_ext' => 'png', 'mob_h' => 534],
    'section-23' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 23',          'mob_ext' => 'png', 'mob_h' => 266],
    'section-24' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — section 24',          'mob_ext' => 'png', 'mob_h' => 266],
];
?>

<main class="case-cobble" id="main-content">
    <div class="case-cobble__page">
        <?php foreach ($frames as $slug => $meta): ?>
            <section class="case-cobble__image-section case-cobble__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>">
                <picture>
                    <source srcset="<?php echo $base . '/mobile/' . esc_attr($slug) . '.' . esc_attr($meta['mob_ext']); ?>" media="(max-width: 768px)">
                    <img src="<?php echo $base . '/' . esc_attr($slug) . '.' . esc_attr($meta['ext']); ?>" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy">
                </picture>
            </section>
        <?php endforeach; ?>
    </div>
</main>

<?php
get_footer();
