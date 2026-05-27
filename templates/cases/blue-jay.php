<?php

/**
 * Template Name: Blue Jay Case
 * Template Post Type: case
 */

if (!defined('ABSPATH')) {
    exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/blue-jay';
?>

<main class="case-blue-jay" id="main-content">
    <div class="case-blue-jay__page">

        <section class="case-blue-jay__image-section case-blue-jay__image-section--hero" aria-label="Blue Jay Vodka — brand hero">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-6.png" alt="Blue Jay Vodka brand hero" width="1440" height="1024" loading="eager" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-1.png" alt="" width="686" height="512" loading="eager" />
        </section>

        <section class="case-blue-jay__section case-blue-jay__section--about" aria-labelledby="bj-about-title">
            <div class="case-blue-jay-about">
                <p class="case-blue-jay-about__label">About</p>
                <h2 id="bj-about-title" class="case-blue-jay-about__title">
                    <span class="case-blue-jay-about__accent">Blue Jay</span> <strong> is a premium</strong><br />
                    <strong>vodka brand</strong> shaped by purity,<br />
                    crafted with a refined and distinctive identity
                </h2>
                <h2 id="bj-about-title" class="case-blue-jay-about__title mobile">
                    <span class="case-blue-jay-about__accent">Blue Jay</span> <strong> is a premium</strong>
                    <strong>vodka brand</strong> shaped by purity,
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

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-34" aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-34.png" alt="" width="1440" height="1300" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-3.png" alt="" width="686" height="772" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-7" aria-label="Blue Jay — typography">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-7.png" alt="Blue Jay — typography" width="1440" height="898" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-4.png" alt="" width="1029" height="661" loading="lazy" />
        </section>

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

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-12" aria-label="Blue Jay — applications">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-12.png" alt="Blue Jay — applications" width="1440" height="1293" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-5.png" alt="" width="1077" height="975" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-14" aria-label="Blue Jay — color palette">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-14.png" alt="Blue Jay — color palette" width="1440" height="675" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-6.png" alt="" width="686" height="507" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-24" aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-24.png" alt="Blue Jay — visuals" width="1440" height="1032" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-7.png" alt="" width="686" height="392" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-36 " aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-36.png" alt="" width="1440" height="1428" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-8.png" alt="" width="732" height="1150" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-27" aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-27.png" alt="Blue Jay — visuals" width="1440" height="1032" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-9.png" alt="" width="686" height="392" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-17" aria-label="Blue Jay — composition">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-17.png" alt="Blue Jay — composition" width="1440" height="871" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-10.png" alt="" width="1029" height="684" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-18 " aria-label="Blue Jay — pattern">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-18.png" alt="Blue Jay — pattern" width="1440" height="828" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-18.png" alt="" width="1029" height="668" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-37" aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-37.png" alt="" width="1440" height="1360" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-11.png" alt="" width="686" height="1030" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-20" aria-label="Blue Jay — mockup">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-20.png" alt="Blue Jay — mockup" width="1440" height="820" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-12.png" alt="" width="686" height="808" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--behance-13" aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/behance-13.png" alt="Blue Jay — visuals" width="1440" height="1443" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-13.png" alt="" width="686" height="1698" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-19" aria-label="Blue Jay — bottle">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-19.png" alt="Blue Jay — bottle" width="1440" height="1214" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-14.png" alt="" width="686" height="1508" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-38" aria-label="Blue Jay — visuals">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-38.png" alt="" width="1440" height="1360" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-15.png" alt="" width="1077" height="2433" loading="lazy" />

        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-26" aria-label="Blue Jay — packaging detail">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-26.png" alt="Blue Jay — packaging detail" width="1440" height="1033" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-16.png" alt="" width="686" height="392" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-21" aria-label="Blue Jay — campaign">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-21.png" alt="Blue Jay — campaign" width="1440" height="1009" loading="lazy" />
            <img class="case-blue-jay__mobile-img" src="<?php echo $base; ?>/mobile/section-17.png" alt="" width="686" height="382" loading="lazy" />
        </section>

        <section class="case-blue-jay__image-section case-blue-jay__image-section--desktop-22 " aria-label="Blue Jay — final">
            <img class="case-blue-jay__desktop-img" src="<?php echo $base; ?>/desktop-22.png" alt="Blue Jay — final" width="1440" height="932" loading="lazy" />
            <img class=" case-blue-jay__mobile-img" src="<?php echo $base; ?>/desktop-22.png" alt="Blue Jay — final" width="1440" height="932" loading="lazy" />
        </section>

    </div>
</main>

<?php
get_footer();
