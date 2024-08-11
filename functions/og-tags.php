<?php
/*
 * Adding generic open-graph meta tags to the head
 * Added here to keep the header.php clean
 */
function wp_easy_og_tags()
{
    global $post;

    // Defaults to site generic info
    $shared_image = get_template_directory_uri() . '/screenshot.png';
    $summary = wp_easy_get_summary();
    $url = get_bloginfo('url');
    $title = wp_easy_get_title();
    $type = 'website';
    $site_name = get_bloginfo('name');

    switch (true) {
        case is_home():
        case is_front_page():
        case empty($post):
            break;

        case !empty($post->video_url):
            $type = 'video';

        case is_singular('post'):
            $type = 'article';

        case is_single() or is_page():
            $url = get_permalink($post->ID);

            // Set image to post thumbnail
            $image_id = get_post_thumbnail_id();
            if (!empty($image_id)) {
                $image_url = wp_get_attachment_image_src($image_id, 'social-preview');
                $shared_image = $image_url[0];
            }

            break;
    }
?>
    <meta property="og:title" content="<?= $title; ?>" />
    <meta property="og:type" content="<?= $type; ?>" />
    <meta property="og:url" content="<?= $url; ?>" />
    <meta property="og:image" content="<?= $shared_image; ?>" />
    <meta property="og:description" content="<?= $summary; ?>" />
    <meta property="og:site_name" content="<?= $site_name; ?>" />
<?php
}
add_action('wp_head', 'wp_easy_og_tags');


/*
 * Adding some generic site data to start of page for SEO
 * Added here to keep the header.php clean
 */
function wp_easy_body_open()
{
    $summary = wp_easy_get_summary();
    $title = wp_easy_get_title();
?>
    <div class="wp-seo">
        <h1><?= $title; ?></h1>
        <p><?= $summary; ?></p>
    </div>
<?php
}
add_action('wp_body_open', 'wp_easy_body_open');

/*
 * Helper function to get a summary for the current page
 */
function wp_easy_get_summary()
{
    global $post;

    $summary = get_bloginfo('description');

    if (is_single() or is_page()) {
        // Generate an excerpt
        $summary = get_the_excerpt() ?: wp_trim_excerpt(strip_shortcodes($post->post_content));
    }

    // Remove any links, tags or line breaks from summary
    $summary = $summary ?: get_bloginfo('description');
    $summary = strip_tags($summary);
    $summary = esc_attr($summary);
    $summary = preg_replace('!\s+!', ' ', $summary);

    return $summary;
}

/*
 * Helper function to get a title for the current page
 */
function wp_easy_get_title()
{
    global $post;

    $title = trim(wp_title('', false));

    if (is_home() or is_front_page()) {
        $title = get_bloginfo('name');
    }

    return $title;
}
