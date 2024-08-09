<?php

/**
 * This file is the main entry point for WordPress functions.
 *
 */

/**
 * Load all required modules.
 */
require_once get_template_directory() . '/functions/utils.php';
require_once get_template_directory() . '/functions/wp.php';
require_once get_template_directory() . '/functions/og-tags.php';
require_once get_template_directory() . '/functions/framework.php';
require_once get_template_directory() . '/functions/images.php';
require_once get_template_directory() . '/functions/plugin-manifest.php';
require_once get_template_directory() . '/functions/libs/no-comments-please.php';
require_once get_template_directory() . '/functions/libs/WpEasyRouter.php';
require_once get_template_directory() . '/router.php';
