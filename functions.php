<?php

// safely require php files
if (!function_exists('safe_require_once')) {
    function safe_require_once($path = '') {
        $path = get_stylesheet_directory() . $path;
        file_exists($path) ? require_once $path : null;
    }
}

safe_require_once('/inc/acf.php');
safe_require_once('/inc/ajax.php');
safe_require_once('/inc/contact-form-7.php');
safe_require_once('/inc/cpt.php');
safe_require_once('/inc/footer-hook.php');
safe_require_once('/inc/header-hook.php');
safe_require_once('/inc/setup-theme.php');
safe_require_once('/inc/shortcode.php');
safe_require_once('/inc/site-data.php');
safe_require_once('/inc/wp-admin-pages.php');

// change sender email address
// add_filter('wp_mail_from', function($original_email_address){
//     return get_bloginfo('admin_email');
// });
// change sender name
// add_filter('wp_mail_from_name', function($original_email_from){
//     return get_bloginfo('name');
// });

add_action(
    'wp_enqueue_scripts',
    function () {
        $tpl_dir = get_stylesheet_directory();
        $tpl_dir_uri = get_stylesheet_directory_uri();

        $path = '/css/bootstrap.min.css';
        if (file_exists($tpl_dir . $path)) {
            wp_register_style('child-bootstrap-style', $tpl_dir_uri . $path, [], '5.2.3');
        }
        $path = '/js/bootstrap.bundle.min.js';
        if (file_exists($tpl_dir . $path)) {
            wp_register_script('child-bootstrap-script', $tpl_dir_uri . $path, [], '5.2.3', true);
        }

        $path = '/js/alpine.min.js';
        if (file_exists($tpl_dir . $path)) {
            wp_register_script('child-alpine-script', $tpl_dir_uri . $path, [], '3.10.5', true);
        }

        $path = '/css/main.css';
        if (file_exists($tpl_dir . $path)) {
            wp_enqueue_style('child-main-style', $tpl_dir_uri . $path, [], filemtime($tpl_dir . $path));
        }
        $path = '/js/main.js';
        if (file_exists($tpl_dir . $path)) {
            wp_enqueue_script('child-main-script', $tpl_dir_uri . $path, ['jquery'], filemtime($tpl_dir . $path), true);
        }

        // connect scripts for few templates like this in array format
        // if( is_page_template(['tpl-home.php', 'tpl-about.php']) ){
        wp_enqueue_style('child-bootstrap-style');
        wp_enqueue_script('child-bootstrap-script');
        // }

        // connecting alpine last so DOM event is ready
        if (is_page_template('tpl-alpine-demo.php')) {
            wp_enqueue_script('child-alpine-script');
        }
    },
    50
);

add_action('admin_enqueue_scripts', function () {
    $tpl_dir = get_stylesheet_directory();
    $tpl_dir_uri = get_stylesheet_directory_uri();

    $path = '/js/admin-main.js';
    if (file_exists($tpl_dir . $path)) {
        wp_enqueue_script('child-admin-main-script', $tpl_dir_uri . $path, ['jquery'], filemtime($tpl_dir . $path), true);
    }
});

// Load styles to WYSIWYG editor
add_filter('mce_css', function ($mce_css) {
    $tpl_dir = get_stylesheet_directory();
    $tpl_dir_uri = get_stylesheet_directory_uri();

    $path = '/css/mce-editor.css';
    if (file_exists($tpl_dir . $path)) {
        if (!empty($mce_css)) {
            $mce_css .= ',';
        }
        $mce_css .= $tpl_dir_uri . $path . '?ver=' . filemtime($tpl_dir . $path);

        // Load Custom Font
        // $font_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap';
        // $mce_css .= str_replace( ',', '%2C', $font_url );
    }
    return $mce_css;
});

add_action('login_enqueue_scripts', function () {
    $tpl_dir = get_stylesheet_directory();
    $tpl_dir_uri = get_stylesheet_directory_uri();
    $path = '/css/login.css';
    if (file_exists($tpl_dir . $path)) {
        wp_enqueue_style('child-login-style', $tpl_dir_uri . $path, [], filemtime($tpl_dir . $path));
    }
});

// Add classes to body
// add_filter('body_class', function($classes){
//     if( is_page_template(['tpl-home.php']) ){
//         return $classes;
//     } else {
//         return array_merge($classes, ['my-custom-class'] );
//     }
// });
