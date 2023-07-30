<?php

defined('ABSPATH') || die('403 Forbidden');

// Support for ACF Option page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

add_action('acf/init', function () {
    if (function_exists('acf_add_local_field_group')) {
        // "key" should be unique (do not use dash, only underscore)
    }
});
