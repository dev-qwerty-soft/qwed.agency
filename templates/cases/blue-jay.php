<?php

/**
 * Template Name: Blue Jay Case
 * Template Post Type: case
 *
 * Static layout for the Blue Jay vodka brand case study. Photo-heavy frames
 * are PNG exports from Figma; text frames (like About) are rendered as HTML.
 */

if (!defined('ABSPATH')) {
    exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/blue-jay';
?>

<main class="case-blue-jay" id="main-content">
    <div class="case-blue-jay__page">

        <!-- Hero — Desktop-6 (253:18198), photo composition -->
        <section class="case-blue-jay__image-section case-blue-jay__image-section--hero" aria-label="Blue Jay Vodka — brand hero">
            <img src="<?php echo $base; ?>/desktop-6.png" alt="Blue Jay Vodka brand hero" width="1440" height="1024" loading="eager" />
        </section>

        <!-- Small logo overlay near the hero bottom -->
        <section class="case-blue-jay__image-section case-blue-jay__image-section--logo" aria-hidden="true">
            <img src="<?php echo $base; ?>/logo.png" alt="" width="270" height="95" loading="eager" />
        </section>

        <!-- About — Desktop-8 (253:18309), HTML verstka -->
        <section class="case-blue-jay__section case-blue-jay__section--about" aria-labelledby="bj-about-title">
            <div class="case-blue-jay-about">
                <p class="case-blue-jay-about__label">About</p>
                <h2 id="bj-about-title" class="case-blue-jay-about__title">
                    <span class="case-blue-jay-about__accent">Blue Jay</span> is a premium<br />
                    <strong>vodka brand</strong> shaped by purity,<br />
                    crafted with a refined and distinctive identity
                </h2>
                <p class="case-blue-jay-about__lede">The identity was built to reflect the cold, pure, and premium nature of the brand through a sharp symbol, elegant typography, and a restrained visual language</p>

                <div class="case-blue-jay-about__icons">
                    <span class="case-blue-jay-about__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="31" viewBox="0 0 25 31" fill="none">
                            <path d="M0.814689 25.4349C0.414379 25.14 0.134859 24.7155 0.037623 24.2547C-0.0596156 23.7939 0.0333963 23.3347 0.296194 22.9779L10.205 9.52659C12.1867 6.83633 15.4301 5.59421 17.1872 6.3698L21.6462 0.316703C21.7776 0.138328 21.9831 0.0258289 22.2175 0.00395575C22.452 -0.0179172 22.6961 0.0526272 22.8963 0.200069L24.4057 1.31193C24.6058 1.45938 24.7456 1.67164 24.7942 1.90203C24.8428 2.13241 24.7963 2.36206 24.6649 2.54043L20.206 8.59352C21.4676 10.0417 21.243 13.5075 19.2612 16.1978L9.35243 29.6491C9.08963 30.0058 8.67857 30.2308 8.20969 30.2746C7.7408 30.3183 7.25249 30.1772 6.85218 29.8824L0.814689 25.4349Z" fill="white" />
                        </svg></span>
                    <span class="case-blue-jay-about__icon" aria-hidden="true">0,7L</span>
                    <span class="case-blue-jay-about__icon" aria-hidden="true">1L</span>
                </div>

                <div class="case-blue-jay-about__meta">
                    <div class="case-blue-jay-about__meta-row">
                        <span class="case-blue-jay-about__meta-label">Location /</span>
                        <span class="case-blue-jay-about__meta-value">Lviv, Ukraine</span>
                    </div>
                    <div class="case-blue-jay-about__meta-row">
                        <span class="case-blue-jay-about__meta-label">Project /</span>
                        <span class="case-blue-jay-about__meta-value">Blue Jay</span>
                    </div>
                    <div class="case-blue-jay-about__meta-row">
                        <span class="case-blue-jay-about__meta-label">Category /</span>
                        <span class="case-blue-jay-about__meta-value">Alcohol</span>
                    </div>
                    <div class="case-blue-jay-about__meta-row">
                        <span class="case-blue-jay-about__meta-label">Date /</span>
                        <span class="case-blue-jay-about__meta-value">2026</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Colors palette (Desktop-9) — HTML/CSS verstka -->
        <section class="case-blue-jay__section case-blue-jay__section--colors" aria-label="Blue Jay — color palette">
            <div class="case-blue-jay-colors">
                <article class="case-blue-jay-colors__card case-blue-jay-colors__card--dark">
                    <span class="case-blue-jay-colors__hex">182D49</span>
                    <p class="case-blue-jay-colors__name">Dark Blue</p>
                </article>
                <article class="case-blue-jay-colors__card case-blue-jay-colors__card--gray">
                    <span class="case-blue-jay-colors__hex">C0D4DB</span>
                    <p class="case-blue-jay-colors__name">Gray</p>
                </article>
                <article class="case-blue-jay-colors__card case-blue-jay-colors__card--blue">
                    <span class="case-blue-jay-colors__hex">7BCAD9</span>
                    <p class="case-blue-jay-colors__name">Blue</p>
                </article>
            </div>
        </section>

        <!-- Remaining frames as PNG exports -->
        <?php
        $frames = [
            'desktop-5' => ['w' => 1440, 'h' => 1293, 'alt' => 'Blue Jay — brand collateral'],
            'desktop-7' => ['w' => 1440, 'h' => 898, 'alt' => 'Blue Jay — typography'],
            'desktop-12' => ['w' => 1440, 'h' => 1293, 'alt' => 'Blue Jay — applications'],
            'desktop-14' => ['w' => 1440, 'h' => 675, 'alt' => 'Blue Jay — color palette'],
            'desktop-24' => ['w' => 1440, 'h' => 1032, 'alt' => 'Blue Jay — visuals'],
            'desktop-17' => ['w' => 1440, 'h' => 871, 'alt' => 'Blue Jay — composition'],
            'desktop-18' => ['w' => 1440, 'h' => 828, 'alt' => 'Blue Jay — pattern'],
            'desktop-27' => ['w' => 1440, 'h' => 1032, 'alt' => 'Blue Jay — visuals'],
            'desktop-20' => ['w' => 1440, 'h' => 820, 'alt' => 'Blue Jay — mockup'],
            'behance-13' => ['w' => 1440, 'h' => 1443, 'alt' => 'Blue Jay — visuals'],
            'desktop-26' => ['w' => 1440, 'h' => 1033, 'alt' => 'Blue Jay — packaging detail'],
            'desktop-19' => ['w' => 1440, 'h' => 1214, 'alt' => 'Blue Jay — bottle'],
            'desktop-21' => ['w' => 1440, 'h' => 1009, 'alt' => 'Blue Jay — campaign'],
            'desktop-22' => ['w' => 1440, 'h' => 932, 'alt' => 'Blue Jay — final'],
        ];
        foreach ($frames as $slug => $meta):
        ?>
            <section class="case-blue-jay__image-section case-blue-jay__image-section--<?php echo esc_attr($slug); ?>" aria-label="<?php echo esc_attr($meta['alt']); ?>">
                <img src="<?php echo $base; ?>/<?php echo esc_attr($slug); ?>.png" alt="<?php echo esc_attr($meta['alt']); ?>" width="<?php echo (int) $meta['w']; ?>" height="<?php echo (int) $meta['h']; ?>" loading="lazy" />
            </section>
        <?php endforeach; ?>

    </div>
</main>

<?php
get_footer();
