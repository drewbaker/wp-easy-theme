<?php

/**
 * This file contains all the functions to power the WP-Easy framework, such as component rendering, default values, and helper functions.
 *
 */

function get_route_name()
{
    return get_query_var('template');
}

function set_defaults($args, $defaults)
{
    return wp_parse_args($args, $defaults);
}

function use_header($name = 'components/header', $args = null)
{
    get_template_part($name, $args);
}

function use_footer($name = 'components/footer', $args = null)
{
    get_template_part($name, $args);
}

function use_component($name, $props = null)
{
    $scss_abs_path = get_template_directory() . '/components/' . $name . '.scss';
    $css_abs_path = get_template_directory() . '/components/' . $name . '.css';

    if (file_exists($scss_abs_path)) {
        $scss_uri = get_template_directory_uri() . '/components/' . $name . '.scss';
        wp_enqueue_style($name, $scss_uri, [], null, 'all');
    }
    if (file_exists($css_abs_path)) {
        $css_uri = get_template_directory_uri() . '/components/' . $name . '.css';
        wp_enqueue_style($name, $css_uri, [], null, 'all');
    }

    get_template_part(
        'components/' . $name,
        null,
        $props
    );
}
