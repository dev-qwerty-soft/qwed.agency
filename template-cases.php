<?php
/**
 * Template Name: Cases Listing
 *
 * Page template that lists every published "case" in a grid with pagination.
 * Assign it to a Page via Page Attributes -> Template, then add that Page to
 * a menu. Works at /{page-slug}/ and /{page-slug}/page/2/ etc.
 */

if (!defined('ABSPATH')) {
  exit();
}

get_header();

$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

$cases = new WP_Query([
  'post_type' => 'case',
  'post_status' => 'publish',
  'posts_per_page' => 9,
  'paged' => $paged,
  'orderby' => 'menu_order date',
  'order' => 'ASC',
]);
?>

<main class="cases-listing" id="main-content">
    <div class="container">

        <header class="cases-listing__head">
            <h1 class="cases-listing__title"><?php the_title(); ?></h1>
        </header>

        <?php if ($cases->have_posts()): ?>
            <ul class="cases-listing__grid">
                <?php while ($cases->have_posts()): $cases->the_post(); ?>
                    <li class="cases-listing__item">
                        <a class="cases-listing__card" href="<?php the_permalink(); ?>">
                            <span class="cases-listing__media">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('large', ['class' => 'cases-listing__img', 'loading' => 'lazy']); ?>
                                <?php else: ?>
                                    <span class="cases-listing__placeholder" aria-hidden="true"></span>
                                <?php endif; ?>
                            </span>
                            <span class="cases-listing__name"><?php the_title(); ?></span>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>

            <?php
            $links = paginate_links([
              'total' => (int) $cases->max_num_pages,
              'current' => $paged,
              'base' => trailingslashit(get_permalink()) . '%_%',
              'format' => 'page/%#%/',
              'prev_text' => '&larr;',
              'next_text' => '&rarr;',
              'type' => 'array',
            ]);
            if (!empty($links)): ?>
                <nav class="cases-listing__pagination" aria-label="Cases pagination">
                    <?php foreach ($links as $link): ?>
                        <span class="cases-listing__page"><?php echo $link; ?></span>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <p class="cases-listing__empty">No cases published yet.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

    </div>
</main>

<?php
get_footer();
