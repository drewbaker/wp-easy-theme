<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" <?php body_class(); ?>>

<head>
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>

    <?php use_component('header'); ?>

    <main class="template-fallback page">

        The router.php file had no matching route. This is the fallback template.

    </main>

    <?php use_component('footer'); ?>
    <?php wp_footer(); ?>
</body>

</html>