<?php
/**
 * Class Utils file
 *
 * @package WpEasyTheme
 */

namespace WpEasyTheme;

/**
 * Class Utils
 *
 * @package WpEasy
 */
class Utils {

	/**
	 * Helper function to return the favicon URL.
	 *
	 * @return string
	 */
	public static function get_favicon_url() {
		if ( has_site_icon() ) {
			$favicon_url = get_site_icon_url();
		} else {
			$favicon_url = self::get_template_url( 'images/favicon.png' );
		}
		return $favicon_url;
	}

	/**
	 * Get template directory url.
	 *
	 * @param string $path_relative Relative path string.
	 *
	 * @return string
	 */
	public static function get_template_url( $path_relative = '' ) {
		return trailingslashit( get_template_directory_uri() ) . ltrim( $path_relative, '/\\' );
	}

	/**
	 * Get template directory url.
	 *
	 * @param string $path_relative Relative path string.
	 *
	 * @return string
	 */
	public static function get_template_directory( $path_relative = '' ) {
		return trailingslashit( get_template_directory() ) . ltrim( $path_relative, '/\\' );
	}

}
