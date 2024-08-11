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
 * Use a component, supporting args and loading styles and scripts
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
    // Try to enqueue all styles and scripts file for the component or template
    $file_types = ['css', 'scss', 'js'];
    foreach ($file_types as $file_type) {
        $file_abs_path = get_template_directory() . '/' . $directory . '/' . $filename . '.' . $file_type;
        if (file_exists($file_abs_path)) {
            $file_uri = get_template_directory_uri() . '/' . $directory . '/' . $filename . '.' . $file_type;
            if ($file_type == 'css' or $file_type == 'scss') {
                wp_enqueue_style($filename, $file_uri, [], null, 'all');
            } else {
                wp_enqueue_script_module($filename, $file_uri, [], null, true);
            }
        }
    }
}

/*
 * Adds some useful default values to a post object
 */
function wp_easy_expand_post_object($post_object)
{
    if (!isset($post_object->id) and !is_admin()) {
        $post_object->id = $post_object->ID;
        $post_object->url = get_permalink($post_object->ID);
        $post_object->thumbnail_id = get_post_thumbnail_id($post_object->ID);
        $post_object->title = get_the_title($post_object->ID);
    }
    return $post_object;
}

/*
 * Filter an array of posts to add some default values to each post object
 */
function wp_easy_filter_posts($posts)
{
    foreach ($posts as $post) {
        $post = wp_easy_expand_post_object($post);
    }
    return $posts;
}
add_filter('the_posts', 'wp_easy_filter_posts');

/*
 * Filter a single post to add some default values to the post object
 */
function wp_easy_filter_post($post)
{
    $post = wp_easy_expand_post_object($post);
}
add_action('the_post', 'wp_easy_filter_post');

/*
 * Adding JS moudle importmaps to the head, allows easier naming of JS imports
 */
function wp_easy_importmaps()
{
    // Directories to find JS files in, the setup ES6 import maps for
    $directories = [
        // namespace => path
        ''              => '/js',
        'utils/'        => '/js/utils',
        'templates/'    => '/templates',
        'components/'   => '/components',
    ];

    $urls = [];
    foreach ($directories as $namespace => $path) {
        $files = glob(get_template_directory() . $path . '/*.js');
        foreach ($files as $file) {
            $urls[$namespace . basename($file, '.js')] = get_template_directory_uri() . $path . '/' . basename($file);
        }
    }

    $imports = [
        'imports' => [
            ...$urls,
        ]
    ];
?>
    <script type="importmap">
        <?= json_encode($imports); ?>
    </script>
<?php
}
add_action('wp_head', 'wp_easy_importmaps');
