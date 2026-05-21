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
  // desktop-7 is now HTML (manifesto) — see the <section> block below
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

        <!-- Hero — Desktop-6 (311:9949), full PNG -->
        <section class="case-imagine__image-section case-imagine__image-section--desktop-6" aria-label="Imagine — hero">
            <img src="<?php echo $base; ?>/desktop-6.png" alt="Imagine — hero" width="1440" height="1024" loading="eager" />
        </section>

        <!-- Editorial Platform manifesto — Desktop-7 (311:10006), HTML/CSS -->
        <section class="case-imagine__section case-imagine__section--manifesto" aria-labelledby="im-manifesto-text">
            <div class="im-manifesto">
                <span class="im-manifesto__tag">Editorial Platform</span>
                <p id="im-manifesto-text" class="im-manifesto__text">
                    <img class="im-manifesto__mark" src="<?php echo $base; ?>/imagine-mark.png" alt="IMAGINE" width="152" height="36" />
                    is a brand new magazine and media brand where high fashion, entertainment and popular culture converge. Built to reflect and predict the cultural zeitgeist, it champions creativity, optimism, and the voices of the moment &mdash; all through a striking, aesthetic lens. IMAGINE will publish a collectible bi-annual print edition &mdash; a bold, boundary-pushing celebration of icons and emerging voices across fashion, film, music, art, and design. Crucially, IMAGINE provides a much-needed dose of positivity in a time of societal and political upheaval &mdash; a visual balm, where beauty and optimism intersect
                </p>
            </div>
        </section>

        <!-- Remaining PNG frames -->
        <?php foreach ($frames as $slug => $meta): if ($slug === 'desktop-6') continue; ?>
        <section class="case-imagine__image-section case-imagine__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>">
            <img src="<?php echo $base; ?>/<?php echo esc_attr($slug); ?>.png" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy" />
        </section>
        <?php endforeach; ?>
    </div>
</main>

<?php
get_footer();
