<?php if ( have_posts() ) : ?>
<section>
        <div class="container">
            <div class="row posts-wrapper">
                <?php $counter  = 1; 
                      $count    = 0; 
                      $posts_per_page = get_option('posts_per_page');
                ?>
                <?php while ( have_posts() ) : the_post(); ?>
<!--                  IS HOME PAGE-->
                   <?php  if( ( is_home() || is_front_page() ) && $paged < 2 && !is_paged() ) : ?>
                      <?php if( $counter == 1 ) : ?>
                          <?php get_template_part('inc/home/first'); ?>
                      <?php endif; ?>
                      <?php if( $counter == 2 ) : ?>
                          <?php get_template_part('inc/home/second'); ?>
                      <?php endif; ?>
                      <?php if( $counter == 3 ) : ?>
                          <?php get_template_part('inc/home/third'); ?>
                      <?php endif; ?>
                      <?php if( $counter == 4 ) : ?>
                          <?php get_template_part('inc/content', 'sidebar'); ?>
                          <?php get_template_part('inc/home/fourth'); ?>
                      <?php endif; ?>
                      <?php if( $counter > 4 ) : ?>
                          <?php if( $count == 8 ){ $count = 0; } ?>
                          <?php if( $count < 3 ) : ?>
                             <?php get_template_part('inc/content', 'small'); ?> 
                          <?php endif; ?>
                          <?php if( $count == 4 || $count == 7 ) : ?>
                              <?php get_template_part('inc/content', 'small'); ?> 
                          <?php endif; ?>
                          <?php if( $count == 5 || $count == 6 ) : ?>
                              <?php get_template_part('inc/content', 'middle'); ?> 
                          <?php endif; ?>
                      <?php endif; ?>
<!--                    END HOME PAGE                     -->
                   <?php elseif( is_search() && $paged < 2 && !is_paged() ) : ?>
                       <?php get_template_part('inc/content','big'); ?>
                   <?php elseif( is_category() && $paged < 2 && !is_paged() ) : ?>
                       <?php get_template_part('inc/content','category'); ?>
                   <?php elseif( ( is_page() || is_single() ) && $paged < 2 && !is_paged() ) : ?>
                       <?php get_template_part('inc/content','single'); ?>
                   <?php elseif( is_paged() && $paged > 2 && $counter > $posts_per_page ) : ?> 
                       <?php get_template_part('inc/content', 'small'); ?> 
                   <?php else : ?>
                       <?php get_template_part('inc/ajax','small'); ?>
                   <?php endif; ?>
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