<template>
    <footer class="footer">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'container'      => 'nav',
            'container_aria_label' => __('Footer', 'wp-easy'),
            'menu_class'     => 'footer-menu',
            'depth'          => 1,
            'fallback_cb'    => false,
        ));
        ?>
        <p class="footer-copyright">&copy; <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?></p>
    </footer>
</template>

<style>
    .footer {
        padding: 40px;

        @media #{$lt-phone} {
            padding: 24px 20px;
        }
    }
    .footer-menu {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 24px;
        margin: 0 0 16px;
        padding: 0;
        list-style: none;

        a {
            color: inherit;
        }
    }
    .footer-copyright {
        margin: 0;
    }
</style>
