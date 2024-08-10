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
    wp_enqueue_script('webfontloader', get_template_directory_uri() . '/js/libs/webfont.1.6.26.js', [], null, true);
    wp_enqueue_script('jquery');
    wp_enqueue_script_module('main', get_template_directory_uri() . '/js/main.js', ['jquery'], [], null, true);
    wp_enqueue_script_module('svgs', get_template_directory_uri() . '/js/svgs.js', [], null, true);
    wp_enqueue_script_module('fonts', get_template_directory_uri() . '/js/fonts.js', [], null, true);

    // Setup JS variables in scripts
    wp_localize_script('jquery', 'serverVars', array(
        'themeURL' => get_template_directory_uri(),
        'homeURL'  => home_url()
    ));
}
add_action("wp_enqueue_scripts", "wp_easy_scripts", 10);

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
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
<?php
}
add_action('wp_head', 'wp_easy_head');


/*
 * Adding JS moudle importmaps to the head
 */
function wp_easy_importmaps()
{

    // TODO Load all templates and components as modules, like wp-easy/templates/header and wp-easy/components/button

    $templates = get_template_directory() . '/templates/';
    $template_files = glob($templates . "*.js");
    $template_urls = [];

    foreach ($template_files as $file) {
        $template_urls['wp-easy/templates/' . basename($file, '.js')] = get_template_directory_uri() . '/templates/' . basename($file);
    }

    $components = get_template_directory() . '/components/';
    $component_files = glob($components . "*.js");
    $component_urls = [];

    foreach ($component_files as $file) {
        $component_urls['wp-easy/components/' . basename($file, '.js')] = get_template_directory_uri() . '/components/' . basename($file);
    }

    $imports = [
        'imports' => [
            'wp-easy/main' => get_template_directory_uri() . '/js/main.js',
            'wp-easy/svgs' => get_template_directory_uri() . '/js/svgs.js',
            ...$template_urls,
            ...$component_urls
        ]
    ];
?>
    <script type="importmap">
        <?php echo json_encode($imports); ?>
    </script>
<?php
}
add_action('wp_head', 'wp_easy_importmaps');
