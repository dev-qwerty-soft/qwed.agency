<?php
/**
 * Template Name: PartPilot Case
 * Template Post Type: case
 *
 * PartPilot case study — Figma section 1009:225103 (Behance Light).
 * Original Desktop-21 (19065px) was split into 13 sub-PNGs at @3x to get
 * sharp text rendering instead of one stretched @1x monolith.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/part-pilot';

// `gap` is the design spacing between this section and the next one (Figma).
$frames = [
  'desktop-60'     => ['w' => 1440, 'h' => 1072,  'gap' => 0,   'alt' => 'PartPilot — hero'],
  'desktop-18'     => ['w' => 1440, 'h' => 914,   'gap' => 0,   'alt' => 'PartPilot — project overview'],
  'desktop-19'     => ['w' => 1440, 'h' => 1299,  'gap' => 0,   'alt' => 'PartPilot — Logo Design'],
  'desktop-20'     => ['w' => 1440, 'h' => 1172,  'gap' => 0,   'alt' => 'PartPilot — section'],
  // Desktop-21 split — 13 sub-PNGs at @3x (one @2x) for sharp inside text.
  'd21-01-hero'    => ['w' => 1212, 'h' => 674,   'gap' => 290, 'alt' => 'PartPilot — manufacturing hero'],
  'd21-02-group'   => ['w' => 1410, 'h' => 947,   'gap' => 290, 'alt' => 'PartPilot — section'],
  'd21-03-scene10' => ['w' => 1440, 'h' => 1080,  'gap' => 280, 'alt' => 'PartPilot — scene'],
  'd21-04-group'   => ['w' => 1352, 'h' => 961,   'gap' => 280, 'alt' => 'PartPilot — section'],
  'd21-05-group'   => ['w' => 1410, 'h' => 965,   'gap' => 290, 'alt' => 'PartPilot — Logo Design'],
  'd21-06-categories' => ['w' => 1410, 'h' => 1237, 'gap' => 290, 'alt' => 'PartPilot — Sizes / Materials / Geometries / Surface conditions'],
  'd21-07-bigblock' => ['w' => 1410, 'h' => 3271, 'gap' => 290, 'alt' => 'PartPilot — main mockup'],
  'd21-08-group'   => ['w' => 1410, 'h' => 717,   'gap' => 290, 'alt' => 'PartPilot — section'],
  'd21-09-group'   => ['w' => 1151, 'h' => 1474,  'gap' => 280, 'alt' => 'PartPilot — section'],
  'd21-10-frame'   => ['w' => 1449, 'h' => 844,   'gap' => 280, 'alt' => 'PartPilot — frame'],
  'd21-11-group'   => ['w' => 989,  'h' => 634,   'gap' => 280, 'alt' => 'PartPilot — section'],
  'd21-12-group'   => ['w' => 1121, 'h' => 888,   'gap' => 20,  'alt' => 'PartPilot — section'],
  'd21-13-mockup'  => ['w' => 884,  'h' => 1032,  'gap' => 0,   'alt' => 'PartPilot — mockup'],
  'final'          => ['w' => 1440, 'h' => 697,   'gap' => 0,   'alt' => 'PartPilot — closing'],
];
?>

<main class="case-part-pilot" id="main-content">
    <div class="case-part-pilot__page">
        <?php foreach ($frames as $slug => $meta):
          $gap_attr = !empty($meta['gap']) ? ' style="margin-bottom: ' . (int) $meta['gap'] . 'px;"' : ''; ?>
        <section class="case-part-pilot__image-section case-part-pilot__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>" data-aos="fade-up"<?php echo $gap_attr; ?>>
            <img src="<?php echo $base; ?>/<?php echo esc_attr($slug); ?>.png" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="<?php echo $slug === 'desktop-60' ? 'eager' : 'lazy'; ?>" />
        </section>
        <?php endforeach; ?>
    </div>
</main>

<?php
get_footer();
