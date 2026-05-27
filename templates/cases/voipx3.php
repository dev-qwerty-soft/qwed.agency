<?php
/**
 * Template Name: VOIPx3 Case
 * Template Post Type: case
 *
 * VOIPx3 case study — Hero + About (HTML) + 12 PNG product/mockup sections.
 * Frame source: Figma node 642:67335.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/voipx3';

$frames = [
  'cloud-video'   => ['w' => 1107, 'h' => 955,  'alt' => 'Cloud Video Security mockup'],
  'identity'      => ['w' => 1404, 'h' => 1983, 'alt' => 'VOIPx3 brand identity'],
  'typography'   => ['w' => 1166, 'h' => 679,  'alt' => 'Typography & Colors'],
  'schools'       => ['w' => 1404, 'h' => 1450, 'alt' => 'Communication systems for schools'],
  'business-phone'=> ['w' => 1370, 'h' => 1827, 'alt' => 'Business phone solutions + AI voice agents'],
  'shop'          => ['w' => 1404, 'h' => 1828, 'alt' => 'Shop & catalog mockup'],
  'faq'           => ['w' => 1439, 'h' => 3701, 'alt' => 'FAQ + testimonials'],
  'plans'         => ['w' => 1404, 'h' => 897,  'alt' => 'Plans & pricing'],
  'social-media'  => ['w' => 1278, 'h' => 1703, 'alt' => 'Social media campaign'],
  'ai-vision'     => ['w' => 1404, 'h' => 970,  'alt' => 'AI Vision suspicious activity detection'],
  'support'       => ['w' => 1404, 'h' => 1382, 'alt' => '404 / support flow'],
  'services'      => ['w' => 1192, 'h' => 737,  'alt' => 'Services tags'],
];
?>

<main class="case-voipx3" id="main-content">
    <div class="case-voipx3__page">

        
        <section class="case-voipx3__hero" aria-label="VOIPx3 — hero composition">
            <img src="<?php echo $base; ?>/hero.png" alt="VOIPx3 hero with MacBook mockup of the platform homepage" width="1440" height="1789" loading="eager" />
        </section>

        
        <section class="case-voipx3__section case-voipx3__section--about" aria-labelledby="voip-about-lead">
            <div class="case-voipx3-about">
                <div class="case-voipx3-about__top">
                    <div class="case-voipx3-about__pill">
                        <span class="case-voipx3-about__pill-number">01</span>
                        <span class="case-voipx3-about__pill-label">About</span>
                    </div>
                    <div class="case-voipx3-about__meta">
                        <span class="case-voipx3-about__meta-item">Industry / AI</span>
                        <span class="case-voipx3-about__meta-item">Location / Texas</span>
                        <span class="case-voipx3-about__meta-item">Date / 2026</span>
                    </div>
                </div>

                <p id="voip-about-lead" class="case-voipx3-about__lead">This platform has been engineered for forward-thinking businesses, providing an AI-enhanced ecosystem that ensures seamless connectivity and a premium communication experience worldwide.</p>

                <div class="case-voipx3-about__footer">
                    <p class="case-voipx3-about__blurb">We were tasked with designing a landing page and developing a visual identity for VOIPx3, an AI-driven unified communications platform. Our team focused on creating a modern, high-tech interface that highlights the product's reliability and advanced features</p>

                    <div class="case-voipx3-about__brand">
                        <div class="case-voipx3-about__brand-card">
                            <img class="case-voipx3-about__brand-logo" src="<?php echo $base; ?>/voip-logo.png" alt="VOIPx3" width="161" height="33" />
                        </div>
                        <ul class="case-voipx3-about__brand-tags">
                            <li class="case-voipx3-about__brand-tag">UX/UI</li>
                            <li class="case-voipx3-about__brand-tag">App/Web</li>
                            <li class="case-voipx3-about__brand-tag">SaaS</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php foreach ($frames as $slug => $meta): ?>
        <section class="case-voipx3__image-section case-voipx3__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>">
            <img src="<?php echo $base; ?>/<?php echo esc_attr($slug); ?>.png" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy" />
        </section>
        <?php endforeach; ?>

    </div>
</main>

<?php
get_footer();
