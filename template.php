<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" <?php body_class('layout-default'); ?>>

<head>
    <?php
    ob_start();
    use_layout();
    $layout = ob_get_clean();

    // This is required by WordPress
    wp_head();
    ?>
</head>

<body>
    <?php
    // This is required by WordPress
    wp_body_open();

    echo $layout;

    // This is required by WordPress
    wp_footer();
    ?>
</body>

</html>