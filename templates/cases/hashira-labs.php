<?php
/**
 * Template Name: HashiraLabs Case
 * Template Post Type: case
 *
 * HashiraLabs case study — Figma frame 475:61695.
 * Hero + 13 PNG product/mockup sections in vertical flow.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/hashira-labs';

$frames = [
  'intro-quote'  => ['w' => 1134, 'h' => 285,  'alt' => 'Co-Founder quote'],
  'about-block'  => ['w' => 1340, 'h' => 482,  'alt' => 'About HashiraLabs platform'],
  'project-meta' => ['w' => 1340, 'h' => 1710, 'alt' => 'Project overview'],
  'section-04'   => ['w' => 1440, 'h' => 2308, 'alt' => 'HashiraLabs section'],
  'section-05'   => ['w' => 1340, 'h' => 733,  'alt' => 'HashiraLabs section'],
  'section-06'   => ['w' => 1490, 'h' => 1117, 'alt' => 'HashiraLabs section'],
  'section-07'   => ['w' => 1340, 'h' => 2423, 'alt' => 'HashiraLabs section'],
  'section-08'   => ['w' => 1340, 'h' => 683,  'alt' => 'HashiraLabs section'],
  'section-09'   => ['w' => 1360, 'h' => 2187, 'alt' => 'HashiraLabs section'],
  'section-10'   => ['w' => 1360, 'h' => 552,  'alt' => 'HashiraLabs section'],
  'section-11'   => ['w' => 1360, 'h' => 2242, 'alt' => 'HashiraLabs section'],
  'section-12'   => ['w' => 1340, 'h' => 668,  'alt' => 'HashiraLabs section'],
  'section-13'   => ['w' => 1340, 'h' => 715,  'alt' => 'HashiraLabs final section'],
];
?>

<main class="case-hashira-labs" id="main-content">
    <div class="case-hashira-labs__page">

        <section class="case-hashira-labs__hero" aria-label="HashiraLabs hero">
            <img src="<?php echo $base; ?>/hero.png" alt="HashiraLabs platform hero" width="1141" height="948" loading="eager" />
        </section>

        <?php foreach ($frames as $slug => $meta): ?>
        <section class="case-hashira-labs__image-section case-hashira-labs__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>" data-aos="fade-up">
            <img src="<?php echo $base; ?>/<?php echo esc_attr($slug); ?>.png" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy" />
        </section>
        <?php endforeach; ?>

    </div>
</main>

<?php
get_footer();
