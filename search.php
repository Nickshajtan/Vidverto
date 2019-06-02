<?php get_header(); ?>
<main>
    <?php if ( get_query_var('paged') ) {
                $paged = get_query_var('paged');
            } elseif ( get_query_var('page') ) { // на статической главной странице используется 'page' вместо 'paged' 
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
    get_template_part('inc/content'); 
    ?>
    <script>
        jQuery(document).ready(function($){
            $('.content-wrapper').removeClass('card card-big');
        });
    </script>
</main>
<?php get_footer(); ?>