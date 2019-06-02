<?php get_header(); ?>
 <main>
       <section>
        <div class="container">
            <div class="row">
                <?php $error_text = get_option('site_error'); ?>
                <h2 class="col-12 text-center"><?php if( isset($error_text) ){ echo $error_text; } ?></h2>
                <?php $error_image = get_theme_mod('img-upload'); ?>
                <?php if( isset( $error_image ) && !empty( $error_image ) ) : ?>
                <div class="col-12 d-flex justify-content-center">
                    <a href="<?php echo home_url(); ?>"><img  style="width:100%;" src="<?php echo $error_image; ?>" alt=""></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
 </main>
<?php get_footer(); ?>