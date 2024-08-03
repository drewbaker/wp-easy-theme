<?php

/**
 * This file contains all the functions to power the WP-Easy framework, such as component rendering, default values, and helper functions.
 *
 */



function set_defaults($args, $defaults)
{
    return wp_parse_args($args, $defaults);
}

function use_component($name, $props = null)
{

    wp_easy_enqueue_scripts($name, 'components');

    get_template_part(
        'components/' . $name,
        null,
        $props
    );
}

function wp_easy_enqueue_scripts($filename, $directory = 'components')
{
    $scss_abs_path = get_template_directory() . '/' . $directory . '/' . $filename . '.scss';
    $css_abs_path = get_template_directory() . '/' . $directory . '/' . $filename . '.css';

    if (file_exists($scss_abs_path)) {
        $scss_uri = get_template_directory_uri() . '/' . $directory . '/' . $filename . '.scss';
        wp_enqueue_style($filename, $scss_uri, [], null, 'all');
    }
    if (file_exists($css_abs_path)) {
        $css_uri = get_template_directory_uri() . '/' . $directory . '/' . $filename . '.css';
        wp_enqueue_style($filename, $css_uri, [], null, 'all');
    }
}

function wp_easy_load_template_scripts()
{
    wp_easy_enqueue_scripts(get_route_name(), 'templates');
}
add_action("wp_enqueue_scripts", "wp_easy_load_template_scripts", 10);
