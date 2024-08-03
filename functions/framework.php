<?php

/**
 * This file contains all the functions to power the WP-Easy framework, such as component rendering, default values, and helper functions.
 *
 */


/*
 * Helper function to set default values component args
 */
function set_defaults($args, $defaults)
{
    return wp_parse_args($args, $defaults);
}

/*
 * Use a component, supporing args and loading styles and scripts
 */
function use_component($name, $props = null)
{

    wp_easy_enqueue_scripts($name, 'components');

    get_template_part(
        'components/' . $name,
        null,
        $props
    );
}

/*
 * Load the current routes styles and scripts
 */
function wp_easy_enqueue_template_scripts()
{
    wp_easy_enqueue_scripts(get_route_name(), 'templates');
}
add_action("wp_enqueue_scripts", "wp_easy_enqueue_template_scripts", 10);

/*
 * Helper function to enqueue scripts and styles for components and templates
 */
function wp_easy_enqueue_scripts($filename, $directory = 'components')
{
    // Start with the css files if they exist
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

    // Now the js files if they exist
    $js_abs_path = get_template_directory() . '/' . $directory . '/' . $filename . '.js';
    if (file_exists($js_abs_path)) {
        $js_uri = get_template_directory_uri() . '/' . $directory . '/' . $filename . '.js';
        wp_enqueue_script_module($filename, $js_uri, [], null, true);
    }
}
