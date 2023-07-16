<?php
/**
 * Template Name: Home Page
 */

get_header();

if (function_exists('astra_page_layout') && astra_page_layout() == 'left-sidebar') {
    get_sidebar();
}
?>
<div id="primary" <?php if (function_exists('astra_primary_class')) {
    astra_primary_class();
} ?>>
    <?php function_exists('astra_primary_content_top') ? astra_primary_content_top() : null; ?>

    <section>
        <div class="container-xl">
            <!-- start coding -->
        </div>
    </section>

    <?php function_exists('astra_content_page_loop') ? astra_content_page_loop() : the_content(); ?>
    <?php function_exists('astra_primary_content_bottom') ? astra_primary_content_bottom() : null; ?>
</div>
<?php
if (function_exists('astra_page_layout') && astra_page_layout() == 'right-sidebar') {
    get_sidebar();
}
get_footer();

