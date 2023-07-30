<?php

defined('ABSPATH') || die('403 Forbidden');

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
// Use Avatar Images like Google
add_filter('get_avatar_data', function($args, $id_or_email){
    if( is_numeric($id_or_email) ){
        $user = get_user_by('ID', $id_or_email);
    } else {
        $user = get_user_by('email', $id_or_email);
    }
    $colors = ['ef4444', 'f97316', '84cc16', '10b981', '6366f1', 'd946ef', 'f43f5e'];
    $randomIndex = array_rand($colors);
    $args['url'] = 'https://ui-avatars.com/api/?background='. $colors[$randomIndex] .'&color=ffffff&name='. $user->display_name;
    return $args;
}, 10, 2);
*/

/*
function file_url_to_path( $url ) {
  $parsed_url = parse_url( $url );
  if( empty($parsed_url['path']) ) return false;
  $file = ABSPATH . ltrim( $parsed_url['path'], '/');
  if ( file_exists( $file) ) return $file;
  return false;
}
*/

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
