<?php

if (!function_exists('get_my_site_data')) {
  function get_my_site_data() {
    return [
      'data' => [],
      'tpl_dir' => get_stylesheet_directory(),
      'tpl_dir_uri' => get_stylesheet_directory_uri(),
      'admin_email' => '',
      'dev_email' => 'byvexarvind@gmail.com',
    ];
  }
}
