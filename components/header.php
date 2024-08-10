<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" <?php body_class(); ?>>

<head>
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>

    <header class="header">
        <img data-svg class="svg" src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
    </header>