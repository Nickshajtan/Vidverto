<?php
/*
Template Post Type: page
*/
global $post; 
while ( have_posts() ) :
				the_post(); ?>
<?php if( is_singular( 'page' ) ) : ?>
<main>
    <div class="container">
        <div class="row">
           <div class="col-12 d-flex flex-row single-cat"><?php the_category(); ?></div>
            <div class="col-12">
                <h1 class="text-left"><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <?php if ( is_active_sidebar( 'sidebar' ) ){ $class = '8'; }else{ $class='12'; } ?>
            <div class="single-content-wrapper col-12 col-lg-<?php echo $class; ?>">
                <div class="row">
                    <?php if ( has_post_thumbnail()) : ?>
                        <div class="col-12">
                            <?php if( !is_mobile() ){ $size = 'content-big'; }else{ $size = 'content-middle'; } ?>   
                            <?php the_post_thumbnail($size); ?>
                            <p class="text-dark text-left"><?php the_post_thumbnail_caption(); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <div class="single-content text-dark"><?php the_content(); ?></div>
                        <date class="d-flex align-items-center text-dark">
                            <?php echo __('Автор статті'); ?>: <?php echo get_the_author( ); ?>, <?php echo get_the_date('j F Y H:i'); ?>
                        </date>
                    </div>
                    <div class="col-12 d-flex flex-row social-panel">
                       <?php $fb = get_option('site_facebook');
                             $in = get_option('site_inst');
                             $tw = get_option('site_tw');
                        ?>
                        <?php $position = get_theme_mod('fb_show'); ?>
                           <?php if( $position == 'block'  ) : ?>
                            <?php if( !empty( $fb )) : ?>
                                    <a href="<?php echo $fb; ?>" rel="nofollow">
                                        <img class="social"  src="<?php echo get_template_directory_uri(); ?>/img/fb.png" />
                                    </a>
                            <?php else : ?>
                                <a onClick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_title(); ?>&amp;p[summary]=<?php echo wp_get_document_title() . get_the_tags(); ?>&amp;p[url]=<?php echo urlencode(get_the_permalink() ); ?>&amp;p[images][0]=<?php echo get_the_post_thumbnail_url(); ?>','sharer','toolbar=0,status=0,width=700,height=400');" href="javascript: void(0)" rel="nofollow">
                                    <img class="social"  src="<?php echo get_template_directory_uri(); ?>/img/fb.png" />
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php $position = get_theme_mod('inst_show'); ?>
                           <?php if( $position == 'block'  ) : ?>
                            <?php if( !empty( $inst )) : ?>
                                <a href="<?php echo $inst; ?>" rel="nofollow">
                                    <img class="social"  src="<?php echo get_template_directory_uri(); ?>/img/inst.svg" />
                                </a>
                            <?php else : ?>
                                <a href="#" rel="nofollow">
                                    <img class="social" src="<?php echo get_template_directory_uri(); ?>/img/inst.svg" />
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php $position = get_theme_mod('tw_show'); ?>
                           <?php if( $position == 'block'  ) : ?>
                            <?php if( !empty( $tw )) : ?>
                                    <a href="<?php echo $tw; ?>" rel="nofollow">
                                        <img class="social"  src="<?php echo get_template_directory_uri(); ?>/img/tg.svg" />
                                    </a>
                            <?php else : ?>
                                <a href="#" target="_parent" rel="nofollow">
                                    <img class="social"  src="<?php echo get_template_directory_uri(); ?>/img/tg.svg" />
                                </a>
                            <?php endif; ?>
                          <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ( is_active_sidebar( 'sidebar' ) ) : ?> 
                <div class="col-12 col-lg-4 sidebar">
                    <aside><?php dynamic_sidebar( 'sidebar' ); ?></aside>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>