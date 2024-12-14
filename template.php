<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" <?php body_class('layout-default'); ?>>

<head>
    <?php
    // This is required by WordPress
    wp_head();
    ?>
</head>

<body>
    <?php
    // This is required by WordPress
    wp_body_open();

	$layout = get_query_var( 'layout', 'default' );
	use_layout( $layout );

    // This is required by WordPress
    wp_footer();
    ?>
</body>

</html>