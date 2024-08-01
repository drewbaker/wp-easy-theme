<?php
/*
 * Enqueue Custom Styles
 */
function wp_easy_styles()
{
    wp_enqueue_style('media-queries', get_template_directory_uri() . '/styles/media-queries.scss', [], null, 'all');
    wp_enqueue_style('variables', get_template_directory_uri() . '/styles/variables.scss', [], null, 'all');
}
add_action("wp_enqueue_scripts", "wp_easy_styles", 10);

/*
 * Enqueue Custom Scripts
 */
function wp_easy_scripts()
{
    //wp_register_script('site', get_template_directory_uri() . '/js/site.js', 'jquery', custom_latest_timestamp() );

    //wp_enqueue_script('jquery');
    //wp_enqueue_script('site', 'jquery');

    // Setup JS variables in scripts
    /*
        wp_localize_script('site', 'siteVars', array(
            'themeURL' => get_template_directory_uri(),
            'homeURL'  => home_url()
        ));
    */
}
add_action("wp_enqueue_scripts", "wp_easy_scripts", 10);





//  Helper functions
function get_route_name() {
    return get_query_var('template');
}

function set_defaults($args, $defaults) {
    return wp_parse_args($args, $defaults);
} 

function use_header($name = 'components/header', $args = null) {
    get_template_part($name, $args);
}

function use_footer($name = 'components/footer', $args = null) {
    get_template_part($name, $args);
}


function use_component($name, $props = null) {
    $scss_abs_path = get_template_directory() . '/components/'. $name .'.scss';
    $css_abs_path = get_template_directory() . '/components/'. $name .'.css';    

    if(file_exists($scss_abs_path)) {
        $scss_uri = get_template_directory_uri() . '/components/'. $name .'.scss';        
        wp_enqueue_style( $name, $scss_uri, [], null, 'all' );    
    }
    if(file_exists($css_abs_path)) {
        $css_uri = get_template_directory_uri() . '/components/'. $name .'.css';            
        wp_enqueue_style( $name, $css_uri, [], null, 'all' );    
    }

    get_template_part(
        'components/' . $name,
        null,
        $props
    );
}