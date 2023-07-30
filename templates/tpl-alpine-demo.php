<?php

/**
 * Template Name: Alpine Demo
 */

defined('ABSPATH') || die('403 Forbidden');

get_header();
?>
<div id="primary" <?php function_exists('astra_primary_class') ? astra_primary_class() : null; ?>>
    <?php function_exists('astra_primary_content_top') ? astra_primary_content_top() : null; ?>

    <div class="container-xl py-4">
        <?php function_exists('astra_content_page_loop') ? astra_content_page_loop() : the_content(); ?>
    </div>

    <section x-data="home_data">
        <div>
            <button @click="handleToggle">Toggle</button>
            <div x-show="toggleOpen" @click.outside="toggleOpen = false">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, pariatur nobis, ut quam quasi eum ipsam iste laborum dolore exercitationem aliquam minus. Dolor maxime accusamus aspernatur eum facilis molestiae, facere?</p>
            </div>
        </div>
    </section>

    <?php function_exists('astra_primary_content_bottom') ? astra_primary_content_bottom() : null; ?>
</div>

<script type="text/javascript">
(function(){
    function alpine_data() {
        return {
            toggleOpen: false,
            handleToggle(){
                this.toggleOpen = ! this.toggleOpen;
            },
            init(){
                console.log('init() is like mounted in VueJS');
            },
        }
    }
    function alpine_init() { Alpine.data('home_data', alpine_data ); }
    document.addEventListener('alpine:init', alpine_init);
})();
</script>

<?php get_footer();
