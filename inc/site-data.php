<?php

if (!function_exists('get_my_site_data')) {
    function get_my_site_data() {
        $upload_dir_arr = wp_upload_dir();
        return [
            'data' => [],
            'tpl_dir' => get_stylesheet_directory(),
            'tpl_dir_uri' => get_stylesheet_directory_uri(),
            'upload_dir_arr' => $upload_dir_arr,
            'upload_dir' => $upload_dir_arr['basedir'],
            'upload_dir_uri' => $upload_dir_arr['baseurl'],
            'admin_email' => get_bloginfo('admin_email'),
            'dev_email' => 'byvexarvind@gmail.com',
        ];
    }
}

// down below are some useful functions

/*
function generateOTP($length = 4) {
    $characters = '0123456789';
    $otp = '';
    $charactersLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charactersLength - 1)];
    }
    return $otp;
}
*/

/*
function isValidIndianPhoneNumber($phone = ''){
    $indian_phone_regex = '/^[6-9]\d{9}$/';
    if(preg_match($indian_phone_regex, $phone)){
        return true;
    } else {
        return false;
    }
}
*/
