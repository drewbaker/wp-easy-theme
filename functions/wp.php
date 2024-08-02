<?php
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
    wp_enqueue_script_module('browser', get_template_directory_uri() . '/js/browser.js', [], null, true);
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
 * Adding generic meta tags to the head
 * Added here to keep the header.php clean
 */
function wp_easy_head()
{
?>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
<?php
}
add_action('wp_head', 'wp_easy_head');

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
