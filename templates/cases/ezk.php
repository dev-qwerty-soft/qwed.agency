<?php

/**
 * Template Name: EZK Case
 * Template Post Type: case
 *
 * Static hand-coded layout for the EZK case study. Selected from the
 * "Template" dropdown in the WP admin sidebar when editing a Case post.
 *
 * Positioning lives in SCSS (modifier classes per section/deco) so values
 * can scale fluidly via get-d() and snap to static pixels under the xl
 * breakpoint. No inline style="top:Xpx; left:Ypx;" anywhere here.
 */

if (!defined('ABSPATH')) {
    exit();
}

get_header();
$base = esc_url(THEME_URL) . '/assets/cases/ezk';
?>

<main class="case-ezk" id="main-content">
    <div class="case-ezk__page">

        <!-- Hero section (Figma 642:48522) -->
        <section class="case-ezk__section case-ezk__section--hero" aria-label="EZK case hero">
            <div class="case-ezk-hero">
                <div class="case-ezk-hero__tags">
                    <span class="case-ezk-hero__tag">UX&amp;UI</span>
                    <span class="case-ezk-hero__tag">e-Commerce</span>
                </div>

                <div class="case-ezk-hero__leaves case-ezk-hero__leaves--top-right" aria-hidden="true">
                    <img src="<?php echo $base; ?>/hero/leaves-top-right.png" alt="" width="559" height="453" loading="eager" />
                </div>

                <div class="case-ezk-hero__device">
                    <img src="<?php echo $base; ?>/hero/device-mockup.png" alt="EZK product page mockup on desktop" width="1223" height="1017" loading="eager" />
                </div>

                <div class="case-ezk-hero__leaves case-ezk-hero__leaves--bottom-left" aria-hidden="true">
                    <img src="<?php echo $base; ?>/hero/leaves-bottom-left.png" alt="" width="676" height="411" loading="eager" />
                </div>
            </div>
        </section>

        <!-- About section (Figma 642:48521) -->
        <section class="case-ezk__section case-ezk__section--about" aria-labelledby="ezk-about-title">
            <div class="case-ezk-about">
                <div class="case-ezk-about__heading">
                    <span class="case-ezk-about__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-about-title" class="case-ezk-about__title">About</h2>
                </div>

                <blockquote class="case-ezk-about__quote">
                    <p class="case-ezk-about__quote-text">&ldquo; Our new storefront experience feels cleaner, more intuitive, and easier to shop, with a clearer structure and smoother flow throughout every customer touchpoint overall &rdquo;</p>

                    <div class="case-ezk-about__author">
                        <div class="case-ezk-about__author-avatar">
                            <img src="<?php echo $base; ?>/about/avatar.png" alt="" width="53" height="67" />
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

        <!-- Identity section (Figma 642:48535) -->
        <section class="case-ezk__section case-ezk__section--identity" aria-labelledby="ezk-identity-title">
            <div class="case-ezk-identity">
                <div class="case-ezk-identity__heading">
                    <span class="case-ezk-identity__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-identity-title" class="case-ezk-identity__title">Identity</h2>
                </div>
                <div class="case-ezk-identity__content">
                    <img src="<?php echo $base; ?>/identity/content.png" alt="EZK logo variations and brand identity collateral" width="1386" height="1814" loading="lazy" />
                </div>
            </div>
        </section>

        <!-- Mobile Design (Figma 642:48539, whole section as PNG) -->
        <section class="case-ezk__image-section case-ezk__image-section--mobile-design" aria-label="Mobile design — kratom products app mockup">
            <img src="<?php echo $base; ?>/mobile-design/full.png" alt="Mobile design — kratom products app mockup" width="916" height="1262" loading="lazy" />
        </section>

        <!-- Scene Light decoration — mid-page centerpiece (Figma 454:4371) -->
        <div class="case-ezk__deco case-ezk__deco--scene-light" aria-hidden="true">
            <img src="<?php echo $base; ?>/decorations/scene-light.png" alt="" width="1014" height="1017" loading="lazy" />
        </div>

        <!-- FAQ (Figma 642:48541) -->
        <section class="case-ezk__image-section case-ezk__image-section--faq" aria-label="Frequently Asked Questions mockup">
            <img src="<?php echo $base; ?>/faq/content.png" alt="FAQ section mockup" width="999" height="1019" loading="lazy" />
        </section>

        <!-- User Feedback (Figma 642:48582) -->
        <section class="case-ezk__image-section case-ezk__image-section--user-feedback" aria-label="User Feedback">
            <img src="<?php echo $base; ?>/user-feedback/content.png" alt="User Feedback metrics" width="1329" height="546" loading="lazy" />
        </section>

        <!-- Bulk Orders (Figma 642:48583) -->
        <section class="case-ezk__image-section case-ezk__image-section--bulk-orders" aria-label="Interested in Bulk Orders">
            <img src="<?php echo $base; ?>/bulk-orders/content.png" alt="Bulk Orders banner" width="1392" height="564" loading="lazy" />
        </section>

        <!-- Buy Kratom Online — full-width landing mockup (Figma 460:96304) -->
        <section class="case-ezk__image-section case-ezk__image-section--buy-kratom" aria-label="Buy Kratom Online — full landing mockup">
            <img src="<?php echo $base; ?>/buy-kratom-online/full.png" alt="Buy Kratom Online landing page" width="1440" height="1250" loading="lazy" />
        </section>

        <!-- Design Process (Figma 642:48589) -->
        <section class="case-ezk__image-section case-ezk__image-section--design-process" aria-label="Design Process">
            <img src="<?php echo $base; ?>/design-process/content.png" alt="Design Process metrics" width="1331" height="564" loading="lazy" />
        </section>

        <!-- Subscribe (Figma 642:48591) -->
        <section class="case-ezk__image-section case-ezk__image-section--subscribe" aria-label="Subscribe for FREE Kratom">
            <img src="<?php echo $base; ?>/subscribe/content.png" alt="Subscribe section" width="1392" height="905" loading="lazy" />
        </section>

        <!-- Fright Night Deals (Figma 494:71295) -->
        <section class="case-ezk__image-section case-ezk__image-section--fright-night" aria-label="Fright Night Deals">
            <img src="<?php echo $base; ?>/fright-night/content.png" alt="Fright Night Deals promo" width="1392" height="923" loading="lazy" />
        </section>

        <!-- Typography & Colors (Figma 642:48594) -->
        <section class="case-ezk__image-section case-ezk__image-section--typography" aria-label="Typography and Colors">
            <img src="<?php echo $base; ?>/typography-colors/content.png" alt="Typography palette and colors" width="1222" height="483" loading="lazy" />
        </section>

        <!-- Aa typography sample (Figma 642:48596) -->
        <section class="case-ezk__image-section case-ezk__image-section--aa" aria-label="Typography sample">
            <img src="<?php echo $base; ?>/aa/content.png" alt="Aa typography sample" width="1375" height="715" loading="lazy" />
        </section>

        <!-- Certified for Purity, Safety, and Quality Assurance (Figma 496:262874) -->
        <section class="case-ezk__image-section case-ezk__image-section--certified" aria-label="Certified for Purity, Safety, and Quality Assurance">
            <img src="<?php echo $base; ?>/certified/full.png" alt="Certified for Purity, Safety, and Quality Assurance" width="1440" height="6340" loading="lazy" />
        </section>

        <!-- Result heading + underline (Figma 496:112920 + 496:112921) -->
        <section class="case-ezk__section case-ezk__section--result" aria-labelledby="ezk-result-title">
            <div class="case-ezk-result">
                <span class="case-ezk-result__underline" aria-hidden="true"></span>
                <h2 id="ezk-result-title" class="case-ezk-result__title">Result</h2>
            </div>
        </section>

        <!-- Social Media decoration — wide near-full-width (Figma 642:48603) -->
        <div class="case-ezk__deco case-ezk__deco--social-media" aria-hidden="true">
            <img src="<?php echo $base; ?>/social-media/decoration.png" alt="" width="1433" height="739" loading="lazy" />
        </div>

    </div>

    <!-- Side leaf decorations live OUTSIDE the 1440px page wrapper so they
         anchor to the viewport edge on wider screens, not the page edge. -->
    <div class="case-ezk__deco case-ezk__deco--side-1" aria-hidden="true">
        <img src="<?php echo $base; ?>/decorations/side-1.png" alt="" width="575" height="590" loading="lazy" />
    </div>
    <div class="case-ezk__deco case-ezk__deco--side-2" aria-hidden="true">
        <img src="<?php echo $base; ?>/decorations/side-2.png" alt="" width="364" height="506" loading="lazy" />
    </div>
    <div class="case-ezk__deco case-ezk__deco--side-3" aria-hidden="true">
        <img src="<?php echo $base; ?>/decorations/side-3.png" alt="" width="575" height="590" loading="lazy" />
    </div>
    <div class="case-ezk__deco case-ezk__deco--side-4" aria-hidden="true">
        <img src="<?php echo $base; ?>/decorations/side-4.png" alt="" width="424" height="530" loading="lazy" />

    </div>

    <section class="case-ezk__mockup case-ezk__mockup--dontmiss" aria-label="Don't miss a new work">
        <img src="<?php echo $base; ?>/dont-miss.png" alt="Don't miss a new work — Green Borneo Kratom product showcase" width="1440" height="697" loading="lazy" />
    </section>
</main>

<?php
get_footer();
