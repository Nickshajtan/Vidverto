<?php get_header(); ?>
<main>
    <?php if ( get_query_var('paged') ) {
                $paged = get_query_var('paged');
            } elseif ( get_query_var('page') ) { // на статической главной странице используется 'page' вместо 'paged' 
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
    ?>
    <?php if ( have_posts() ) : ?>
<section>
        <div class="container">
            <div class="row posts-wrapper">
                <?php $counter  = 1; 
                      $count    = 0; 
                      $posts_per_page = get_option('posts_per_page');
                ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part('inc/content','category'); ?>
                <?php $counter++; $count++; ?>
                <?php endwhile; ?>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <?php if ( function_exists('the_posts_pagination') ) : ?>
                    <div class="row d-flex justify-content-center align-items-center"><?php the_posts_pagination(); ?></div>
                <?php endif; ?>
            </div>
        </div>
</section>
<?php else : ?>
<section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center ">
                <?php echo __('Новин не знайдено'); ?>
            </div>
        </div>
</section>
<?php endif; ?><?php wp_reset_postdata(); ?>
</main>
<?php get_footer(); ?>