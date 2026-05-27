<?php
/**
 * Default fallback template for the "case" CPT.
 *
 * Used when no per-case template has been selected from the Template
 * dropdown in the admin. Each real case should have its own template
 * under templates/cases/{slug}.php with a "Template Name" header and
 * "Template Post Type: case" so it shows up in that dropdown.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();
?>

<main class="case-fallback" id="main-content">
    <div class="container">
        <?php while (have_posts()) {
          the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <p>
                No layout has been selected for this case. Open it in the admin
                and pick a template from the <strong>Template</strong> dropdown
                in the sidebar.
            </p>
        <?php
        } ?>
    </div>
</main>

<?php
get_footer();
