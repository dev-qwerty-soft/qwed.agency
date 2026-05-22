<?php
/**
 * Template Name: Cobble Case
 * Template Post Type: case
 *
 * Static layout for the Cobble case study. All frames are PNG/JPG exports
 * from Figma Frame 5 (1114:147289, 1440x17466). Sections 7 and 9 are JPG
 * because Figma's PNG renderer timed out on the heavy nested content.
 */

if (!defined('ABSPATH')) {
    exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/cobble';

$frames = [
    'section-1'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — hero'],
    'section-2'  => ['ext' => 'png', 'w' => 1440, 'h' => 1648, 'alt' => 'Cobble — concept'],
    'section-3'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — player'],
    'section-4'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — content'],
    'section-5'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — content'],
    'section-6'  => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — uncover'],
    'section-7'  => ['ext' => 'jpg', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — content'],
    'section-8'  => ['ext' => 'png', 'w' => 1440, 'h' => 1612, 'alt' => 'Cobble — map'],
    'section-9'  => ['ext' => 'jpg', 'w' => 1440, 'h' => 3286, 'alt' => 'Cobble — typeface and colors'],
    'section-10' => ['ext' => 'png', 'w' => 1440, 'h' => 1024, 'alt' => 'Cobble — final'],
];
?>

<main class="case-cobble" id="main-content">
    <div class="case-cobble__page">
        <?php foreach ($frames as $slug => $meta): ?>
            <section class="case-cobble__image-section case-cobble__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>">
                <img src="<?php echo $base . '/' . esc_attr($slug) . '.' . esc_attr($meta['ext']); ?>" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy" />
            </section>
        <?php endforeach; ?>
    </div>
</main>

<?php
get_footer();
