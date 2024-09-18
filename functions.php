<?php

/**
 * This file is the main entry point for WordPress functions.
 *
 */

/**
 * Load all required modules.
 */
require_once get_template_directory() . '/includes/class-utils.php';
require_once get_template_directory() . '/includes/class-override.php';

( new \WpEasyTheme\Override() )->init();
