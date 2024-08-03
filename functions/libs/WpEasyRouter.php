<?php

function wp_easy_router($routes)
{
    require_once get_template_directory() . '/functions/libs/PathToRegexp.php';

    $keys = [];
    $template_name = '';

    foreach ($routes as $name => $params) {

        $re = PathToRegexp::convert($params['path'], $keys);
        $matches = [];
        $match = preg_match($re, $_SERVER["REQUEST_URI"], $matches);

        if ($match) {
            $template_name = $params['template'] ?? $name;
            break;
        }
    }

    $template = locate_template(array('templates/' . $template_name . '.php'));

    if ($template_name and !$template) {
        $error = new WP_Error(
            'missing_template',
            sprintf(__('The file for the template %s does not exist', 'wp-easy-router'), '<b>' . $template_name . '</b>')
        );
        echo $error->get_error_message();
    }

    // Now replace the template
    add_filter('template_include', function ($old_template) use ($template, $template_name) {

        if (!$template) {
            set_query_var('template', 'default');
            return $old_template;
        }

        // Set our custom query var
        set_query_var('template', $template_name);
        return $template;
    }, 1);
}

// Add custom body classes to the front-end of our application so we can style accordingly.
add_filter('body_class', function ($classes) {
    $classes[] = 'template-' . get_route_name();
    return $classes;
});

// Register our custom query var
add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'template';
    return $query_vars;
});

// Helper function to get the current route name
function get_route_name()
{
    return get_query_var('template') ?? 'default';
}
