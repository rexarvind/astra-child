<?php

defined('ABSPATH') || exit();
defined('SITE_NAME') || define('SITE_NAME', 'WordPress Site Name');
defined('SITE_ADMIN_EMAIL') || define('SITE_ADMIN_EMAIL', get_bloginfo('admin_email'));
defined('SITE_DEV_EMAIL') || define('SITE_DEV_EMAIL', 'byvexarvind@gmail.com');
defined('TPL_DIR') || define('TPL_DIR', get_stylesheet_directory());
defined('TPL_DIR_URI') || define('TPL_DIR_URI', get_stylesheet_directory_uri());
defined('SITE_UPLOAD_DIR_ARR') || define('SITE_UPLOAD_DIR_ARR', wp_upload_dir());
defined('SITE_UPLOAD_DIR') || define('SITE_UPLOAD_DIR', (is_array(SITE_UPLOAD_DIR_ARR) && isset(SITE_UPLOAD_DIR_ARR['basedir'])) ? SITE_UPLOAD_DIR_ARR['basedir'] : $_SERVER['DOCUMENT_ROOT']);
defined('SITE_UPLOAD_DIR_URI') || define('SITE_UPLOAD_DIR_URI', (is_array(SITE_UPLOAD_DIR_ARR) && isset(SITE_UPLOAD_DIR_ARR['baseurl'])) ? SITE_UPLOAD_DIR_ARR['baseurl'] : 'https://' . $_SERVER['HTTP_HOST']);


// safely require php files
if (!function_exists('safe_require_once')) {
    function safe_require_once($path = '')
    {
        $path = TPL_DIR . $path;
        file_exists($path) ? require_once $path : null;
    }
}

safe_require_once('/inc/acf/index.php');
safe_require_once('/inc/ajax.php');
safe_require_once('/inc/contact-form-7.php');
safe_require_once('/inc/cpt.php');
safe_require_once('/inc/footer-hook.php');
safe_require_once('/inc/header-hook.php');
safe_require_once('/inc/setup-theme.php');
safe_require_once('/inc/shortcode.php');

add_action(
    'wp_enqueue_scripts',
    function () {
        $tpl_dir = TPL_DIR;
        $tpl_dir_uri = TPL_DIR_URI;

        $path = '/assets/css/bootstrap.min.css';
        if (file_exists($tpl_dir . $path)) {
            wp_register_style('child-bootstrap-style', $tpl_dir_uri . $path, [], '5.2.3');
        }
        $path = '/assets/js/bootstrap.bundle.min.js';
        if (file_exists($tpl_dir . $path)) {
            wp_register_script('child-bootstrap-script', $tpl_dir_uri . $path, [], '5.2.3', true);
        }

        $path = '/assets/js/alpine.min.js';
        if (file_exists($tpl_dir . $path)) {
            wp_register_script('child-alpine-script', $tpl_dir_uri . $path, [], '3.13.0', true);
        }

        $path = '/assets/css/main.css';
        if (file_exists($tpl_dir . $path)) {
            wp_enqueue_style('child-main-style', $tpl_dir_uri . $path, [], filemtime($tpl_dir . $path));
        }
        $path = '/assets/js/main.js';
        if (file_exists($tpl_dir . $path)) {
            wp_enqueue_script('child-main-script', $tpl_dir_uri . $path, ['jquery'], filemtime($tpl_dir . $path), true);
        }

        wp_enqueue_style('child-bootstrap-style');
        wp_enqueue_script('child-bootstrap-script');

        /* connect styles to specific pages */
        if (is_singular(['post'])) {
            $path = '/assets/css/single-post.css';
            if(file_exists($tpl_dir . $path)){
                wp_enqueue_style('child-single-post-style', $tpl_dir_uri . $path, [], filemtime($tpl_dir . $path));
            }
        }

        /* connecting alpine last so DOM event is ready */
        if (is_page_template(['templates/tpl-alpine-demo.php'])) {
            wp_enqueue_script('child-alpine-script');
        }

    },
    50
);

add_action('admin_enqueue_scripts', function () {
    $tpl_dir = TPL_DIR;
    $tpl_dir_uri = TPL_DIR_URI;

    $path = '/assets/js/admin-main.js';
    if (file_exists($tpl_dir . $path)) {
        wp_enqueue_script('child-admin-main-script', $tpl_dir_uri . $path, ['jquery'], filemtime($tpl_dir . $path), true);
    }
    $path = '/assets/css/admin-main.css';
    if (file_exists($tpl_dir . $path)) {
        wp_enqueue_style('child-admin-main-style', $tpl_dir_uri . $path, [], filemtime($tpl_dir . $path));
    }
    wp_enqueue_style('child-admin-inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap');
});

// load styles to WYSIWYG editor
add_filter('mce_css', function ($mce_css) {
    $tpl_dir = TPL_DIR;
    $tpl_dir_uri = TPL_DIR_URI;

    $path = '/assets/css/mce-editor.css';
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


/* change wp-admin login page styles */
add_action('login_enqueue_scripts', function () {
    $tpl_dir = TPL_DIR;
    $tpl_dir_uri = TPL_DIR_URI;
    $path = '/assets/css/login.css';
    if (file_exists($tpl_dir . $path)) {
        wp_enqueue_style('child-login-style', $tpl_dir_uri . $path, [], filemtime($tpl_dir . $path));
    }
});
