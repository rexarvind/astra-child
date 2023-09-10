<?php

/**
 * Template Name: Home Page
 */

defined('ABSPATH') || exit();

get_header();
?>
<div id="primary" <?php function_exists('astra_primary_class') ? astra_primary_class() : null; ?>>
    <?php function_exists('astra_primary_content_top') ? astra_primary_content_top() : null; ?>

    <section>
        <div class="container-lg text-center">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <?php function_exists('astra_content_page_loop') ? astra_content_page_loop() : the_content(); ?>
    <?php function_exists('astra_primary_content_bottom') ? astra_primary_content_bottom() : null; ?>
</div>
<?php get_footer();
