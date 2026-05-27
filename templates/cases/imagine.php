<?php

/**
 * Template Name: Imagine Case
 * Template Post Type: case
 */

if (!defined('ABSPATH')) {
    exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/imagine';
?>

<main class="case-imagine" id="main-content">
    <div class="case-imagine__page">

        <section class="case-imagine__image-section case-imagine__image-section--desktop-6" aria-label="Imagine — hero">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-6.png" alt="Imagine — hero" width="1440" height="1024" loading="eager" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-1.png" alt="" width="707" height="580" loading="eager" />
        </section>

        <section class="case-imagine__section case-imagine__section--manifesto" aria-labelledby="im-manifesto-text">
            <div class="im-manifesto">
                <span class="im-manifesto__tag">Editorial Platform</span>
                <p id="im-manifesto-text" class="im-manifesto__text im-manifesto__text--desktop">
                    <img class="im-manifesto__mark" src="<?php echo $base; ?>/imagine-mark.png" alt="IMAGINE" width="152" height="36" />
                    is a brand new magazine and media brand<br />
                    where high fashion, entertainment and popular culture converge.<br />
                    Built to reflect and predict the cultural zeitgeist, it champions creativity,<br />
                    optimism, and the voices of the moment &mdash; all through a striking, aesthetic lens.<br />
                    IMAGINE will publish a collectible bi-annual print edition &mdash; a bold, boundary-pushing<br />
                    celebration of icons and emerging voices across fashion, film, music, art, and design. Crucially,<br />
                    IMAGINE provides a much-needed dose of positivity in a time of societal and political upheaval &mdash;<br />
                    a visual balm, where beauty and optimism intersect
                </p>
                <p class="im-manifesto__text im-manifesto__text--mobile" aria-hidden="true">
                    <img class="im-manifesto__mark" src="<?php echo $base; ?>/imagine-mark.png" alt="" width="152" height="36" />
                    is a brand new magazine<br />
                    and media brand where high fashion, entertainment<br />
                    and popular culture converge. Built to reflect and predict<br />
                    the cultural zeitgeist, it champions creativity, optimism, and<br />
                    the voices of the moment &mdash; all through a striking,<br />
                    aesthetic lens. IMAGINE will publishbi-annual.
                </p>
            </div>
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-39" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-39.png" alt="Imagine — section" width="1440" height="824" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-3.png" alt="" width="750" height="430" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-8" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-8.png" alt="Imagine — section" width="1440" height="1008" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-4.png" alt="" width="750" height="696" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-9" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-9.png" alt="Imagine — section" width="1440" height="783" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-5.png" alt="" width="686" height="646" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-10" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-10.png" alt="Imagine — section" width="1440" height="988" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-6.png" alt="" width="750" height="520" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-13" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-13.png" alt="Imagine — section" width="1440" height="1061" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-7.png" alt="" width="750" height="578" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-35" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-35.png" alt="Imagine — section" width="1440" height="1198" loading="lazy" />
            <div class="im-slider" data-im-slider data-im-slider-interval="5000" aria-roledescription="carousel">
                <ul class="im-slider__track">
                    <li class="im-slider__slide is-active"><img src="<?php echo $base; ?>/mobile/slider-1.png" alt="" loading="lazy" /></li>
                    <li class="im-slider__slide"><img src="<?php echo $base; ?>/mobile/slider-2.png" alt="" loading="lazy" /></li>
                    <li class="im-slider__slide"><img src="<?php echo $base; ?>/mobile/slider-3.png" alt="" loading="lazy" /></li>
                </ul>
                <div class="im-slider__dots" role="tablist" aria-label="Slider navigation">
                    <button class="im-slider__dot is-active" type="button" aria-label="Slide 1" data-im-slider-dot="0"></button>
                    <button class="im-slider__dot" type="button" aria-label="Slide 2" data-im-slider-dot="1"></button>
                    <button class="im-slider__dot" type="button" aria-label="Slide 3" data-im-slider-dot="2"></button>
                </div>
            </div>
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-16" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-16.png" alt="Imagine — section" width="1440" height="1198" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-9.png" alt="" width="750" height="2736" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-19" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-19.png" alt="Imagine — section" width="1440" height="1089" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-10.png" alt="" width="686" height="966" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-36" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-36.png" alt="Imagine — section" width="1440" height="2545" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-11.png" alt="" width="750" height="1918" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--group-1" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/group-1.png" alt="Imagine — section" width="1440" height="873" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-13.png" alt="" width="750" height="482" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-26" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-26.png" alt="Imagine — section" width="1440" height="1226" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-14.png" alt="" width="686" height="1308" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--group-2" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/group-2.png" alt="Imagine — section" width="1440" height="976" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-38" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-38.png" alt="Imagine — section" width="1440" height="1202" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-16.png" alt="" width="750" height="506" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-37" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-37.png" alt="Imagine — section" width="1440" height="1060" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-17.png" alt="" width="686" height="1658" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-28" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-28.png" alt="Imagine — section" width="1440" height="784" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-18.png" alt="" width="750" height="878" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-32" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-32.png" alt="Imagine — section" width="1440" height="724" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-19.png" alt="" width="686" height="786" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-31" aria-label="Imagine — section">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-31.png" alt="Imagine — section" width="1440" height="1219" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-20.png" alt="" width="750" height="1232" loading="lazy" />
        </section>

        <section class="case-imagine__image-section case-imagine__image-section--desktop-33" aria-label="Imagine — final">
            <img class="case-imagine__desktop-img" src="<?php echo $base; ?>/desktop-33.png" alt="Imagine — final" width="1440" height="1120" loading="lazy" />
            <img class="case-imagine__mobile-img" src="<?php echo $base; ?>/mobile/section-21.png" alt="" width="750" height="692" loading="lazy" />
        </section>

    </div>
</main>

<?php
get_footer();
