<?php


function child_setup_theme(){

    add_theme_support('custom-header', array(
        'height' => '40',
        'flex-height' => true,
        'width' => '140',
        'flex-width' => true,
        'uploads' => true,
        'header-text' => true,
    ));
    add_theme_support(
        'custom-logo',
        array(
            'height' => 145,
            'weight' => 45,
            'flex-height' => true,
            'flex-weight' => true,
        )
    );

    // register_nav_menus(array(
    //     'footer1' => __('Footer 1', 'astra-child'),
    //     'footer2' => __('Footer 2', 'astra-child'),
    // ));
}
add_action('after_setup_theme', 'child_setup_theme');



// Support for ACF Option page
if( function_exists('acf_add_options_page') ){
    acf_add_options_page();
}


