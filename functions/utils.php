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


/*
 * Get the next or previous sibling page (or any post type)
 */
function get_adjacent_sibling($post_id, $direction = 'next', $args = ['post_type' => 'page', 'orderby' => 'menu_order'])
{
    $post = get_post($post_id);
    $is_next = $direction == 'next';
    $is_prev = $direction == 'prev' || $direction == 'previous';

    // Get all siblings, respect supplied args
    $defaults = [
        'post_type'         => get_post_type($post),
        'posts_per_page'    => -1,
        'order'         => 'ASC',
        'orderby'       => 'menu_order',
        'post_parent'   => $post->post_parent,
        'fields'        => 'ids'
    ];
    $args = wp_parse_args($args, $defaults);
    $siblings = get_posts($args);

    // Find where current post is in the array
    $current = array_search($post->ID, $siblings);

    // Get the adjacent post
    if ($is_next) {
        $adjacent_post_id = $siblings[$current + 1] ?? null;
    } else {
        $adjacent_post_id = $siblings[$current - 1] ?? null;
    }

    // Loop around if at the end
    $found = count($siblings);
    if ($current == 0 and $is_prev) {
        $adjacent_post_id = $siblings[$found - 1];
    } elseif ($current == $found - 1 and $is_next) {
        $adjacent_post_id = $siblings[0];
    }

    return wp_easy_expand_post_object(get_post($adjacent_post_id));
}
