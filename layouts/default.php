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
    ?>

    <?php use_component('header'); ?>

    <?php use_outlet(); ?>

    <?php use_component('footer'); ?>

    <?php
    // This is required by WordPress
    wp_footer();
    ?>
</body>

</html>