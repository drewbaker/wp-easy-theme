<?php

/**
 * First we need to autoload WP_Easy.
 */



/**
 * Then we run the bootloader
 */

if( ! function_exists( 'wp_easy_bootloader' ) ) {
	wp_die( __( 'Install the bootloader!', 'wp-easy-starter' ) );
}

wp_easy_bootloader()->run();

/**
 * Do other things. 
 */
