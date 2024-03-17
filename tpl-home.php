<?php

/**
 * Template Name: Home Page
 */

defined('ABSPATH') || exit();

get_header();
?>
<div id="primary" <?php function_exists('astra_primary_class') ? astra_primary_class() : null; ?>>
    <?php function_exists('astra_primary_content_top') ? astra_primary_content_top() : null; ?>

    <?php
    $pj_name = 'Blue Bottle Caf?© ‚Äì Prudential Tower | Boston, MA';
    $pj_name = 'fb-borító-1.jpg';

    try {
        // $post_id = wp_insert_post( array(
        //     'post_title' => wp_strip_all_tags($pj_name),
        //     'post_content' => '',
        //     'post_excerpt' => '',
        //     'post_status' => 'publish',
        // ) );
        $post_id = wp_strip_all_tags(remove_accents($pj_name));
        var_dump($post_id);
        echo 'yes';
    } catch (Exception $e) {
        var_dump($e);
        echo 'no';
    }




    ?>


    <section>
        <div class="container-lg text-center">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <?php function_exists('astra_content_page_loop') ? astra_content_page_loop() : the_content(); ?>
    <?php function_exists('astra_primary_content_bottom') ? astra_primary_content_bottom() : null; ?>
</div>
<?php get_footer();
