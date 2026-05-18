<?php get_header(); ?>
<main id="main-content" class="site-main">

        <?php while (have_posts()):
          the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <?php printf(
                          esc_html__('Published on %s', 'custombasetheme'),
                          '<span class="posted-on">' . get_the_date() . '</span>'
                        ); ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php // Display post tags

          the_tags(
                      '<span class="tags-links">' . esc_html__('Tags: ', 'custombasetheme'),
                      ', ',
                      '</span>'
                    ); ?>
                </footer>
            </article>

            <?php // Display comments if enabled and available

          if (comments_open() || get_comments_number()):
              comments_template();
            endif; ?>

        <?php
        endwhile; ?>

</main>
<?php get_footer(); ?>
