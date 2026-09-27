<?php
/*
 * Theme init functions
 */
function wp_easy_init()
{
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menus(array(
        'primary' => __('Primary navigation', 'wp-easy'),
        'footer'  => __('Footer navigation', 'wp-easy'),
    ));
    add_theme_support('html5', array('gallery', 'caption'));

    add_post_type_support('page', 'excerpt');
    register_taxonomy_for_object_type('post_tag', 'page');

    // Disable the hiding of big images
    add_filter('big_image_size_threshold', '__return_false');
    add_filter('max_srcset_image_width', '__return_false');
}
add_action('init', 'wp_easy_init');
