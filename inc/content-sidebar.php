<div class="col-12">
    <div class="row">
        <?php if ( is_active_sidebar( 'sidebar_one' ) ) : ?>
            <aside class="show__block col-12 col-md-6 col-lg-3 d-flex justify-content-center"><?php dynamic_sidebar( 'sidebar_one' ); ?></aside>
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'sidebar_two' ) ) : ?>
            <aside class="show__block col-12 col-md-6 col-lg-3 d-flex justify-content-center"><?php dynamic_sidebar( 'sidebar_two' ); ?></aside>
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'sidebar_three' ) ) : ?>
            <aside class="show__block col-12 col-md-6 col-lg-3 d-flex justify-content-center"><?php dynamic_sidebar( 'sidebar_three' ); ?></aside>
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'sidebar_four' ) ) : ?>
            <aside class="show__block col-12 col-md-6 col-lg-3 d-flex justify-content-center"><?php dynamic_sidebar( 'sidebar_four' ); ?></aside>
        <?php endif; ?>
    </div>
</div>