<?php
/**
 * Template Name: EZK Case
 * Template Post Type: case
 *
 * Static, hand-coded layout for the EZK case study. Selected from the
 * "Template" dropdown in the WP admin sidebar when editing a Case post.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();
?>

<main class="case-ezk" id="main-content">
    <div class="case-ezk__page">

        <!-- Hero section (Figma node 642:48522, top of page) -->
        <section
            class="case-ezk__section case-ezk__section--hero"
            style="top: 0; left: 0;"
            aria-label="EZK case hero"
        >
            <div class="case-ezk-hero">
                <div class="case-ezk-hero__tags">
                    <span class="case-ezk-hero__tag">UX&amp;UI</span>
                    <span class="case-ezk-hero__tag">e-Commerce</span>
                </div>

                <div class="case-ezk-hero__leaves case-ezk-hero__leaves--top-right" aria-hidden="true">
                    <img
                        src="<?php echo esc_url(THEME_URL); ?>/assets/cases/ezk/hero/leaves-top-right.png"
                        alt=""
                        width="559"
                        height="453"
                        loading="eager"
                    />
                </div>

                <div class="case-ezk-hero__device">
                    <img
                        src="<?php echo esc_url(THEME_URL); ?>/assets/cases/ezk/hero/device-mockup.png"
                        alt="EZK product page mockup on desktop"
                        width="1223"
                        height="1017"
                        loading="eager"
                    />
                </div>

                <div class="case-ezk-hero__leaves case-ezk-hero__leaves--bottom-left" aria-hidden="true">
                    <img
                        src="<?php echo esc_url(THEME_URL); ?>/assets/cases/ezk/hero/leaves-bottom-left.png"
                        alt=""
                        width="676"
                        height="411"
                        loading="eager"
                    />
                </div>
            </div>
        </section>

        <!-- About section (Figma node 642:48521, position 50,1305 inside page) -->
        <section
            class="case-ezk__section case-ezk__section--about"
            style="top: 1305px; left: 50px;"
            aria-labelledby="ezk-about-title"
        >
            <div class="case-ezk-about">
                <div class="case-ezk-about__heading">
                    <span class="case-ezk-about__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-about-title" class="case-ezk-about__title">About</h2>
                </div>

                <blockquote class="case-ezk-about__quote">
                    <p class="case-ezk-about__quote-text">&ldquo; Our new storefront experience feels cleaner, more intuitive, and easier to shop, with a clearer structure and smoother flow throughout every customer touchpoint overall &rdquo;</p>

                    <div class="case-ezk-about__author">
                        <div class="case-ezk-about__author-avatar">
                            <img
                                src="<?php echo esc_url(THEME_URL); ?>/assets/cases/ezk/about/avatar.png"
                                alt=""
                                width="53"
                                height="67"
                            />
                        </div>
                        <div class="case-ezk-about__author-info">
                            <p class="case-ezk-about__author-name">First &amp; Last Name</p>
                            <p class="case-ezk-about__author-role">Co-Founder EZK</p>
                        </div>
                    </div>
                </blockquote>

                <div class="case-ezk-about__meta">
                    <div class="case-ezk-about__meta-col">
                        <h3 class="case-ezk-about__meta-label">Overview</h3>
                        <p class="case-ezk-about__meta-text">A modern e-commerce concept focused on clarity, trust, and smoother product discovery, with a cleaner and more intuitive shopping experience</p>
                    </div>
                    <div class="case-ezk-about__meta-col case-ezk-about__meta-col--right">
                        <h3 class="case-ezk-about__meta-label">Project</h3>
                        <p class="case-ezk-about__meta-text">Industry / Botanical</p>
                        <p class="case-ezk-about__meta-text">Location / Florida, USA</p>
                        <p class="case-ezk-about__meta-text">Date / 2025</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Identity section (Figma node 642:48535, position 29,2469 inside page) -->
        <section
            class="case-ezk__section case-ezk__section--identity"
            style="top: 2469px; left: 29px;"
            aria-labelledby="ezk-identity-title"
        >
            <div class="case-ezk-identity">
                <div class="case-ezk-identity__heading">
                    <span class="case-ezk-identity__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-identity-title" class="case-ezk-identity__title">Identity</h2>
                </div>
                <div class="case-ezk-identity__content">
                    <img
                        src="<?php echo esc_url(THEME_URL); ?>/assets/cases/ezk/identity/content.png"
                        alt="EZK logo variations and brand identity collateral"
                        width="1386"
                        height="1814"
                        loading="lazy"
                    />
                </div>
            </div>
        </section>

        <?php $base = esc_url(THEME_URL) . '/assets/cases/ezk'; ?>

        <!-- Decoration: leaves between About and Identity (right side) -->
        <div class="case-ezk__deco" style="top: 1973px; left: 1116px; width: 575px; height: 590px;" aria-hidden="true">
            <img src="<?php echo $base; ?>/decorations/side-1.png" alt="" width="575" height="590" loading="lazy" />
        </div>

        <!-- Decoration: leaves between Identity and Mobile Design (left overflow) -->
        <div class="case-ezk__deco" style="top: 4344px; left: -208px; width: 364px; height: 506px;" aria-hidden="true">
            <img src="<?php echo $base; ?>/decorations/side-2.png" alt="" width="364" height="506" loading="lazy" />
        </div>

        <!-- Mobile Design (Figma 642:48539, whole section as PNG) -->
        <section class="case-ezk__image-section" style="top: 4759px; left: 50px; width: 916px; height: 1262px;" aria-label="Mobile design — kratom products app mockup">
            <img src="<?php echo $base; ?>/mobile-design/full.png" alt="Mobile design — kratom products app mockup" width="916" height="1262" loading="lazy" />
        </section>

        <!-- Scene Light decoration -->
        <div class="case-ezk__deco" style="top: 6291px; left: 402px; width: 1014px; height: 1017px;" aria-hidden="true">
            <img src="<?php echo $base; ?>/decorations/scene-light.png" alt="" width="1014" height="1017" loading="lazy" />
        </div>

        <!-- FAQ (Figma 642:48541) -->
        <section class="case-ezk__image-section" style="top: 7518px; left: 24px; width: 999px; height: 1019px;" aria-label="Frequently Asked Questions mockup">
            <img src="<?php echo $base; ?>/faq/content.png" alt="FAQ section mockup" width="999" height="1019" loading="lazy" />
        </section>

        <!-- User Feedback (Figma 642:48582) -->
        <section class="case-ezk__image-section" style="top: 8767px; left: 50px; width: 1329px; height: 546px;" aria-label="User Feedback">
            <img src="<?php echo $base; ?>/user-feedback/content.png" alt="User Feedback metrics" width="1329" height="546" loading="lazy" />
        </section>

        <!-- Bulk Orders (Figma 642:48583) -->
        <section class="case-ezk__image-section" style="top: 9553px; left: 24px; width: 1392px; height: 564px;" aria-label="Interested in Bulk Orders">
            <img src="<?php echo $base; ?>/bulk-orders/content.png" alt="Bulk Orders banner" width="1392" height="564" loading="lazy" />
        </section>

        <!-- Buy Kratom Online — full-width landing mockup (Figma 460:96304) -->
        <section class="case-ezk__image-section" style="top: 10337px; left: 0; width: 1440px; height: 1250px;" aria-label="Buy Kratom Online — full landing mockup">
            <img src="<?php echo $base; ?>/buy-kratom-online/full.png" alt="Buy Kratom Online landing page" width="1440" height="1250" loading="lazy" />
        </section>

        <!-- Decoration: leaves on right side of Buy Kratom section -->
        <div class="case-ezk__deco" style="top: 10625px; left: 1116px; width: 575px; height: 590px;" aria-hidden="true">
            <img src="<?php echo $base; ?>/decorations/side-3.png" alt="" width="575" height="590" loading="lazy" />
        </div>

        <!-- Design Process (Figma 642:48589) -->
        <section class="case-ezk__image-section" style="top: 11818px; left: 50px; width: 1331px; height: 564px;" aria-label="Design Process">
            <img src="<?php echo $base; ?>/design-process/content.png" alt="Design Process metrics" width="1331" height="564" loading="lazy" />
        </section>

        <!-- Subscribe (Figma 642:48591) -->
        <section class="case-ezk__image-section" style="top: 12618px; left: 24px; width: 1392px; height: 905px;" aria-label="Subscribe for FREE Kratom">
            <img src="<?php echo $base; ?>/subscribe/content.png" alt="Subscribe section" width="1392" height="905" loading="lazy" />
        </section>

        <!-- Fright Night Deals (Figma 494:71295) -->
        <section class="case-ezk__image-section" style="top: 13752px; left: 24px; width: 1392px; height: 923px;" aria-label="Fright Night Deals">
            <img src="<?php echo $base; ?>/fright-night/content.png" alt="Fright Night Deals promo" width="1392" height="923" loading="lazy" />
        </section>

        <!-- Typography & Colors (Figma 642:48594) -->
        <section class="case-ezk__image-section" style="top: 14905px; left: 50px; width: 1222px; height: 483px;" aria-label="Typography and Colors">
            <img src="<?php echo $base; ?>/typography-colors/content.png" alt="Typography palette and colors" width="1222" height="483" loading="lazy" />
        </section>

        <!-- Aa typography sample (Figma 642:48596) -->
        <section class="case-ezk__image-section" style="top: 15566px; left: 0; width: 1375px; height: 715px;" aria-label="Typography sample">
            <img src="<?php echo $base; ?>/aa/content.png" alt="Aa typography sample" width="1375" height="715" loading="lazy" />
        </section>

        <!-- Certified for Purity, Safety, and Quality Assurance — large section (Figma 496:262874) -->
        <section class="case-ezk__image-section" style="top: 16551px; left: 0; width: 1440px; height: 6340px;" aria-label="Certified for Purity, Safety, and Quality Assurance">
            <img src="<?php echo $base; ?>/certified/full.png" alt="Certified for Purity, Safety, and Quality Assurance" width="1440" height="6340" loading="lazy" />
        </section>

        <!-- Result heading (Figma 496:112920 + 496:112921 underline) -->
        <section
            class="case-ezk__section case-ezk__section--result"
            style="top: 19432px; left: 50px;"
            aria-labelledby="ezk-result-title"
        >
            <div class="case-ezk-result">
                <span class="case-ezk-result__underline" aria-hidden="true"></span>
                <h2 id="ezk-result-title" class="case-ezk-result__title">Result</h2>
            </div>
        </section>

        <!-- Social Media decoration (Figma 642:48603) -->
        <div class="case-ezk__deco" style="top: 23121px; left: -53px; width: 1433px; height: 739px;" aria-hidden="true">
            <img src="<?php echo $base; ?>/social-media/decoration.png" alt="" width="1433" height="739" loading="lazy" />
        </div>

        <!-- Side decoration 4 (right edge, near bottom) -->
        <div class="case-ezk__deco" style="top: 23336px; left: 1576px; width: 424px; height: 530px;" aria-hidden="true">
            <img src="<?php echo $base; ?>/decorations/side-4.png" alt="" width="424" height="530" loading="lazy" />
        </div>

    </div>
</main>

<?php
get_footer();

