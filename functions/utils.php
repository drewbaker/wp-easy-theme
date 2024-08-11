<?php

/*
 * Function that works like get_posts, but for children of the current post
 * Also adds some default values to the post object
 */
function use_children($args = [])
{
    global $post;

    $defaults = [
        'post_type'         => 'any',
        'post_parent'       => $post->ID,
        'posts_per_page'    => -1,
        'order'             => 'ASC',
        'orderby'           => 'menu_order'
    ];
    $args = wp_parse_args($args, $defaults);

    $posts = new WP_Query($args);

    return $posts->posts ?? [];
}
