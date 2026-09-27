<template>
    <header class="header">
        <a class="header-home" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <?php bloginfo('name'); ?>
        </a>

        <?php
        // Links come from the "Primary navigation" menu location (Appearance > Menus).
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => 'nav',
            'container_class' => 'header-nav',
            'container_aria_label' => __('Primary', 'wp-easy'),
            'menu_class'     => 'header-menu',
            'depth'          => 1,
            'fallback_cb'    => false,
        ));
        ?>
    </header>
</template>

<style>
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 20px 40px;

        @media #{$lt-phone} {
            flex-direction: column;
            align-items: flex-start;
            padding: 16px 20px;
        }
    }
    .header-home {
        color: inherit;
        text-decoration: none;
        font-weight: 600;
    }
    .header-menu {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 24px;
        margin: 0;
        padding: 0;
        list-style: none;

        a {
            color: inherit;
            text-decoration: none;
        }
        .current-menu-item > a,
        a:hover,
        a:focus-visible {
            text-decoration: underline;
        }
    }
</style>
