<?php if (substr_count($_SERVER[‘HTTP_ACCEPT_ENCODING’], ‘gzip’)) ob_start(«ob_gzhandler»); else ob_start(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,user-scalable=0">
    <meta name="keywords" content="">
    <title><?php echo wp_get_document_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
    <div class="main__wrapper global-wrapper">
       <header class="mobile">
           <div class="container">
               <div class="row d-flex flex-row justify-content-between align-items-center">
                   <div class="burger d-block col-md-1 d-md-flex flex-column justify-content-center">
                       <span class="line line_first d-block"></span>
                       <span class="line line_second d-block"></span>
                   </div>
                   <div class="col-12 col-md-10 d-flex flex-row justify-content-center align-items-center">
                       <?php if ( function_exists( 'the_custom_logo' ) ) { if( is_home() || is_front_page() ){ echo '<h1 class="d-block w-100 text-center">';} the_custom_logo(); if( is_home() || is_front_page() ){ echo '</h1>';} }?>
                   </div> 
                   <div class="search_form d-block col-md-1 d-md-flex flex-row-reverse">
                       <img src="<?php echo get_template_directory_uri(); ?>/img/magnify.svg" alt="" class="search_icon">
                       <?php echo get_search_form(); ?>
                   </div>     
               </div>
           </div>
       </header>
       <section class="mobile mobile-menu d-none">
          <?php if( has_nav_menu('main') ) : ?> 
           <div class="container">
               <div class="row">
                   <div class="col-12 menu__main__container">
                       <?php wp_nav_menu(array('theme_location'  => 'main')); ?>
                   </div>
               </div>
           </div>
           <?php endif; ?>
       </section>
       <?php $position = get_theme_mod('breadcrumbs'); ?>
       <?php if( !(  is_home() || is_front_page() ) && function_exists('the_posts_pagination') && ( $position == 'block' ) ) : ?>
       <section>
           <div class="container" style="height:60px;">
               <div class="row d-flex flex-row justify-content-start align-items-center h-100">
                   <div class="col-12"><?php the_breadcrumb() ?></div>
               </div>
           </div>
       </section>
       <?php endif; ?>
       <?php if( !is_404() && !is_page() && !is_single() ) : ?>
       <section class="switcher">
           <div class="container">
               <div class="row">
                   <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                       <div class="switch switch_left left d-flex flex-row w-50 justify-content-end align-items-center">
                           <span><?php echo __('по порядку'); ?></span>
                           <img src="<?php echo get_template_directory_uri(); ?>/img/square-grid.svg" alt="">
                       </div>
                       <div class="switch switch_right right d-flex flex-row w-50 justify-content-start align-items-center">
                           <img src="<?php echo get_template_directory_uri(); ?>/img/view-headline.svg" alt="">
                           <span><?php echo __('списком'); ?></span>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <?php endif; ?>