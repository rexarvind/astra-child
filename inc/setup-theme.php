<?php

defined('ABSPATH') || die('403 Forbidden');

// start PHP sessions
add_action('init', function () {
    if (!session_id()) {
        session_start([
            'read_and_close' => true,
        ]);
    }
});

add_action('after_setup_theme', function () {
    add_theme_support('custom-header', [
        'height' => '40',
        'flex-height' => true,
        'width' => '140',
        'flex-width' => true,
        'uploads' => true,
        'header-text' => true,
    ]);

    add_theme_support('custom-logo', [
        'height' => 145,
        'weight' => 45,
        'flex-height' => true,
        'flex-weight' => true,
    ]);

    // Uncomment when you need to register new menus
    // register_nav_menus([
    //     'footer1' => __('Footer 1', 'astra-child'),
    //     'footer2' => __('Footer 2', 'astra-child'),
    // ]);
});
