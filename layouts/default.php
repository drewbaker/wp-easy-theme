<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" <?php body_class(); ?>>

<head>
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>

    <?php use_component('header'); ?>

    <h1>Default Layout</h1>

    <?php use_outlet(); ?>

    <?php use_component('footer'); ?>

    <?php wp_footer(); ?>
</body>

</html>