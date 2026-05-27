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


        <section class="case-ezk__section case-ezk__section--hero" aria-label="EZK case hero">
            <div class="case-ezk-hero">
                <div class="case-ezk-hero__tags">
                    <span class="case-ezk-hero__tag">UX&amp;UI</span>
                    <span class="case-ezk-hero__tag">e-Commerce</span>
                </div>

                <div class="case-ezk-hero__leaves case-ezk-hero__leaves--top-right" aria-hidden="true">
                    <img src="<?php echo $base; ?>/leaves-top-right.png" alt="" width="559" height="453" loading="eager" />
                </div>

                <div class="case-ezk-hero__device">
                    <img src="<?php echo $base; ?>/device-mockup.png" alt="EZK product page mockup on desktop" width="1223" height="1017" loading="eager" />
                </div>

                <div class="case-ezk-hero__leaves case-ezk-hero__leaves--bottom-left" aria-hidden="true">
                    <img src="<?php echo $base; ?>/leaves-bottom-left.png" alt="" width="676" height="411" loading="eager" />
                </div>
            </div>
        </section>


        <section class="case-ezk__section case-ezk__section--about" aria-labelledby="ezk-about-title">
            <div class="case-ezk-about">
                <div class="case-ezk-about__heading">
                    <span class="case-ezk-about__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-about-title" class="case-ezk-about__title">About</h2>
                </div>

                <blockquote class="case-ezk-about__quote">
                    <p class="case-ezk-about__quote-text">&ldquo; Our new storefront experience<br />
                        feels cleaner, more intuitive, and easier<br />
                        to shop, with a clearer structure and smoother<br />
                        flow throughout every customer touchpoint overall &rdquo;</p>

                    <div class="case-ezk-about__author">
                        <div class="case-ezk-about__author-avatar">
                            <img src="<?php echo $base; ?>/avatar.png" alt="" width="53" height="67" />
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
                        <p class="case-ezk-about__meta-text">Industry / <strong>Botanical</strong></p>
                        <p class="case-ezk-about__meta-text">Location / <strong>Florida, USA</strong></p>
                        <p class="case-ezk-about__meta-text">Date / <strong>2025</strong></p>
                    </div>
                </div>
            </div>
        </section>


        <section class="case-ezk__section case-ezk__section--identity" aria-labelledby="ezk-identity-title">
            <div class="case-ezk-identity">
                <div class="case-ezk-identity__heading">
                    <span class="case-ezk-identity__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-identity-title" class="case-ezk-identity__title">Identity</h2>
                </div>

                <div class="case-ezk-identity__card case-ezk-identity__card--leaf-1">
                    <img src="<?php echo $base; ?>/identity-leaf-1.png" alt="EZK leaf mark — primary" width="121" height="87" loading="lazy" />
                </div>
                <div class="case-ezk-identity__card case-ezk-identity__card--leaf-2">
                    <img src="<?php echo $base; ?>/identity-leaf-2.png" alt="EZK leaf mark — medium" width="95" height="69" loading="lazy" />
                </div>
                <div class="case-ezk-identity__card case-ezk-identity__card--leaf-3">
                    <img src="<?php echo $base; ?>/identity-leaf-3.png" alt="EZK leaf mark — small" width="65" height="47" loading="lazy" />
                </div>
                <div class="case-ezk-identity__card case-ezk-identity__card--avatar">
                    <img src="<?php echo $base; ?>/identity-avatar.png" alt="EZK cap on model" width="417" height="342" loading="lazy" />
                </div>
                <div class="case-ezk-identity__card case-ezk-identity__card--hand">
                    <img src="<?php echo $base; ?>/identity-hand.png" alt="Hand holding EZK branded card" width="839" height="701" loading="lazy" />
                </div>
                <div class="case-ezk-identity__card case-ezk-identity__card--tote">
                    <img src="<?php echo $base; ?>/identity-tote.png" alt="EZK branded tote bag" width="471" height="549" loading="lazy" />
                </div>
            </div>
        </section>


        <section class="case-ezk__section case-ezk__section--mobile" aria-labelledby="ezk-mobile-title">
            <div class="case-ezk-mobile">
                <div class="case-ezk-mobile__heading">
                    <span class="case-ezk-mobile__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-mobile-title" class="case-ezk-mobile__title">Mobile Design</h2>
                </div>

                <div class="case-ezk-mobile__card case-ezk-mobile__card--products">
                    <img class="case-ezk-mobile__img case-ezk-mobile__img--desktop" src="<?php echo $base; ?>/mobile-phone-1.png" alt="Kratom Products screen with Strain and Merch category tiles" width="883" height="1035" loading="lazy" />
                    <img class="case-ezk-mobile__img case-ezk-mobile__img--mobile" src="<?php echo $base; ?>/mobile/phone-products.png" alt="Kratom Products screen" loading="lazy" />
                </div>
                <div class="case-ezk-mobile__categories" aria-hidden="true">
                    <img class="case-ezk-mobile__category case-ezk-mobile__category--strain" src="<?php echo $base; ?>/mobile/category-strain.png" alt="Strain" loading="lazy" />
                    <img class="case-ezk-mobile__category case-ezk-mobile__category--merch" src="<?php echo $base; ?>/mobile/category-merch.png" alt="Merch" loading="lazy" />
                </div>
                <div class="case-ezk-mobile__card case-ezk-mobile__card--phone-cart">
                    <img class="case-ezk-mobile__img case-ezk-mobile__img--desktop" src="<?php echo $base; ?>/scene-light.png" alt="Hand holding phone — kratom product cart with $45.00" width="1014" height="1017" loading="lazy" />
                    <img class="case-ezk-mobile__img case-ezk-mobile__img--mobile" src="<?php echo $base; ?>/mobile/phone-cart.png" alt="Hand holding phone — kratom product cart" loading="lazy" />
                </div>
                <div class="case-ezk-mobile__card case-ezk-mobile__card--phone-order">
                    <img class="case-ezk-mobile__img case-ezk-mobile__img--desktop" src="<?php echo $base; ?>/faq.png" alt="Hand holding phone — order form" width="999" height="1019" loading="lazy" />
                    <img class="case-ezk-mobile__img case-ezk-mobile__img--mobile" src="<?php echo $base; ?>/mobile/phone-order.png" alt="Hand holding phone — order form" loading="lazy" />
                </div>
            </div>
        </section>


        <section class="case-ezk__section case-ezk__section--feedback" aria-labelledby="ezk-feedback-title">
            <div class="case-ezk-feedback">
                <div class="case-ezk-feedback__heading">
                    <span class="case-ezk-feedback__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-feedback-title" class="case-ezk-feedback__title">User Feedback</h2>
                </div>
                <div class="case-ezk-feedback__grid">
                    <div class="case-ezk-feedback__col">
                        <div class="case-ezk-feedback__bar" aria-hidden="true">
                            <div class="case-ezk-feedback__bar-fill case-ezk-feedback__bar-fill--85"></div>
                        </div>
                        <div class="case-ezk-feedback__label">
                            <p class="case-ezk-feedback__label">Users</p>
                            <p class="case-ezk-feedback__percent">85%</p>
                        </div>
                        <div> </div>
                        <p class="case-ezk-feedback__desc">Said the platform feels intuitive and easy to navigate</p>
                    </div>
                    <div class="case-ezk-feedback__col">
                        <div class="case-ezk-feedback__bar" aria-hidden="true">
                            <div class="case-ezk-feedback__bar-fill case-ezk-feedback__bar-fill--50"></div>
                        </div>
                        <div class="case-ezk-feedback__label">
                            <p class="case-ezk-feedback__label">Users</p>
                            <p class="case-ezk-feedback__percent">50%</p>
                        </div>
                        <div> </div>
                        <p class="case-ezk-feedback__desc">Completed key actions without additional guidance</p>
                    </div>
                    <div class="case-ezk-feedback__col">
                        <div class="case-ezk-feedback__bar" aria-hidden="true">
                            <div class="case-ezk-feedback__bar-fill case-ezk-feedback__bar-fill--65"></div>
                        </div>
                        <div class="case-ezk-feedback__label">
                            <p class="case-ezk-feedback__label">Users</p>
                            <p class="case-ezk-feedback__percent">65%</p>
                        </div>
                        <div> </div>
                        <p class="case-ezk-feedback__desc">Felt confident using the platform from first use</p>
                    </div>
                </div>
            </div>
        </section>


        <section class="case-ezk__image-section case-ezk__image-section--bulk-orders" aria-label="Interested in Bulk Orders">
            <img class="case-ezk__mobile-img" src="<?php echo $base; ?>/mobile/section-6.png" alt="" loading="lazy" />
            <img class="case-ezk__desktop-img" src="<?php echo $base; ?>/bulk-orders.png" alt="Bulk Orders banner" width="1392" height="564" loading="lazy" />
        </section>


        <section class="case-ezk__image-section case-ezk__image-section--buy-kratom" aria-label="Buy Kratom Online — full landing mockup">
            <img class="case-ezk__mobile-img" src="<?php echo $base; ?>/mobile/section-7.png" alt="" loading="lazy" />
            <img class="case-ezk__desktop-img" src="<?php echo $base; ?>/buy-kratom-online.png" alt="Buy Kratom Online landing page" width="1440" height="1250" loading="lazy" />
        </section>


        <section class="case-ezk__section case-ezk__section--process" aria-labelledby="ezk-process-title">
            <div class="case-ezk-process">
                <div class="case-ezk-process__heading">
                    <span class="case-ezk-process__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-process-title" class="case-ezk-process__title">Design Process</h2>
                </div>
                <div class="case-ezk-process__cards">
                    <article class="case-ezk-process__card">
                        <header class="case-ezk-process__card-head">
                            <h3 class="case-ezk-process__card-label">Strategy</h3>
                            <span class="case-ezk-process__card-hours">40h</span>
                        </header>
                        <ul class="case-ezk-process__items case-ezk-process__items--top">
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">Competitor Analysis</li>
                        </ul>
                        <ul class="case-ezk-process__items">
                            <li class="case-ezk-process__item case-ezk-process__item--pill">User Research</li>
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">Ideations</li>
                        </ul>
                    </article>
                    <article class="case-ezk-process__card">
                        <header class="case-ezk-process__card-head">
                            <h3 class="case-ezk-process__card-label">Discovery</h3>
                            <span class="case-ezk-process__card-hours">90h</span>
                        </header>
                        <ul class="case-ezk-process__items case-ezk-process__items--top">
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">Wireframing</li>
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">User Flow</li>
                        </ul>
                        <ul class="case-ezk-process__items">
                            <li class="case-ezk-process__item case-ezk-process__item--pill">UX Design</li>
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">Prototyping</li>
                        </ul>
                    </article>
                    <article class="case-ezk-process__card">
                        <header class="case-ezk-process__card-head">
                            <h3 class="case-ezk-process__card-label">Solutions</h3>
                            <span class="case-ezk-process__card-hours">120h</span>
                        </header>
                        <ul class="case-ezk-process__items case-ezk-process__items--top">
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">Design System</li>
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">UI Design</li>
                        </ul>
                        <ul class="case-ezk-process__items">
                            <li class="case-ezk-process__item case-ezk-process__item--pill">Branding</li>
                            <li class="case-ezk-process__item case-ezk-process__item--arrow">Usability Testing</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>


        <section class="case-ezk__image-section case-ezk__image-section--subscribe" aria-label="Subscribe for FREE Kratom">
            <img class="case-ezk__mobile-img" src="<?php echo $base; ?>/mobile/section-9.png" alt="" loading="lazy" />
            <img class="case-ezk__desktop-img" src="<?php echo $base; ?>/subscribe.png" alt="Subscribe section" width="1392" height="905" loading="lazy" />
        </section>


        <section class="case-ezk__image-section case-ezk__image-section--fright-night" aria-label="Fright Night Deals">
            <img class="case-ezk__mobile-img" src="<?php echo $base; ?>/mobile/section-10.png" alt="" loading="lazy" />
            <img class="case-ezk__desktop-img" src="<?php echo $base; ?>/fright-night.png" alt="Fright Night Deals promo" width="1392" height="923" loading="lazy" />
        </section>


        <section class="case-ezk__section case-ezk__section--typography" aria-labelledby="ezk-typography-title">
            <div class="case-ezk-typography">
                <div class="case-ezk-typography__heading">
                    <span class="case-ezk-typography__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-typography-title" class="case-ezk-typography__title">Typography &amp; Colors</h2>
                </div>
                <div class="case-ezk-typography__colors">
                    <div class="case-ezk-typography__swatch case-ezk-typography__swatch--black">
                        <p class="case-ezk-typography__swatch-name">Black</p>
                        <p class="case-ezk-typography__swatch-hex">#0A0F17</p>
                    </div>
                    <div class="case-ezk-typography__swatch case-ezk-typography__swatch--green">
                        <p class="case-ezk-typography__swatch-name">Green</p>
                        <p class="case-ezk-typography__swatch-hex">#3C9845</p>
                    </div>
                    <div class="case-ezk-typography__swatch case-ezk-typography__swatch--dark-gray">
                        <p class="case-ezk-typography__swatch-name">Dark Gray</p>
                        <p class="case-ezk-typography__swatch-hex">#3B3F45</p>
                    </div>
                    <div class="case-ezk-typography__swatch case-ezk-typography__swatch--light-gray">
                        <p class="case-ezk-typography__swatch-name">Light Gray</p>
                        <p class="case-ezk-typography__swatch-hex">#9B9A9A</p>
                    </div>
                </div>
                <div class="case-ezk-typography__aa">
                    <img class="case-ezk-typography__shelf" src="<?php echo $base; ?>/aa-bookshelf.png" alt="Bookshelf with Ariel font weights Regular, Medium, SemiBold" width="725" height="701" loading="lazy" />
                    <div>
                        <p class="case-ezk-typography__sample">Aa</p>
                        <p class="case-ezk-typography__alphabet">Bb, C,c Dd, Ee, Ff, Gg, Hh, Ii, Jj, Kk, Ll, Mm, Nn, Oo, Pp, Qq, Rr, Ss, Tt, Uu, Vv, Ww, Xx, Yy Zz</p>
                    </div>
                </div>
            </div>
        </section>


        <?php /* Remove the separate Aa image-section since it is now part of typography */ ?>




        <section class="case-ezk__image-section case-ezk__image-section--certified" aria-label="Certified for Purity, Safety, and Quality Assurance">
            <img class="case-ezk__mobile-img" src="<?php echo $base; ?>/mobile/section-13.png" alt="" loading="lazy" />
            <img class="case-ezk__desktop-img" src="<?php echo $base; ?>/certified.png" alt="Certified for Purity, Safety, and Quality Assurance" width="1440" height="6340" loading="lazy" />
        </section>




        <section class="case-ezk__section case-ezk__section--social" aria-labelledby="ezk-social-title">
            <div class="case-ezk-social">
                <div class="case-ezk-social__heading">
                    <span class="case-ezk-social__heading-underline" aria-hidden="true"></span>
                    <h2 id="ezk-social-title" class="case-ezk-social__title">Social Media</h2>
                </div>

                <div class="case-ezk-social__cards">
                    <img class="case-ezk-social__leaves" src="<?php echo $base; ?>/sm-leaves.png" alt="" width="415" height="427" loading="lazy" />
                    <img class="case-ezk-social__card" src="<?php echo $base; ?>/sm-card-1.png" alt="Premium Kratom — Crafted for Quality" width="420" height="524" loading="lazy" />
                    <img class="case-ezk-social__card" src="<?php echo $base; ?>/sm-card-2.png" alt="Pure Kratom — Elevated Standard" width="420" height="524" loading="lazy" />
                    <img class="case-ezk-social__card" src="<?php echo $base; ?>/sm-card-3.png" alt="Liquid Kratom — Crafted for Balance" width="420" height="524" loading="lazy" />
                </div>
            </div>
        </section>

        <section class="case-ezk__mockup case-ezk__mockup--dontmiss" aria-label="Don't miss a new work">
            <img src="<?php echo $base; ?>/dont-miss.png" alt="Don't miss a new work — Green Borneo Kratom product showcase" width="1440" height="697" loading="lazy" />
        </section>

    </div>



</main>

<?php
get_footer();
