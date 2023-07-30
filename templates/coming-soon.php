<?php

/**
 * Template Name: Coming Soon
 * Template Post Type: page, post, product
 **/

defined('ABSPATH') || die('403 Forbidden');

get_header();
?>
<div id="primary" <?php function_exists('astra_primary_class') ? astra_primary_class() : null; ?>>
    <?php function_exists('astra_primary_content_top') ? astra_primary_content_top() : null; ?>

    <section>
        <div class="container text-center">
            <h1>Coming Soon</h1>
            <h2><?php echo get_the_title(); ?></h2>
            <br>
            <a href="<?php echo home_url('/'); ?>" class="button">Back to Home</a>
        </div>
    </section>

    <?php function_exists('astra_content_page_loop') ? astra_content_page_loop() : the_content(); ?>
    <?php function_exists('astra_primary_content_bottom') ? astra_primary_content_bottom() : null; ?>
</div>
<?php get_footer();
