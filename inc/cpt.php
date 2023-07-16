<?php

// place all custom post type code in one file

function create_news_cpt() {
    $labels = [
        'name' => 'News',
        'singular_name' => 'News',
        'menu_name' => 'News',
        'add_new_item' => 'Add New News',
        'new_item' => 'New News',
        'edit_item' => 'Edit News',
        'view_item' => 'View News',
        'all_items' => 'All News',
        'search_items' => 'Search News',
        'parent_item_colon' => 'Parent News',
        'not_found' => 'No News found',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'capability_type' => 'post',
        'supports' => ['title', 'editor', 'author', 'thumbnail', 'page-attributes'],
        'taxonomies' => [],
        'query_var' => true,
        'rewrite' => ['slug' => 'news'],
        'show_in_rest' => true,
    ];
    register_post_type('news', $args);
    flush_rewrite_rules();
}
// add_action('init', 'create_news_cpt');
