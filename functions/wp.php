<?php
/*
 * Theme init functions
 */
function wp_easy_init()
{
    add_theme_support('title-tag');
    add_theme_support('menus');
    add_theme_support('html5', array('gallery', 'caption'));

    add_post_type_support('page', 'excerpt');
    register_taxonomy_for_object_type('post_tag', 'page');

    // Disable the hiding of big images
    add_filter('big_image_size_threshold', '__return_false');
    add_filter('max_srcset_image_width', '__return_false');
}
add_action('init', 'wp_easy_init');


/*
 * Enqueue Custom Styles
 */
function wp_easy_styles()
{
    wp_enqueue_style('fonts', get_template_directory_uri() . '/styles/fonts.css', [], null, 'all');
    wp_enqueue_style('variables', get_template_directory_uri() . '/styles/variables.scss', [], null, 'all');
    wp_enqueue_style('main', get_template_directory_uri() . '/styles/main.scss', [], null, 'all');
}
add_action("wp_enqueue_scripts", "wp_easy_styles", 10);

/*
 * Enqueue Custom Scripts
 */
function wp_easy_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script_module('main', get_template_directory_uri() . '/js/main.js', ['jquery'], [], null, true);
    wp_enqueue_script_module('svgs', get_template_directory_uri() . '/js/svgs.js', [], null, true);
    wp_enqueue_script_module('fonts', get_template_directory_uri() . '/js/fonts.js', [], null, true);

    // Enqueue all JS files in /js/libs
    wp_easy_auto_enqueue_libs();

    // Setup JS variables in scripts
    wp_localize_script('jquery', 'serverVars', array(
        'themeURL' => get_template_directory_uri(),
        'homeURL'  => home_url()
    ));
}
add_action("wp_enqueue_scripts", "wp_easy_scripts", 10);

/*
 * Helper function to enqueue all JS files in /js/libs
 */
function wp_easy_auto_enqueue_libs()
{
    $libs_dir = get_template_directory() . '/js/libs/';
    $libs = glob($libs_dir . '*.js');
    foreach ($libs as $lib) {
        // Remove file extension and version numbers for the handle name of the script
        $handle = basename($lib, '.js');
        $handle = str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'js', '..'], '', $handle);
        $handle = rtrim($handle, ".");
        wp_enqueue_script($handle, get_template_directory_uri() . '/js/libs/' . basename($lib), [], null, true);
    }
}

/*
 * Just a hack to allow jQuery to work globally
 * This way cause conflicts with other JS libraries that us $ as a global variable.
 */
function wp_easy_enable_jquery_dollar()
{
?>
    <!-- A hacky way to allow jQuery to work globally. -->
    <!-- This might cause conflicts with other JS libraries that us $ as a global variable. -->
    <script type="text/javascript">
        window.$ = jQuery;
    </script>
<?php
}
add_action('wp_head', 'wp_easy_enable_jquery_dollar');

/*
 * Disable the default WordPress emoji scripts
 */
function wp_easy_disable_wp_emojicons()
{
    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', function ($plugins) {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    });
}
add_action('init', 'wp_easy_disable_wp_emojicons');

/*
 * Adding generic meta tags to the head
 * Added here to keep the header.php clean
 */
function wp_easy_head()
{
?>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/images/favicon.png" />
<?php
}
add_action('wp_head', 'wp_easy_head');

/**
 * Allow SVG uploads.
 * Off be default, only enable on sites that need SVG uploaded.
 */
function add_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_mime_types');

/**
 * Remove jQuery Migrate auto-loading by WordPress
 */
function wp_easy_dequeue_jquery_migrate($scripts)
{
    if (! is_admin() && ! empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            ['jquery-migrate']
        );
    }
}
add_action('wp_default_scripts', 'wp_easy_dequeue_jquery_migrate');
