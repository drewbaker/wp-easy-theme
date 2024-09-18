<?php

/**
 * Class Template file
 *
 * @package WpEasyTheme
 */

namespace WpEasyTheme;

/**
 * Class Utils
 *
 * @package WpEasyTheme
 */
class Template {

	/**
	 * Init function
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );

		add_action( 'wp_head', array( $this, 'print_importmaps' ) );
	}

	/**
	 * Enqueue Custom Styles
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'fonts', get_theme_file_uri() . '/styles/fonts.css', [], null, 'all' );
		wp_enqueue_style( 'variables', get_theme_file_uri() . '/styles/variables.scss', [], null, 'all' );
		wp_enqueue_style( 'main', get_theme_file_uri() . '/styles/main.scss', [], null, 'all' );
	}

	/**
	 * Enqueue Custom Scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );

		// Enqueue all JS files in /js/libs
		$this->auto_enqueue_libs();

		// Enqueue wp-easy scripts
		wp_enqueue_script_module( 'main', get_theme_file_uri() . '/scripts/main.js', [ 'jquery' ], [], null, true );
		wp_enqueue_script_module( 'fonts', get_theme_file_uri() . '/scripts/fonts.js', [], null, true );

		// Setup JS variables in scripts
		wp_localize_script(
			'jquery',
			'serverVars',
			array(
				'themeURL' => get_template_directory_uri(),
				'homeURL'  => home_url(),
			)
		);
	}

	/**
	 * Helper function to enqueue all JS files in /js/libs
	 */
	private function auto_enqueue_libs() {
		$libs = glob( Utils::get_template_directory( 'scripts/libs/*.js' ) );
		foreach ( $libs as $lib ) {
			// Remove file extension and version numbers for the handle name of the script
			$handle = basename( $lib, '.js' );
			$handle = str_replace( [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'js', '..' ], '', $handle );
			$handle = rtrim( $handle, '.' );
			wp_enqueue_script( $handle, get_theme_file_uri() . '/scripts/libs/' . basename( $lib ), [], null, [] );
		}
	}

	/**
	 * Adding JS moudle importmaps to the head, allows easier naming of JS imports.
	 */
	public function print_importmaps() {
		// Directories to find JS files in, the setup ES6 import maps for
		$directories = [
			// namespace => path
			''       => '/scripts',
			'utils/' => '/scripts/utils',
		];

		$urls = [];
		foreach ( $directories as $namespace => $path ) {
			$files = glob( Utils::get_template_directory( $path . '/*.js' ) );
			foreach ( $files as $file ) {
				$urls[ $namespace . basename( $file, '.js' ) ] = get_template_directory_uri() . $path . '/' . basename( $file );
			}
		}

		$imports = [
			'imports' => [
				...$urls,
			],
		];
		?>

		<script type="importmap">
			<?php echo json_encode( $imports ); ?>
		</script>

		<?php
	}
}
