<?php

defined('ABSPATH') || die('403 Forbidden');

// sample ajax request
// https://example.com/wp-admin/admin-ajax.php?action=test_ajax
function test_ajax() {
    echo json_encode(['status' => true, 'message' => 'Request successfull.']);
    exit();
}
add_action('wp_ajax_test_ajax', 'test_ajax');
add_action('wp_ajax_nopriv_test_ajax', 'test_ajax');
