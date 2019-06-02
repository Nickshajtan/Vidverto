<?php if( !is_mobile() ){ $size = 'content-small'; }else{ $size = 'content-middle'; } ?>   
<?php if( get_page_template_slug( get_the_ID() ) == '' || get_page_template_slug( get_the_ID() ) == 'page-single.php' ): ?>
                            <?php if( get_post_meta(get_the_ID(), 'my_checkbox', true) == 'white' ){$class = 'white__bottom';}else{$class= 'card';} ?>
                        <article id="post-<?php the_ID(); ?>" class="post col-12 col-md-6 col-lg-4" data-href="<?php the_permalink() ?>" data-class="ajax-post">
                                    <div class="content-wrapper <?php echo $class; ?>" <?php if ( has_post_thumbnail()) : ?>style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), $size); ?>')"<?php endif; ?>>
                                        <div class="content">
                                            <div class="white__block">
                                               <?php the_category(); ?>
                                                <p class="title"><?php the_title(); ?></p>
                                                <date class="d-flex align-items-center"  title="<?php echo get_the_date('j F Y H:i'); ?>">
                                                    <object width='15' height='15' type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/img/clock.svg" class="d-block"></object>
                                                    <time class="timeago" datetime="<?php echo get_the_date('Y-m-j H:i:s'); ?>"><?php echo get_the_date('j F Y H:i'); ?></time>
                                                </date>
                                            </div>
                                        </div>
                                    </div>
                                    <?php get_template_part('inc/ajax', 'js'); ?>
                        </article>
<?php elseif( get_page_template_slug( get_the_ID() ) == 'adv.php' ) : ?>
                               <?php if( !empty( get_post_meta(get_the_ID(), 'title', true) ))
                                {
                                    $link = get_post_meta(get_the_ID(), 'title', true);
                                    $content = '';
                                }else{
                                    $link='#';
                                    $content = get_the_content();
                                } ?>
            <a href="<?php echo $link; ?>" target="_blank" id="post-<?php the_ID(); ?>" class="post col-12 col-md-6 col-lg-4" data-class="ajax-post">
                <div class="content-wrapper d-flex justify-content-center align-items-center" <?php if ( has_post_thumbnail()) : ?>style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), $size); ?>')"<?php endif; ?>>
                                <div class="title"><?php the_title(); ?></div>
                                <div class="text-white"><?php echo $content; ?></div>
                </div>
                <?php get_template_part('inc/ajax', 'js'); ?>
            </a> 
<?php endif; ?>