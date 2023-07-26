<?php
    // $post is avaible in the layout file.
    
    // The html_class() will automatically include `route-${get_route_name()}` in it.
?>

<html <?php language_attributes(); ?> <?php html_class(); ?>>
    <head>
        <?php wp_head();?>
    </head>

    <body <?php body_class(['layout']); ?>>
    
        <?php use_component('header'); ?>

        <?php page_outlet();?>

        <?php wp_footer(); ?>
    </body>
</html>

<style>
    .layout {
        margin: 0;
        padding: 0;
    }
</style>