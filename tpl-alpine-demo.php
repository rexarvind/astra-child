<?php

/**
 * Template Name: Alpine Demo
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

    <section x-data="home_data">
        <div>
            <button @click="handleToggle">Toggle</button>
            <div x-show="toggleOpen" @click.outside="toggleOpen = false">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, pariatur nobis, ut quam quasi eum ipsam iste laborum dolore exercitationem aliquam minus. Dolor maxime accusamus aspernatur eum facilis molestiae, facere?</p>
            </div>
        </div>
    </section>

    <?php astra_primary_content_bottom(); ?>
</div><!-- #primary -->

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

<?php
if ( astra_page_layout() == 'right-sidebar' ){
    get_sidebar();
}
get_footer();
