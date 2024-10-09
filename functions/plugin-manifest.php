<?php

/**
 * This file handles the required plugins for the theme.
 */

// Require tgm plugin.
require_once get_template_directory() . '/functions/libs/class-tgm-plugin-activation.php';

/**
 * Register required plugins for the theme.
 */
function fuxt_register_required_plugins()
{

    // Change these values to install new versions of plugins
    $config = array(
        'id'           => 'wp-easy',                  // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                    // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    $plugins = array(
        // array(
        // 	'name'         => 'Advanced Custom Fields Pro',
        // 	'slug'         => 'advanced-custom-fields-pro',
        // 	'external_url' => 'https://www.advancedcustomfields.com/pro/',
        // 	'required'     => false,
        // ),
        array(
            'name'     => 'Nested Pages',
            'slug'     => 'wp-nested-pages',
            'required' => false,
        ),
        array(
            'name'     => 'Classic Editor',
            'slug'     => 'classic-editor',
            'required' => false,
        ),
        array(
            'name'         => 'WP Easy',
            'slug'         => 'wp-easy',
            'external_url' => 'https://github.com/drewbaker/wp-easy-theme/archive/refs/heads/main.zip',
            'required'     => true,
        ),
    );

    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'fuxt_register_required_plugins');
