<?php

/**
 * Template Name: Home Page
 */

get_header();
if ( astra_page_layout() == 'left-sidebar' ){
    get_sidebar();
}
?>

<div id="primary" <?php astra_primary_class(); ?>>
    <?php astra_primary_content_top(); ?>


    <div class="container-xl py-4">
        <?php astra_content_page_loop(); ?>
    </div>


    <?php astra_primary_content_bottom(); ?>
</div><!-- #primary -->

<?php
if ( astra_page_layout() == 'right-sidebar' ){
    get_sidebar();
}
get_footer();
